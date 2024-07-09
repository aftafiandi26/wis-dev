<?php

namespace App\Http\Controllers;

use App\Ws_Availability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Session;

class PipelineWorkstationsAvailability extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function index()
    {
        return view('Pipeline.Availability.newDashboard.index');
    }

    public function dataIndex()
    {
        $query = Ws_Availability::where('status', 1)->orderBy('id', 'asc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('noted', 'Pipeline.Availability.newDashboard.notes')
            ->rawColumns(['noted'])
            ->make(true);
    }

    public function noted($id)
    {
        $workstation = Ws_Availability::find($id);

        return view('Pipeline.Availability.newDashboard.modalNotes', compact(['workstation']));
    }

    public function indexIdle()
    {
        return view('Pipeline.Availability.newDashboard.idle.index');
    }

    public function dataIdle()
    {
        $query = Ws_Availability::where('user', 'like', '%idle%')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('noted', 'Pipeline.Availability.newDashboard..idle.notes')
            ->rawColumns(['noted'])
            ->make(true);
    }

    public function idleNoted($id)
    {
        $workstation = Ws_Availability::find($id);

        return view('Pipeline.Availability.newDashboard..idle.modalNotes', compact(['workstation']));
    }

    public function indexFails()
    {
        return view('Pipeline.Availability.newDashboard.fails.index');
    }

    public function dataFails()
    {
        $query = Ws_Availability::where('status', 0)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('noted', 'Pipeline.Availability.newDashboard..fails.notes')
            ->rawColumns(['noted'])
            ->make(true);
    }

    public function failsNoted($id)
    {
        $workstation = Ws_Availability::find($id);

        return view('Pipeline.Availability.newDashboard..fails.modalNotes', compact(['workstation']));
    }

    public function indexScrapped()
    {
        return view('Pipeline.Availability.newDashboard.scrapped.index');
    }

    public function dataScrapped()
    {
        $query = Ws_Availability::where('status', 0)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('noted', 'Pipeline.Availability.newDashboard..scrapped.notes')
            ->rawColumns(['noted'])
            ->make(true);
    }

    public function scrappedNoted($id)
    {
        $workstation = Ws_Availability::find($id);

        return view('Pipeline.Availability.newDashboard..scrapped.modalNotes', compact(['workstation']));
    }
}