<?php

namespace App\Http\Controllers;

use App\Log_Ws_Availability;
use App\User;
use App\Ws_Availability;
use App\Ws_Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Session;

class ITWSAvailability extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'it']);
    }

    private function wsType()
    {
        $wstype    = [
            ''  => '-select workstations-',
            'Generic PC' => 'Generic PC',
            'HP xw4400' => 'HP xw4400',
            'HP z640' => 'HP z640',
            'HP z600' => 'HP z600',
            'HP Z400' => 'HP Z400',
            'HP z240' => 'HP z240',
            'HP z210' => 'HP z210',
            'HP z200 i7' => 'HP z200 i7',
            'HP z200 i5' => 'HP z200 i5',
            'Dell T7910' => 'Dell T7910',
            'Dell 3040 i5' => 'Dell 3040 i5',
            'Dell T3620'    => 'Dell T3620',
            'Ryzen Mocca'   => 'Ryzen Mocca',
            'i9-12900KF'    => 'i9-12900KF',
            'Custom - i5' => 'Custom - i5',
            'Custom - i7' => 'Custom - i7',
        ];

        return $wstype;
    }

    private function operationSytemsWindows()
    {
        $opsystem = [
            'Windows' => 'Windows',
            'Windows 7' => 'Windows 7',
            'WIN10-Trial' => 'WIN10-Trial',
            'Windows 10' => 'Windows 10',
            'windows 11' => 'Windows 11',
        ];
        return $opsystem;
    }

    private function operationSytemsLinux()
    {
        $opsystem = [
            'Linux' => 'Linux',
            'Linux - Sunrise' => 'Linux - Sunrise',
        ];
        return $opsystem;
    }

    private function mapArea()
    {
        $map_area = [
            '3D Animation' => '3D Animation',
            'Layout' => 'Layout',
            'Render' => 'Render',
            'Officer' => 'Officer',
            'IT Room' => 'IT Room'
        ];

        return $map_area;
    }

    private function usedWorkstations()
    {
        $stat_ws = ['Main Workstation' => 'Main Workstation', 'Secondary Workstation' => 'Secondary Workstation'];

        return $stat_ws;
    }

    private function Gateway()
    {
        $array = [
            '172.16.0.4',
            '172.16.0.5',
            '172.16.0.6',
            '172.16.0.254',
            '172.16.61.253',
        ];

        return $array;
    }

    public function index()
    {
        return view('IT.Availability.newDashboard.index');
    }

    public function dataObject()
    {
        $query = Ws_Availability::where('status', 1)->orderBy('id', 'asc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('noted', 'IT.Availability.newDashboard.notes')
            ->addColumn('dept', function (Ws_Availability $ws_Availability) {
                $return = "`variable empty`";

                if ($ws_Availability->user_id) {
                    $return = User::find($ws_Availability->user_id);
                    $return = $return->getDepartment();
                }

                return $return;
            })
            ->addColumn('position', function (Ws_Availability $ws_Availability) {
                $return = "`variable empty`";
                if ($ws_Availability->user_id) {
                    $return = User::find($ws_Availability->user_id);
                    $return = $return->position;
                }
                return $return;
            })
            ->addColumn('project', function (Ws_Availability $ws_Availability) {
                $return = null;
                if ($ws_Availability->user_id) {
                    $user = User::find($ws_Availability->user_id);
                    $project1 = $user->getProjectName($user->project_category_id_1);
                    $project2 = $user->getProjectName($user->project_category_id_2);
                    $project3 = $user->getProjectName($user->project_category_id_3);

                    if ($project2) {
                        $project2 = " - $project2";
                    }

                    if ($project3) {
                        $project2 = " - $project3";
                    }

                    $return = $project1 . $project2 . $project3;
                }
                return $return;
            })
            ->addColumn('actions', 'IT.Availability.newDashboard.actions')
            ->rawColumns(['actions', 'noted'])
            ->make(true);
    }

    public function add()
    {
        $users = User::where('active', 1)->whereNotIn('nik', ["", 123456789])->orderBy('first_name', 'asc')->get();

        // $workstations = Ws_Availability::find($id);
        $gateway = $this->Gateway();

        $wsType = $this->wsType();

        $windows = $this->operationSytemsWindows();
        $linux = $this->operationSytemsLinux();
        $mapArea = $this->mapArea();
        $usedWS = $this->usedWorkstations();

        // $firstWS = Ws_Map::where('workstation', '=', $workstations->hostname)->first();
        // $secondWS = WS_MAP::where('secondary_workstation', '=', $workstations->hostname)->first();

        return view('IT.Availability.newDashboard.add', compact(['wsType', 'windows', 'linux', 'mapArea', 'usedWS', 'users', 'gateway']));
    }

    public function store(Request $request)
    {
        $rules = [
            'type'      => 'required',
            'hostname'  =>  ["required", "unique:ws_Availability,hostname"],
            'os'        => 'required',
            'memory'    => 'required',
            'vga'       => 'required',
            'status'    => 'required',
            'gateway'   => 'required',
            'usb'       => 'required',
        ];

        $findUser = $request->input('findUser');

        $fullName = $request->input('user');

        if ($findUser) {
            $user = User::find($findUser);
            $fullName = $user->getFullName();
        }

        $data = [
            'type'     => $request->input('type'),
            'user_id' => $findUser,
            'user'     => $fullName,
            'hostname'  => Str::upper($request->input('hostname')),
            'os'       => $request->input('os'),
            'memory'   => $request->input('memory'),
            'vga'      => $request->input('vga'),
            'notes'    => $request->input('notes'),
            'location' => $request->input('area'),
            'status'   => $request->input('status'),
            'gateway'   => $request->input('gateway'),
            'antivirus' => $request->input('antivirus'),
            'usb'       => $request->input('usb'),
            'update_by' => auth()->user()->getFullName()
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('workstations/availability/add')
                ->withErrors($validator)
                ->withInput();
        }

        Ws_Availability::insert($data);
        Session::flash('success', Lang::get('messages.data_custom', ['data' => 'Data ' . $request->input('hostname') . ' has been recorded']));
        return Redirect::route('workstations/availability/index');
    }

    public function edit($id)
    {
        $users = User::where('active', 1)->whereNotIn('nik', ["", 123456789])->orderBy('first_name', 'asc')->get();

        $workstations = Ws_Availability::find($id);
        $gateway = $this->Gateway();

        $wsType = $this->wsType();

        $windows = $this->operationSytemsWindows();
        $linux = $this->operationSytemsLinux();
        $mapArea = $this->mapArea();
        $usedWS = $this->usedWorkstations();

        $firstWS = Ws_Map::where('workstation', '=', $workstations->hostname)->first();
        $secondWS = WS_MAP::where('secondary_workstation', '=', $workstations->hostname)->first();

        return view('IT.Availability.newDashboard.editNew', compact(['workstations', 'wsType', 'windows', 'linux', 'mapArea', 'usedWS', 'firstWS', 'secondWS', 'users', 'gateway']));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'type'      => 'required',
            'os'        => 'required',
            'memory'    => 'required',
            'vga'       => 'required',
            'status'    => 'required',
            'gateway'   => 'required',
            'usb'       => 'required',
        ];

        $findUser = $request->input('findUser');

        $fullName = $request->input('user');

        if ($findUser) {
            $user = User::find($findUser);
            $fullName = $user->getFullName();
        }


        $data = [
            'type'     => $request->input('type'),
            'user_id' => $findUser,
            'user'     => $fullName,
            'os'       => $request->input('os'),
            'memory'   => $request->input('memory'),
            'vga'      => $request->input('vga'),
            'notes'    => $request->input('notes'),
            'location' => $request->input('area'),
            'status'   => $request->input('status'),
            'gateway'   => $request->input('gateway'),
            'antivirus' => $request->input('antivirus'),
            'usb'       => $request->input('usb'),
            'update_by' => auth()->user()->getFullName()
        ];

        // dd($data);

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('workstations/availability/edit', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            Log_Ws_Availability::where('id', '=', $id)->insert($data);
            Ws_Availability::where('id', '=', $id)->update($data);
            Session::flash('success', Lang::get('messages.data_custom', ['data' => 'Data ' . $request->input('hostname') . ' has been updated']));
            return Redirect::route('workstations/availability/index');
        }
    }

    public function delete($id)
    {
        $workstation = Ws_Availability::find($id);

        return view('IT.Availability.newDashboard.modalDelete', compact(['workstation']));
    }

    public function postDelete(Request $request, $id)
    {
        $workstation = Ws_Availability::find($id);

        $workstation->delete();

        Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Data ' . $request->input('hostname') . ' deleted.']));

        return redirect()->route('workstations/availability/index');
    }

    public function noted($id)
    {
        $workstation = Ws_Availability::find($id);

        return view('IT.Availability.newDashboard.modalNotes', compact(['workstation']));
    }

    public function idleIndex()
    {
        return view('IT.Availability.newDashboard.idle.index');
    }

    public function dataIdle()
    {
        $query = Ws_Availability::where('user', 'like', '%idle%')->where('status', 1)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('noted', 'IT.Availability.newDashboard.idle.notes')
            ->addColumn('actions', 'IT.Availability.newDashboard.idle.actions')
            ->rawColumns(['actions', 'noted'])
            ->make(true);
    }

    public function editIdle($id)
    {
        $workstations = Ws_Availability::find($id);

        $wsType = $this->wsType();

        $windows = $this->operationSytemsWindows();
        $linux = $this->operationSytemsLinux();
        $mapArea = $this->mapArea();
        $usedWS = $this->usedWorkstations();

        $firstWS = Ws_Map::where('workstation', '=', $workstations->hostname)->first();
        $secondWS = WS_MAP::where('secondary_workstation', '=', $workstations->hostname)->first();

        return view('IT.Availability.newDashboard.idle.editNew', compact(['workstations', 'wsType', 'windows', 'linux', 'mapArea', 'usedWS', 'firstWS', 'secondWS']));
    }

    public function updateIdle(Request $request, $id)
    {
        $rules = [
            'type'      => 'required',
            'user'      => 'required',
            'os'        => 'required',
            'memory'    => 'required',
            'vga'       => 'required',
            'status'    => 'required',
        ];

        $data = [
            'type'     => $request->input('type'),
            'user'     => $request->input('user'),
            'os'       => $request->input('os'),
            'memory'   => $request->input('memory'),
            'vga'      => $request->input('vga'),
            'notes'    => $request->input('notes'),
            'location' => $request->input('area'),
            'status'   => $request->input('status'),
            'update_by' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('workstations/availability/idle/edit', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            Log_Ws_Availability::where('id', '=', $id)->insert($data);
            Ws_Availability::where('id', '=', $id)->update($data);
            Session::flash('success', Lang::get('messages.data_custom', ['data' => 'Data ' . $request->input('hostname') . ' has been updated']));
            return Redirect::route('workstations/availability/idle/index');
        }
    }

    public function deleteIdle($id)
    {
        $workstation = Ws_Availability::find($id);

        return view('IT.Availability.newDashboard.idle.modalDelete', compact(['workstation']));
    }

    public function postDeleteIdle(Request $request, $id)
    {
        $workstation = Ws_Availability::find($id);

        $workstation->delete();

        Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Data ' . $request->input('hostname') . ' deleted.']));

        return redirect()->route('workstations/availability/idle/index');
    }

    public function scrappedIndex()
    {
        return view('IT.Availability.newDashboard.scrapped.index');
    }

    public function dataScrapped()
    {
        $query = Ws_Availability::where('status', 2)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('noted', 'IT.Availability.newDashboard.scrapped.notes')
            ->addColumn('actions', 'IT.Availability.newDashboard.scrapped.actions')
            ->rawColumns(['actions', 'noted'])
            ->make(true);
    }

    public function editScrapped($id)
    {
        $workstations = Ws_Availability::find($id);

        $wsType = $this->wsType();

        $windows = $this->operationSytemsWindows();
        $linux = $this->operationSytemsLinux();
        $mapArea = $this->mapArea();
        $usedWS = $this->usedWorkstations();

        $firstWS = Ws_Map::where('workstation', '=', $workstations->hostname)->first();
        $secondWS = WS_MAP::where('secondary_workstation', '=', $workstations->hostname)->first();

        return view('IT.Availability.newDashboard.scrapped.editNew', compact(['workstations', 'wsType', 'windows', 'linux', 'mapArea', 'usedWS', 'firstWS', 'secondWS']));
    }

    public function updateSrcapped(Request $request, $id)
    {
        $rules = [
            'type'      => 'required',
            'user'      => 'required',
            'os'        => 'required',
            'memory'    => 'required',
            'vga'       => 'required',
            'status'    => 'required',
        ];

        $data = [
            'type'     => $request->input('type'),
            'user'     => $request->input('user'),
            'os'       => $request->input('os'),
            'memory'   => $request->input('memory'),
            'vga'      => $request->input('vga'),
            'notes'    => $request->input('notes'),
            'location' => $request->input('area'),
            'status'   => $request->input('status'),
            'update_by' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('workstations/availability/scrapped/edit', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            Log_Ws_Availability::where('id', '=', $id)->insert($data);
            Ws_Availability::where('id', '=', $id)->update($data);
            Session::flash('success', Lang::get('messages.data_custom', ['data' => 'Data ' . $request->input('hostname') . ' has been updated']));
            return Redirect::route('workstations/availability/scrapped/index');
        }
    }

    public function deleteScrapped($id)
    {
        $workstation = Ws_Availability::find($id);

        return view('IT.Availability.newDashboard.scrapped.modalDelete', compact(['workstation']));
    }

    public function postDeleteScrapped(Request $request, $id)
    {
        $workstation = Ws_Availability::find($id);

        $workstation->delete();

        Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Data ' . $request->input('hostname') . ' deleted.']));

        return redirect()->route('workstations/availability/scrapped/index');
    }

    public function failsindex()
    {
        return view('IT.Availability.newDashboard.fails.index');
    }

    public function dataFails()
    {
        $query = Ws_Availability::where('status', 0)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('noted', 'IT.Availability.newDashboard.fails.notes')
            ->addColumn('actions', 'IT.Availability.newDashboard.fails.actions')
            ->rawColumns(['actions', 'noted'])
            ->make(true);
    }

    public function editFails($id)
    {
        $workstations = Ws_Availability::find($id);

        $wsType = $this->wsType();

        $windows = $this->operationSytemsWindows();
        $linux = $this->operationSytemsLinux();
        $mapArea = $this->mapArea();
        $usedWS = $this->usedWorkstations();

        $firstWS = Ws_Map::where('workstation', '=', $workstations->hostname)->first();
        $secondWS = WS_MAP::where('secondary_workstation', '=', $workstations->hostname)->first();

        return view('IT.Availability.newDashboard.fails.editNew', compact(['workstations', 'wsType', 'windows', 'linux', 'mapArea', 'usedWS', 'firstWS', 'secondWS']));
    }

    public function updateFails(Request $request, $id)
    {
        $rules = [
            'type'      => 'required',
            'user'      => 'required',
            'os'        => 'required',
            'memory'    => 'required',
            'vga'       => 'required',
            'status'    => 'required',
        ];

        $data = [
            'type'     => $request->input('type'),
            'user'     => $request->input('user'),
            'os'       => $request->input('os'),
            'memory'   => $request->input('memory'),
            'vga'      => $request->input('vga'),
            'notes'    => $request->input('notes'),
            'location' => $request->input('area'),
            'status'   => $request->input('status'),
            'update_by' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('workstations/availability/fails/edit', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            Log_Ws_Availability::where('id', '=', $id)->insert($data);
            Ws_Availability::where('id', '=', $id)->update($data);
            Session::flash('success', Lang::get('messages.data_custom', ['data' => 'Data ' . $request->input('hostname') . ' has been updated']));
            return Redirect::route('workstations/availability/fails/index');
        }
    }

    public function deleteFails($id)
    {
        $workstation = Ws_Availability::find($id);

        return view('IT.Availability.newDashboard.fails.modalDelete', compact(['workstation']));
    }

    public function postDeleteFails(Request $request, $id)
    {
        $workstation = Ws_Availability::find($id);

        $workstation->delete();

        Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Data ' . $request->input('hostname') . ' deleted.']));

        return redirect()->route('workstations/availability/fails/index');
    }
}
