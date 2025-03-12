<?php

namespace App\Http\Controllers;

use App\Mail\Outside\WFH\doneMail;
use App\Mail\Outside\WFH\SendingMail;
use App\User;
use App\Wfh_Checklist;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class HR_NetworkCheckForWFH_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function index()
    {
        return view('HRDLevelAcces.networkForWfh.index');
    }

    public function dataTables()
    {
        $data = Wfh_Checklist::where('it', true)->where('guest', true)->where('hr', false)->orderBy('date', 'asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', 'HRDLevelAcces.networkForWfh.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function form($id)
    {
        $data = Wfh_Checklist::find($id);
        $filePdf = asset('storage/INFINTE-STUDIOS-LATENCY.pdf');

        return view('HRDLevelAcces.networkForWfh.formIndex', compact(['data', 'filePdf']));
    }

    public function updateForm(Request $request, $id)
    {
        $query = Wfh_Checklist::find($id);
        $user = User::find(auth()->user()->id);

        $rules = [
            'confirmed' => ["required"],
            'suges_hr'  => ["required"]
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('hr/form/remote-access-wfh/form', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'hr'        => $request->input('confirmed'),
            'hr_by'     => auth()->user()->id,
            'hr_date'   => Carbon::now(),
            'suges_hrd' => $request->input('suges_hr'),
            'confirm'   => true
        ];

        $array = [
            'date'          => $query->date,
            'session_id'    => $query->session_id,
            'ipaddress'     => $query->ipaddress,
            'requester'     => $query->requester,
            'job'           => $query->job,
            'location'      => $query->location,
            'device_personal'   => $query->device_personal,
            'device_hostname'   => $query->device_hostname,
            'device_isp'        => $query->device_isp,
            'bandwidth'         => $query->bandwidth,
            'download'          => $query->download,
            'upload'            => $query->upload,
            'vpn03'             => $query->vpn03,
            'vpn04'             => $query->vpn04,
            'it_confirm'        =>  $user->getFullName(),
        ];

        $query->update($data);
        Mail::to('dede.aftafiandi@infinitestudios.id')->send(new doneMail($array));
        Session::flash('success', Lang::get('messages.data_custom', ['data' => $query->requester . " Form Confirmed"]));
        return redirect()->route('hr/form/remote-access-wfh');
    }

    public function summaryForm()
    {
        return view('outside.wfh.summary');
    }

    public function dataTableSummary()
    {
        $query = Wfh_Checklist::orderBy('date', 'asc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->editColumn('it', function (Wfh_Checklist $wfh) {
                $return = "Checked";

                if ($wfh->it == 0) {
                    $return = "Waiting IT";
                }

                return $return;
            })
            ->editColumn('hr', function (Wfh_Checklist $wfh) {

                if ($wfh->hr == 0 and $wfh->it == 0) {
                    $return = "Waiting IT";
                }
                if ($wfh->hr == 0 and $wfh->it == 1) {
                    $return = "Waiting HR";
                }
                if ($wfh->hr == 1 and $wfh->it == 1) {
                    $return = "Confirmed";
                }
                return $return;
            })
            ->editColumn('confirm', function (Wfh_Checklist $wfh) {
                if ($wfh->confirm == true) {
                    return "done";
                } else {
                    return "progress";
                }
            })
            ->addColumn('actions', 'outside.wfh.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function formSummary($id)
    {
        $data = Wfh_Checklist::find($id);
        $filePdf = asset('storage/INFINTE-STUDIOS-LATENCY.pdf');

        return view('HRDLevelAcces.networkForWfh.formSummary', compact(['data', 'filePdf']));
    }

    public function pdfSummary($id)
    {
        $data = Wfh_Checklist::find($id);

        $date = Carbon::now();

        // Menghasilkan PDF
        $pdf = PDF::loadView('outside.wfh.pdfSummary', compact(['data', 'date']))
            ->setPaper('a4', 'potrait')->setWarnings(false);

        return $pdf->stream('Network_Access_Check.pdf');
    }
}