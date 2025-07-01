<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Attendance_Questions;
use App\ForfeitedCounts;
use App\Leave;
use App\Mail\HRD\Attendance\feedbackFeelMail;
use App\Mail\IT\Notify\NoticeAttendanceMails;
use App\Project_Category;
use App\ProjectGroup;
use Carbon\Carbon;
use DateTime;
use Greggilbert\Recaptcha\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Str;

class AllEmployes_AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
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

    private function projected()
    {
        $projects = Project_Category::where('actived', 1)->get();

        $project1 = auth()->user()->project_category_id_1;
        $project2 = auth()->user()->project_category_id_2;
        $project3 = auth()->user()->project_category_id_3;
        $project4 = auth()->user()->project_category_id_4;
        $project5 = auth()->user()->project_category_id_5;

        $idProject1 = null;
        $idProject2 = null;
        $idProject3 = null;
        $idProject4 = null;
        $idProject5 = null;

        if ($project1) {
            $project1Name = $projects->find($project1);
            $project1 = null;
            $idProject1 = null;
            if ($project1Name) {
                $group = ProjectGroup::find($project1Name->group);
                $project1 = null;
                $idProject1 = null;
                if ($group) {
                    $project1 = $group->group_name;
                    $idProject1 = $group->id;
                }
            }
        }

        if ($project2) {
            $project2Name = $projects->find($project2);
            $project2 = null;
            $idProject2 = null;
            if ($project2Name) {
                $group = ProjectGroup::find($project2Name->group);
                $project2 = null;
                $idProject2 = null;
                if ($group) {
                    $project2 = $group->group_name;
                    $idProject2 = $group->id;
                }
            }
        }

        if ($project3) {
            $project3Name = $projects->find($project3);
            $project3 = null;
            $idProject3 = null;
            if ($project3Name) {
                $group = ProjectGroup::find($project3Name->group);
                $project3 = null;
                $idProject3 = null;
                if ($group) {
                    $project3 = $group->group_name;
                    $idProject3 = $group->id;
                }
            }
        }

        if ($project4) {
            $project4Name = $projects->find($project4);
            $project4 = null;
            $idProject4 = null;
            if ($project4Name) {
                $group = ProjectGroup::find($project4Name->group);
                $project4 = null;
                $idProject4 = null;
                if ($group) {
                    $project4 = $group->group_name;
                    $idProject4 = $group->id;
                }
            }
        }

        if ($project5) {
            $project5Name = $projects->find($project5);
            $project5 = null;
            $idProject5 = null;
            if ($project5Name) {
                $group = ProjectGroup::find($project5Name->group);
                $project5 = null;
                $idProject5 = null;
                if ($group) {
                    $project5 = $group->group_name;
                    $idProject5 = $group->id;
                }
            }
        }

        $viewProjects = [$project1, $project2, $project3, $project4, $project5];
        $viewIdProjects = [$idProject1, $idProject2, $idProject3, $idProject4, $idProject5];

        $array = [$viewIdProjects, $viewProjects];

        return $array;
    }

    public function dataProvinsi()
    {
        $data = asset('response/js/provinsi.js');
        $response = file_get_contents($data);
        $response = json_decode($response, true);

        return $response;
    }

    public function feels($object)
    {
        // $array = [
        //     '1' => 'Distressed',
        //     '2' => 'Unhappy',
        //     '3' => 'Neutral',
        //     '4' => 'Happy',
        //     '5' => 'Very Happy'
        // ];
        // update 18-06-2025

        $array = [
            '1' => 'Very Unpleasant',
            '2' => 'Unpleasant',
            '3' => 'Neutral',
            '4' => 'Pleasant',
            '5' => 'Very Pleasant'
        ];

        // Memeriksa apakah $object ada dalam array dan mengembalikan nilainya
        if (array_key_exists($object, $array)) {
            return $array[$object]; // Mengembalikan value sesuai dengan key
        }

        return "**********"; // Mengembalikan null jika key tidak ditemukan
    }

    public function health($object)
    {
        // $array = [
        //     1 => "Severely Unhealthy",
        //     2 => "Not Feeling Well",
        //     3 => "Healthy"
        // ];
        // update 18-06-2025

        $array = [
            1 => "Very Poor",
            2 => "Poor",
            3 => "Good",
            4 => "Very Good",
            5 => "Excellent"
        ];

        if (array_key_exists($object, $array)) {
            return $array[$object];
        }

        return "*********";
    }

    public function index()
    {
        $header = $this->header();
        $date = Carbon::now();
        $endOfDay = Carbon::today()->endOfDay();

        $attendance = Attendance::where('user_id', auth()->user()->id)->where('in', 1)->whereDATE('start', date('Y-m-d'))->latest()->first();

        $feeled = Attendance::with('relationsQuest')->where('user_id', auth()->user()->id)->orderBy('start', 'desc')->first();

        if ($feeled->relationsQuest) {
            $Q1 = $feeled->relationsQuest->Q1;
            $noteQ1 = false;
            $Q2 = $feeled->relationsQuest->Q2;
            $noteQ2 = false;

            if ($Q1 <= 2) {
                $noteQ1 = true;
            }

            if ($Q2 <= 2) {
                $noteQ2 = true;
            }
        } else {
            $noteQ1 = false;
            $noteQ2 = false;
        }

        $hidden = "hidden";
        return view('all_employee.Absensi.indexAttendance', compact(['date', 'header', 'hidden', 'attendance', 'endOfDay', 'noteQ1', 'noteQ2']));
    }

    public function modalFeel()
    {
        $feeled = Attendance::with('relationsQuest')->where('user_id', auth()->user()->id)->orderBy('start', 'desc')->first();

        $q1 = $feeled->relationsQuest->Q1;
        $q2 = $feeled->relationsQuest->Q2;

        if ($q1 < 3) {
            $bitFeel = "feel";
        } else {
            if ($q2 < 3) {
                $bitFeel = "health";
            } else {
                $bitFeel = null;
            }
        }

        return view('all_employee.Absensi.modalFeel', compact(['bitFeel']));
    }

    public function checkIn()
    {
        $date = Carbon::now();

        $arrayProject = $this->projected();

        $viewProjects = $arrayProject[1];
        $viewIdProjects = $arrayProject[0];

        $groups = ProjectGroup::where('active', true)->orderBy('group_name', 'asc')->get();

        return view('all_employee.Absensi.modalCheckIn', compact(['date', 'viewIdProjects', 'viewProjects', 'groups']));
    }



    public function postCheckIn(Request $request)
    {
        // $projectJSON = json_encode($request->input('project'));

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

        if (empty($request->input('feel'))) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, Choose how you are feeling right now !!']));
            return redirect()->route('attendance/index');
        }

        if (empty($request->input('health'))) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, choose your current health status !!']));
            return redirect()->route('attendance/index');
        }

        if (empty($request->input('project'))) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, your project is empty!']));
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Please check your project.']));
            return redirect()->route('attendance/index');
        }

        $project = ProjectGroup::find($request->input('project'));

        if ($project->active == false) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, ' . $project->group_name . ' has been completed, you cannot choose this project']));
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'If you want choose this project, please contact administrator']));
            return redirect()->route('attendance/index');
        }

        $qeu = [
            'user_id'   => auth()->user()->id,
            'Q1'        => $request->input('feel'),
            'Q2'        => $request->input('health'),
            'group'     => $project->id,
            'will_do'   => $request->input('being')
        ];

        Attendance_Questions::create($qeu);

        $question = Attendance_Questions::where('user_id', auth()->user()->id)->latest()->first();

        $data = [
            'user_id'      => auth()->user()->id,
            'in'           => true,
            'start'        => $datetime,
            'status_in'    => $request->input('value_work'),
            'quest_id'     => $question->id,
        ];

        Attendance::create($data);
        Mail::to('dede.aftafiandi@infinitestudios.id')->send(new NoticeAttendanceMails($data));
        Session::flash('message', lang::get('messages.data_custom', ['data' => "Attendance data has been recorded."]));
        return redirect()->route('attendance/index');
    }

    public function formQuestions(Request $request)
    {
        dd($request->all());
    }

    public function checkOut()
    {
        $date = Carbon::now();
        $attendance = Attendance::with(['relationsQuest'])->where('user_id', auth()->user()->id)->where('in', 1)->where('out', 0)->latest()->first();

        $arrayProject = $this->projected();

        $viewProjects = $arrayProject[1];
        $viewIdProjects = $arrayProject[0];

        return view('all_employee.Absensi.modalCheckOut', compact(['date', 'attendance', 'viewProjects', 'viewIdProjects']));
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
            ->addColumn('nameQ1', function (Attendance $att) {

                if ($att->quest_id) {
                    $quest = Attendance_Questions::find($att->quest_id);

                    return $quest->nameQ1();
                }

                return "";
            })
            ->addColumn('nameQ2', function (Attendance $att) {

                if ($att->quest_id) {
                    $quest = Attendance_Questions::find($att->quest_id);
                    return $quest->nameQ2();
                }

                return "";
            })
            ->addColumn('projects', function (Attendance $att) {
                if ($att->quest_id) {

                    $quest = Attendance_Questions::find($att->quest_id);
                    if ($quest->group) {
                        $project = ProjectGroup::find($quest->group);
                        return $project->group_name;
                    }
                }

                return "";
            })
            ->make(true);
    }

    public function checkInYes()
    {
        $date = Carbon::now();

        $arrayProject = $this->projected();

        $viewProjects = $arrayProject[1];
        $viewIdProjects = $arrayProject[0];

        $groups = ProjectGroup::where('active', true)->orderBy('group_name', 'asc')->get();
        $feeled = Attendance::with('relationsQuest')->where('user_id', auth()->user()->id)->orderBy('start', 'desc')->first();

        $q1 = $feeled->relationsQuest->Q1;
        $q2 = $feeled->relationsQuest->Q2;

        return view('all_employee.Absensi.modalCheckIn_yes', compact(['date', 'viewIdProjects', 'viewProjects', 'groups', 'q1', 'q2']));
    }

    public function postCheckInYes(Request $request)
    {
        // $projectJSON = json_encode($request->input('project'));

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

        if (empty($request->input('feel'))) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, Choose how you are feeling right now !!']));
            return redirect()->route('attendance/index');
        }

        if (empty($request->input('health'))) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, choose your current health status !!']));
            return redirect()->route('attendance/index');
        }

        if (empty($request->input('project'))) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, your project is empty!']));
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Please check your project.']));
            return redirect()->route('attendance/index');
        }

        $project = ProjectGroup::find($request->input('project'));

        if ($project->active == false) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, ' . $project->group_name . ' has been completed, you cannot choose this project']));
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'If you want choose this project, please contact administrator']));
            return redirect()->route('attendance/index');
        }

        $qeu = [
            'user_id'   => auth()->user()->id,
            'Q1'        => 2 + $request->input('feel'),
            'Q2'        => 2 + $request->input('health'),
            'group'     => $project->id,
            'will_do'   => $request->input('being')
        ];

        Attendance_Questions::create($qeu);

        $question = Attendance_Questions::where('user_id', auth()->user()->id)->latest()->first();

        $data = [
            'user_id'      => auth()->user()->id,
            'in'           => true,
            'start'        => $datetime,
            'status_in'    => $request->input('value_work'),
            'quest_id'     => $question->id,
        ];

        Attendance::create($data);
        Mail::to('dede.aftafiandi@infinitestudios.id')->send(new NoticeAttendanceMails($data));
        Session::flash('message', lang::get('messages.data_custom', ['data' => "Attendance data has been recorded."]));
        return redirect()->route('attendance/index');
    }

    public function checkInNo()
    {
        $date = Carbon::now();

        $arrayProject = $this->projected();

        $viewProjects = $arrayProject[1];
        $viewIdProjects = $arrayProject[0];

        $groups = ProjectGroup::where('active', true)->orderBy('group_name', 'asc')->get();
        $feeled = Attendance::with('relationsQuest')->where('user_id', auth()->user()->id)->orderBy('start', 'desc')->first();

        $q1 = $feeled->relationsQuest->Q1;
        $q2 = $feeled->relationsQuest->Q2;


        return view('all_employee.Absensi.modalCheckIn_no', compact(['date', 'viewIdProjects', 'viewProjects', 'groups', 'q1', 'q2']));
    }
    public function interCheckInNo()
    {
        $feeled = Attendance::with('relationsQuest')->where('user_id', auth()->user()->id)->orderBy('start', 'desc')->first();

        $q1 = $feeled->relationsQuest->Q1;
        $q2 = $feeled->relationsQuest->Q2;

        if ($q1 < 3) {
            $bitFeel = "feel";
        } else {
            if ($q2 < 3) {
                $bitFeel = "health";
            } else {
                $bitFeel = null;
            }
        }

        return view('all_employee.Absensi.modalCheckIn_no_feedback', compact(['bitFeel']));
    }

    public function postCheckInNo(Request $request)
    {
        $project = $_COOKIE['project'];
        $status_in = $_COOKIE['status_in'];
        $feel = $_COOKIE['feel'];
        $health = $_COOKIE['health'];

        if ($project == "") {
            Session::flash('getError', lang::get('messages.data_custom', ['data' => "Please check your selected."]));
            return redirect()->route('attendance/index');
        }

        if ($status_in == "") {
            Session::flash('getError', lang::get('messages.data_custom', ['data' => "Please check your work status again."]));
            return redirect()->route('attendance/index');
        }

        if ($feel == "" or $health == "") {
            Session::flash('getError', lang::get('messages.data_custom', ['data' => "Your data is empty"]));
            return redirect()->route('attendance/index');
        }

        $datetime = Carbon::now();
        $attendance = Attendance::whereDATE('start', date('Y-m-d'))->where('user_id', auth()->user()->id)->first();

        if ($attendance) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, attendance already exists']));
            return redirect()->route('attendance/index');
        }

        $qeu = [
            'user_id'   => auth()->user()->id,
            'Q1'        => $feel,
            'Q2'        => $health,
            'group'     => $project,
            'will_do'   => $request->input('textArea')
        ];

        // Attendance_Questions::create($qeu);

        $question = Attendance_Questions::where('user_id', auth()->user()->id)->latest()->first();

        $data = [
            'user_id'      => auth()->user()->id,
            'in'           => true,
            'start'        => $datetime,
            'status_in'    => $status_in,
            'quest_id'     => $question->id,
        ];

        // Attendance::create($data);
        $bitFeel = $request->input('bitFeel');

        if ($bitFeel == "feel") {
            $yiu = Attendance_Questions::where('user_id', auth()->user()->id)->latest()->limit(3)->pluck('Q1');
            $de = $yiu->filter(function ($value) {
                return $value < 3;
            });
            $deArray = $de->toArray();
            $deArray = count($deArray);
            if ($deArray >= 3) {
                Mail::to("dede.aftafiandi@infinitestudios.id")->send(new feedbackFeelMail());
            }
        } else if ($bitFeel == "health") {
            $yiu = Attendance_Questions::where('user_id', auth()->user()->id)->latest()->limit(3)->pluck('Q1');
            $de = $yiu->filter(function ($value) {
                return $value < 3;
            });
            $deArray = $de->toArray();
            $deArray = count($deArray);
            if ($deArray >= 3) {
                Mail::to("dede.aftafiandi@infinitestudios.id")->send(new feedbackFeelMail());
            }
        }
        // Mail::to('dede.aftafiandi@infinitestudios.id')->send(new NoticeAttendanceMails($data));
        Session::flash('message', lang::get('messages.data_custom', ['data' => "Attendance data has been recorded."]));
        return redirect()->route('attendance/index');
    }
}