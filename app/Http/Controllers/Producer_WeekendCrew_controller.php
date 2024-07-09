<?php

namespace App\Http\Controllers;

use App\Mail\Form\Weekend_Crew\DisapprovedMail;
use App\Mail\Form\Weekend_Crew\ProducerMail;
use App\SendingDataWorkingWeekend;
use App\User;
use App\WorkingOnWeekends;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;

class Producer_WeekendCrew_controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'producer']);
    }

    public function index()
    {
        return view('production.producer.weekend_crew.index');
    }

    public function datatables()
    {
        $query = SendingDataWorkingWeekend::where('producer_id', auth()->user()->id)->where('ap_producer', false)->where('approved', false)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('coor_name', function (SendingDataWorkingWeekend $sent) {
                return $sent->coordinator()->getFullName();
            })
            ->addColumn('position', function (SendingDataWorkingWeekend $sent) {
                return $sent->coordinator()->position;
            })
            ->addColumn('project', function (SendingDataWorkingWeekend $sent) {
                return $sent->coordinator()->getProjectName($sent->coordinator()->project_category_id_1);
            })
            ->editColumn('ap_producer', function (SendingDataWorkingWeekend $sent) {
                return "Pending";
            })
            ->addColumn('actions', 'production.producer.weekend_crew.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function detail($id)
    {
        $getId = SendingDataWorkingWeekend::find($id);

        $allowances = WorkingOnWeekends::where('status', $getId->status)->where('extra', 'allowance')->where('ap_producer', false)->get();

        $exdoed = WorkingOnWeekends::where('status', $getId->status)->where('extra', 'exdo')->where('ap_producer', false)->get();

        return view('production.producer.weekend_crew.detail', compact(['getId', 'allowances', 'exdoed']));
    }

    public function approved($id)
    {
        $sending = SendingDataWorkingWeekend::find($id);
        $gm = User::find(69);
        $works = WorkingOnWeekends::where('status', $sending->status)->where('ap_producer', false)->get();

        foreach ($works as $work) {
            $work->update([
                'ap_producer'   => true,
                'date_producer' => Carbon::now()
            ]);
        }

        $sending->update([
            'ap_producer'   => true,
            'date_producer' => Carbon::now()
        ]);

        Session::flash('message', Lang::get('messages.data_custom', ['data' => "Form request weekend crew by " . $sending->coordinator()->getFullName() . " has been approved."]));
        // Mail::to('dede.aftafiandi@infinitestudios.id')->send(new ProducerMail($id));
        // Mail::to($gm->email)->send(new ProducerMail($id));
        return redirect()->route('producer/weekend-crew/index');
    }

    public function disapproved($id)
    {
        $sending = SendingDataWorkingWeekend::find($id);

        $works = WorkingOnWeekends::where('status', $sending->status)->where('ap_producer', false)->get();

        foreach ($works as $work) {
            $work->update([
                'ap_producer'   => 2,
                'approved'      => 2,
                'date_producer' => Carbon::now()
            ]);
        }

        $sending->update([
            'ap_producer'   => 2,
            'approved'   => 2,
            'date_producer' => Carbon::now()
        ]);

        Session::flash('message', Lang::get('messages.data_custom', ['data' => "Form request weekend crew by " . $sending->coordinator()->getFullName() . " has been approved."]));
        Mail::to('wis_system@infinitestudios.id')->send(new DisapprovedMail($sending->id));
        return redirect()->route('producer/weekend-crew/index');
    }

    public function summary()
    {
        return view('production.producer.weekend_crew.summary');
    }

    public function dataSummary()
    {
        $query = WorkingOnWeekends::where('producer_id', auth()->user()->id)->orderBy('start', 'desc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (WorkingOnWeekends $work) {
                return $work->user()->getFullName();
            })
            ->addColumn('position', function (WorkingOnWeekends $work) {
                return $work->user()->position;
            })
            ->addColumn('coordinator', function (WorkingOnWeekends $work) {
                return $work->coordinator()->getFullName();
            })
            ->addColumn('time', function (WorkingOnWeekends $work) {
                return "$work->hourly Hours, $work->minutely minutes";
            })
            ->editColumn('approved', function (WorkingOnWeekends $work) {
                $return = null;
                if ($work->approved === 1) {
                    $return = "Approved";
                } elseif ($work->approved === 2) {
                    $return = "Disapproved";
                } else {
                    $return = "Pending";
                }

                return $return;
            })
            ->editColumn('workStat', function (WorkingOnWeekends $work) {
                return strtoupper($work->workStat);
            })
            ->make(true);
    }
}