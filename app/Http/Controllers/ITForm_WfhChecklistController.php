<?php

namespace App\Http\Controllers;

use App\Mail\Outside\WFH\SendingMail;
use App\User;
use App\Wfh_Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class ITForm_WfhChecklistController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'it']);
    }

    public function index()
    {
        return view('IT.WfhChecklist.index');
    }

    public function dataTables()
    {
        $data = Wfh_Checklist::where('it', false)->Where('guest', true)->orderBy('date', 'asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', 'IT.WfhChecklist.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function formIndex($id)
    {
        $data = Wfh_Checklist::find($id);
        $filePdf = asset('storage/INFINTE-STUDIOS-LATENCY.pdf');

        return view('IT.WfhChecklist.formIndex', compact(['data', 'filePdf']));
    }

    public function modalButtonVPN04($id)
    {
        $data = Wfh_Checklist::find($id);

        $filePdf = null;

        if ($data->file_vpn04) {
            $filePdf = asset('storage/wfh_checklist/file_vpn/04/' . $data->file_vpn04);
        }

        $header = "VPN 04";

        return view('IT.WfhChecklist.modalButton', compact('filePdf', 'header'));
    }

    public function modalButtonVPN03($id)
    {
        $data = Wfh_Checklist::find($id);

        $filePdf = null;

        if ($data->file_vpn03) {
            $filePdf = asset('storage/wfh_checklist/file_vpn/03/' . $data->file_vpn03);
        }

        $header = "VPN 03";

        return view('IT.WfhChecklist.modalButton', compact('filePdf', 'header'));
    }

    public function modalButtonBandwidth($id)
    {
        $data = Wfh_Checklist::find($id);

        $filePdf = null;

        if ($data->bandwidth_file) {
            $filePdf = asset('storage/wfh_checklist/bandwidth_file/' . $data->bandwidth_file);
        }

        $header = "bandwidth";

        return view('IT.WfhChecklist.modalButton', compact('filePdf', 'header'));
    }

    public function updateForm(Request $request, $id)
    {
        $query = Wfh_Checklist::find($id);
        $user = User::find(auth()->user()->id);

        $rules = [
            'net_stat'          => ["required"],
            'network_quality'   => ["required"],
            'vpn04_stat'        => ["required"],
            'vpn03_stat'        => ["required"],
            'suges_it'          => ["required"]
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'net_stat'      => $request->input('net_stat'),
            'vpn03_stat'    => $request->input('vpn03_stat'),
            'vpn04_stat'    => $request->input('vpn04_stat'),
            'net_quality'   => $request->input('network_quality'),
            'suges_it'      => $request->input('suges_it'),
            'it'            => true,
            'it_by'         => $user->id,

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
        Mail::to('dede.aftafiandi@infinitestudios.id')->send(new SendingMail($array));
        Session::flash('success', Lang::get('messages.data_custom', ['data' => $query->requester . " Form Updated"]));
        return redirect()->route('it/form/remote-access-wfh');
    }
}