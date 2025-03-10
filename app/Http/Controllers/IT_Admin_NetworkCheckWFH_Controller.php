<?php

namespace App\Http\Controllers;

use App\User;
use App\Wfh_Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class IT_Admin_NetworkCheckWFH_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'it']);
    }

    public function index()
    {
        return view('IT.WfhChecklist.document');
    }

    public function dataTables()
    {
        $query = Wfh_Checklist::where('document', null)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('actions', 'IT.WfhChecklist.documentAct')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function form($id)
    {
        $data = Wfh_Checklist::find($id);
        $filePdf = asset('storage/INFINTE-STUDIOS-LATENCY.pdf');

        return view('IT.WfhChecklist.formDocument', compact(['data', 'filePdf']));
    }

    public function update(Request $request, $id)
    {
        $query = Wfh_Checklist::find($id);
        $user = User::find(auth()->user()->id);

        $wfh = Wfh_Checklist::where('document', $request->input('document'))->first();

        $rules = ['document' => ["required"]];

        if ($wfh) {
            Session::flash('success', Lang::get('messages.data_custom', ['data' => "Document ID already exists"]));
            return redirect()->route('it/form/remote-access-wfh');
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('it/form/remote-access-wfh/document')
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'document'  => $request->input('document')
        ];

        $query->update($data);

        Session::flash('success', Lang::get('messages.data_custom', ['data' => $query->requester . " Form Updated"]));
        return redirect()->route('it/form/remote-access-wfh');
    }
}