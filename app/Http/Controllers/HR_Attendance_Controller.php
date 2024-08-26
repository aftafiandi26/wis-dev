<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Attendance_Questions;
use App\Dept_Category;
use App\Project_Category;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class HR_Attendance_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function index()
    {
        $users = User::where('active', 1)->where('dept_category_id', 6)->orderBy('first_name', 'asc')->get();

        return view('HRDLevelAcces.attendances.index', compact(['users']));
    }

    public function  datatables()
    {
        $waktu = Carbon::today();

        if (!isset($_COOKIE['date-time-start'])) {
            $start = $waktu->copy()->subDay(7);
        } else {
            $start = $_COOKIE['date-time-start'];
        }

        if (!isset($_COOKIE['date-time-end'])) {
            $end = $waktu->copy();
        } else {
            $end = $_COOKIE['date-time-end'];
        }

        $query = Attendance::whereDATE('start', '>=', $start)->whereDATE('start', '<=', $end)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('nik', function (Attendance $att) {
                return $att->user()->nik;
            })
            ->addColumn('employes', function (Attendance $att) {
                return User::find($att->user_id)->getFullName();
            })
            ->addColumn('department', function (Attendance $att) {
                return User::find($att->user_id)->getDepartment();
            })
            ->addColumn('dateStart', function (Attendance $att) {
                $return = null;
                if ($att->start) {
                    $return = date('Y-m-d', strtotime($att->start));
                }
                return $return;
            })
            ->addColumn('timeStart', function (Attendance $att) {
                $return = Null;
                if ($att->start) {
                    $return = date('H:i:s', strtotime($att->start));
                }
                return $return;
            })
            ->addColumn('timeEnded', function (Attendance $att) {
                $return = null;
                if ($att->end) {
                    $return = date('H:i:s', strtotime($att->end));
                }
                return $return;
            })
            ->addColumn('actions', 'HRDLevelAcces.attendances.actions')
            ->rawColumns(['actions'])
            ->editColumn('durations', function (Attendance $att) {
                $minutes = $att->durations; // Misalnya, jumlah menit yang ingin Anda konversi

                // Hitung jumlah jam, sisa menit, dan jumlah hari
                $days = floor($minutes / (60 * 24)); // Hitung jumlah hari
                $hours = floor(($minutes % (60 * 24)) / 60); // Mengonversi sisa menit ke jam
                $remainingMinutes = $minutes % 60; // Menemukan sisa menit setelah konversi
                $second = 00;

                // Format waktu ke dalam string
                $timeString = sprintf("%02d:%02d", $hours, $remainingMinutes); // Format jam, menit, dan hari menjadi string HH:MM:SS   

                return $timeString;
            })
            ->make(true);
    }

    public function edit($id)
    {
        $data = Attendance::with(['relationsUser'])->find($id);

        return view('HRDLevelAcces.attendances.modalEdit', compact(['data']));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'start'     => 'required',
            'end'       => 'required',
            'status'    => 'required',
        ];

        $startTime = new DateTime($request->input('start'));
        $endTime = new DateTime($request->input('end'));

        $interval = $startTime->diff($endTime);

        $convertDay = $interval->format('%d');
        $convertHours = $interval->format('%h');
        $convertMinutes = $interval->format('%i');

        $convertDay = $convertDay * 24;
        $convertHours = $convertDay + $convertHours;
        $convertHours = $convertHours * 60;
        $convertMinutes = $convertHours + $convertMinutes;

        $data = [
            'in'         => true,
            'out'        => true,
            'start'      => $request->input('start'),
            'end'        => $request->input('end'),
            'status_in'  => $request->input('status'),
            'status_out' => $request->input('status'),
            'remarks'    => $request->input('remarks'),
            'durations'  => $convertMinutes
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('hr/summary/attendance/index')
                ->withErrors($validator)
                ->withInput();
        }
        Attendance::find($id)->update($data);
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'The recorded data has been updated']));
        return redirect()->route('hr/summary/attendance/index');
    }

    public function delete($id)
    {
        $data = Attendance::with(['relationsUser'])->find($id);

        return view('HRDLevelAcces.attendances.modalDelete', compact(['data']));
    }

    public function removed(Request $request, $id)
    {
        Attendance::find($id)->delete();
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'The recorded data has been removed']));
        return redirect()->route('hr/summary/attendance/index');
    }

    public function insert(Request $request)
    {
        $rules = [
            'employes'      => 'required',
            'start'         => 'required',
            'end'           => 'required',
            'status'        => 'required',
        ];

        $startTime = new DateTime($request->input('start'));
        $endTime = new DateTime($request->input('end'));

        $interval = $startTime->diff($endTime);

        $convertDay = $interval->format('%d');
        $convertHours = $interval->format('%h');
        $convertMinutes = $interval->format('%i');

        $convertDay = $convertDay * 24;
        $convertHours = $convertDay + $convertHours;
        $convertHours = $convertHours * 60;
        $convertMinutes = $convertHours + $convertMinutes;

        $data = [
            'user_id'    => $request->input('employes'),
            'in'         => true,
            'out'        => true,
            'start'      => $request->input('start'),
            'end'        => $request->input('end'),
            'status_in'  => $request->input('status'),
            'status_out' => $request->input('status'),
            'remarks'    => $request->input('remarks'),
            'durations'  => $convertMinutes
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('hr/summary/attendance/index')
                ->withErrors($validator)
                ->withInput();
        }

        Attendance::create($data);
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'The recorded data has been inserted']));
        return redirect()->route('hr/summary/attendance/index');
    }

    public function convertEmp(Request $request)
    {
        $selectEmp = $request->input('emp');
        $empDateStarted = $request->input('empStarted');
        $empDateEnded = $request->input('empEnded');

        return redirect()->route('hr/summary/attendance/summary/employes', compact(['selectEmp', 'empDateStarted', 'empDateEnded']));
    }

    public function summaryEmp($selectEmp, $empDateStarted, $empDateEnded)
    {

        $users = User::where('active', 1)->where('dept_category_id', 6)->orderBy('first_name', 'asc')->get();
        $emp = User::find($selectEmp);
        $dataArray = [$selectEmp, $empDateStarted, $empDateEnded];

        return view('HRDLevelAcces.attendances.summary.index', compact(['users', 'emp', 'dataArray']));
    }

    public function dataSummaryEmp($selectEmp, $empDateStarted, $empDateEnded)
    {

        $query = Attendance::where('user_id', $selectEmp)->whereDATE('start', '>=', $empDateStarted)->whereDATE('start', '<=', $empDateEnded)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('nik', function (Attendance $attendance) {
                return $attendance->user()->nik;
            })
            ->addColumn('fullname', function (Attendance $attendance) {
                return $attendance->user()->getFullName();
            })
            ->addColumn('dept', function (Attendance $attendance) {
                return $attendance->user()->getDepartment();
            })
            ->addColumn('dated', function (Attendance $attendance) {
                return date('Y-m-d', strtotime($attendance->start));
            })
            ->addColumn('checkIn', function (Attendance $attendance) {
                return date('H:i:s', strtotime($attendance->start));
            })
            ->addColumn('checkOut', function (Attendance $attendance) {
                if ($attendance->end) {
                    return date('H:i:s', strtotime($attendance->end));
                }
                return null;
            })
            ->addColumn('time', function (Attendance $attendance) {
                $minutes = $attendance->durations; // Misalnya, jumlah menit yang ingin Anda konversi

                // Hitung jumlah jam, sisa menit, dan jumlah hari
                $days = floor($minutes / (60 * 24)); // Hitung jumlah hari
                $hours = floor(($minutes % (60 * 24)) / 60); // Mengonversi sisa menit ke jam
                $remainingMinutes = $minutes % 60; // Menemukan sisa menit setelah konversi
                $second = 00;

                // Format waktu ke dalam string
                $timeString = sprintf("%02d:%02d", $hours, $remainingMinutes); // Format jam, menit, dan hari menjadi string HH:MM:SS   

                return $timeString;
            })
            ->addColumn('actions', function (Attendance $attendance) use ($selectEmp, $empDateStarted, $empDateEnded) {
                $id = $attendance->id;

                return view('HRDLevelAcces.attendances.summary.actions', compact(['id', 'selectEmp', 'empDateStarted', 'empDateEnded']));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function SummaryEmpEdit($id, $selectEmp, $empDateStarted, $empDateEnded)
    {
        $data = Attendance::with(['relationsUser'])->find($id);
        $dataArray = [$selectEmp, $empDateStarted, $empDateEnded];

        return view('HRDLevelAcces.attendances.summary.modalEdit', compact(['data', 'dataArray']));
    }

    public function SummaryEmpUpdate(Request $request, $id)
    {
        $attendance = Attendance::find($id);

        $rules = [
            'start' => 'required',
            'end' => 'required',
        ];

        $startTime = new DateTime($request->input('start'));
        $endTime = new DateTime($request->input('end'));

        $interval = $startTime->diff($endTime);

        $convertDay = $interval->format('%d');
        $convertHours = $interval->format('%h');
        $convertMinutes = $interval->format('%i');

        $convertDay = $convertDay * 24;
        $convertHours = $convertDay + $convertHours;
        $convertHours = $convertHours * 60;
        $convertMinutes = $convertHours + $convertMinutes;

        $data = [
            'start' => $request->input('start'),
            'end'   => $request->input('end'),
            'status_in' => $request->input('status'),
            'status_out' => $request->input('status'),
            'remarks'   => $request->input('remarks'),
            'durations' => $convertMinutes
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $attendance->update($data);

        Session::flash('success', Lang::get('messages.data_custom', ['data' => $attendance->user()->getFullName() . " attendance updated."]));
        return redirect()->route('hr/summary/attendance/summary/employes', [$request->input('selectEmp'), $request->input('empDateStarted'), $request->input('empDateEnded')]);
    }

    public function DeleteEmp($id, $selectEmp, $empDateStarted, $empDateEnded)
    {
        $data = Attendance::find($id);
        $dataArray = [$selectEmp, $empDateStarted, $empDateEnded];

        return view('HRDLevelAcces.attendances.summary.modalDelete', compact(['data', 'dataArray']));
    }

    public function removeEmp(Request $request, $id)
    {
        $attendance = Attendance::find($id);

        $notif = date('Y-m-d', strtotime($attendance->start)) . " has been removed";
        $attendance->delete();
        Session::flash('message', Lang::get('messages.data_custom', ['data' => $notif]));
        return redirect()->route('hr/summary/attendance/summary/employes', [$request->input('selectEmp'), $request->input('empDateStarted'), $request->input('empDateEnded')]);
    }

    public function reset($id)
    {

        $attendance = Attendance::find($id);

        $data = [
            'out'       => false,
            'end'       => null,
            'durations' => 0,
        ];

        $attendance->update($data);

        Session::flash('message', Lang::get('messages.data_custom', ['data' => $attendance->user()->getFullName() . ' attendance has been reset.']));
        return redirect()->route('hr/summary/attendance/index');
    }

    public function getChart(Request $request)
    {
        if (empty($request->input('start'))) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, please check date inputed']));
            return redirect()->route('hr/summary/attendance/index');
        }

        if (empty($request->input('end'))) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, please check date inputed']));
            return redirect()->route('hr/summary/attendance/index');
        }

        $start = $request->input('start');
        $end = $request->input('end');

        return redirect()->route('hr/summary/attendance/chart', compact(['start', 'end']));
    }

    public function chart($start, $end)
    {
        $attendances = Attendance::with('relationsQuest')->where('quest_id', '!=', null)->whereDate('start', '>=', $start)->whereDate('start', '<=', $end)->where('in', true)->get();
        $getProjects = Project_Category::whereIn('actived', [1, 2])->orderBy('project_name', 'asc')->get();

        // dd($attendances);

        $arrayProject = [];

        foreach ($getProjects as $a) {
            $arrayProject[] = $a->project_name;
        }

        $Q1_ver_unpleasent = [];
        $Q1_unpleasent = [];
        $Q1_neutral = [];
        $Q1_pleasent = [];
        $Q1_ver_pleasent = [];

        $Q2_ver_poor = [];
        $Q2_good = [];
        $Q2_ver_good = [];
        $Q2_excellent = [];

        $proj = [];

        foreach ($attendances as $att) {
            $questioner = Attendance_Questions::where('user_id', $att->user_id)->get();

            $projectIds = json_decode($att->relationsQuest->projects, true);
            // dd($att->relationsQuest->projects, $projectIds);

            $projects = Project_Category::whereIn('id', $projectIds)->get();

            foreach ($projects as $project) {
                $proj[] = $project->project_name;
            }

            if ($att->relationsQuest->Q1 === 1) {
                $Q1_ver_unpleasent[] = [$att->relationsQuest->Q1];
            }
            if ($att->relationsQuest->Q1 === 2) {
                $Q1_unpleasent[] = [$att->relationsQuest->Q1];
            }
            if ($att->relationsQuest->Q1 === 3) {
                $Q1_neutral[] = [$att->relationsQuest->Q1];
            }
            if ($att->relationsQuest->Q1 === 4) {
                $Q1_pleasent[] = [$att->relationsQuest->Q1];
            }
            if ($att->relationsQuest->Q1 === 5) {
                $Q1_ver_pleasent[] = [$att->relationsQuest->Q1];
            }

            if ($att->relationsQuest->Q2 === 4) {
                $Q2_excellent[] = [$att->relationsQuest->Q2];
            }
            if ($att->relationsQuest->Q2 === 3) {
                $Q2_ver_good[] = [$att->relationsQuest->Q2];
            }
            if ($att->relationsQuest->Q2 === 2) {
                $Q2_good[] = [$att->relationsQuest->Q2];
            }
            if ($att->relationsQuest->Q2 === 1) {
                $Q2_ver_poor[] = [$att->relationsQuest->Q2];
            }
        }

        $Q1_Total = count($Q1_ver_unpleasent) + count($Q1_unpleasent) + count($Q1_neutral) + count($Q1_pleasent) + count($Q1_ver_pleasent);

        $Q2_Total = count($Q2_excellent) + count($Q2_ver_good) + count($Q2_good) + count($Q2_ver_poor);

        $ver_unpleasent_percent = number_format(count($Q1_ver_unpleasent) / $Q1_Total * 100, 1);
        $unpleasent_percent = number_format(count($Q1_unpleasent) / $Q1_Total * 100, 1);
        $neutral_percent = number_format(count($Q1_neutral) / $Q1_Total * 100, 1);
        $pleasent_percent = number_format(count($Q1_pleasent) / $Q1_Total * 100, 1);
        $ver_pleasent_percent = number_format(count($Q1_ver_pleasent) / $Q1_Total * 100, 1);

        $excellent_percent = number_format(count($Q2_excellent) / $Q2_Total * 100, 1);
        $ver_good_percent = number_format(count($Q2_ver_good) / $Q2_Total * 100, 1);
        $good_percent = number_format(count($Q2_good) / $Q2_Total * 100, 1);
        $ver_poor_percent = number_format(count($Q2_ver_poor) / $Q2_Total * 100, 1);

        $percentages = [
            $ver_unpleasent_percent,
            $unpleasent_percent,
            $neutral_percent,
            $pleasent_percent,
            $ver_pleasent_percent
        ];

        $percent_Q2 = [
            $ver_poor_percent,
            $good_percent,
            $ver_good_percent,
            $excellent_percent
        ];

        $name_counts = array_count_values($proj);

        $counted = [];
        foreach ($name_counts as $name => $count) {
            $counted[] = ['name' => $name, 'count' => $count];
        }

        $result = [];

        foreach ($arrayProject as $sd) {
            $count = 0;
            foreach ($counted as $val) {
                if ($val['name'] === $sd) {
                    $count = $val['count'];
                    break; // Exit the inner loop once a match is found
                }
            }
            $result[] = $count;
        }

        $jsonProject = json_encode($arrayProject, true);
        $jsonResult = json_encode($result, true);

        return view('HRDLevelAcces.attendances.summary.chart', compact(['percentages', 'percent_Q2', 'start', 'end', 'jsonProject', 'jsonResult']));
    }

    public function chartDatatables($start, $end)
    {
        $attendances = Attendance::where('quest_id', '!=', null)->whereDate('start', '>=', $start)->whereDate('start', '<=', $end)->where('in', true)->orderBy('start', 'desc')->get();

        return Datatables::of($attendances)
            ->addIndexColumn()
            ->addColumn('condition', function (Attendance $att) {
                $quest = Attendance_Questions::find($att->quest_id);
                $return = null;

                if ($quest->Q1 === 1) {
                    $return = "Very Unpleasent";
                }
                if ($quest->Q1 === 2) {
                    $return = "Unpleasent";
                }
                if ($quest->Q1 === 3) {
                    $return = "Neutral";
                }
                if ($quest->Q1 === 4) {
                    $return = "Pleasent";
                }
                if ($quest->Q1 === 5) {
                    $return = "Very Pleasent";
                }

                return $return;
            })
            ->addColumn('health', function (Attendance $att) {
                $quest = Attendance_Questions::find($att->quest_id);
                $return = null;

                if ($quest->Q2 === 1) {
                    $return = "Very Poor";
                }
                if ($quest->Q2 === 2) {
                    $return = "Good";
                }
                if ($quest->Q2 === 3) {
                    $return = "Very Good";
                }
                if ($quest->Q2 === 4) {
                    $return = "Excellent";
                }

                return $return;
            })
            ->addColumn('nik', function (Attendance $att) {
                $user = User::find($att->user_id);

                return $user->nik;
            })
            ->addColumn('employes', function (Attendance $att) {
                $user = User::find($att->user_id);
                return $user->getFullName();
            })
            ->addColumn('projects', function (Attendance $att) {
                $idProjects = Attendance_Questions::find($att->quest_id);
                $array = json_decode($idProjects->projects, true);

                $return = [];

                foreach ($array as $arr) {
                    $get = Project_Category::find($arr);

                    $return[] = ' ' . $get->project_name;
                }

                $return = json_encode($return, true);

                return $return;
            })
            ->make(true);
    }
}