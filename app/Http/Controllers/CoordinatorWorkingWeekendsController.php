<?php

namespace App\Http\Controllers;

use App\Log_WorkingWeekends;
use App\Mail\Form\Weekend_Crew_Mail;
use App\Project_Category;
use App\SendingDataWorkingWeekend;
use App\User;
use App\WorkingOnWeekends;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class CoordinatorWorkingWeekendsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'koor']);
    }

    private function getCookies()
    {
        $employes = $_COOKIE['employes'];

        return $employes;
    }

    public function form()
    {
        $users = User::where('active', 1)->where('dept_category_id', 6)->where('gm', false)->where('hd', false)->orderBy('first_name', 'asc')->get();

        $tableWorkings = Log_WorkingWeekends::where('coor_id', auth()->user()->id)->get();

        $producers = User::where('active', 1)->where('producer', 1)->get();

        $workings = [];

        $eocUser = [];

        $now = Carbon::now();
        $sekarang = Carbon::now();

        $limitEoc = $sekarang->addMonth();

        foreach ($tableWorkings as $key => $work) {
            $user = User::find($work->user_id);

            $workings[] = [
                'id'        => $work->id,
                'no'        => $key + 1,
                'employes'  => $user->getFullName(),
                'position'  => $user->position,
                'project'   => $work->project,
                'start'     => $work->start,
                'end'       => $work->end,
                'time'      => sprintf("%02d:%02d", $work->hourly, $work->minutely),
                'workStat'  => strtoupper($work->workStat),
                'extra'     => title_case($work->extra),
                'eoc'       => "text-red"
            ];
        }

        foreach ($users as $key => $user) {
            $eoc = $user->end_date;

            if (empty($user->end_date)) {
                $eoc = Carbon::now()->addMonth();
            }

            if ($eoc <= $limitEoc) {
                $eocUser[] = $user->getFullName();
            }
        }

        // dd($eocUser, $ape = Carbon::now()->addMonth());

        $eocUser = json_encode($eocUser);


        if ($now->format('N') == 4 and $now->format('H') >= 16) {
            return redirect()->route('coordinator/working/weekends/form/not-accessed');
        }
        if ($now->format('N') > 4) {
            return redirect()->route('coordinator/working/weekends/form/not-accessed');
        }

        return view('all_employee.Form.weekends.form', compact(['users', 'workings', 'producers', 'eocUser']));
    }

    public function formInserModal()
    {
        $employes = $this->getCookies();

        if ($employes === 'null') {
            dd('sorry, your data is null');
        }

        $findUser = User::where('active', 1)->where('dept_category_id', 6)->find($employes);

        return view('all_employee.Form.weekends.modalInsert', compact(['findUser']));
    }

    public function postFormInsert(Request $request)
    {

        $employes = $request->input('user1');

        $user = User::find($employes);

        $now = Carbon::now();
        $limitEoc = $now->addMonth();

        if (empty($user->end_date)) {
            $eoc = Carbon::now()->addYear();
        } else {
            $eoc = $user->end_date;
        }

        if ($eoc <= $limitEoc) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => $user->getFullName() . ' contract period will end soon, please note this ']));
            Session::flash('message', Lang::get('messages.data_custom', ['data' => "Sorry, this employee can not to inserted"]));
            return response()->json(['message' => "Can not inserted"]);
        }

        $timeStart = new DateTime($request->input('local1'));
        $timeEnd = new DateTime($request->input('local2'));

        $countTime = $timeStart->diff($timeEnd);

        $count = $countTime;

        foreach ($request->input('extra') as $extra) {
            $data = [
                'coor_id'   => auth()->user()->id,
                'user_id'   => $employes,
                'project'   => $user->getProjectName($user->project_category_id_1),
                'start'     => $timeStart,
                'end'       => $timeEnd,
                'hourly'    => $count->h,
                'minutely'  => $count->m,
                'workStat'  => $request->input('workStat'),
                'extra'     => $extra
            ];
            Log_WorkingWeekends::create($data);
        }

        Session::flash('message', Lang::get('messages.data_custom', ['data' => $user->getFullName() . ' has been inserted']));
        // return response()->json(['message' => $request->all()]);
        return response()->json(['message' => "Data has been inserted"]);
    }

    public function editDataTable($id)
    {
        $data = Log_WorkingWeekends::find($id);
        $user = User::find($data->user_id);
        $projects = Project_Category::orderBy('project_name', 'asc')->get();

        return view('all_employee.Form.weekends.editData', compact(['data', 'user', 'projects']));
    }

    public function updateData(Request $request, $id)
    {
        $log = Log_WorkingWeekends::find($id);

        $timeStart = new DateTime($request->input('start'));
        $timeEnd = new DateTime($request->input('end'));

        if ($timeStart > $timeEnd) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, Please check your datetime']));
            return redirect()->route('coordinator/working/weekends/form');
        }

        $countTime = $timeStart->diff($timeEnd);

        $count = $countTime;

        $rules = [
            'employes' => 'required',
            'start'     => 'required',
            'end'       => 'required',
            'project'   => 'required'
        ];

        $data = [
            'start'     => $request->input('start'),
            'end'       => $request->input('end'),
            'hourly'    => $count->h,
            'minutely'  => $count->m,
            'project'   => $request->input('project'),
            'workStat'  => $request->input('workStatus'),
            'extra'     => $request->input('over')
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('coordinator/working/weekends/form')
                ->withErrors($validator)
                ->withInput();
        }

        $log->update($data);
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Data ' . $log->user($log->user_id)->getFullName() . ' has been successfully recorded']));
        return redirect()->route('coordinator/working/weekends/form');
    }

    public function deleteData($id)
    {
        $data = Log_WorkingWeekends::find($id);
        $user = User::find($data->user_id);
        $projects = Project_Category::orderBy('project_name', 'asc')->get();

        return view('all_employee.Form.weekends.deleteData', compact(['data', 'user', 'projects']));
    }

    public function removeRecordData($id)
    {
        Log_WorkingWeekends::find($id)->delete();
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Data removed']));
        return redirect()->route('coordinator/working/weekends/form');
    }

    //send data 

    public function sendData(Request $request)
    {
        // $sendData = SendingDataWorkingWeekend::where('coor_id', auth()->user()->id)->latest()->first();
        $sendData = SendingDataWorkingWeekend::orderBy('id', 'desc')->first();
        $status = $sendData;
        $producer = User::find($request->input('producers'));

        if ($sendData == null) {
            $status = 0;
        } else {
            $status = $sendData->id;
        }

        $weekends = Log_WorkingWeekends::where('coor_id', auth()->user()->id)->get();

        if ($dataSending['count'] = 0) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, cannot sending...']));
            return redirect()->route('coordinator/working/weekends/form');
        }

        $statused = ++$status;

        $count = [];

        foreach ($weekends as $key => $weekend) {
            $dataWorkingWeekends = [
                'coor_id' => $weekend->coor_id,
                'user_id' => $weekend->user_id,
                'project' => $weekend->project,
                'status'    => $statused,
                'start'     => $weekend->start,
                'end'       => $weekend->end,
                'hourly'    => $weekend->hourly,
                'minutely'  => $weekend->minutely,
                'workStat'  => $weekend->workStat,
                'producer_id' => $request->input('producers'),
                'extra'     => $weekend->extra
            ];

            $count[] = ++$key;

            WorkingOnWeekends::create($dataWorkingWeekends);
        }

        $dataSending = [
            'coor_id'   => auth()->user()->id,
            'count'     => count($count),
            'status'    => $statused,
            'producer_id' => $request->input('producers'),
        ];

        SendingDataWorkingWeekend::create($dataSending);
        // Mail::to('dede.aftafiandi@infinitestudios.id')->send(new Weekend_Crew_Mail($statused));
        Mail::to($producer->email)->send(new Weekend_Crew_Mail($statused));
        $weekends->each->delete();
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'The Weekend work request form has been successfully submitted.']));
        return redirect()->route('coordinator/working/weekends/form');
    }

    public function notAccessed()
    {
        return view('all_employee.Form.weekends.not_accessed');
    }

    // Summary

    public function summary()
    {
        return view('all_employee.Form.weekends.summary.index');
    }

    public function dataSummary()
    {
        $query = SendingDataWorkingWeekend::where('coor_id', auth()->user()->id)->orderBy('status', 'desc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('formDate', function (SendingDataWorkingWeekend $sent) {
                $asc = WorkingOnWeekends::where('coor_id', $sent->coor_id)->where('status', $sent->status)->orderBy('start', 'asc')->first();

                $ascc = date('Y-m-d', strtotime($asc->start));

                return $ascc;
            })
            ->addColumn('totalCrew', function (SendingDataWorkingWeekend $sent) {
                return $sent->count . " People";
            })
            ->addColumn('listCrew', 'all_employee.Form.weekends.summary.buttonListCrew')
            ->rawColumns(['listCrew'])
            ->editColumn('approved', function (SendingDataWorkingWeekend $sent) {
                $return  = "Err!!";

                if ($sent->ap_producer === 1 and $sent->approved === 1) {
                    $return = "Approved";
                }

                if ($sent->ap_producer === 1 and $sent->approved === 0) {
                    $return = "Pending (GM)";
                }

                if ($sent->ap_producer === 0 and $sent->approved === 0) {
                    $return = "Pending (Producer)";
                }

                if ($sent->ap_producer === 2 or $sent->approved === 2) {
                    $return = "Disapproved";
                }

                return $return;
            })
            ->make(true);
    }

    public function modalListCrew($id)
    {
        $sent = SendingDataWorkingWeekend::find($id);

        $works = WorkingOnWeekends::where('status', $sent->status)->get();

        $array = [];

        foreach ($works as $key => $work) {
            $array[] = [
                'employes' => $work->user()->getFullName(),
                'position' => $work->user()->position,
                'project'  => $work->project,
                'started'  => $work->start,
                'ended'    => $work->end,
                'time'     => sprintf("%02d:%02d", $work->hourly, $work->minutely)
            ];
        }

        return view('all_employee.Form.weekends.summary.modalListCrew', compact(['array', 'sent']));
    }
}
