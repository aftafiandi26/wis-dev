<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\ForfeitedCounts;
use App\Leave;
use Carbon\Carbon;
use DateTime;
use Greggilbert\Recaptcha\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;

class AllEmployes_AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'attendance']);
    }

    private function getCookies()
    {
        return $_COOKIE['checkIn'];
    }

    private function header()
    {
        return "Attendance";
    }

    private function GeocodingAPI()
    {
        // URL API Google Maps Geocoding
        $api_url = "https://maps.googleapis.com/maps/api/geocode/json?address=nama_lokasi&key=YOUR_API_KEY";

        // Mengambil data dari API
        $response = file_get_contents($api_url);

        // Menguraikan data JSON yang diterima
        $data = json_decode($response);

        // Memeriksa apakah permintaan sukses
        if ($data->status == "OK") {
            // Mengambil latitude dan longitude dari hasil
            $lat = $data->results[0]->geometry->location->lat;
            $lon = $data->results[0]->geometry->location->lng;

            // Menampilkan hasil
            echo "Latitude: $lat<br>";
            echo "Longitude: $lon<br>";
        } else {
            echo "Fail got location address.";
        }
    }

    private function getUserIpAddr()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    private function showMap()
    {
        // $lat = 51.5074;
        // $lon = -0.1278;

        // // Membuat peta
        // $map = Map::createMap();
        // $marker = \Map::createMarker('Marker')->position($lat, $lon);
        // $map->addMarker($marker);

        // return $map;
    }

    public function dataProvinsi()
    {
        $data = asset('response/js/provinsi.js');
        $response = file_get_contents($data);
        $response = json_decode($response, true);

        return $response;
    }

    public function index()
    {

        if (auth()->user()->dept_category_id !== 6) {
            if (auth()->user()->hd == false) {
                if (auth()->user()->id !== 226) {
                    Session::flash('getError', Lang::get('messages.no_access'));
                    return redirect()->route('index');
                }
            }
        }

        $header = $this->header();
        $date = Carbon::now();
        $endOfDay = Carbon::today()->endOfDay();

        $attendance = Attendance::where('user_id', auth()->user()->id)->where('in', 1)->whereDATE('start', date('Y-m-d'))->latest()->first();

        $hidden = "hidden";

        return view('all_employee.Absensi.indexAttendance', compact(['date', 'header', 'hidden', 'attendance', 'endOfDay']));
    }

    public function checkIn()
    {
        $date = Carbon::now();

        return view('all_employee.Absensi.modalCheckIn', compact(['date']));
    }

    public function postCheckIn(Request $request)
    {
        $datetime = Carbon::now();
        $attendance = Attendance::whereDATE('start', date('Y-m-d'))->where('user_id', auth()->user()->id)->first();

        if (empty($request->input('value_work'))) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, your data cannot be recorded']));
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Please, attention to the form you will send']));
            return redirect()->route('attendance/index');
        }

        if ($attendance) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, attendance already exists']));
            return redirect()->route('attendance/index');
        }

        $data = [
            'user_id'   => auth()->user()->id,
            'in'        => true,
            'start'     => $datetime,
            'status_in'    => $request->input('value_work')
        ];

        Attendance::create($data);
        Session::flash('message', lang::get('messages.data_custom', ['data' => "Attendance data has been recorded."]));
        return redirect()->route('attendance/index');
    }

    public function checkOut()
    {
        $date = Carbon::now();
        $attendance = Attendance::where('user_id', auth()->user()->id)->where('in', 1)->where('out', 0)->latest()->first();

        return view('all_employee.Absensi.modalCheckOut', compact(['date', 'attendance']));
    }

    public function postCheckOut(Request $request)
    {
        $datetime = Carbon::now();

        if (empty($request->input('value_work'))) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Please selecct a work option']));
            return redirect()->route('attendance/index');
        }

        $getAttendance = Attendance::where('user_id', auth()->user()->id)->latest()->first();

        $startTime = new DateTime($getAttendance->start);
        $endTime = new DateTime($datetime);

        $interval = $startTime->diff($endTime);

        $convertDay = $interval->format('%d');
        $convertHours = $interval->format('%h');
        $convertMinutes = $interval->format('%i');

        $convertDay = $convertDay * 24;
        $convertHours = $convertDay + $convertHours;
        $convertHours = $convertHours * 60;
        $convertMinutes = $convertHours + $convertMinutes;

        $data = [
            'user_id'   => auth()->user()->id,
            'Out'        => true,
            'end'        => $datetime,
            'durations'  => $convertMinutes,
            'status_out'    => $request->input('value_work'),
        ];

        $getAttendance->update($data);
        Session::flash('message', lang::get('messages.data_custom', ['data' => "Attendance data has been recorded."]));
        return redirect()->route('attendance/index');
    }

    public function dataTables()
    {
        $query = Attendance::where('user_id', auth()->user()->id)->Latest()->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('day', function (Attendance $attendance) {
                $return = new DateTime($attendance->start);
                return $return->format('l');
            })
            ->editColumn('durations', function (Attendance $att) {
                $minutes = $att->durations; // Misalnya, jumlah menit yang ingin Anda konversi

                // Hitung jumlah jam, sisa menit, dan jumlah hari
                $days = floor($minutes / (60 * 24)); // Hitung jumlah hari
                $hours = floor(($minutes % (60 * 24)) / 60); // Mengonversi sisa menit ke jam
                $remainingMinutes = $minutes % 60; // Menemukan sisa menit setelah konversi
                $second = 00;

                // Format waktu ke dalam string
                $timeString = sprintf("%02d:%02d:%02d:%02d", $days, $hours, $remainingMinutes, $second); // Format jam, menit, dan hari menjadi string HH:MM:SS               


                return $timeString;
            })
            ->make(true);
    }
}