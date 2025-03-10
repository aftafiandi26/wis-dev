<?php

namespace App\Http\Controllers\FormNonAccess;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Outside\WFH\SendingMail;
use App\Wfh_Checklist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EmployesWFH_Controller extends Controller
{
    private function tanggal()
    {
        return "2025-03-06";
    }

    public function index(Request $request)
    {
        $time = $this->tanggal();

        if (date('Y-m-d') !== $time) {
            return view('outside.wfh.pageNotFound');
        }
        $sessionId = $request->session()->getId();

        $getSession = Wfh_Checklist::where('session_id', $sessionId)->first();

        if ($getSession) {
            return view('outside.wfh.pageNotFound');
        }

        $filePdf = asset('storage/INFINTE-STUDIOS-LATENCY.pdf'); // Path yang benar untuk URL
        $filePdf1 = asset('storage/INFINTE-STUDIOS-BANDWIDTH.pdf'); // Path yang benar untuk URL

        return view('outside.wfh.form_remote', compact(['filePdf', 'filePdf1']));
    }

    public function store(Request $request)
    {
        $rules = [
            'requester'     => ["required"],
            'job'           => ["required"],
            'location'      => ["required"],
            'device_personal'   => ["required"],
            'device_hostname'   => ["required"],
            'device_isp'        => ["required"],
            'bandwidth'          => ["required", "numeric"],
            'bandwidth_file'     => ["required", "file", "max:2048", "mimes:jpg,png,jpeg"],
            'download'          => ["required", "numeric"],
            'upload'            => ["required", "numeric"],
            'vpn03'             => ["required", "numeric"],
            'file_vpn03'        => ["required", "file", "max:2048", "mimes:jpg,png,jpeg"],
            'vpn04'             => ["required", "numeric"],
            'file_vpn04'        => ["required", "file", "max:2048", "mimes:jpg,png,jpeg"],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $sessionId = $request->session()->getId();

        $getSession = Wfh_Checklist::where('session_id', $sessionId)->first();

        if ($getSession) {
            return redirect()->route('remote-access-wfh');
        }


        if ($request->hasFile('bandwidth_file') && $request->file('bandwidth_file')->isValid()) {
            $file      =  $request->file('bandwidth_file');
            $bandwidth_file = time() . '_' . '_' . $request->input('requester') . '_' . $file->getClientOriginalName();
            $file->storeAs('public/wfh_checklist/bandwidth_file/', $bandwidth_file);
        } else {
            $bandwidth_file = null;
        }

        if ($request->hasFile('file_vpn03') && $request->file('file_vpn03')->isValid()) {
            $file      =  $request->file('file_vpn03');
            $file_vpn03 = time() . '_' . '_' . $request->input('requester') . '_' . $file->getClientOriginalName();
            $file->storeAs('public/wfh_checklist/file_vpn/03/', $file_vpn03);
        } else {
            $file_vpn03 = null;
        }

        if ($request->hasFile('file_vpn04') && $request->file('file_vpn04')->isValid()) {
            $file      =  $request->file('file_vpn04');
            $file_vpn04 = time() . '_' . '_' . $request->input('requester') . '_' . $file->getClientOriginalName();
            $file->storeAs('public/wfh_checklist/file_vpn/04/', $file_vpn04);
        } else {
            $file_vpn04 = null;
        }

        $data = [
            'date'          => Carbon::now(),
            'session_id'    => $request->session()->getId(),
            'ipaddress'     => $request->ip(),
            'requester'     => $request->input('requester'),
            'job'           => $request->input('job'),
            'location'      => $request->input('location'),
            'device_personal'   => $request->input('device_personal'),
            'device_hostname'   => $request->input('device_hostname'),
            'device_isp'        => $request->input('device_isp'),
            'bandwidth'         => $request->input('bandwidth'),
            'bandwidth_file'    => $bandwidth_file,
            'download'          => $request->input('download'),
            'upload'            => $request->input('upload'),
            'vpn03'             => $request->input('vpn03'),
            'file_vpn03'        => $file_vpn03,
            'vpn04'             => $request->input('vpn04'),
            'file_vpn04'        => $file_vpn04,
            'guest'             => true
        ];

        Wfh_Checklist::create($data);
        Mail::to('dede.aftafiandi@infinitestudios.id')->send(new SendingMail($data));
        return redirect()->route('remote-access-wfh/success');
    }

    public function thanks()
    {
        return view('outside.wfh.thanks');
    }
}