<?php

namespace App\Http\Controllers;

use App;
use App\Dept_Category;
use App\Entitled_leave_view;
use App\Events\LeaveVerificatedByHr;
use App\Http\Controllers\Controller;
use App\Initial_Leave;
use App\JobFunction_Category;
use App\Leave;
use App\Leave_Category;
use App\Log_User;
use App\Log_Ws_Availability;
use App\NewUser;
use App\Project_Category;
use App\User;
use App\User_project;
use App\Ws_Availability;
use App\Asseting_IT;
use App\Asseting_PS;
use App\Ws_Map;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\PDF;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use Storage;
use Yajra\Datatables\Facades\Datatables;
use Yajra\DataTables\Html\Builder;

use \Milon\Barcode\DNS2D;
use \Milon\Barcode\DNS1D;
use SimpleSoftwareIO\QrCode;


class ITController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'it']);
    }

    public function indexWS_Availability()
    {
        return view::make('IT.Availability.index');
    }

    public function get_indexWS_Availability()
    {
        $select = Ws_Availability::select('*')
            ->where('user', '!=', 'SCRAPPED')
            ->get();

        return Datatables::of($select)
            ->add_column(
                'edit',
                Lang::get('messages.btn_warning', ['title' => 'Edit Workstation', 'url' => '{{ URL::route(\'edit-WS\', [$id]) }}', 'class' => 'pencil'])
            )
            ->setRowClass('notes', '@if ($notes === "SCRAPPED"){{ "danger" }}@endif')
            ->edit_column('updated_at', '{!! date("M, d Y - H:m", strtotime($updated_at)) !!} WIB')
            ->make();
    }

    public function wsType()
    {
        $wstype    = [
            ''  => '-select workstations-',
            'Generic PC' => 'Generic PC',
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
            'i9-12900KF'    => 'i9-12900KF'
        ];

        return $wstype;
    }

    public function addWS_Availability()
    {
        $wstype = $this->wsType();

        $map_area = ['3D Animation' => '3D Animation', 'Layout' => 'Layout', 'Render' => 'Render', 'Officer' => 'Officer', 'IT Room' => 'IT Room'];
        $OSS = ['Windows' => 'Windows', 'Linux' => 'Linux'];
        $stat_ws = ['Main Workstation' => 'Main Workstation', 'Secondary Workstation' => 'Secondary Workstation'];

        return view::make('IT.Availability.add', ['wstype' => $wstype, 'OSS' => $OSS, 'map_area' => $map_area, 'stat_ws' => $stat_ws]);
    }

    public function storeAddWS(Request $request)
    {
        $mainws = 'Main Workstation';
        $seconws = 'Secondary Workstation';
        
         if ($request->input('type') === "-select workstations-") {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry!! Please check your type workstation']));
            return redirect()->back();
        }

        $rules = [
            'hostname'  => 'required',
        ];
        $data = [
            'hostname' => strtoupper($request->input('hostname')),
            'type'     => $request->input('type'),
            'user'     => $request->input('user'),
            'os'       => $request->input('os'),
            'memory'   => $request->input('memory') . ' GB',
            'vga'      => $request->input('vga'),
            'notes'    => $request->input('notes'),
            'location' => $request->input('location'),
            'update_by' => auth::user()->first_name . ' ' . auth::user()->last_name,

        ];
        $data2 = [
            'no_seat'       => $request->input('no_seat'),
            'workstation'   => strtoupper($request->input('hostname')),
            'user'          => $request->input('user'),
            'monitor1'      => $request->input('main_monitor'),
            'monitor2'      => $request->input('secondary_monitor'),
            'area'          => $request->input('location'),
            'created_by'    => auth::user()->first_name . ' ' . auth::user()->last_name,
        ];
        $data3 = [
            'no_seat'                    => $request->input('no_seat'),
            'secondary_workstation'   => strtoupper($request->input('hostname')),
            'user'          => $request->input('user'),
            'area'          => $request->input('location'),
            'created_by'    => auth::user()->first_name . ' ' . auth::user()->last_name,
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('add-WS')
                ->withErrors($validator)
                ->withInput();
        } else {
            DB::table('ws_Availability')->insert($data);
            Log_Ws_Availability::insert($data);
            if ($request->input('main_workstation') === $mainws) {
                DB::table('ws_map')->where('no_seat', '=', $request->input('no_seat'))->update($data2);
            }
            if ($request->input('main_workstation') === $seconws) {
                DB::table('ws_map')->where('no_seat', '=', $request->input('no_seat'))->update($data3);
            }
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
            return Redirect::route('indexIT');
        }
    }

    public function EditWs_Availability($id)
    {
        $hostname = Ws_Availability::where('id', '=', $id)->first();

        $mainws = WS_MAP::where('workstation', '=', $hostname->hostname)->first();
        $secws = WS_MAP::where('secondary_workstation', '=', $hostname->hostname)->first();

        $wstype = $this->wsType();

        $main_workstation = WS_MAP::where('workstation', 'like', '%' . $hostname->hostname . '%')->orwhere('secondary_workstation', 'like', '%' . $hostname->hostname . '%')->first();

        $opsystem = [
            'Windows' => 'Windows',
            'Linux' => 'Linux',
            'WIN10-Trial' => 'WIN10-Trial',
            'Windows 10' => 'Windows 10',
            'Linux - Sunrise' => 'Linux - Sunrise'
        ];
        $map_area = ['' => '', '3D Animation' => '3D Animation', 'Layout' => 'Layout', 'Render' => 'Render', 'Officer' => 'Officer', 'IT Room' => 'IT Room'];

        $stat_ws = ['Main Workstation' => 'Main Workstation', 'Secondary Workstation' => 'Secondary Workstation'];

        return view::make('IT.Availability.edit')
            ->with([
                'hostname'      => $hostname,
                'type'          => $hostname,
                'user'          => $hostname,
                'os'            => $hostname,
                'memory'        => $hostname,
                'location'         => $hostname,
                'notes'            => $hostname,
                'opsystem'         => $opsystem,
                'main_workstation' => $main_workstation,
                'map_area'      => $map_area,
                'stat_ws'       => $stat_ws,
                'mainws'        => $mainws,
                'secws'         => $secws,
                'wstype'        => $wstype

            ]);
    }

    public function Store_EditWs_Availability(request $request, $id)
    {
        $mainws = 'Main Workstation';
        $seconws = 'Secondary Workstation';
        
         if ($request->input('type') === "-select workstations-") {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry!! Please check your type workstation']));
            return redirect()->back();
        }

        $sett = Ws_Availability::find($id);
        $main_workstation2 = WS_MAP::where('workstation', 'like', '%' . $sett->hostname . '%')->orwhere('secondary_workstation', 'like', '%' . $sett->hostname . '%')->first();
        
       

        $rules = [
            'hostname'  => 'required',

        ];
        $data = [
            'hostname' => $request->input('hostname'),
            'type'     => $request->input('type'),
            'user'     => $request->input('user'),
            'os'       => $request->input('os'),
            'memory'   => $request->input('memory'),
            'vga'      => $request->input('vga'),
            'notes'    => $request->input('notes'),
            'location' => $request->input('location'),
            'update_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('edit-WS', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            Log_Ws_Availability::where('id', '=', $id)->insert($data);
            Ws_Availability::where('id', '=', $id)->update($data);
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
            return Redirect::route('indexIT');
        }
    }

    public function index_idle_Avability()
    {

        return view::make('IT.Availability.index_WS_idle');
    }

    public function get_index_idle_Avability()
    {
        $select = Ws_Availability::select([
            'id', 'hostname', 'type', 'user', 'os', 'memory', 'vga', 'location', 'notes', 'update_by', 'updated_at'
        ])
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        return Datatables::of($select)
            ->add_column(
                'edit',
                Lang::get('messages.btn_warning', ['title' => 'Edit Workstation', 'url' => '{{ URL::route(\'edit-WS\', [$id]) }}', 'class' => 'pencil'])
            )
            ->setRowClass('notes', '@if ($notes === "SCRAPPED"){{ "danger" }}@endif')
            ->edit_column('updated_at', '{!! date("M, d Y - H:m", strtotime($updated_at)) !!} WIB')
            ->make();
    }

    public function Edi_Idlet_Ws_Availability($id)
    {
        /*if (auth::user()->position === 'Junior IT Support' or auth::user()->position === 'Senior IT Support') {*/
        $hostname = Ws_Availability::where('id', '=', $id)->first();

        return view::make('IT.Availability.edit_WS_idle')
            ->with([
                'hostname'      => $hostname,
                'type'          => $hostname,
                'user'          => $hostname,
                'os'            => $hostname,
                'memory'        => $hostname,
                'location'      => $hostname,
                'notes'         => $hostname,

            ]);
        /*}else {
			return Redirect::back();
		}   */
    }

    public function Store_Edit_Idlet_Ws_Availability(request $request, $id)
    {
        $rules = [
            'hostname'  => 'required|alpha_dash|unique:ws_Availability,hostname',
            'type'      => 'required',
            'user'      => 'required',
            'position'  => 'required',
            'os'        => 'required',
            'memory'    => 'required',
            'vga'       => 'required',
            'notes'     => 'required',
        ];
        $data = [
            'hostname' => $request->input('hostname'),
            'type'     => $request->input('type'),
            'user'     => $request->input('user'),
            'os'       => $request->input('os'),
            'memory'   => $request->input('memory'),
            'vga'      => $request->input('vga'),
            'notes'    => $request->input('notes'),
            'location' => $request->input('location')
        ];

        Ws_Availability::where('id', '=', $id)->update($data);
        Log_Ws_Availability::insert($data);
        return Redirect::route('idle');
    }

    public function send_WS_Availability()
    {
        $IT = DB::table('users')->select('email')
            ->where('dept_category_id', '=', 1)
            ->where('email', '!=', NULL)
            ->where('online', '=', 1)
            ->where('hd', '!=', '1')
            /*->where('position', '=', 'Junior Programmer') */
            ->pluck('email');

        $HR = NewUser::select('email')
            ->where('dept_category_id', '=', 3)
            ->where('email', '!=', NULL)
            ->where('online', '=', 1)
            ->where('position', '=', 'HR Offiecer')
            ->value('email');

        $director = NewUser::select('email')
            ->where('dept_category_id', '=', 6)
            ->where('email', '!=', NULL)
            ->where('online', '=', 1)
            ->where('position', '=', 'Supervisor Technical Director')
            ->value('email');

        $production_manager = NewUser::select('email')
            ->where('dept_category_id', '=', 6)
            ->where('email', '!=', NULL)
            ->where('online', '=', 1)
            ->where('hd', '=', 1)
            ->value('email');

        $senior_pipeline = NewUser::select('email')
            ->where('dept_category_id', '=', 6)
            ->where('email', '!=', NULL)
            ->where('online', '=', 1)
            ->where('position', '=', 'Supervisor Pipeline')
            ->value('email');

        $subject = 'WS Availability';

        $total = Ws_Availability::select('*')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $Generic = Ws_Availability::select('*')
            ->where('type', '=', 'Generic PC')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->count();

        $z200i7 = Ws_Availability::select('*')
            ->where('type', '=', 'HP z200 i7')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->count();

        $z200i5 = Ws_Availability::select('*')
            ->where('type', '=', 'HP z200 i5')

            ->whereIn('user', ['WS Render', 'Idle'])
            ->count();

        $z210  = Ws_Availability::select('*')
            ->where('type', '=', 'HP z210')

            ->whereIn('user', ['WS Render', 'Idle'])
            ->count();


        $z400  = Ws_Availability::select('*')
            ->where('type', '=', 'HP z400')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->count();

        $z600  = Ws_Availability::select('*')
            ->where('type', '=', 'HP z600')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->count();

        $T3620 = Ws_Availability::select('*')
            ->where('type', '=', 'Dell T3620')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->count();
        $T7910 = Ws_Availability::select('*')
            ->where('type', '=', 'Dell T7910')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->count();

        $z240 = Ws_Availability::select('*')
            ->where('type', '=', 'HP Z240')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->count();

        $z640 = Ws_Availability::select('*')
            ->where('type', '=', 'HPZ640')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->count();




        Mail::send('email.ws_avaibility', ['Generic' => $Generic, 'total' => $total, 'z200i7' => $z200i7, 'z200i5' => $z200i5, 'z210' => $z210, 'z400' => $z400, 'z600' => $z600, 'T3620' => $T3620, 'T7910' => $T7910, 'z240' => $z240, 'z640' => $z640], function ($message) use ($IT, $HR, $director, $production_manager, $senior_pipeline, $subject) {
            $message->to($senior_pipeline, 'WIS')->subject($subject);
            $message->cc($HR, 'WIS')->subject($subject);
            $message->cc($director, 'WIS')->subject($subject);
            $message->cc($production_manager, 'WIS')->subject($subject);
            $message->cc('support@frameworks-studios.com', 'WIS')->subject($subject);
            /*    $message->to('dede.aftafiandi@frameworks-studios.com', 'WIS')->subject($subject);*/

            $message->from('wis_system@frameworks-studios.com', 'WIS');
        });
        Session::flash('message', Lang::get('messages.send_email_availability'));
        return Redirect::back();
    }

    public function index_Histori_Avaiblility()
    {
        return View::make('IT.Availability.index_Histori');
    }

    public function get_index_Histori_Avaiblility()
    {
        $select = Log_Ws_Availability::select(['id', 'hostname', 'type', 'user', 'os', 'memory', 'vga', 'notes', 'updated_at'])

            ->get();

        return Datatables::of($select)
            ->add_column('edit', '<a href="{{route("der", [$id])}}" class="btn btn-danger btn-sm"> Edit </a>')
            ->make();
    }

    public function editHIStoriWS_Availability($id)
    {
        $hostname = Log_Ws_Availability::where('id', '=', $id)->first();

        return view::make('IT.Availability.edit_Histori_WS_idle')
            ->with([
                'hostname'      => $hostname,
                'type'          => $hostname,
                'user'          => $hostname,
                'os'            => $hostname,
                'memory'        => $hostname,
                'location'      => $hostname,
                'notes'         => $hostname,

            ]);
    }

    public function Store_Edit_Histori_Ws_Availability(request $request, $id)
    {
        $hostname = Log_Ws_Availability::where('id', '=', $id)->first();
        $rules = [
            'hostname'  => 'required|alpha_dash|unique:ws_Availability,hostname',
            'type'      => 'required',
        ];
        $data = [
            'hostname' => $request->input('hostname'),
            'type'     => $request->input('type'),
            'user'     => $request->input('user'),
            'os'       => $request->input('os'),
            'memory'   => $request->input('memory'),
            'vga'      => $request->input('vga'),
            'notes'    => $request->input('notes'),
            'location' => $request->input('location')
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('der', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($hostname->hostname === $request->input('hostname')) {
                Ws_Availability::insert($data);
                Log_Ws_Availability::insert($data);
                Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data User']));
                return Redirect::route('indexIT');
            } else {
                Ws_Availability::where('hostname', '=', $hostname->hostname)->update($data);
                Log_Ws_Availability::insert($data);
                Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data User']));
                return Redirect::route('indexIT');
            }
        }
    }

    public function index_WS_MAP()
    {
        $anim_1 = Ws_Map::select('*')->where('no_seat', 1)->where('area', '=', '3D Animation')->first();
        $anim_2 = Ws_Map::select('*')->where('no_seat', 2)->where('area', '=', '3D Animation')->first();
        $anim_3 = Ws_Map::select('*')->where('no_seat', 3)->where('area', '=', '3D Animation')->first();
        $anim_4 = Ws_Map::select('*')->where('no_seat', 4)->where('area', '=', '3D Animation')->first();
        $anim_5 = Ws_Map::select('*')->where('no_seat', 5)->where('area', '=', '3D Animation')->first();
        $anim_6 = Ws_Map::select('*')->where('no_seat', 6)->where('area', '=', '3D Animation')->first();
        $anim_7 = Ws_Map::select('*')->where('no_seat', 7)->where('area', '=', '3D Animation')->first();
        $anim_8 = Ws_Map::select('*')->where('no_seat', 8)->where('area', '=', '3D Animation')->first();
        $anim_9 = Ws_Map::select('*')->where('no_seat', 9)->where('area', '=', '3D Animation')->first();
        $anim_10 = Ws_Map::select('*')->where('no_seat', 10)->where('area', '=', '3D Animation')->first();
        $anim_11 = Ws_Map::select('*')->where('no_seat', 11)->where('area', '=', '3D Animation')->first();
        $anim_12 = Ws_Map::select('*')->where('no_seat', 12)->where('area', '=', '3D Animation')->first();
        $anim_13 = Ws_Map::select('*')->where('no_seat', 13)->where('area', '=', '3D Animation')->first();
        $anim_14 = Ws_Map::select('*')->where('no_seat', 14)->where('area', '=', '3D Animation')->first();
        $anim_15 = Ws_Map::select('*')->where('no_seat', 15)->where('area', '=', '3D Animation')->first();
        $anim_16 = Ws_Map::select('*')->where('no_seat', 16)->where('area', '=', '3D Animation')->first();
        $anim_17 = Ws_Map::select('*')->where('no_seat', 17)->where('area', '=', '3D Animation')->first();
        $anim_18 = Ws_Map::select('*')->where('no_seat', 18)->where('area', '=', '3D Animation')->first();
        $anim_19 = Ws_Map::select('*')->where('no_seat', 19)->where('area', '=', '3D Animation')->first();
        $anim_20 = Ws_Map::select('*')->where('no_seat', 20)->where('area', '=', '3D Animation')->first();
        $anim_21 = Ws_Map::select('*')->where('no_seat', 21)->where('area', '=', '3D Animation')->first();
        $anim_22 = Ws_Map::select('*')->where('no_seat', 22)->where('area', '=', '3D Animation')->first();
        $anim_23 = Ws_Map::select('*')->where('no_seat', 23)->where('area', '=', '3D Animation')->first();
        $anim_24 = Ws_Map::select('*')->where('no_seat', 24)->where('area', '=', '3D Animation')->first();
        $anim_25 = Ws_Map::select('*')->where('no_seat', 25)->where('area', '=', '3D Animation')->first();
        $anim_26 = Ws_Map::select('*')->where('no_seat', 26)->where('area', '=', '3D Animation')->first();
        $anim_27 = Ws_Map::select('*')->where('no_seat', 27)->where('area', '=', '3D Animation')->first();
        $anim_28 = Ws_Map::select('*')->where('no_seat', 28)->where('area', '=', '3D Animation')->first();
        $anim_29 = Ws_Map::select('*')->where('no_seat', 29)->where('area', '=', '3D Animation')->first();
        $anim_30 = Ws_Map::select('*')->where('no_seat', 30)->where('area', '=', '3D Animation')->first();
        $anim_31 = Ws_Map::select('*')->where('no_seat', 31)->where('area', '=', '3D Animation')->first();
        $anim_32 = Ws_Map::select('*')->where('no_seat', 32)->where('area', '=', '3D Animation')->first();
        $anim_33 = Ws_Map::select('*')->where('no_seat', 33)->where('area', '=', '3D Animation')->first();
        $anim_34 = Ws_Map::select('*')->where('no_seat', 34)->where('area', '=', '3D Animation')->first();
        $anim_35 = Ws_Map::select('*')->where('no_seat', 35)->where('area', '=', '3D Animation')->first();
        $anim_36 = Ws_Map::select('*')->where('no_seat', 36)->where('area', '=', '3D Animation')->first();
        $anim_37 = Ws_Map::select('*')->where('no_seat', 37)->where('area', '=', '3D Animation')->first();
        $anim_38 = Ws_Map::select('*')->where('no_seat', 38)->where('area', '=', '3D Animation')->first();
        $anim_39 = Ws_Map::select('*')->where('no_seat', 39)->where('area', '=', '3D Animation')->first();
        $anim_40 = Ws_Map::select('*')->where('no_seat', 40)->where('area', '=', '3D Animation')->first();
        $anim_41 = Ws_Map::select('*')->where('no_seat', 41)->where('area', '=', '3D Animation')->first();
        $anim_42 = Ws_Map::select('*')->where('no_seat', 42)->where('area', '=', '3D Animation')->first();
        $anim_43 = Ws_Map::select('*')->where('no_seat', 43)->where('area', '=', '3D Animation')->first();
        $anim_44 = Ws_Map::select('*')->where('no_seat', 44)->where('area', '=', '3D Animation')->first();
        $anim_45 = Ws_Map::select('*')->where('no_seat', 45)->where('area', '=', '3D Animation')->first();
        $anim_46 = Ws_Map::select('*')->where('no_seat', 46)->where('area', '=', '3D Animation')->first();
        $anim_47 = Ws_Map::select('*')->where('no_seat', 47)->where('area', '=', '3D Animation')->first();
        $anim_48 = Ws_Map::select('*')->where('no_seat', 48)->where('area', '=', '3D Animation')->first();
        $anim_49 = Ws_Map::select('*')->where('no_seat', 49)->where('area', '=', '3D Animation')->first();
        $anim_50 = Ws_Map::select('*')->where('no_seat', 50)->where('area', '=', '3D Animation')->first();
        $anim_51 = Ws_Map::select('*')->where('no_seat', 51)->where('area', '=', '3D Animation')->first();
        $anim_52 = Ws_Map::select('*')->where('no_seat', 52)->where('area', '=', '3D Animation')->first();
        $anim_53 = Ws_Map::select('*')->where('no_seat', 53)->where('area', '=', '3D Animation')->first();
        $anim_54 = Ws_Map::select('*')->where('no_seat', 54)->where('area', '=', '3D Animation')->first();
        $anim_55 = Ws_Map::select('*')->where('no_seat', 55)->where('area', '=', '3D Animation')->first();
        $anim_56 = Ws_Map::select('*')->where('no_seat', 56)->where('area', '=', '3D Animation')->first();
        $anim_57 = Ws_Map::select('*')->where('no_seat', 57)->where('area', '=', '3D Animation')->first();
        $anim_58 = Ws_Map::select('*')->where('no_seat', 58)->where('area', '=', '3D Animation')->first();
        $anim_59 = Ws_Map::select('*')->where('no_seat', 59)->where('area', '=', '3D Animation')->first();
        $anim_60 = Ws_Map::select('*')->where('no_seat', 60)->where('area', '=', '3D Animation')->first();
        $anim_61 = Ws_Map::select('*')->where('no_seat', 61)->where('area', '=', '3D Animation')->first();
        $anim_62 = Ws_Map::select('*')->where('no_seat', 62)->where('area', '=', '3D Animation')->first();
        $anim_63 = Ws_Map::select('*')->where('no_seat', 63)->where('area', '=', '3D Animation')->first();
        $anim_64 = Ws_Map::select('*')->where('no_seat', 64)->where('area', '=', '3D Animation')->first();
        $anim_65 = Ws_Map::select('*')->where('no_seat', 65)->where('area', '=', '3D Animation')->first();
        $anim_66 = Ws_Map::select('*')->where('no_seat', 66)->where('area', '=', '3D Animation')->first();
        $anim_67 = Ws_Map::select('*')->where('no_seat', 67)->where('area', '=', '3D Animation')->first();
        $anim_68 = Ws_Map::select('*')->where('no_seat', 68)->where('area', '=', '3D Animation')->first();
        $anim_69 = Ws_Map::select('*')->where('no_seat', 69)->where('area', '=', '3D Animation')->first();
        $anim_70 = Ws_Map::select('*')->where('no_seat', 70)->where('area', '=', '3D Animation')->first();
        $anim_71 = Ws_Map::select('*')->where('no_seat', 71)->where('area', '=', '3D Animation')->first();
        $anim_72 = Ws_Map::select('*')->where('no_seat', 72)->where('area', '=', '3D Animation')->first();
        $anim_73 = Ws_Map::select('*')->where('no_seat', 73)->where('area', '=', '3D Animation')->first();
        $anim_74 = Ws_Map::select('*')->where('no_seat', 74)->where('area', '=', '3D Animation')->first();
        $anim_75 = Ws_Map::select('*')->where('no_seat', 75)->where('area', '=', '3D Animation')->first();
        $anim_76 = Ws_Map::select('*')->where('no_seat', 76)->where('area', '=', '3D Animation')->first();
        $anim_77 = Ws_Map::select('*')->where('no_seat', 77)->where('area', '=', '3D Animation')->first();
        $anim_78 = Ws_Map::select('*')->where('no_seat', 78)->where('area', '=', '3D Animation')->first();
        $anim_79 = Ws_Map::select('*')->where('no_seat', 79)->where('area', '=', '3D Animation')->first();
        $anim_80 = Ws_Map::select('*')->where('no_seat', 80)->where('area', '=', '3D Animation')->first();
        $anim_81 = Ws_Map::select('*')->where('no_seat', 81)->where('area', '=', '3D Animation')->first();
        $anim_82 = Ws_Map::select('*')->where('no_seat', 82)->where('area', '=', '3D Animation')->first();
        $anim_83 = Ws_Map::select('*')->where('no_seat', 83)->where('area', '=', '3D Animation')->first();
        $anim_84 = Ws_Map::select('*')->where('no_seat', 84)->where('area', '=', '3D Animation')->first();
        $anim_85 = Ws_Map::select('*')->where('no_seat', 85)->where('area', '=', '3D Animation')->first();
        $anim_86 = Ws_Map::select('*')->where('no_seat', 86)->where('area', '=', '3D Animation')->first();
        $anim_87 = Ws_Map::select('*')->where('no_seat', 87)->where('area', '=', '3D Animation')->first();
        $anim_88 = Ws_Map::select('*')->where('no_seat', 88)->where('area', '=', '3D Animation')->first();
        $anim_89 = Ws_Map::select('*')->where('no_seat', 89)->where('area', '=', '3D Animation')->first();
        $anim_90 = Ws_Map::select('*')->where('no_seat', 90)->where('area', '=', '3D Animation')->first();
        $anim_91 = Ws_Map::select('*')->where('no_seat', 91)->where('area', '=', '3D Animation')->first();
        $anim_92 = Ws_Map::select('*')->where('no_seat', 92)->where('area', '=', '3D Animation')->first();
        $anim_93 = Ws_Map::select('*')->where('no_seat', 93)->where('area', '=', '3D Animation')->first();
        $anim_94 = Ws_Map::select('*')->where('no_seat', 94)->where('area', '=', '3D Animation')->first();
        $anim_95 = Ws_Map::select('*')->where('no_seat', 95)->where('area', '=', '3D Animation')->first();
        $anim_96 = Ws_Map::select('*')->where('no_seat', 96)->where('area', '=', '3D Animation')->first();
        $anim_97 = Ws_Map::select('*')->where('no_seat', 97)->where('area', '=', '3D Animation')->first();
        $anim_98 = Ws_Map::select('*')->where('no_seat', 98)->where('area', '=', '3D Animation')->first();
        $anim_99 = Ws_Map::select('*')->where('no_seat', 99)->where('area', '=', '3D Animation')->first();
        $anim_100 = Ws_Map::select('*')->where('no_seat', 100)->where('area', '=', '3D Animation')->first();
        $anim_101 = Ws_Map::select('*')->where('no_seat', 101)->where('area', '=', '3D Animation')->first();
        $anim_102 = Ws_Map::select('*')->where('no_seat', 102)->where('area', '=', '3D Animation')->first();
        $anim_103 = Ws_Map::select('*')->where('no_seat', 103)->where('area', '=', '3D Animation')->first();
        $anim_104 = Ws_Map::select('*')->where('no_seat', 104)->where('area', '=', '3D Animation')->first();
        $anim_105 = Ws_Map::select('*')->where('no_seat', 105)->where('area', '=', '3D Animation')->first();
        $anim_106 = Ws_Map::select('*')->where('no_seat', 106)->where('area', '=', '3D Animation')->first();
        $anim_107 = Ws_Map::select('*')->where('no_seat', 107)->where('area', '=', '3D Animation')->first();
        $anim_108 = Ws_Map::select('*')->where('no_seat', 108)->where('area', '=', '3D Animation')->first();
        $anim_109 = Ws_Map::select('*')->where('no_seat', 109)->where('area', '=', '3D Animation')->first();
        $anim_110 = Ws_Map::select('*')->where('no_seat', 110)->where('area', '=', '3D Animation')->first();
        $anim_111 = Ws_Map::select('*')->where('no_seat', 111)->where('area', '=', '3D Animation')->first();
        $anim_112 = Ws_Map::select('*')->where('no_seat', 112)->where('area', '=', '3D Animation')->first();
        $anim_113 = Ws_Map::select('*')->where('no_seat', 113)->where('area', '=', '3D Animation')->first();
        $anim_114 = Ws_Map::select('*')->where('no_seat', 114)->where('area', '=', '3D Animation')->first();
        $anim_115 = Ws_Map::select('*')->where('no_seat', 115)->where('area', '=', '3D Animation')->first();
        $anim_116 = Ws_Map::select('*')->where('no_seat', 116)->where('area', '=', '3D Animation')->first();
        $anim_117 = Ws_Map::select('*')->where('no_seat', 117)->where('area', '=', '3D Animation')->first();
        $anim_118 = Ws_Map::select('*')->where('no_seat', 118)->where('area', '=', '3D Animation')->first();
        $anim_119 = Ws_Map::select('*')->where('no_seat', 119)->where('area', '=', '3D Animation')->first();
        $anim_120 = Ws_Map::select('*')->where('no_seat', 120)->where('area', '=', '3D Animation')->first();
        $anim_121 = Ws_Map::select('*')->where('no_seat', 121)->where('area', '=', '3D Animation')->first();
        $anim_122 = Ws_Map::select('*')->where('no_seat', 122)->where('area', '=', '3D Animation')->first();
        $anim_123 = Ws_Map::select('*')->where('no_seat', 123)->where('area', '=', '3D Animation')->first();
        $anim_124 = Ws_Map::select('*')->where('no_seat', 124)->where('area', '=', '3D Animation')->first();
        $anim_125 = Ws_Map::select('*')->where('no_seat', 125)->where('area', '=', '3D Animation')->first();
        $anim_126 = Ws_Map::select('*')->where('no_seat', 126)->where('area', '=', '3D Animation')->first();
        $anim_127 = Ws_Map::select('*')->where('no_seat', 127)->where('area', '=', '3D Animation')->first();
        $anim_128 = Ws_Map::select('*')->where('no_seat', 128)->where('area', '=', '3D Animation')->first();
        $anim_129 = Ws_Map::select('*')->where('no_seat', 129)->where('area', '=', '3D Animation')->first();
        $anim_130 = Ws_Map::select('*')->where('no_seat', 130)->where('area', '=', '3D Animation')->first();
        $anim_131 = Ws_Map::select('*')->where('no_seat', 131)->where('area', '=', '3D Animation')->first();
        $anim_132 = Ws_Map::select('*')->where('no_seat', 132)->where('area', '=', '3D Animation')->first();
        $anim_133 = Ws_Map::select('*')->where('no_seat', 133)->where('area', '=', '3D Animation')->first();
        $anim_134 = Ws_Map::select('*')->where('no_seat', 134)->where('area', '=', '3D Animation')->first();
        $anim_135 = Ws_Map::select('*')->where('no_seat', 135)->where('area', '=', '3D Animation')->first();
        $anim_136 = Ws_Map::select('*')->where('no_seat', 136)->where('area', '=', '3D Animation')->first();
        $anim_137 = Ws_Map::select('*')->where('no_seat', 137)->where('area', '=', '3D Animation')->first();
        $anim_138 = Ws_Map::select('*')->where('no_seat', 138)->where('area', '=', '3D Animation')->first();
        $anim_139 = Ws_Map::select('*')->where('no_seat', 139)->where('area', '=', '3D Animation')->first();
        $anim_140 = Ws_Map::select('*')->where('no_seat', 140)->where('area', '=', '3D Animation')->first();
        $anim_141 = Ws_Map::select('*')->where('no_seat', 141)->where('area', '=', '3D Animation')->first();
        $anim_142 = Ws_Map::select('*')->where('no_seat', 142)->where('area', '=', '3D Animation')->first();
        $anim_143 = Ws_Map::select('*')->where('no_seat', 143)->where('area', '=', '3D Animation')->first();
        $anim_144 = Ws_Map::select('*')->where('no_seat', 144)->where('area', '=', '3D Animation')->first();
        $anim_145 = Ws_Map::select('*')->where('no_seat', 145)->where('area', '=', '3D Animation')->first();
        $anim_146 = Ws_Map::select('*')->where('no_seat', 146)->where('area', '=', '3D Animation')->first();
        $anim_147 = Ws_Map::select('*')->where('no_seat', 147)->where('area', '=', '3D Animation')->first();
        $anim_148 = Ws_Map::select('*')->where('no_seat', 148)->where('area', '=', '3D Animation')->first();
        $anim_149 = Ws_Map::select('*')->where('no_seat', 149)->where('area', '=', '3D Animation')->first();
        $anim_150 = Ws_Map::select('*')->where('no_seat', 150)->where('area', '=', '3D Animation')->first();
        $anim_151 = Ws_Map::select('*')->where('no_seat', 151)->where('area', '=', '3D Animation')->first();
        $anim_152 = Ws_Map::select('*')->where('no_seat', 152)->where('area', '=', '3D Animation')->first();
        $anim_153 = Ws_Map::select('*')->where('no_seat', 153)->where('area', '=', '3D Animation')->first();
        $anim_154 = Ws_Map::select('*')->where('no_seat', 154)->where('area', '=', '3D Animation')->first();
        $anim_155 = Ws_Map::select('*')->where('no_seat', 155)->where('area', '=', '3D Animation')->first();
        $anim_156 = Ws_Map::select('*')->where('no_seat', 156)->where('area', '=', '3D Animation')->first();
        $anim_157 = Ws_Map::select('*')->where('no_seat', 157)->where('area', '=', '3D Animation')->first();
        $anim_158 = Ws_Map::select('*')->where('no_seat', 158)->where('area', '=', '3D Animation')->first();
        $anim_159 = Ws_Map::select('*')->where('no_seat', 159)->where('area', '=', '3D Animation')->first();

        $animasii = WS_MAP::where('area', '3D Animation')->get();


        return view::make('IT.WS_MAP.3D.index_3D', [
            'animasii'  => $animasii,
            'anim_1' => $anim_1,
            'anim_2' => $anim_2,
            'anim_3' => $anim_3,
            'anim_4' => $anim_4,
            'anim_5' => $anim_5,
            'anim_6' => $anim_6,
            'anim_7' => $anim_7,
            'anim_8' => $anim_8,
            'anim_9' => $anim_9,
            'anim_10' => $anim_10,
            'anim_11' => $anim_11,
            'anim_12' => $anim_12,
            'anim_13' => $anim_13,
            'anim_14' => $anim_14,
            'anim_15' => $anim_15,
            'anim_16' => $anim_16,
            'anim_17' => $anim_17,
            'anim_18' => $anim_18,
            'anim_19' => $anim_19,
            'anim_20' => $anim_20,
            'anim_21' => $anim_21,
            'anim_22' => $anim_22,
            'anim_23' => $anim_23,
            'anim_24' => $anim_24,
            'anim_25' => $anim_25,
            'anim_26' => $anim_26,
            'anim_27' => $anim_27,
            'anim_28' => $anim_28,
            'anim_29' => $anim_29,
            'anim_30' => $anim_30,
            'anim_31' => $anim_31,
            'anim_32' => $anim_32,
            'anim_33' => $anim_33,
            'anim_34' => $anim_34,
            'anim_35' => $anim_35,
            'anim_36' => $anim_36,
            'anim_37' => $anim_37,
            'anim_38' => $anim_38,
            'anim_39' => $anim_39,
            'anim_40' => $anim_40,
            'anim_41' => $anim_41,
            'anim_42' => $anim_42,
            'anim_43' => $anim_43,
            'anim_44' => $anim_44,
            'anim_45' => $anim_45,
            'anim_46' => $anim_46,
            'anim_47' => $anim_47,
            'anim_48' => $anim_48,
            'anim_49' => $anim_49,
            'anim_50' => $anim_50,
            'anim_51' => $anim_51,
            'anim_52' => $anim_52,
            'anim_53' => $anim_53,
            'anim_54' => $anim_54,
            'anim_55' => $anim_55,
            'anim_56' => $anim_56,
            'anim_57' => $anim_57,
            'anim_58' => $anim_58,
            'anim_59' => $anim_59,
            'anim_60' => $anim_60,
            'anim_61' => $anim_61,
            'anim_62' => $anim_62,
            'anim_63' => $anim_63,
            'anim_64' => $anim_64,
            'anim_65' => $anim_65,
            'anim_66' => $anim_66,
            'anim_67' => $anim_67,
            'anim_68' => $anim_68,
            'anim_69' => $anim_69,
            'anim_70' => $anim_70,
            'anim_71' => $anim_71,
            'anim_72' => $anim_72,
            'anim_73' => $anim_73,
            'anim_74' => $anim_74,
            'anim_75' => $anim_75,
            'anim_76' => $anim_76,
            'anim_77' => $anim_77,
            'anim_78' => $anim_78,
            'anim_79' => $anim_79,
            'anim_80' => $anim_80,
            'anim_81' => $anim_81,
            'anim_82' => $anim_82,
            'anim_83' => $anim_83,
            'anim_84' => $anim_84,
            'anim_85' => $anim_85,
            'anim_86' => $anim_86,
            'anim_87' => $anim_87,
            'anim_88' => $anim_88,
            'anim_89' => $anim_89,
            'anim_90' => $anim_90,
            'anim_91' => $anim_91,
            'anim_92' => $anim_92,
            'anim_93' => $anim_93,
            'anim_94' => $anim_94,
            'anim_95' => $anim_95,
            'anim_96' => $anim_96,
            'anim_97' => $anim_97,
            'anim_98' => $anim_98,
            'anim_99' => $anim_99,
            'anim_100' => $anim_100,
            'anim_101' => $anim_101,
            'anim_102' => $anim_102,
            'anim_103' => $anim_103,
            'anim_104' => $anim_104,
            'anim_105' => $anim_105,
            'anim_106' => $anim_106,
            'anim_107' => $anim_107,
            'anim_108' => $anim_108,
            'anim_109' => $anim_109,
            'anim_110' => $anim_110,
            'anim_111' => $anim_111,
            'anim_112' => $anim_112,
            'anim_113' => $anim_113,
            'anim_114' => $anim_114,
            'anim_115' => $anim_115,
            'anim_116' => $anim_116,
            'anim_117' => $anim_117,
            'anim_118' => $anim_118,
            'anim_119' => $anim_119,
            'anim_120' => $anim_120,
            'anim_121' => $anim_121,
            'anim_122' => $anim_122,
            'anim_123' => $anim_123,
            'anim_124' => $anim_124,
            'anim_125' => $anim_125,
            'anim_126' => $anim_126,
            'anim_127' => $anim_127,
            'anim_128' => $anim_128,
            'anim_129' => $anim_129,
            'anim_130' => $anim_130,
            'anim_131' => $anim_131,
            'anim_132' => $anim_132,
            'anim_133' => $anim_133,
            'anim_134' => $anim_134,
            'anim_135' => $anim_135,
            'anim_136' => $anim_136,
            'anim_137' => $anim_137,
            'anim_138' => $anim_138,
            'anim_139' => $anim_139,
            'anim_140' => $anim_140,
            'anim_140' => $anim_140,
            'anim_141' => $anim_141,
            'anim_142' => $anim_142,
            'anim_143' => $anim_143,
            'anim_144' => $anim_144,
            'anim_145' => $anim_145,
            'anim_146' => $anim_146,
            'anim_147' => $anim_147,
            'anim_148' => $anim_148,
            'anim_149' => $anim_149,
            'anim_150' => $anim_150,
            'anim_151' => $anim_151,
            'anim_152' => $anim_152,
            'anim_153' => $anim_153,
            'anim_154' => $anim_154,
            'anim_155' => $anim_155,
            'anim_156' => $anim_156,
            'anim_157' => $anim_157,
            'anim_158' => $anim_158,
            'anim_159' => $anim_159,
        ]);
    }

    public function PDF_3D_Animation()
    {
        $name = auth::user()->username;
        /*    
		$pdf = App::make('dompdf.wrapper');        
		$pdf->loadview('IT.WS_MAP.pdf_3d')->setPaper('A3', 'landscape');
		return $pdf->stream();*/
        return view::make('IT.WS_MAP.3D.print', ['name' => $name]);
    }

    public function loadHTML3D_Animation()
    {
        $anim_1 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 1)->where('area', '=', '3D Animation')->first();
        $anim_2 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 2)->where('area', '=', '3D Animation')->first();
        $anim_3 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 3)->where('area', '=', '3D Animation')->first();
        $anim_4 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 4)->where('area', '=', '3D Animation')->first();
        $anim_5 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 5)->where('area', '=', '3D Animation')->first();
        $anim_6 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 6)->where('area', '=', '3D Animation')->first();
        $anim_7 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 7)->where('area', '=', '3D Animation')->first();
        $anim_8 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 8)->where('area', '=', '3D Animation')->first();
        $anim_9 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 9)->where('area', '=', '3D Animation')->first();
        $anim_10 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 10)->where('area', '=', '3D Animation')->first();
        $anim_11 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 11)->where('area', '=', '3D Animation')->first();
        $anim_12 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 12)->where('area', '=', '3D Animation')->first();
        $anim_13 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 13)->where('area', '=', '3D Animation')->first();
        $anim_14 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 14)->where('area', '=', '3D Animation')->first();
        $anim_15 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 15)->where('area', '=', '3D Animation')->first();
        $anim_16 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 16)->where('area', '=', '3D Animation')->first();
        $anim_17 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 17)->where('area', '=', '3D Animation')->first();
        $anim_18 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 18)->where('area', '=', '3D Animation')->first();
        $anim_19 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 19)->where('area', '=', '3D Animation')->first();
        $anim_20 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 20)->where('area', '=', '3D Animation')->first();
        $anim_21 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 21)->where('area', '=', '3D Animation')->first();
        $anim_22 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 22)->where('area', '=', '3D Animation')->first();
        $anim_23 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 23)->where('area', '=', '3D Animation')->first();
        $anim_24 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 24)->where('area', '=', '3D Animation')->first();
        $anim_25 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 25)->where('area', '=', '3D Animation')->first();
        $anim_26 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 26)->where('area', '=', '3D Animation')->first();
        $anim_27 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 27)->where('area', '=', '3D Animation')->first();
        $anim_28 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 28)->where('area', '=', '3D Animation')->first();
        $anim_29 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 29)->where('area', '=', '3D Animation')->first();
        $anim_30 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 30)->where('area', '=', '3D Animation')->first();
        $anim_31 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 31)->where('area', '=', '3D Animation')->first();
        $anim_32 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 32)->where('area', '=', '3D Animation')->first();
        $anim_33 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 33)->where('area', '=', '3D Animation')->first();
        $anim_34 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 34)->where('area', '=', '3D Animation')->first();
        $anim_35 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 35)->where('area', '=', '3D Animation')->first();
        $anim_36 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 36)->where('area', '=', '3D Animation')->first();
        $anim_37 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 37)->where('area', '=', '3D Animation')->first();
        $anim_38 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 38)->where('area', '=', '3D Animation')->first();
        $anim_39 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 39)->where('area', '=', '3D Animation')->first();
        $anim_40 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 40)->where('area', '=', '3D Animation')->first();
        $anim_41 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 41)->where('area', '=', '3D Animation')->first();
        $anim_42 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 42)->where('area', '=', '3D Animation')->first();
        $anim_43 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 43)->where('area', '=', '3D Animation')->first();
        $anim_44 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 44)->where('area', '=', '3D Animation')->first();
        $anim_45 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 45)->where('area', '=', '3D Animation')->first();
        $anim_46 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 46)->where('area', '=', '3D Animation')->first();
        $anim_47 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 47)->where('area', '=', '3D Animation')->first();
        $anim_48 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 48)->where('area', '=', '3D Animation')->first();
        $anim_49 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 49)->where('area', '=', '3D Animation')->first();
        $anim_50 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 50)->where('area', '=', '3D Animation')->first();
        $anim_51 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 51)->where('area', '=', '3D Animation')->first();
        $anim_52 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 52)->where('area', '=', '3D Animation')->first();
        $anim_53 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 53)->where('area', '=', '3D Animation')->first();
        $anim_54 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 54)->where('area', '=', '3D Animation')->first();
        $anim_55 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 55)->where('area', '=', '3D Animation')->first();
        $anim_56 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 56)->where('area', '=', '3D Animation')->first();
        $anim_57 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 57)->where('area', '=', '3D Animation')->first();
        $anim_58 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 58)->where('area', '=', '3D Animation')->first();
        $anim_59 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 59)->where('area', '=', '3D Animation')->first();
        $anim_60 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 60)->where('area', '=', '3D Animation')->first();
        $anim_61 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 61)->where('area', '=', '3D Animation')->first();
        $anim_62 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 62)->where('area', '=', '3D Animation')->first();
        $anim_63 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 63)->where('area', '=', '3D Animation')->first();
        $anim_64 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 64)->where('area', '=', '3D Animation')->first();
        $anim_65 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 65)->where('area', '=', '3D Animation')->first();
        $anim_66 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 66)->where('area', '=', '3D Animation')->first();
        $anim_67 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 67)->where('area', '=', '3D Animation')->first();
        $anim_68 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 68)->where('area', '=', '3D Animation')->first();
        $anim_69 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 69)->where('area', '=', '3D Animation')->first();
        $anim_70 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 70)->where('area', '=', '3D Animation')->first();
        $anim_71 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 71)->where('area', '=', '3D Animation')->first();
        $anim_72 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 72)->where('area', '=', '3D Animation')->first();
        $anim_73 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 73)->where('area', '=', '3D Animation')->first();
        $anim_74 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 74)->where('area', '=', '3D Animation')->first();
        $anim_75 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 75)->where('area', '=', '3D Animation')->first();
        $anim_76 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 76)->where('area', '=', '3D Animation')->first();
        $anim_77 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 77)->where('area', '=', '3D Animation')->first();
        $anim_78 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 78)->where('area', '=', '3D Animation')->first();
        $anim_79 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 79)->where('area', '=', '3D Animation')->first();
        $anim_80 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 80)->where('area', '=', '3D Animation')->first();
        $anim_81 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 81)->where('area', '=', '3D Animation')->first();
        $anim_82 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 82)->where('area', '=', '3D Animation')->first();
        $anim_83 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 83)->where('area', '=', '3D Animation')->first();
        $anim_84 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 84)->where('area', '=', '3D Animation')->first();
        $anim_85 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 85)->where('area', '=', '3D Animation')->first();
        $anim_86 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 86)->where('area', '=', '3D Animation')->first();
        $anim_87 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 87)->where('area', '=', '3D Animation')->first();
        $anim_88 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 88)->where('area', '=', '3D Animation')->first();
        $anim_89 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 89)->where('area', '=', '3D Animation')->first();
        $anim_90 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 90)->where('area', '=', '3D Animation')->first();
        $anim_91 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 91)->where('area', '=', '3D Animation')->first();
        $anim_92 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 92)->where('area', '=', '3D Animation')->first();
        $anim_93 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 93)->where('area', '=', '3D Animation')->first();
        $anim_94 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 94)->where('area', '=', '3D Animation')->first();
        $anim_95 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 95)->where('area', '=', '3D Animation')->first();
        $anim_96 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 96)->where('area', '=', '3D Animation')->first();
        $anim_97 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 97)->where('area', '=', '3D Animation')->first();
        $anim_98 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 98)->where('area', '=', '3D Animation')->first();
        $anim_99 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 99)->where('area', '=', '3D Animation')->first();
        $anim_100 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 100)->where('area', '=', '3D Animation')->first();
        $anim_101 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 101)->where('area', '=', '3D Animation')->first();
        $anim_102 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 102)->where('area', '=', '3D Animation')->first();
        $anim_103 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 103)->where('area', '=', '3D Animation')->first();
        $anim_104 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 104)->where('area', '=', '3D Animation')->first();
        $anim_105 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 105)->where('area', '=', '3D Animation')->first();
        $anim_106 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 106)->where('area', '=', '3D Animation')->first();
        $anim_107 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 107)->where('area', '=', '3D Animation')->first();
        $anim_108 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 108)->where('area', '=', '3D Animation')->first();
        $anim_109 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 109)->where('area', '=', '3D Animation')->first();
        $anim_110 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 110)->where('area', '=', '3D Animation')->first();
        $anim_111 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 111)->where('area', '=', '3D Animation')->first();
        $anim_112 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 112)->where('area', '=', '3D Animation')->first();
        $anim_113 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 113)->where('area', '=', '3D Animation')->first();
        $anim_114 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 114)->where('area', '=', '3D Animation')->first();
        $anim_115 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 115)->where('area', '=', '3D Animation')->first();
        $anim_116 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 116)->where('area', '=', '3D Animation')->first();
        $anim_117 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 117)->where('area', '=', '3D Animation')->first();
        $anim_118 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 118)->where('area', '=', '3D Animation')->first();
        $anim_119 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 119)->where('area', '=', '3D Animation')->first();
        $anim_120 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 120)->where('area', '=', '3D Animation')->first();
        $anim_121 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 121)->where('area', '=', '3D Animation')->first();
        $anim_122 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 122)->where('area', '=', '3D Animation')->first();
        $anim_123 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 123)->where('area', '=', '3D Animation')->first();
        $anim_124 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 124)->where('area', '=', '3D Animation')->first();
        $anim_125 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 125)->where('area', '=', '3D Animation')->first();
        $anim_126 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 126)->where('area', '=', '3D Animation')->first();
        $anim_127 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 127)->where('area', '=', '3D Animation')->first();
        $anim_128 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 128)->where('area', '=', '3D Animation')->first();
        $anim_129 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 129)->where('area', '=', '3D Animation')->first();
        $anim_130 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 130)->where('area', '=', '3D Animation')->first();
        $anim_131 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 131)->where('area', '=', '3D Animation')->first();
        $anim_132 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 132)->where('area', '=', '3D Animation')->first();
        $anim_133 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 133)->where('area', '=', '3D Animation')->first();
        $anim_134 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 134)->where('area', '=', '3D Animation')->first();
        $anim_135 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 135)->where('area', '=', '3D Animation')->first();
        $anim_136 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 136)->where('area', '=', '3D Animation')->first();
        $anim_137 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 137)->where('area', '=', '3D Animation')->first();
        $anim_138 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 138)->where('area', '=', '3D Animation')->first();
        $anim_139 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 139)->where('area', '=', '3D Animation')->first();
        $anim_140 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 140)->where('area', '=', '3D Animation')->first();
        $anim_141 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 141)->where('area', '=', '3D Animation')->first();
        $anim_142 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 142)->where('area', '=', '3D Animation')->first();
        $anim_143 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 143)->where('area', '=', '3D Animation')->first();
        $anim_144 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 144)->where('area', '=', '3D Animation')->first();
        $anim_145 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 145)->where('area', '=', '3D Animation')->first();
        $anim_146 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 146)->where('area', '=', '3D Animation')->first();
        $anim_147 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 147)->where('area', '=', '3D Animation')->first();
        $anim_148 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 148)->where('area', '=', '3D Animation')->first();
        $anim_149 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 149)->where('area', '=', '3D Animation')->first();
        $anim_150 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 150)->where('area', '=', '3D Animation')->first();
        $anim_151 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 151)->where('area', '=', '3D Animation')->first();
        $anim_152 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 152)->where('area', '=', '3D Animation')->first();
        $anim_153 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 153)->where('area', '=', '3D Animation')->first();
        $anim_154 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 154)->where('area', '=', '3D Animation')->first();
        $anim_155 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 155)->where('area', '=', '3D Animation')->first();
        $anim_156 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 156)->where('area', '=', '3D Animation')->first();
        $anim_157 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 157)->where('area', '=', '3D Animation')->first();
        $anim_158 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 158)->where('area', '=', '3D Animation')->first();
        $anim_159 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 159)->where('area', '=', '3D Animation')->first();
        $total_seat = Ws_Map::where('area', '=', '3D Animation')->count();
        $pdf = App::make('dompdf.wrapper');
        ini_set("memory_limit", '512M');

        $pdf->loadview('IT.WS_MAP.3D.pdf', [
            'total_seat' => $total_seat,
            'anim_1' => $anim_1,
            'anim_2' => $anim_2,
            'anim_3' => $anim_3,
            'anim_4' => $anim_4,
            'anim_5' => $anim_5,
            'anim_6' => $anim_6,
            'anim_7' => $anim_7,
            'anim_8' => $anim_8,
            'anim_9' => $anim_9,
            'anim_10' => $anim_10,
            'anim_11' => $anim_11,
            'anim_12' => $anim_12,
            'anim_13' => $anim_13,
            'anim_14' => $anim_14,
            'anim_15' => $anim_15,
            'anim_16' => $anim_16,
            'anim_17' => $anim_17,
            'anim_18' => $anim_18,
            'anim_19' => $anim_19,
            'anim_20' => $anim_20,
            'anim_21' => $anim_21,
            'anim_22' => $anim_22,
            'anim_23' => $anim_23,
            'anim_24' => $anim_24,
            'anim_25' => $anim_25,
            'anim_26' => $anim_26,
            'anim_27' => $anim_27,
            'anim_28' => $anim_28,
            'anim_29' => $anim_29,
            'anim_30' => $anim_30,
            'anim_31' => $anim_31,
            'anim_32' => $anim_32,
            'anim_33' => $anim_33,
            'anim_34' => $anim_34,
            'anim_35' => $anim_35,
            'anim_36' => $anim_36,
            'anim_37' => $anim_37,
            'anim_38' => $anim_38,
            'anim_39' => $anim_39,
            'anim_40' => $anim_40,
            'anim_41' => $anim_41,
            'anim_42' => $anim_42,
            'anim_43' => $anim_43,
            'anim_44' => $anim_44,
            'anim_45' => $anim_45,
            'anim_46' => $anim_46,
            'anim_47' => $anim_47,
            'anim_48' => $anim_48,
            'anim_49' => $anim_49,
            'anim_50' => $anim_50,
            'anim_51' => $anim_51,
            'anim_52' => $anim_52,
            'anim_53' => $anim_53,
            'anim_54' => $anim_54,
            'anim_55' => $anim_55,
            'anim_56' => $anim_56,
            'anim_57' => $anim_57,
            'anim_58' => $anim_58,
            'anim_59' => $anim_59,
            'anim_60' => $anim_60,
            'anim_61' => $anim_61,
            'anim_62' => $anim_62,
            'anim_63' => $anim_63,
            'anim_64' => $anim_64,
            'anim_65' => $anim_65,
            'anim_66' => $anim_66,
            'anim_67' => $anim_67,
            'anim_68' => $anim_68,
            'anim_69' => $anim_69,
            'anim_70' => $anim_70,
            'anim_71' => $anim_71,
            'anim_72' => $anim_72,
            'anim_73' => $anim_73,
            'anim_74' => $anim_74,
            'anim_75' => $anim_75,
            'anim_76' => $anim_76,
            'anim_77' => $anim_77,
            'anim_78' => $anim_78,
            'anim_79' => $anim_79,
            'anim_80' => $anim_80,
            'anim_81' => $anim_81,
            'anim_82' => $anim_82,
            'anim_83' => $anim_83,
            'anim_84' => $anim_84,
            'anim_85' => $anim_85,
            'anim_86' => $anim_86,
            'anim_87' => $anim_87,
            'anim_88' => $anim_88,
            'anim_89' => $anim_89,
            'anim_90' => $anim_90,
            'anim_91' => $anim_91,
            'anim_92' => $anim_92,
            'anim_93' => $anim_93,
            'anim_94' => $anim_94,
            'anim_95' => $anim_95,
            'anim_96' => $anim_96,
            'anim_97' => $anim_97,
            'anim_98' => $anim_98,
            'anim_99' => $anim_99,
            'anim_100' => $anim_100,
            'anim_101' => $anim_101,
            'anim_102' => $anim_102,
            'anim_103' => $anim_103,
            'anim_104' => $anim_104,
            'anim_105' => $anim_105,
            'anim_106' => $anim_106,
            'anim_107' => $anim_107,
            'anim_108' => $anim_108,
            'anim_109' => $anim_109,
            'anim_110' => $anim_110,
            'anim_111' => $anim_111,
            'anim_112' => $anim_112,
            'anim_113' => $anim_113,
            'anim_114' => $anim_114,
            'anim_115' => $anim_115,
            'anim_116' => $anim_116,
            'anim_117' => $anim_117,
            'anim_118' => $anim_118,
            'anim_119' => $anim_119,
            'anim_120' => $anim_120,
            'anim_121' => $anim_121,
            'anim_122' => $anim_122,
            'anim_123' => $anim_123,
            'anim_124' => $anim_124,
            'anim_125' => $anim_125,
            'anim_126' => $anim_126,
            'anim_127' => $anim_127,
            'anim_128' => $anim_128,
            'anim_129' => $anim_129,
            'anim_130' => $anim_130,
            'anim_131' => $anim_131,
            'anim_132' => $anim_132,
            'anim_133' => $anim_133,
            'anim_134' => $anim_134,
            'anim_135' => $anim_135,
            'anim_136' => $anim_136,
            'anim_137' => $anim_137,
            'anim_138' => $anim_138,
            'anim_139' => $anim_139,
            'anim_140' => $anim_140,
            'anim_140' => $anim_140,
            'anim_141' => $anim_141,
            'anim_142' => $anim_142,
            'anim_143' => $anim_143,
            'anim_144' => $anim_144,
            'anim_145' => $anim_145,
            'anim_146' => $anim_146,
            'anim_147' => $anim_147,
            'anim_148' => $anim_148,
            'anim_149' => $anim_149,
            'anim_150' => $anim_150,
            'anim_151' => $anim_151,
            'anim_152' => $anim_152,
            'anim_153' => $anim_153,
            'anim_154' => $anim_154,
            'anim_155' => $anim_155,
            'anim_156' => $anim_156,
            'anim_157' => $anim_157,
            'anim_158' => $anim_158,
            'anim_159' => $anim_159,
        ])
            ->setPaper('A1', 'landscape')
            ->setOptions(['dpi' => 100, 'defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }

    public function postData3DMap(Request $request, $id)
    {

        $animasi = Ws_Map::where('id', '=', $id)->first();

        $AvailabilityMap = ws_Availability::orderBy('hostname', 'asc')->get();

        $ws_availability = ws_Availability::where('hostname', '=', $animasi->workstation)->first();

        $ws_after = ws_Availability::where('hostname', '=', $animasi->workstation)->first();

        $workstation = ws_Availability::select('hostname')->orderBy('hostname', 'asc')->pluck('hostname');


        return view::make('IT.WS_MAP.3D.post3DMap', [
            'animasi' => $animasi,
            'AvailabilityMap' => $AvailabilityMap,
            'ws_availability' => $ws_availability,
            'ws_after' => $ws_after,
        ]);
    }

    public function postInputData3DMap(Request $request, $id)
    {
        $animasi = Ws_Map::where('id', '=', $id)->first();
        if ($request->input('workstation') != null) {
            $ws_availability = ws_Availability::where('hostname', '=', $request->input('workstation'))->first();
        }
        if ($request->input('secondary_workstation') != null) {
            $ws_availability2 = ws_Availability::where('hostname', '=', $request->input('secondary_workstation'))->first();
        }

        $rules = [
            'no_seat'          => 'required',
            'area'             => 'required',
        ];

        if ($request->input('secondary_workstation') === null and $request->input('workstation') === null) {
            $data = [
                'user'             => $request->input('username'),
                'workstation'      => $request->input('workstation'),
                'workstation1_id'  => null,
                'secondary_workstation' => $request->input('secondary_workstation'),
                'workstation2_id'  => null,
                'monitor1'         => $request->input('monitor1'),
                'monitor2'         => $request->input('monitor2'),
                'wacom'            => $request->input('wacom'),
                'no_seat'          => $request->input('no_seat'),
                'area'             => $request->input('area'),
                'updated_by'       => auth::user()->first_name . ' ' . auth::user()->last_name,
            ];
        } elseif ($request->input('secondary_workstation') === null and $request->input('workstation') != null) {
            $findmainsecondws = null;
            $findmainws = db::table('asseting_barcode')->select('*')->where('addtional', 'like', '%' . $request->input('workstation') . '%')->first();

            if ($findmainws != null) {
                $barcode = $findmainws->instansi_id . $findmainws->barcode_id . $findmainws->id;
            } else {
                $barcode = null;
            }

            $data = [
                'user'             => $request->input('username'),
                'workstation'      => $request->input('workstation'),
                'workstation1_id'  =>     $barcode,
                'secondary_workstation' => $request->input('secondary_workstation'),
                'workstation2_id'  => $findmainsecondws,
                'monitor1'         => $request->input('monitor1'),
                'monitor2'         => $request->input('monitor2'),
                'wacom'            => $request->input('wacom'),
                'no_seat'          => $request->input('no_seat'),
                'area'             => $request->input('area'),
                'updated_by'       => auth::user()->first_name . ' ' . auth::user()->last_name,
            ];
        } elseif ($request->input('secondary_workstation') != null and $request->input('workstation') === null) {
            $findmainws = null;
            $findmainsecondws = db::table('asseting_barcode')->select('*')->where('addtional', 'like', '%' . $request->input('secondary_workstation') . '%')->first();

            if ($findmainsecondws != null) {
                $barcode = $findmainsecondws->instansi_id . $findmainsecondws->barcode_id . $findmainsecondws->id;
            } else {
                $barcode = null;
            }
            $data = [
                'user'             => $request->input('username'),
                'workstation'      => $request->input('workstation'),
                'workstation1_id'  => $findmainws,
                'secondary_workstation' => $request->input('secondary_workstation'),
                'workstation2_id'  => $findmainsecondws->instansi_id . $findmainsecondws->barcode_id . $findmainsecondws->id,
                'monitor1'         => $request->input('monitor1'),
                'monitor2'         => $request->input('monitor2'),
                'no_seat'          => $request->input('no_seat'),
                'wacom'            => $request->input('wacom'),
                'area'             => $request->input('area'),
                'updated_by'       => auth::user()->first_name . ' ' . auth::user()->last_name,
            ];
        } elseif ($request->input('secondary_workstation') != null and $request->input('workstation') != null) {
            $findmainsecondws = db::table('asseting_barcode')->select('*')->where('addtional', 'like', '%' . $request->input('secondary_workstation') . '%')->first();
            $findmainws = db::table('asseting_barcode')->select('*')->where('addtional', 'like', '%' . $request->input('workstation') . '%')->first();

            if ($findmainsecondws != null) {
                $barcodews = $findmainsecondws->instansi_id . $findmainsecondws->barcode_id . $findmainsecondws->id;
            } else {
                $barcodews = null;
            }


            if ($findmainws != null) {
                $barcode = $findmainws->instansi_id . $findmainws->barcode_id . $findmainws->id;
            } else {
                $barcode = null;
            }

            $data = [
                'user'             => $request->input('username'),
                'workstation'      => $request->input('workstation'),
                'workstation1_id'  => $barcode,
                'secondary_workstation' => $request->input('secondary_workstation'),
                'workstation2_id'  => $barcodews,
                'monitor1'         => $request->input('monitor1'),
                'monitor2'         => $request->input('monitor2'),
                'wacom'            => strtoupper($request->input('wacom')),
                'no_seat'          => $request->input('no_seat'),
                'area'             => $request->input('area'),
                'updated_by'       => auth::user()->first_name . ' ' . auth::user()->last_name,
            ];
        }

        if ($request->input('workstation') != null) {
            $data2 = [
                'hostname'      => $request->input('workstation'),
                'type'          => $ws_availability->type,
                'user'          => $request->input('username'),
                'os'            => $ws_availability->os,
                'Memory'        => $ws_availability->memory,
                'vga'           => $ws_availability->vga,
                'location'      => $request->input('area'),
                'notes'         => $ws_availability->notes,
            ];
        }

        if ($request->input('secondary_workstation') != null) {
            $data3 = [
                'hostname'      => $request->input('secondary_workstation'),
                'type'          => $ws_availability2->type,
                'user'          => $request->input('username'),
                'os'            => $ws_availability2->os,
                'Memory'        => $ws_availability2->memory,
                'vga'           => $ws_availability2->vga,
                'location'      => $request->input('area'),
                'notes'         => $ws_availability2->notes,
            ];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('message', Lang::get('messages.data_error', ['data' => 'Sorry, Data']));
            return Redirect::route('postData3DMap', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($request->input('workstation') != null) {
                db::table('ws_Availability')->where('hostname', '=', $ws_availability->hostname)->update($data2);
                db::table('log_ws_Availability')->insert($data2);
            }
            if ($request->input('secondary_workstation') != null) {
                db::table('ws_Availability')->where('hostname', '=', $ws_availability2->hostname)->update($data3);
                db::table('log_ws_Availability')->insert($data3);
            }
            db::table('ws_map')->where('id', '=', $id)->update($data);
            Session::flash('message', Lang::get('messages.data_map_updated', ['data' => 'Data Map']));
            return Redirect::route('indexMAP');
        }
    }

    public function ImportData3DMap(Request $request, $id)
    {

        if ($request->file('mapp') === NULL) {
            return Redirect::route('postData3DMap', [$id])->with('getError', Lang::get('messages.upload_nothing'));
        } else {
            if ($request->hasFile('mapp')) {
                $path = $request->file('mapp')->getRealPath();
                $data = Excel::load($path)->get();
                if ($data->count()) {
                    foreach ($data as $key => $value) {
                        $arr[] = [
                            'id'           => $value->id,
                            'no_seat'      => $value->no_seat,
                            'area'         => $value->area,
                            'workstation'  => $value->workstation,
                            'secondary_workstation' => $value->secondary,
                            'user'         => $value->user,
                            'monitor1'     => $value->monitor,
                            'id_monitor1'  => null,
                            'monitor2'     => $value->monitorr,
                            'id_monitor2'  => null,
                            'wacom'        => $value->wacom,
                            'created_by'   => auth::user()->first_name . ' ' . auth::user()->last_name,
                            'updated_by'  => auth::user()->first_name . ' ' . auth::user()->last_name,
                        ];
                    }

                    if (!empty($arr)) {
                        WS_MAP::insert($arr);
                        $file = $request->file('mapp');
                        $name = 'WS_MAP' . \Carbon\Carbon::now()->format('Y-m-d') . '.' . $file->getClientOriginalExtension();
                        $path = $file->storeAs('WS_MAP', $name);
                        Session::flash('message', Lang::get('messages.data_upload', ['data' => 'Data Employee']));
                        return Redirect::back();
                    }
                }
            }
            return Redirect::route('postData3DMap', [$id])->with('getError', Lang::get('messages.data_problem'));;
        }
    }

    public function Detail3DMap($id)
    {
        $detaill = WS_MAP::find($id);
        $detail = Ws_Availability::where('hostname', '=', $detaill->workstation)->first();

        $return   = "
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				<h4 class='modal-title' id='showModalLabel'>Detail Workstation</h4>
			</div>
			<div class='modal-body'>
				<form class='form-horizontal' enctype='multipart/form-data'>   
				   <div class='form-group'>
					  <label class='control-label  col-sm-2' for='username'>User:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='username' placeholder='Nothing' value='$detail->user' name='username' readonly='true'>
					  </div>                      
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='workstation'>Workstation:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='workstation' placeholder='Nothing' value='$detail->hostname' name='workstation' readonly='true'>
					  </div>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='workstation' placeholder='Nothing' value='$detaill->workstation1_id' name='workstation' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='type'>Type:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='type' placeholder='Nothing' value='$detail->type' name='type' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='os'>Operation System:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='os' placeholder='Nothing' value='$detail->os' name='os' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='memory'>Memory:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='memory' placeholder='Nothing' value='$detail->memory' name='memory' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='vga'>GPU:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='vga' placeholder='Nothing' value='$detail->vga' name='vga' readonly='true'>
					  </div>					  
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='monitor1'>Main Monitor:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='monitor1' placeholder='Nothing' value='$detaill->monitor1' name='monitor1' readonly='true'>
					  </div>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='workstation' placeholder='Nothing' value='$detaill->id_monitor1' name='workstation' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='monitor2'>Secondary Monitor:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='monitor2' placeholder='Nothing' value='$detaill->monitor2' name='monitor2' readonly='true'>
					 </div>
					 <div class=' col-sm-5'>
						<input type='text' class='form-control' id='workstation' placeholder='Nothing' value='$detaill->id_monitor2' name='workstation' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='additem'>Wacom:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='additem' placeholder='Nothing' value='$detaill->wacom' name='additem' readonly='true'>
					  </div>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='workstation' placeholder='Nothing' value='$detaill->wacom_id' name='workstation' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='no_seat'>No Seat:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='no_seat' placeholder='Nothing' value='$detaill->no_seat' name='no_seat' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='area'>Area:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='area' placeholder='Nothing' value='$detaill->area' name='area' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='notes'>Notes:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='notes' placeholder='Nothing' value='$detail->notes' name='notes' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='notes'>Updated By:</label>
					  <div class=' col-sm-10'>
						<p>$detail->updated_by</p><p>$detaill->updated_by</p><br><p>$detaill->updated_at</p>
					  </div>
					</div>
				 </form>

			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
			</div>
		";
        return $return;
    }

    public function DetailMobileMap($id)
    {
        $detaill = WS_MAP::find($id);
        $detail = DB::table('laptop_availability')->where('hostname_laptop', '=', $detaill->workstation)->orwhere('hostname_laptop', '=', $detaill->workstation)->first();

        $return   = "
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				<h4 class='modal-title' id='showModalLabel'>Detail Workstation</h4>
			</div>
			<div class='modal-body'>
				<form class='form-horizontal' enctype='multipart/form-data'>   
				   <div class='form-group'>
					  <label class='control-label  col-sm-2' for='username'>User:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='username' placeholder='Nothing' value='$detaill->user' name='username' readonly='true'>
					  </div>                      
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='workstation'>Workstation:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='workstation' placeholder='Nothing' value='$detail->hostname_laptop' name='workstation' readonly='true'>
					  </div>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='workstation' placeholder='Nothing' value='$detaill->workstation1_id' name='workstation' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='type'>Type:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='type' placeholder='Nothing' value='$detail->type_laptop' name='type' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='os'>Operation System:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='os' placeholder='Nothing' value='$detail->os_laptop' name='os' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='memory'>Memory:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='memory' placeholder='Nothing' value='$detail->memory_laptop' name='memory' readonly='true'>
					  </div>
					</div>
				
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='no_seat'>No Seat:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='no_seat' placeholder='Nothing' value='$detaill->no_seat' name='no_seat' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='area'>Area:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='area' placeholder='Nothing' value='$detaill->area' name='area' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='notes'>Notes:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='notes' placeholder='Nothing' value='$detail->notes_laptop' name='notes' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='notes'>Updated By:</label>
					  <div class=' col-sm-10'>
						<p>$detail->updated_by</p><p>$detaill->updated_by</p><br><p>$detaill->updated_at</p>
					  </div>
					</div>
				 </form>

			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
			</div>
		";
        return $return;
    }
    public function DetailMobileMap2($id)
    {
        $detaill = WS_MAP::find($id);
        $detail = DB::table('laptop_availability')->where('hostname_laptop', '=', $detaill->secondary_workstation)->orwhere('hostname_laptop', '=', $detaill->secondary_workstation)->first();

        $return   = "
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				<h4 class='modal-title' id='showModalLabel'>Detail Workstation</h4>
			</div>
			<div class='modal-body'>
				<form class='form-horizontal' enctype='multipart/form-data'>   
				   <div class='form-group'>
					  <label class='control-label  col-sm-2' for='username'>User:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='username' placeholder='Nothing' value='$detaill->user' name='username' readonly='true'>
					  </div>                      
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='workstation'>Workstation:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='workstation' placeholder='Nothing' value='$detail->hostname_laptop' name='workstation' readonly='true'>
					  </div>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='workstation' placeholder='Nothing' value='$detaill->workstation2_id' name='workstation' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='type'>Type:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='type' placeholder='Nothing' value='$detail->type_laptop' name='type' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='os'>Operation System:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='os' placeholder='Nothing' value='$detail->os_laptop' name='os' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='memory'>Memory:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='memory' placeholder='Nothing' value='$detail->memory_laptop' name='memory' readonly='true'>
					  </div>
					</div>
				
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='no_seat'>No Seat:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='no_seat' placeholder='Nothing' value='$detaill->no_seat' name='no_seat' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='area'>Area:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='area' placeholder='Nothing' value='$detaill->area' name='area' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='notes'>Notes:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='notes' placeholder='Nothing' value='$detail->notes_laptop' name='notes' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='notes'>Updated By:</label>
					  <div class=' col-sm-10'>
						<p>$detail->updated_by</p><p>$detaill->updated_by</p><br><p>$detaill->updated_at</p>
					  </div>
					</div>
				 </form>

			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
			</div>
		";
        return $return;
    }

    public function Detail3DMap2($id)
    {
        $detaill = WS_MAP::find($id);
        $detail = Ws_Availability::where('hostname', '=', $detaill->secondary_workstation)->first();

        $return   = "
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				<h4 class='modal-title' id='showModalLabel2'>Detail Workstation</h4>
			</div>
			<div class='modal-body'>
				<form class='form-horizontal' enctype='multipart/form-data'>   
				   <div class='form-group'>
					  <label class='control-label  col-sm-2' for='username'>User:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='username' placeholder='Nothing' value='$detail->user' name='username' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='workstation'>Workstation:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='workstation' placeholder='Nothing' value='$detail->hostname' name='workstation' readonly='true'>
					  </div>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='workstation' placeholder='Nothing' value='$detaill->workstation2_id' name='workstation' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='type'>Type:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='type' placeholder='Nothing' value='$detail->type' name='type' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='os'>Operation System:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='os' placeholder='Nothing' value='$detail->os' name='os' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='memory'>Memory:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='memory' placeholder='Nothing' value='$detail->memory' name='memory' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='vga'>GPU:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='vga' placeholder='Nothing' value='$detail->vga' name='vga' readonly='true'>
					  </div>
					</div>
				<div class='form-group'>
					  <label class='control-label  col-sm-2' for='monitor1'>Main Monitor:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='monitor1' placeholder='Nothing' value='$detaill->monitor1' name='monitor1' readonly='true'>
					  </div>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='workstation' placeholder='Nothing' value='$detaill->id_monitor1' name='workstation' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='monitor2'>Secondary Monitor:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='monitor2' placeholder='Nothing' value='$detaill->monitor2' name='monitor2' readonly='true'>
					 </div>
					 <div class=' col-sm-5'>
						<input type='text' class='form-control' id='workstation' placeholder='Nothing' value='$detaill->id_monitor2' name='workstation' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='additem'>Wacom:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='additem' placeholder='Nothing' value='$detaill->wacom' name='additem' readonly='true'>
					  </div>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='workstation' placeholder='Nothing' value='$detaill->wacom_id' name='workstation' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='no_seat'>No Seat:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='no_seat' placeholder='Nothing' value='$detaill->no_seat' name='no_seat' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='area'>Area:</label>
					  <div class=' col-sm-5'>
						<input type='text' class='form-control' id='area' placeholder='Nothing' value='$detaill->area' name='area' readonly='true'>
					  </div>
					</div>
					<div class='form-group'>
					  <label class='control-label  col-sm-2' for='notes'>Notes:</label>
					  <div class=' col-sm-10'>
						<input type='text' class='form-control' id='notes' placeholder='Nothing' value='$detail->notes' name='notes' readonly='true'>
					  </div>
					</div>
				 </form>

			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
			</div>
		";

        return $return;
    }


    public function index_LegendWS()
    {
        $this->view_legend_z400_64gb();
        $this->view_legend_z400_48gb();
        $this->view_legend_z400_32gb();
        $this->view_legend_z400_24gb();
        $this->view_legend_z400_16gb();
        $this->view_legend_z400_12gb();
        $this->view_legend_z400_8gb();
        $this->view_legend_z400_6gb();
        $this->view_legend_z400_4gb();
        $this->view_legend_z400_0gb();

        $this->view_legend_z200i7_64gb();
        $this->view_legend_z200i7_48gb();
        $this->view_legend_z200i7_32gb();
        $this->view_legend_z200i7_24gb();
        $this->view_legend_z200i7_16gb();
        $this->view_legend_z200i7_12gb();
        $this->view_legend_z200i7_8gb();
        $this->view_legend_z200i7_6gb();
        $this->view_legend_z200i7_4gb();
        $this->view_legend_z200i7_0gb();

        $this->view_legend_z200i5_64gb();
        $this->view_legend_z200i5_48gb();
        $this->view_legend_z200i5_32gb();
        $this->view_legend_z200i5_24gb();
        $this->view_legend_z200i5_16gb();
        $this->view_legend_z200i5_12gb();
        $this->view_legend_z200i5_8gb();
        $this->view_legend_z200i5_6gb();
        $this->view_legend_z200i5_4gb();
        $this->view_legend_z200i5_0gb();

        $this->view_legend_z210_64gb();
        $this->view_legend_z210_48gb();
        $this->view_legend_z210_32gb();
        $this->view_legend_z210_24gb();
        $this->view_legend_z210_16gb();
        $this->view_legend_z210_12gb();
        $this->view_legend_z210_8gb();
        $this->view_legend_z210_6gb();
        $this->view_legend_z210_4gb();
        $this->view_legend_z210_0gb();

        $this->view_legend_z600_64gb();
        $this->view_legend_z600_48gb();
        $this->view_legend_z600_32gb();
        $this->view_legend_z600_24gb();
        $this->view_legend_z600_16gb();
        $this->view_legend_z600_12gb();
        $this->view_legend_z600_8gb();
        $this->view_legend_z600_6gb();
        $this->view_legend_z600_4gb();
        $this->view_legend_z600_0gb();

        $this->view_legend_z240_64gb();
        $this->view_legend_z240_48gb();
        $this->view_legend_z240_32gb();
        $this->view_legend_z240_24gb();
        $this->view_legend_z240_16gb();
        $this->view_legend_z240_12gb();
        $this->view_legend_z240_8gb();
        $this->view_legend_z240_6gb();
        $this->view_legend_z240_4gb();
        $this->view_legend_z240_0gb();

        $this->view_legend_z640_64gb();
        $this->view_legend_z640_48gb();
        $this->view_legend_z640_32gb();
        $this->view_legend_z640_24gb();
        $this->view_legend_z640_16gb();
        $this->view_legend_z640_12gb();
        $this->view_legend_z640_8gb();
        $this->view_legend_z640_6gb();
        $this->view_legend_z640_4gb();
        $this->view_legend_z640_0gb();

        $this->view_legend_T3620_64gb();
        $this->view_legend_T3620_48gb();
        $this->view_legend_T3620_32gb();
        $this->view_legend_T3620_24gb();
        $this->view_legend_T3620_16gb();
        $this->view_legend_T3620_12gb();
        $this->view_legend_T3620_8gb();
        $this->view_legend_T3620_6gb();
        $this->view_legend_T3620_4gb();
        $this->view_legend_T3620_0gb();

        $this->view_legend_T7910_64gb();
        $this->view_legend_T7910_48gb();
        $this->view_legend_T7910_32gb();
        $this->view_legend_T7910_24gb();
        $this->view_legend_T7910_16gb();
        $this->view_legend_T7910_12gb();
        $this->view_legend_T7910_8gb();
        $this->view_legend_T7910_6gb();
        $this->view_legend_T7910_4gb();
        $this->view_legend_T7910_0gb();

        $this->view_legend_generic_64gb();
        $this->view_legend_generic_48gb();
        $this->view_legend_generic_32gb();
        $this->view_legend_generic_24gb();
        $this->view_legend_generic_16gb();
        $this->view_legend_generic_12gb();
        $this->view_legend_generic_8gb();
        $this->view_legend_generic_6gb();
        $this->view_legend_generic_4gb();
        $this->view_legend_generic_0gb();

        return View::make('IT.Availability.index_Legend');
    }

    public function view_legend_z400_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '64 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '64 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z400_64gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z400 RAM 64 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z400_48gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '48 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '48 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z400_48gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z400 RAM 48 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z400_32gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '32 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '32 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z400_32gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z400 RAM 32 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z400_24gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '24 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '24 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z400_24gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z400 RAM 24 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z400_16gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '16 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '16 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z400_16gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z400 RAM 16 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z400_12gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '12 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '12 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z400_12gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z400 RAM 12 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z400_8gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '8 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '8 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z400_8gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z400 RAM 8 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z400_6gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '6 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '6 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z400_6gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z400 RAM 6 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z400_4gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '4 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '4 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z400_4gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z400 RAM 4 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z400_0gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '0 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z400')
            ->where('memory', '=', '0 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z400_0gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z400 RAM 0 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i7_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '64 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '64 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i7_64gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i7 RAM 64 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i7_48gb()
    {

        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '48 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '48 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i7_48gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i7 RAM 48 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i7_32gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '32 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '32 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i7_32gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i7 RAM 32 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i7_24gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '24 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '24 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i7_24gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i7 RAM 24 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i7_16gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '16 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '16 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i7_16gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i7 RAM 16 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i7_12gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '12 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '12 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i7_12gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i7 RAM 12 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i7_8gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '8 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '8 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i7_8gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i7 RAM 8 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i7_6gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '6 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '6 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i7_6gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i7 RAM 6 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i7_4gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '4 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '4 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i7_4gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i7 RAM 4 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i7_0gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '0 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '0 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i7_0gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i7 RAM 0 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i5_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '64 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '64 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i5_64gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i5 RAM 64 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i5_48gb()
    {

        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '48 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '48 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i5_48gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i5 RAM 48 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i5_32gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '32 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '32 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i5_32gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i5 RAM 32 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i5_24gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '24 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '24 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i5_24gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i5 RAM 24 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i5_16gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '16 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '16 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i5_16gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i5 RAM 16 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i5_12gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '12 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '12 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i5_12gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i5 RAM 12 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i5_8gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '8 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '8 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i5_8gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i5 RAM 8 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i5_6gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '6 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '6 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i5_6gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i5 RAM 6 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i5_4gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '4 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '4 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i5_4gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i5 RAM 4 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z200i5_0gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '0 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '0 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z200i5_0gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z200i5 RAM 0 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z210_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '64 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '64 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z210_64gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z210 RAM 64 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z210_48gb()
    {

        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '48 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '48 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z210_48gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z210 RAM 48 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z210_32gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '32 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '32 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z210_32gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z210 RAM 32 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z210_24gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '24 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '24 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z210_24gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z210 RAM 24 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z210_16gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '16 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '16 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z210_16gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z210 RAM 16 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z210_12gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '12 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '12 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z210_12gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z210 RAM 12 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z210_8gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '8 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '8 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z210_8gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z210 RAM 8 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z210_6gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '6 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '6 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z210_6gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z210 RAM 6 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z210_4gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '4 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '4 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z210_4gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z210 RAM 4 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z210_0gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '0 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '0 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z210_0gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z210 RAM 0 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z600_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '64 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '64 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z600_64gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z600 RAM 64 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z600_48gb()
    {

        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '48 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '48 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z600_48gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z600 RAM 48 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z600_32gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '32 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '32 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z600_32gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z600 RAM 32 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z600_24gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '24 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '24 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z600_24gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z600 RAM 24 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z600_16gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '16 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '16 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z600_16gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z600 RAM 16 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z600_12gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '12 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '12 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z600_12gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z600 RAM 12 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z600_8gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '8 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '8 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z600_8gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z600 RAM 8 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z600_6gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '6 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '6 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z600_6gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z600 RAM 6 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z600_4gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '4 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '4 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z600_4gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z600 RAM 4 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z600_0gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '0 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '0 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z600_0gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z600 RAM 0 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z240_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '64 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '64 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z240_64gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z240 RAM 64 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z240_48gb()
    {

        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '48 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '48 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z240_48gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z240 RAM 48 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z240_32gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '32 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '32 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z240_32gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z240 RAM 32 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z240_24gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '24 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '24 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z240_24gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z240 RAM 24 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z240_16gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '16 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '16 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z240_16gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z240 RAM 16 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z240_12gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '12 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '12 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z240_12gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z240 RAM 12 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z240_8gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '8 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '8 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z240_8gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z240 RAM 8 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z240_6gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '6 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '6 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z240_6gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z240 RAM 6 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z240_4gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '4 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '4 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z240_4gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z240 RAM 4 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z240_0gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '0 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '0 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z240_0gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z240 RAM 0 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z640_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '64 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '64 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z640_64gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z640 RAM 64 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z640_48gb()
    {

        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '48 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '48 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z640_48gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z640 RAM 48 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z640_32gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '32 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '32 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z640_32gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z640 RAM 32 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z640_24gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '24 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '24 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z640_24gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z640 RAM 24 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z640_16gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '16 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '16 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z640_16gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z640 RAM 16 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z640_12gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '12 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '12 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z640_12gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z640 RAM 12 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z640_8gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '8 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '8 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z640_8gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z640 RAM 8 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z640_6gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '6 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '6 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z640_6gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z640 RAM 6 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z640_4gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '4 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '4 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z640_4gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z640 RAM 4 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_z640_0gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '0 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '0 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='z640_0gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation z640 RAM 0 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T3620_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '64 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '64 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T3620_64gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T3620 RAM 64 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T3620_48gb()
    {

        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '48 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '48 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T3620_48gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T3620 RAM 48 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T3620_32gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '32 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '32 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T3620_32gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T3620 RAM 32 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T3620_24gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '24 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '24 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T3620_24gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T3620 RAM 24 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T3620_16gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '16 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '16 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T3620_16gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T3620 RAM 16 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T3620_12gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '12 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '12 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T3620_12gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T3620 RAM 12 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T3620_8gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '8 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '8 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T3620_8gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T3620 RAM 8 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T3620_6gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '6 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '6 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T3620_6gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T3620 RAM 6 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T3620_4gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '4 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '4 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T3620_4gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T3620 RAM 4 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T3620_0gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '0 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '0 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T3620_0gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T3620 RAM 0 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T7910_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '64 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '64 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T7910_64gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T7910 RAM 64 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T7910_48gb()
    {

        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '48 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '48 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T7910_48gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T7910 RAM 48 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T7910_32gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '32 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '32 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T7910_32gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T7910 RAM 32 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T7910_24gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '24 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '24 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T7910_24gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T7910 RAM 24 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T7910_16gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '16 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '16 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T7910_16gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T7910 RAM 16 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T7910_12gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '12 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '12 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T7910_12gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T7910 RAM 12 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T7910_8gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '8 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '8 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T7910_8gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T7910 RAM 8 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T7910_6gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '6 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '6 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T7910_6gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T7910 RAM 6 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T7910_4gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '4 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '4 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T7910_4gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T7910 RAM 4 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_T7910_0gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '0 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '0 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='T7910_0gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation T7910 RAM 0 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_generic_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '64 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '64 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='generic_64gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation generic RAM 64 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_generic_48gb()
    {

        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '48 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '48 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='generic_48gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation generic RAM 48 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_generic_32gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '32 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '32 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='generic_32gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation generic RAM 32 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_generic_24gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '24 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '24 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='generic_24gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation generic RAM 24 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_generic_16gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '16 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '16 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='generic_16gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation generic RAM 16 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_generic_12gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '12 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '12 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='generic_12gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation generic RAM 12 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_generic_8gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '8 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '8 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='generic_8gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation generic RAM 8 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_generic_6gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '6 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '6 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='generic_6gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation generic RAM 6 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_generic_4gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '4 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '4 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='generic_4gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation generic RAM 4 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function view_legend_generic_0gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
            ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '0 GB')
            ->whereIn('user', ['WS Render', 'Idle'])
            ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '0 GB')
            ->where('user', '=', 'Fail')
            ->get();

        echo "        
		<div class='modal fade' id='generic_0gb' role='dialog'>
		<div class='modal-dialog'>   
	  
			  <div class='modal-content'>
				<div class='modal-header'>
				  <button type='button' class='close' data-dismiss='modal'>&times;</button>
				  <h4 class='modal-title'>Workstation generic RAM 0 GB</h4>
				</div>
				<div class='modal-body scroll1'>  
				<h4>Workstation Used</h4>              
				<table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }
        echo "</thead>
				</table>
				<h4>Workstation Idle</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_idle as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				<h4>Workstation Fail</h4> 
				 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
				<thead>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>VGA</th>                 
					</tr>";
        foreach ($select_fail as $s) {
            echo "          <tr>
						<td>$s->hostname</td> 
						<td>$s->user</td>
						<td>$s->vga</td>                                          
						</tr>
		";
        }

        echo "</thead>
				</table>
				</div>                
				<div class='modal-footer'>
				  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
				</div>
			  </div>
			  /div>
			</div>
		  </div>";
    }

    public function index_Scrapped()
    {
        return view::make('IT.Availability.index_scrap');
    }

    public function get_index_Scrapped()
    {
        $select = Ws_Availability::select([
            'id', 'hostname', 'type', 'user', 'os', 'memory', 'vga', 'location', 'notes', 'updated_at'
        ])
            ->where('user', '=', "SCRAPPED")
            ->get();

        return Datatables::of($select)
            ->add_column(
                'action',
                Lang::get('messages.btn_warning', ['title' => 'Edit Workstation', 'url' => '{{ URL::route(\'editSracped\', [$id]) }}', 'class' => 'pencil'])
            )
            ->edit_column('updated_at', '{!! date("M, d Y - H:m", strtotime($updated_at)) !!} WIB')
            ->make();
    }

    public function editSracped($id)
    {
        $hostname = Ws_Availability::where('id', '=', $id)->first();

        $mainws = WS_MAP::where('workstation', '=', $hostname->hostname)->first();
        $secws = WS_MAP::where('secondary_workstation', '=', $hostname->hostname)->first();

        $main_workstation = WS_MAP::where('workstation', 'like', '%' . $hostname->hostname . '%')->orwhere('secondary_workstation', 'like', '%' . $hostname->hostname . '%')->first();

        $opsystem = ['Windows' => 'Windows', 'Linux' => 'Linux'];
        $map_area = ['3D Animation' => '3D Animation', 'Layout' => 'Layout', 'Render' => 'Render', 'Officer' => 'Officer', 'IT Room' => 'IT Room'];

        $stat_ws = ['Main Workstation' => 'Main Workstation', 'Secondary Workstation' => 'Secondary Workstation'];

        return view::make('IT.Availability.editSracpe')
            ->with([
                'hostname'      => $hostname,
                'type'          => $hostname,
                'user'          => $hostname,
                'os'            => $hostname,
                'memory'        => $hostname,
                'location'         => $hostname,
                'notes'            => $hostname,
                'opsystem'         => $opsystem,
                'main_workstation' => $main_workstation,
                'map_area'      => $map_area,
                'stat_ws'       => $stat_ws,
                'mainws'        => $mainws,
                'secws'         => $secws,

            ]);
    }

    public function index_Failed()
    {

        return view::make('IT.Availability.index_fail');
    }

    public function get_index_Failed()
    {
        $select = Ws_Availability::select('*')
            ->where('user', '=', "FAIL")

            ->get();

        return Datatables::of($select)

            ->make();
    }


    public function index_Audit_Employee()
    {
        return view::make('IT.Audit_Employee.index');
    }

    public function get_Audit_Employee()
    {
        $select = DB::table('users')
            ->select(['id', 'nik', 'first_name', 'last_name'])
            ->where('email', '=', Null)
            ->where('nik', '!=', ' ')
            ->get();

        return Datatables::of($select)
            ->add_column(
                'action',
                Lang::get('messages.btn_warning', ['title' => 'Edit Workstation', 'url' => '{{ URL::route(\'audit\', [$id]) }}', 'class' => 'pencil'])
            )
            ->make();
    }

    public function edit_Audit_Employee(request $request, $id)
    {
        $data = NewUser::JoinDeptCategory()->where('users.id', $id)->first();

        $oldData = NewUser::where('users.first_name', 'like', '%' . $data->first_name . '%')
            ->where('users.last_name', 'like', '%' . $data->last_name . '%')
            ->where('users.username', '!=', Null)
            ->orderBy('users.id', 'desc')
            ->get();

        return view::make('IT.Audit_Employee.edit')
            ->with([
                'data'        => $data,
                'oldData'    => $oldData,
                'id'        => $id
            ]);
    }

    public function store_Audit_Employee(Request $request, $id)
    {
        $rules = [
            'username'  => 'required',
            'email'      => 'required|email',
        ];

        $data = [
            'username' => $request->input('username'),
            'email'    => $request->input('email')
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('audit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        } else {
            User::where('id', $id)->update($data);
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
            return Redirect::route('index-audit', ['id' => $id]);
        }
    }

    public function store_Audit_Employee_old(Request $request, $id)
    {
        $data = NewUser::findOrFail($id);

        $oldData = NewUser::where('users.first_name', 'like', '%' . $data->first_name . '%')
            ->where('users.last_name', 'like', '%' . $data->last_name . '%')
            ->where('users.username', Null)
            ->orderBy('users.id', 'desc')
            ->first();

        $rules = [
            'username'  => 'required',
        ];

        $data = [
            'username' => $request->input('username'),
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('audit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        } else {
            User::where('id', $id)->update($data);
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
            return Redirect::route('audit', ['id' => $oldData->id]);
        }
    }

    public function indexALLUSER()
    {
        return view::make('IT.Audit_Employee.indexAllUser');
    }

    public function getAllUser()
    {
        $select = User::whereNotNull('nik')
            ->whereNotIn('nik', ['123456789'])
            ->orderBy('id', 'desc')
            ->get();

        return Datatables::of($select)
            /*->addColumn('action', function(User $user){
	    	return view::make('IT.Audit_Employee.action.dataAction');
	    })*/
            ->addColumn('action', 'IT.Audit_Employee.action.dataAction')
            ->rawColumns(['action'])

            ->editColumn('fullName', function (User $user) {
                return $user->first_name . ' ' . $user->last_name;
            })
            ->editColumn('department', function (User $user) {
                $dept = Dept_Category::find($user->dept_category_id);

                return $dept->dept_category_name;
            })
            ->setRowClass(function (User $user) {
                if ($user->active === 0) {
                    return $alert = 'alert-danger';
                }
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function modalActionEmployes($id)
    {
        $user = User::find($id);
        $dept = Dept_Category::find($user->dept_category_id);
        // dd($user);
        $modal = '
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="showEmployesLabel">Detail Employee</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              <div class="modal-body">
                    <div class="row">
                       <div class="col-lg-4">
							<table class="table table-striped">
								<tr>
									<th>Username</th>
									<td>:</td>
									<td>' . $user->username . '</td>
								</tr>
								<tr>
									<th>NIK</th>
									<td>:</td>
									<td>' . $user->nik . '</td>
								</tr>
								<tr>
									<th>Name</th>
									<td>:</td>
									<td>' . $user->first_name . ' ' . $user->last_name . '</td>
								</tr>
								<tr>
									<th>Join Date</th>
									<td>:</td>
									<td>' . $user->join_date . '</td>
								</tr>
								<tr>
									<th>End Date</th>
									<td>:</td>
									<td>' . $user->end_date . '</td>
								</tr>
								<tr>
									<th>Department</th>
									<td>:</td>
									<td>' . $dept->dept_category_name . '</td>
								</tr>
								<tr>
									<th>Position</th>
									<td>:</td>
									<td>' . $user->position . '</td>
								</tr>
							</table>
						</div>
                    </div>
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
       </div>';

        return $modal;
    }

    public function asset_IT()
    {
        $category_name    = ['0' => '- Select Category Name -', '1' => 'Switch', '2' => 'Server', '3' => 'Storage', '4' => 'Printer', '5' => 'Wacom', '6' => 'VGA', '7' => 'HDD External & Internal', '8' => 'HBA Card', '9' => 'Render Farm', '10' => 'UPS', '11' => 'Monitor', '12' => 'Laptop', '13' => 'KVMX', '14' => 'Scanner', '15' => 'Wireless', '16' => 'VOIP', '17' => 'Workstation', '18' => 'Projector', '19' => 'Enclosure', '20' => 'Other'];

        return view::make('IT.Assett.index', ['category_name' => $category_name]);
    }

    public function index_asset_IT()
    {
        $select = DB::table('asseting_barcode')
            ->select([
                'id', 'barcode_id', 'category_name', 'item_description_name', 'model', 'asset_type_id', 'category_type_id', 'date_incoming', 'asset_category_name', 'SN', 'addtional', 'instansi_id', 'embedded'
            ])
            ->where('instansi_id', 1)
            ->where('dept_id', 1)
            ->get();

        return Datatables::of($select)
            ->edit_column('barcode_id', '{{$instansi_id.$barcode_id.$id}}')
            ->edit_column('instansi_id', '@if($instansi_id === 1){{"Kinema Animasi"}} @elseif($instansi_id === 2){{"Kinema Production Services"}} @elseif($instansi_id === 3){{"Infinite Learning"}} @else {{"--"}} @endif')
            ->edit_column('category_name', '@if($category_name === "17"){{"Workstation"}} @elseif($category_name === "1"){{"Switch"}} @elseif($category_name === "2"){{"Server"}} @elseif($category_name === "3"){{"Storage"}} @elseif($category_name === "4"){{"Printer"}} @elseif($category_name === "5"){{"Wacom"}} @elseif($category_name === "6"){{"VGA"}} @elseif($category_name === "7"){{"HDD External & Internal"}} @elseif($category_name === "8"){{"HBA Card"}} @elseif($category_name === "9"){{"Render Farm"}} @elseif($category_name === "10"){{"UPS"}} @elseif($category_name === "11"){{"Monitor"}} @elseif($category_name === "12"){{"Laptop"}} @elseif($category_name === "13"){{"KVMX"}} @elseif($category_name === "14"){{"Scanner"}} @elseif($category_name === "15"){{"Wireless"}} @elseif($category_name === "16"){{"VOIP"}} @elseif($category_name === "18"){{"Projector"}} @elseif($category_name === "19"){{"Enclosure"}} @elseif($category_name === "20"){{"Other"}} @else {{"--"}} @endif')
            ->edit_column('date_incoming', ' {{date("M, d Y", strtotime($date_incoming))}}')
            ->edit_column('asset_type_id', '@if ($asset_type_id === 1){{ "Purchase" }}@elseif($asset_type_id === 2){{ "Transfer" }}@else{{"-"}}@endif')

            ->edit_column('category_type_id', '@if ($category_type_id === 1){{"Hardware"}} @elseif($category_type_id === 2){{"Tools"}} @elseif($category_type_id === 3){{"Equipment"}} @else {{"-"}} @endif')
            /*   ->add_column('barcode',
				'<?php          
			use \Milon\Barcode\DNS2D;
			$space = " || "; 
			echo DNS2D::getBarcodeHTML($barcode_id.$id, "QRCODE", 2, 2);          
			 ?>'
)*/
->edit_column('embedded', '@if($embedded === 1){{"YES"}} @else {{"NO"}} @endif')
->add_column(
'action',
Lang::get('messages.btn_warning', [
'title' => 'Edit Workstation', 'url' => '{{ URL::route(\'edit-Asset\', [$id]) }}',
'class' => 'pencil'
])
. Lang::get('messages.btn_print', ['title' => 'Print', 'url' => '{{ URL::route(\'print-asset\', [$id]) }}', 'class' =>
'print'])
. Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'DetailAssett\', [$id]) }}', 'class'
=> 'file'])
. Lang::get('messages.btn_info', ['title' => 'Embedded', 'url' => '{{ URL::route(\'embeddedAsset\', [$id]) }}', 'class'
=> 'file'])
)
->make();
}

public function add_asset_IT()
{
$b = db::table('asseting_barcode')->select('*')
->get();

$list_dept = Dept_Category::WHERE('id', '!=', 7)->orderBy('id', 'asc')->get();
$ps = Dept_Category::where('id', 7)->orderBy('id', 'asc')->get();


$asset_type = ['0' => '- Select Asset Type -', '1' => 'Purchase', '2' => 'Transfer'];

$asset_category = ['0' => '- Select Asset Category -', '1' => 'Asset', '2' => 'Integrable Asset'];

$category_type = ['0' => '- Select Category Type -', '1' => 'Hardware', '2' => 'Tools', '3' => 'Equipment', '4' =>
'Software'];

$category_name = [
'0' => '- Select Category Name -', '1' => 'Switch', '2' => 'Server', '3' => 'Storage', '4' =>
'Printer', '5' => 'Wacom', '6' => 'VGA', '7' => 'HDD External & Internal', '8' => 'HBA Card', '9' => 'Render Farm', '10'
=> 'UPS', '11' => 'Monitor', '12' => 'Laptop', '13' => 'KVMX', '14' => 'Scanner', '15' => 'Wireless', '16' => 'VOIP',
'17' => 'Workstation', '18' => 'Projector', '19' => 'Enclosure', '20' => 'Other'
];

/* $status = ['0' => '-Select Status Item-', 'FAILED' => 'FAILED', 'SCRAPPED' => 'SCRAPPED', 'OK' => 'OK', 'Other' =>
'Other'];*/
$instansi_name = ['' => '- Select Instansi -', '1' => 'Kinema Animasi', '2' => 'Kinema Production Services', '3' =>
'Infinite Learning'];


return view::make('IT.Assett.add')
->with([
'asset_category' => $asset_category,
'asset_type' => $asset_type,
'category_type' => $category_type,
'category_name' => $category_name,
'b' => $b,
'instansi_name' => $instansi_name,
'department' => $list_dept,
'ps' => $ps,
]);
}

public function store_add_asset_IT_123(Request $request)
{
$asset_type_name = null;
$asset_category_name = null;
$category_type_name = null;
$category_name_name = null;
$instansi = null;
$date_incoming = date('Y-m-d', strtotime("0000-00-00"));

if ($request->input('instansi_name') === '1') {
$instansi = "Kinema Animasi";
} elseif ($request->input('instansi_name') === '2') {
$instansi = "Kinema Production Services";
} elseif ($request->input('instansi_name') === '3') {
$instansi = "Infinite Learning";
} else {
$instansi = Null;
}


if ($request->input('asset_type') === "1") {
$asset_type_name = "Purchase";
} else {
$asset_type_name = "Transfer";
}
if ($request->input('incoming') === null) {
$date_incoming = date('Y-m-d', strtotime('+1 years', strtotime("0000-00-00")));
} else {
$date_incoming = $request->input('incoming');
}


if ($request->input('asset_category') === "1") {
$asset_category_name = "Asset";
} else {
$asset_category_name = "Integrable Asset";
}

if ($request->input('category_type') === "1") {
$category_type_name = "Hardware";
} elseif ($request->input('category_type') === "2") {
$category_type_name = "Tools";
} elseif ($request->input('category_type') === "3") {
$category_type_name = "Equipment";
} else {
$category_type_name = "Software";
}

if ($request->input('category_name') === "1") {
$category_name_name = "Switch";
} elseif ($request->input('category_name') === "2") {
$category_name_name = "Server";
} elseif ($request->input('category_name') === "3") {
$category_name_name = "Storage";
} elseif ($request->input('category_name') === "4") {
$category_name_name = "Printer";
} elseif ($request->input('category_name') === "5") {
$category_name_name = "Wacom";
} elseif ($request->input('category_name') === "6") {
$category_name_name = "VGA";
} elseif ($request->input('category_name') === "7") {
$category_name_name = "HDD External & Internal";
} elseif ($request->input('category_name') === "8") {
$category_name_name = "HBA Card";
} elseif ($request->input('category_name') === "9") {
$category_name_name = "Render Farm";
} elseif ($request->input('category_name') === "10") {
$category_name_name = "UPS";
} elseif ($request->input('category_name') === "11") {
$category_name_name = "Monitor";
} elseif ($request->input('category_name') === "12") {
$category_name_name = "Laptop";
} elseif ($request->input('category_name') === "13") {
$category_name_name = "KVMX";
} elseif ($request->input('category_name') === "14") {
$category_name_name = "Scanner";
} elseif ($request->input('category_name') === "15") {
$category_name_name = "Wireless";
} elseif ($request->input('category_name') === "16") {
$category_name_name = "VOIP";
} elseif ($request->input('category_name') === "17") {
$category_name_name = "Workstation";
} elseif ($request->input('category_name') === "18") {
$category_name_name = "Projector";
} elseif ($request->input('category_name') === "19") {
$category_name_name = "Enclosure";
}


$rules = [
'asset_category' => 'required',
'asset_type' => 'required',
'category_type' => 'required',
'category_name' => 'required',
'brand' => 'required',
'series' => 'required',
'sn' => 'required',

];

$data = [
'instansi_id' => $request->input('instansi_name'),
'instansi_name' => $instansi,
'dept_id' => $request->input('dept'),
'asset_category_id' => $request->input('asset_category'),
'asset_type_id' => $request->input('asset_type'),
'category_type_id' => $request->input('category_type'),
'date_incoming' => $date_incoming,
'addtional' => $request->input('addtional'),
'item_description_name' => $request->input('brand'),
'vendor' => $request->input('vendor'),
'model' => $request->input('series'),
'SN' => $request->input('sn'),
'category_name' => $request->input('category_name'),
'years_of_id' => date('Y', strtotime($request->input('incoming'))),

'barcode_id' => $request->input('dept') . $request->input('asset_type') . $request->input('asset_category') .
$request->input('category_type') . date('y', strtotime($date_incoming)) . $request->input('category_name'),
'asset_type_name' => $asset_type_name,
'asset_category_name' => $asset_category_name,
'category_type_name' => $category_type_name,
'category_name_name' => $category_name_name,
'status' => $request->input('status'),
'created_name' => auth::user()->first_name . ' ' . auth::user()->last_name,
'update_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
'created_date' => date('Y-m-d'),
'updated_date' => date('Y-m-d'),
'PN' => $request->input('pn')

];
$bac = auth::user()->dept_category_id . $request->input('asset_type') . $request->input('asset_category') .
$request->input('category_type') . date('y', strtotime($request->input('incoming'))) . $request->input('category_name');

/* return dd($data);*/
$validator = Validator::make($request->all(), $rules);

if ($validator->fails()) {
return Redirect::route('add-it')
->withErrors($validator)
->withInput();
} else {
DB::table('asseting_barcode')->insert($data);
Session::flash('message', Lang::get('messages.data_asset_inserted', ['data' => 'Data User']));
return Redirect::route('asset-it');
}
}

public function edit_Asset_IT(Request $request, $id)
{
$asset = db::table('asseting_barcode')->select('*')->where('id', '=', $id)
->first();


$deptt = Dept_Category::where('id', '=', $asset->dept_id)->first();

$list_dept = Dept_Category::orderBy('id', 'asc')->get();

$asset_type = ['0' => '- Select Asset Category -', '1' => 'Purchase', '2' => 'Transfer'];
$asset_category = ['0' => '- Select Asset Type -', '1' => 'Asset', '2' => 'Integrable Asset'];
$category_type = ['0' => '- Select Category Type -', '1' => 'Hardware', '2' => 'Tools', '3' => 'Equipment'];
$category_name = ['0' => '- Select Category Name -', '17' => 'Workstation', '1' => 'Switch', '2' => 'Server', '3' =>
'Storage', '4' => 'Printer', '5' => 'Wacom', '6' => 'VGA', '7' => 'HDD External & Internal', '8' => 'HBA Card', '9' =>
'Render Farm', '10' => 'UPS', '11' => 'Monitor', '12' => 'Laptop', '13' => 'KVMX', '14' => 'Scanner', '15' =>
'Wireless', '16' => 'VOIP', '18' => 'Projector', '19' => 'Enclosure', '20' => 'Other'];
$instansi_name = ['' => '- Select Instansi -', '1' => 'Kinema Animasi', '2' => 'Kinema Production Services', '3' =>
'Infinite Learning'];

/* $status = ['0' => '-Select Status Item-', 'FAILED' => 'FAILED', 'SCRAPPED' => 'SCRAPPED', 'OK' => 'OK', 'Other' =>
'Other'];*/


return view::make('IT.Assett.edit')
->with([
'asset_category' => $asset_category,
'asset_type' => $asset_type,
'category_type' => $category_type,
'aset' => $asset,
'category_name' => $category_name,
'instansi_name' => $instansi_name,
'department' => $list_dept,
'deptt' => $deptt,
/*'status' => $status,*/
]);
}

public function post_edit_Asset_IT(Request $request, $id)
{
$dept = Dept_Category::select('*')->get();
$item = db::table('asseting_barcode')->select('*')->orderBy('id', 'desc')
->first();


$asset_type_name = null;
$asset_category_name = null;
$category_type_name = null;
$category_name_name = null;
$instansi = null;
$date_incoming = date('Y-m-d', strtotime("0000-00-00"));

if ($request->input('instansi_name') === '1') {
$instansi = "Kinema Animasi";
} elseif ($request->input('instansi_name') === '2') {
$instansi = "Kinema Production Services";
} elseif ($request->input('instansi_name') === '3') {
$instansi = "Infinite Learning";
} else {
$instansi = Null;
}

if ($request->input('incoming') === null) {
$date_incoming = date('Y-m-d', strtotime('+1 years', strtotime("0000-00-00")));
} else {
$date_incoming = $request->input('incoming');
}

if ($request->input('asset_type') === "1") {
$asset_type_name = "Purchase";
} else {
$asset_type_name = "Transfer";
}

if ($request->input('asset_category') === "1") {
$asset_category_name = "Asset";
} else {
$asset_category_name = "intangible Asset";
}

if ($request->input('category_type') === "1") {
$category_type_name = "Hardware";
} elseif ($request->input('category_type') === "2") {
$category_type_name = "Tools";
} elseif ($request->input('category_type') === "3") {
$category_type_name = "Equipment";
} else {
$category_type_name = "Software";
}

if ($request->input('category_name') === "1") {
$category_name_name = "Switch";
} elseif ($request->input('category_name') === "2") {
$category_name_name = "Server";
} elseif ($request->input('category_name') === "3") {
$category_name_name = "Storage";
} elseif ($request->input('category_name') === "4") {
$category_name_name = "Printer";
} elseif ($request->input('category_name') === "5") {
$category_name_name = "Wacom";
} elseif ($request->input('category_name') === "6") {
$category_name_name = "VGA";
} elseif ($request->input('category_name') === "7") {
$category_name_name = "HDD External & Internal";
} elseif ($request->input('category_name') === "8") {
$category_name_name = "HBA Card";
} elseif ($request->input('category_name') === "9") {
$category_name_name = "Render Farm";
} elseif ($request->input('category_name') === "10") {
$category_name_name = "UPS";
} elseif ($request->input('category_name') === "11") {
$category_name_name = "Monitor";
} elseif ($request->input('category_name') === "12") {
$category_name_name = "Laptop";
} elseif ($request->input('category_name') === "13") {
$category_name_name = "KVMX";
} elseif ($request->input('category_name') === "14") {
$category_name_name = "Scanner";
} elseif ($request->input('category_name') === "15") {
$category_name_name = "Wireless";
} elseif ($request->input('category_name') === "16") {
$category_name_name = "VOIP";
} elseif ($request->input('category_name') === "17") {
$category_name_name = "Workstation";
} elseif ($request->input('category_name') === "18") {
$category_name_name = "Projector";
} elseif ($request->input('category_name') === "19") {
$category_name_name = "Enclosure";
} elseif ($request->input('category_name') === "20") {
$category_name_name = "Other";
}


$rules = [
'asset_category' => 'required',
'asset_type' => 'required',
'category_type' => 'required',
'category_name' => 'required',
'brand' => 'required',

'series' => 'required',

];

$data = [
'instansi_id' => $request->input('instansi_name'),
'instansi_name' => $instansi,
'dept_id' => auth::user()->dept_category_id,
'asset_category_id' => $request->input('asset_category'),
'asset_type_id' => $request->input('asset_type'),
'category_type_id' => $request->input('category_type'),
'date_incoming' => $date_incoming,
'addtional' => $request->input('addtional'),
'item_description_name' => $request->input('brand'),
'vendor' => $request->input('vendor'),
'model' => $request->input('series'),
'SN' => $request->input('sn'),
'category_name' => $request->input('category_name'),
'years_of_id' => date('Y', strtotime($request->input('incoming'))),
'barcode_id' => $request->input('dept') . $request->input('asset_type') . $request->input('asset_category') .
$request->input('category_type') . date('y', strtotime($date_incoming)) . $request->input('category_name'),
'asset_type_name' => $asset_type_name,
'asset_category_name' => $asset_category_name,
'category_type_name' => $category_type_name,
'category_name_name' => $category_name_name,
'status' => $request->input('status'),
'update_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
'updated_date' => date('Y-m-d'),
];

$validator = Validator::make($request->all(), $rules);

if ($validator->fails()) {
return Redirect::route('add-it')
->withErrors($validator)
->withInput();
} else {
DB::table('asseting_barcode')->where('id', '=', $id)->update($data);
Session::flash('message', Lang::get('messages.data_asset_updated', ['data' => 'Data User']));
return Redirect::route('asset-it');
}
}

public function print_asset_IT($id)
{
$select = DB::table('asseting_barcode')->select('*')->where('id', '=', $id)->first();
/* view()->share('select', $select);*/
$customPaper = array(0, 0, 300, 200);

$pdf = App::make('dompdf.wrapper');

$pdf->loadview('IT.Assett.print_asset', ['select' => $select]);
$pdf->setPaper('A4', 'potrait');
return $pdf->stream();

/* return view('IT.Assett.print_asset', ['select' => $select]);*/
}

public function GetBarcodeID(Request $request)
{
$ss = DB::table('asseting_barcode')->select('*')->where(
'category_name',
'=',
$request->input('category_name')
)->where('embedded', '=', 0)->get();

$cobaan = db::table('asseting_barcode')->select('*')->orderBy('id', 'dasc')->first();

/* $ss = DB::table('asseting_barcode')->select('*')->wherein('category_name', [11, 16])->get(); */
/* view()->share('select', $select);*/


/* $pdf = App::make('dompdf.wrapper');

$pdf->loadview('IT.Assett.print_All_asset',['ss' => $ss]);
$pdf->setPaper('A4', 'landscape');
return $pdf->stream();*/

return view::make('IT.Assett.print_All_asset', ['ss' => $ss, 'cobaan' => $cobaan]);
}

public function DetailAssett($id)
{
$asset2 = Asseting_IT::JoinDeptCategory()->find($id);
/* dd($asset2->created_name);
*/
$return = "
<div class='modal-header'>
    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
    <h4 class='modal-title' id='showModalLabel'>Asset IT</h4>
</div>
<div class='modal-body'>
    <div class='well'>
        <h5> <strong><u>$asset2->item_description_name </u> </strong></h5>
        <strong>Code ID :</strong> $asset2->barcode_id$id<br>
        <strong>Department :</strong> $asset2->dept_category_name<br>
        <strong>Asset Type :</strong> $asset2->asset_type_name<br>
        <strong>Asset Category :</strong> $asset2->asset_category_name<br>
        <strong>Category Type :</strong> $asset2->category_type_name<br>
        <strong>Category Name :</strong> $asset2->category_name_name<br>
        <strong>Date incoming :</strong> $asset2->date_incoming<br>
        <strong>Addtional :</strong> $asset2->addtional<br>
        <strong>Series/Type/Model :</strong> $asset2->model<br>
        <strong>Serial Number :</strong> $asset2->SN<br>
        <strong>Vendor :</strong> $asset2->vendor<br>
        <strong>Status Item :</strong> $asset2->status<br>
    </div>
    <div class='well'>
        <h5> <strong><u>Note </u> </strong></h5>
        <strong>Created by :</strong> $asset2->created_name<br>
        <strong>Date Create :</strong> $asset2->created_date<br>
        <strong>Updated by :</strong> $asset2->update_by<br>
        <strong>Date Update :</strong> $asset2->updated_date<br>
    </div>
</div>
<div class='modal-footer'>
    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
</div>
";

return $return;
}

public function ImportDataAsset(Request $request)
{
/*WAJIB EDIT*/
if ($request->file('asset') === NULL) {

return Redirect::route('asset-it')->with('getError', Lang::get('messages.upload_nothing'));
} else {
if ($request->hasFile('asset')) {
$path = $request->file('asset')->getRealPath();
$data = Excel::load($path)->get();
if ($data->count()) {
foreach ($data as $key => $value) {
$date_incoming = date('Y-m-d', strtotime('+1 years', strtotime("0000-00-00")));
$arr[] = [
'dept_id' => $value->dept_id,
'instansi_id' => $value->instansi_id,
'instansi_name' => $value->instansi_name,
'asset_type_id' => $value->asset_type_id,
'asset_category_id' => $value->asset_category_id,
'category_type_id' => $value->category_type_id,
'category_name' => $value->category_name,
'asset_type_name' => $value->asset_type_name,
'asset_category_name' => $value->asset_category_name,
'category_type_name' => $value->category_type_name,
'category_name_name' => $value->category_name_name,
'years_of_id' => date('Y', strtotime($value->date_incoming)) /*'0000' */,
'date_incoming' => date('Ymd', strtotime($value->date_incoming)) /*'00-00-0000'*/,
'item_description_name' => $value->item_description_name,
'addtional' => $value->additional,
'model' => $value->model,
'SN' => $value->sn,
'PN' => $value->partnumber,
'vendor' => $value->vendor,
'status' => $value->status,
'barcode_id' => '1' . $value->asset_type_id . $value->asset_category_id . $value->category_type_id . date(
'y',
strtotime($value->date_incoming)
) . $value->category_name,
/* 'barcode_id' =>
'1'.$value->asset_type_id.$value->asset_category_id.$value->category_type_id.'00'.$value->category_name,*/
'created_name' => auth::user()->first_name . ' ' . auth::user()->last_name,
'update_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
'created_date' => date('Y-m-d'),
'updated_date' => date('Y-m-d'),
];
/*$c = '1'.$value->asset_type_id.$value->asset_category_id.$value->category_type_id.date('y',
strtotime($value->date_incoming)).$value->category_name;

return dd($c);*/
}
/* return dd($arr);*/

if (!empty($arr)) {
Asseting_IT::insert($arr);

$file = $request->file('asset');
$name = 'Asset_IT_' . \Carbon\Carbon::now()->format('Y-m-d') . '.' . $file->getClientOriginalExtension();
$path = $file->storeAs('asseting_barcode', $name);
Session::flash('message', Lang::get('messages.data_upload', ['data' => 'Data Employee']));
return Redirect::route('asset-it');
}
}
}
return Redirect::route('asset-it')->with('getError', Lang::get('messages.data_problem'));;
}
}

public function postUpdate()
{
$data = [
'instansi_id' => 1,
'instansi_name' => 'Kinema Animasi'
];

DB::table('asseting_barcode')->update($data);
Session::flash('message', Lang::get('messages.data_asset_updated', ['data' => 'Data User']));
return Redirect::route('asset-it');
}

public function embeddedAsset($id)
{
$asset = db::table('asseting_barcode')->select('*')->where('id', '=', $id)
->first();


$deptt = Dept_Category::where('id', '=', $asset->dept_id)->first();

$list_dept = Dept_Category::orderBy('id', 'asc')->get();

$asset_type = ['0' => '- Select Asset Category -', '1' => 'Purchase', '2' => 'Transfer'];
$asset_category = ['0' => '- Select Asset Type -', '1' => 'Asset', '2' => 'Integrable Asset'];
$category_type = ['0' => '- Select Category Type -', '1' => 'Hardware', '2' => 'Tools', '3' => 'Equipment'];
$category_name = ['0' => '- Select Category Name -', '17' => 'Workstation', '1' => 'Switch', '2' => 'Server', '3' =>
'Storage', '4' => 'Printer', '5' => 'Wacom', '6' => 'VGA', '7' => 'HDD External & Internal', '8' => 'HBA Card', '9' =>
'Render Farm', '10' => 'UPS', '11' => 'Monitor', '12' => 'Laptop', '13' => 'KVMX', '14' => 'Scanner', '15' =>
'Wireless', '16' => 'VOIP', '18' => 'Projector', '19' => 'Enclosure'];
$instansi_name = ['' => '- Select Instansi -', '1' => 'Kinema Animasi', '2' => 'Kinema Production Services', '3' =>
'Infinite Learning'];

return view::make('IT.Assett.edit_Embedded')->with([
'asset_category' => $asset_category,
'asset_type' => $asset_type,
'category_type' => $category_type,
'select' => $asset,
'category_name' => $category_name,
'instansi_name' => $instansi_name,
'department' => $list_dept,
'deptt' => $deptt,
/*'status' => $status,*/
]);
}

public function POSTembeddedAsset(Request $request, $id)
{

$paname = Asseting_IT::where('category_name', '=', 18)->pluck('category_name');

$rules = [
'inlineRadioOptions' => 'required'
];

$data = [
'embedded' => $request->input('inlineRadioOptions')
];

$validator = Validator::make($request->all(), $rules);
/* return dd($paname);*/
if ($validator->fails()) {
return Redirect::route('embeddedAsset', ['id' => $id])
->withErrors($validator)
->withInput();
} else {
Asseting_IT::where('id', $id)->update($data);
Session::flash('message', Lang::get('messages.data_asset_updated', ['data' => 'Data User']));
return Redirect::route('asset-it', ['id' => $id]);
}
}

public function indexRequestForm()
{
return view::make('IT.RequestForm.index');
}

public function CreateRequestForm()
{
$list_email = ['' => '-Select Email Reporter-'];
$email = db::table('users')->where('email', '!=', Null)->orderBy('email', 'asc')->get();
foreach ($email as $value)
$list_email[$value->email] = $value->email;

return view::make('IT.RequestForm.add', ['list_email' => $list_email]);
}

public function indexAssetPS()
{
$category_name = [
'0' => '- Select Category Name -', '1' => 'Switch', '2' => 'Server', '3' => 'Storage', '4' =>
'Printer', '5' => 'Wacom', '6' => 'VGA', '7' => 'HDD External & Internal', '8' => 'HBA Card', '9' => 'Render Farm', '10'
=> 'UPS', '11' => 'Monitor', '12' => 'Laptop', '13' => 'KVMX', '14' => 'Scanner', '15' => 'Wireless', '16' => 'VOIP',
'17' => 'Workstation', '18' => 'Projector', '19' => 'Enclosure'
];

return view::make('PS.Assett.index', ['category_name' => $category_name]);
}

public function getAssetPS()
{
$select = DB::table('asseting_barcode')
->select([
'id', 'barcode_id', 'category_name', 'item_description_name', 'model', 'asset_type_id', 'category_type_id',
'date_incoming', 'asset_category_name', 'SN', 'addtional', 'instansi_id', 'embedded'
])
->where('instansi_id', 2)
->get();

return Datatables::of($select)
->edit_column('barcode_id', '{{$instansi_id.$barcode_id.$id}}')
->edit_column('instansi_id', '@if($instansi_id === 1){{"Kinema Animasi"}} @elseif($instansi_id ===
2){{"Kinema Production Services"}} @elseif($instansi_id === 3){{"Infinite Learning"}} @else {{"--"}} @endif')
->edit_column('category_name', '@if($category_name === "17"){{"Workstation"}} @elseif($category_name ===
"1"){{"Switch"}} @elseif($category_name === "2"){{"Server"}} @elseif($category_name === "3"){{"Storage"}}
@elseif($category_name === "4"){{"Printer"}} @elseif($category_name === "5"){{"Wacom"}} @elseif($category_name ===
"6"){{"VGA"}} @elseif($category_name === "7"){{"HDD External & Internal"}} @elseif($category_name === "8"){{"HBA Card"}}
@elseif($category_name === "9"){{"Render Farm"}} @elseif($category_name === "10"){{"UPS"}} @elseif($category_name ===
"11"){{"Monitor"}} @elseif($category_name === "12"){{"Laptop"}} @elseif($category_name === "13"){{"KVMX"}}
@elseif($category_name === "14"){{"Scanner"}} @elseif($category_name === "15"){{"Wireless"}} @elseif($category_name ===
"16"){{"VOIP"}} @elseif($category_name === "18"){{"Projector"}} @elseif($category_name === "19"){{"Enclosure"}} @else
{{"--"}} @endif')
->edit_column('date_incoming', ' {{date("M, d Y", strtotime($date_incoming))}}')
->edit_column('asset_type_id', '@if ($asset_type_id === 1){{ "Purchase" }}@elseif($asset_type_id ===
2){{ "Transfer" }}@else{{"-"}}@endif')

->edit_column('category_type_id', '@if ($category_type_id === 1){{"Hardware"}} @elseif($category_type_id ===
2){{"Tools"}} @elseif($category_type_id === 3){{"Equipment"}} @else {{"-"}} @endif')
/* ->add_column('barcode',
'<?php          
			use \Milon\Barcode\DNS2D;
			$space = " || "; 
			echo DNS2D::getBarcodeHTML($barcode_id.$id, "QRCODE", 2, 2);          
			 ?>'
)*/
->edit_column('embedded', '@if($embedded === 1){{"YES"}} @else {{"NO"}} @endif')
->add_column(
'action',
Lang::get('messages.btn_warning', [
'title' => 'Edit Asset PS', 'url' => '{{ URL::route(\'editAssetPS\', [$id]) }}',
'class' => 'pencil'
])
. Lang::get('messages.btn_print', ['title' => 'Print', 'url' => '{{ URL::route(\'printAssetPS\', [$id]) }}', 'class' =>
'print'])
. Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'DetailAssett\', [$id]) }}', 'class'
=> 'file'])
. Lang::get('messages.btn_info', ['title' => 'Embedded', 'url' => '{{ URL::route(\'embeddedAsset\', [$id]) }}', 'class'
=> 'file'])
)
->make();
}

public function addAssetPS()
{
$b = db::table('asseting_barcode')->select('*')
->get();

$list_dept = Dept_Category::WHERE('id', '!=', 7)->orderBy('id', 'asc')->get();
$ps = Dept_Category::where('id', 7)->orderBy('id', 'asc')->get();


$asset_type = ['0' => '- Select Asset Type -', '1' => 'Purchase', '2' => 'Transfer'];

$asset_category = ['0' => '- Select Asset Category -', '1' => 'Asset', '2' => 'Integrable Asset'];

$category_type = ['0' => '- Select Category Type -', '1' => 'Hardware', '2' => 'Tools', '3' => 'Equipment', '4' =>
'Software'];

$category_name = [
'0' => '- Select Category Name -', '1' => 'Switch', '2' => 'Server', '3' => 'Storage', '4' =>
'Printer', '5' => 'Wacom', '6' => 'VGA', '7' => 'HDD External & Internal', '8' => 'HBA Card', '9' => 'Render Farm', '10'
=> 'UPS', '11' => 'Monitor', '12' => 'Laptop', '13' => 'KVMX', '14' => 'Scanner', '15' => 'Wireless', '16' => 'VOIP',
'17' => 'Workstation', '18' => 'Projector', '19' => 'Enclosure'
];

/* $status = ['0' => '-Select Status Item-', 'FAILED' => 'FAILED', 'SCRAPPED' => 'SCRAPPED', 'OK' => 'OK', 'Other' =>
'Other'];*/
$instansi_name = ['' => '- Select Instansi -', '1' => 'Kinema Animasi', '2' => 'Kinema Production Services', '3' =>
'Infinite Learning'];


return view::make('PS.Assett.add')
->with([
'asset_category' => $asset_category,
'asset_type' => $asset_type,
'category_type' => $category_type,
'category_name' => $category_name,
'b' => $b,
'instansi_name' => $instansi_name,
'department' => $list_dept,
'ps' => $ps,
]);
}

public function StoreAssetPS(Request $request)
{
$asset_type_name = null;
$asset_category_name = null;
$category_type_name = null;
$category_name_name = null;
$instansi = null;
$date_incoming = date('Y-m-d', strtotime("0000-00-00"));

if ($request->input('instansi_name') === '1') {
$instansi = "Kinema Animasi";
} elseif ($request->input('instansi_name') === '2') {
$instansi = "Kinema Production Services";
} elseif ($request->input('instansi_name') === '3') {
$instansi = "Infinite Learning";
} else {
$instansi = Null;
}


if ($request->input('asset_type') === "1") {
$asset_type_name = "Purchase";
} else {
$asset_type_name = "Transfer";
}
if ($request->input('incoming') === null) {
$date_incoming = date('Y-m-d', strtotime('+1 years', strtotime("0000-00-00")));
} else {
$date_incoming = $request->input('incoming');
}


if ($request->input('asset_category') === "1") {
$asset_category_name = "Asset";
} else {
$asset_category_name = "Integrable Asset";
}

if ($request->input('category_type') === "1") {
$category_type_name = "Hardware";
} elseif ($request->input('category_type') === "2") {
$category_type_name = "Tools";
} elseif ($request->input('category_type') === "3") {
$category_type_name = "Equipment";
} else {
$category_type_name = "Software";
}

if ($request->input('category_name') === "1") {
$category_name_name = "Switch";
} elseif ($request->input('category_name') === "2") {
$category_name_name = "Server";
} elseif ($request->input('category_name') === "3") {
$category_name_name = "Storage";
} elseif ($request->input('category_name') === "4") {
$category_name_name = "Printer";
} elseif ($request->input('category_name') === "5") {
$category_name_name = "Wacom";
} elseif ($request->input('category_name') === "6") {
$category_name_name = "VGA";
} elseif ($request->input('category_name') === "7") {
$category_name_name = "HDD External & Internal";
} elseif ($request->input('category_name') === "8") {
$category_name_name = "HBA Card";
} elseif ($request->input('category_name') === "9") {
$category_name_name = "Render Farm";
} elseif ($request->input('category_name') === "10") {
$category_name_name = "UPS";
} elseif ($request->input('category_name') === "11") {
$category_name_name = "Monitor";
} elseif ($request->input('category_name') === "12") {
$category_name_name = "Laptop";
} elseif ($request->input('category_name') === "13") {
$category_name_name = "KVMX";
} elseif ($request->input('category_name') === "14") {
$category_name_name = "Scanner";
} elseif ($request->input('category_name') === "15") {
$category_name_name = "Wireless";
} elseif ($request->input('category_name') === "16") {
$category_name_name = "VOIP";
} elseif ($request->input('category_name') === "17") {
$category_name_name = "Workstation";
} elseif ($request->input('category_name') === "18") {
$category_name_name = "Projector";
} elseif ($request->input('category_name') === "19") {
$category_name_name = "Enclosure";
}


$rules = [
'asset_category' => 'required',
'asset_type' => 'required',
'category_type' => 'required',
'category_name' => 'required',
'brand' => 'required',
'series' => 'required',
'sn' => 'required',

];

$data = [
'instansi_id' => $request->input('instansi_name'),
'instansi_name' => $instansi,
'dept_id' => $request->input('dept'),
'asset_category_id' => $request->input('asset_category'),
'asset_type_id' => $request->input('asset_type'),
'category_type_id' => $request->input('category_type'),
'date_incoming' => $date_incoming,
'addtional' => $request->input('addtional'),
'item_description_name' => $request->input('brand'),
'vendor' => $request->input('vendor'),
'model' => $request->input('series'),
'SN' => $request->input('sn'),
'category_name' => $request->input('category_name'),
'years_of_id' => date('Y', strtotime($request->input('incoming'))),

'barcode_id' => $request->input('dept') . $request->input('asset_type') . $request->input('asset_category') .
$request->input('category_type') . date('y', strtotime($date_incoming)) . $request->input('category_name'),
'asset_type_name' => $asset_type_name,
'asset_category_name' => $asset_category_name,
'category_type_name' => $category_type_name,
'category_name_name' => $category_name_name,
'status' => $request->input('status'),
'created_name' => auth::user()->first_name . ' ' . auth::user()->last_name,
'update_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
'created_date' => date('Y-m-d'),
'updated_date' => date('Y-m-d'),
'PN' => $request->input('pn')

];
$bac = auth::user()->dept_category_id . $request->input('asset_type') . $request->input('asset_category') .
$request->input('category_type') . date('y', strtotime($request->input('incoming'))) . $request->input('category_name');

return dd($data);
$validator = Validator::make($request->all(), $rules);

if ($validator->fails()) {
return Redirect::route('addAssetPS')
->withErrors($validator)
->withInput();
} else {
DB::table('asseting_barcode')->insert($data);
Session::flash('message', Lang::get('messages.data_asset_inserted', ['data' => 'Data User']));
return Redirect::route('indexAssetPS');
}
}

public function editAssetPS(Request $request, $id)
{
$asset = db::table('asseting_barcode')->select('*')->where('id', '=', $id)
->first();


$deptt = Dept_Category::where('id', '=', $asset->dept_id)->first();

$list_dept = Dept_Category::WHERE('id', '!=', 7)->orderBy('id', 'asc')->get();
$ps = Dept_Category::where('id', '=', 7)->orderBy('id', 'asc')->get();


$asset_type = ['0' => '- Select Asset Category -', '1' => 'Purchase', '2' => 'Transfer'];
$asset_category = ['0' => '- Select Asset Type -', '1' => 'Asset', '2' => 'Integrable Asset'];
$category_type = ['0' => '- Select Category Type -', '1' => 'Hardware', '2' => 'Tools', '3' => 'Equipment'];
$category_name = ['0' => '- Select Category Name -', '17' => 'Workstation', '1' => 'Switch', '2' => 'Server', '3' =>
'Storage', '4' => 'Printer', '5' => 'Wacom', '6' => 'VGA', '7' => 'HDD External & Internal', '8' => 'HBA Card', '9' =>
'Render Farm', '10' => 'UPS', '11' => 'Monitor', '12' => 'Laptop', '13' => 'KVMX', '14' => 'Scanner', '15' =>
'Wireless', '16' => 'VOIP', '18' => 'Projector', '19' => 'Enclosure'];
$instansi_name = ['' => '- Select Instansi -', '1' => 'Kinema Animasi', '2' => 'Kinema Production Services', '3' =>
'Infinite Learning'];

/* $status = ['0' => '-Select Status Item-', 'FAILED' => 'FAILED', 'SCRAPPED' => 'SCRAPPED', 'OK' => 'OK', 'Other' =>
'Other'];*/


return view::make('PS.Assett.edit')
->with([
'asset_category' => $asset_category,
'asset_type' => $asset_type,
'category_type' => $category_type,
'aset' => $asset,
'category_name' => $category_name,
'instansi_name' => $instansi_name,
'department' => $list_dept,
'deptt' => $deptt,
'ps' => $ps,
/*'status' => $status,*/
]);
}

public function postEditAsssetPS(Request $request, $id)
{
$dept = Dept_Category::select('*')->get();
$item = db::table('asseting_barcode')->select('*')->orderBy('id', 'desc')
->first();


$asset_type_name = null;
$asset_category_name = null;
$category_type_name = null;
$category_name_name = null;
$instansi = null;
$date_incoming = date('Y-m-d', strtotime("0000-00-00"));

if ($request->input('instansi_name') === '1') {
$instansi = "Kinema Animasi";
} elseif ($request->input('instansi_name') === '2') {
$instansi = "Kinema Production Services";
} elseif ($request->input('instansi_name') === '3') {
$instansi = "Infinite Learning";
} else {
$instansi = Null;
}

if ($request->input('incoming') === null) {
$date_incoming = date('Y-m-d', strtotime('+1 years', strtotime("0000-00-00")));
} else {
$date_incoming = $request->input('incoming');
}

if ($request->input('asset_type') === "1") {
$asset_type_name = "Purchase";
} else {
$asset_type_name = "Transfer";
}

if ($request->input('asset_category') === "1") {
$asset_category_name = "Asset";
} else {
$asset_category_name = "intangible Asset";
}

if ($request->input('category_type') === "1") {
$category_type_name = "Hardware";
} elseif ($request->input('category_type') === "2") {
$category_type_name = "Tools";
} elseif ($request->input('category_type') === "3") {
$category_type_name = "Equipment";
} else {
$category_type_name = "Software";
}

if ($request->input('category_name') === "1") {
$category_name_name = "Switch";
} elseif ($request->input('category_name') === "2") {
$category_name_name = "Server";
} elseif ($request->input('category_name') === "3") {
$category_name_name = "Storage";
} elseif ($request->input('category_name') === "4") {
$category_name_name = "Printer";
} elseif ($request->input('category_name') === "5") {
$category_name_name = "Wacom";
} elseif ($request->input('category_name') === "6") {
$category_name_name = "VGA";
} elseif ($request->input('category_name') === "7") {
$category_name_name = "HDD External & Internal";
} elseif ($request->input('category_name') === "8") {
$category_name_name = "HBA Card";
} elseif ($request->input('category_name') === "9") {
$category_name_name = "Render Farm";
} elseif ($request->input('category_name') === "10") {
$category_name_name = "UPS";
} elseif ($request->input('category_name') === "11") {
$category_name_name = "Monitor";
} elseif ($request->input('category_name') === "12") {
$category_name_name = "Laptop";
} elseif ($request->input('category_name') === "13") {
$category_name_name = "KVMX";
} elseif ($request->input('category_name') === "14") {
$category_name_name = "Scanner";
} elseif ($request->input('category_name') === "15") {
$category_name_name = "Wireless";
} elseif ($request->input('category_name') === "16") {
$category_name_name = "VOIP";
} elseif ($request->input('category_name') === "17") {
$category_name_name = "Workstation";
} elseif ($request->input('category_name') === "18") {
$category_name_name = "Projector";
} elseif ($request->input('category_name') === "19") {
$category_name_name = "Enclosure";
}


$rules = [
'asset_category' => 'required',
'asset_type' => 'required',
'category_type' => 'required',
'category_name' => 'required',
'brand' => 'required',

'series' => 'required',

];

$data = [
'instansi_id' => $request->input('instansi_name'),
'instansi_name' => $instansi,
'dept_id' => $request->input('dept'),
'asset_category_id' => $request->input('asset_category'),
'asset_type_id' => $request->input('asset_type'),
'category_type_id' => $request->input('category_type'),
'date_incoming' => $date_incoming,
'addtional' => $request->input('addtional'),
'item_description_name' => $request->input('brand'),
'vendor' => $request->input('vendor'),
'model' => $request->input('series'),
'SN' => $request->input('sn'),
'category_name' => $request->input('category_name'),
'years_of_id' => date('Y', strtotime($request->input('incoming'))),
'barcode_id' => $request->input('dept') . $request->input('asset_type') . $request->input('asset_category') .
$request->input('category_type') . date('y', strtotime($date_incoming)) . $request->input('category_name'),
'asset_type_name' => $asset_type_name,
'asset_category_name' => $asset_category_name,
'category_type_name' => $category_type_name,
'category_name_name' => $category_name_name,
'status' => $request->input('status'),
'update_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
'updated_date' => date('Y-m-d'),
];

$validator = Validator::make($request->all(), $rules);

if ($validator->fails()) {
return Redirect::route('add-it')
->withErrors($validator)
->withInput();
} else {
DB::table('asseting_barcode')->where('id', '=', $id)->update($data);
Session::flash('message', Lang::get('messages.data_asset_updated', ['data' => 'Data User']));
return Redirect::route('indexAssetPS');
}
}

public function printAssetPS($id)
{
$select = DB::table('asseting_barcode')->select('*')->where('id', '=', $id)->first();

$customPaper = array(0, 0, 300, 200);

$pdf = App::make('dompdf.wrapper');

$pdf->loadview('PS.Assett.print_asset', ['select' => $select]);
$pdf->setPaper($customPaper, 'landscape');
return $pdf->stream();
}

public function indexLayout()
{
$animasii = WS_MAP::where('area', 'Layout')->get();

$layout_160 = Ws_Map::select('*')->where('no_seat', 160)->where('area', '=', 'Layout')->first();
$layout_161 = Ws_Map::select('*')->where('no_seat', 161)->where('area', '=', 'Layout')->first();
$layout_162 = Ws_Map::select('*')->where('no_seat', 162)->where('area', '=', 'Layout')->first();
$layout_163 = Ws_Map::select('*')->where('no_seat', 163)->where('area', '=', 'Layout')->first();
$layout_164 = Ws_Map::select('*')->where('no_seat', 164)->where('area', '=', 'Layout')->first();
$layout_165 = Ws_Map::select('*')->where('no_seat', 165)->where('area', '=', 'Layout')->first();
$layout_166 = Ws_Map::select('*')->where('no_seat', 166)->where('area', '=', 'Layout')->first();
$layout_167 = Ws_Map::select('*')->where('no_seat', 167)->where('area', '=', 'Layout')->first();
$layout_168 = Ws_Map::select('*')->where('no_seat', 168)->where('area', '=', 'Layout')->first();
$layout_169 = Ws_Map::select('*')->where('no_seat', 169)->where('area', '=', 'Layout')->first();
$layout_170 = Ws_Map::select('*')->where('no_seat', 170)->where('area', '=', 'Layout')->first();
$layout_171 = Ws_Map::select('*')->where('no_seat', 171)->where('area', '=', 'Layout')->first();
$layout_172 = Ws_Map::select('*')->where('no_seat', 172)->where('area', '=', 'Layout')->first();
$layout_173 = Ws_Map::select('*')->where('no_seat', 173)->where('area', '=', 'Layout')->first();
$layout_174 = Ws_Map::select('*')->where('no_seat', 174)->where('area', '=', 'Layout')->first();
$layout_175 = Ws_Map::select('*')->where('no_seat', 175)->where('area', '=', 'Layout')->first();
$layout_176 = Ws_Map::select('*')->where('no_seat', 176)->where('area', '=', 'Layout')->first();
$layout_177 = Ws_Map::select('*')->where('no_seat', 177)->where('area', '=', 'Layout')->first();
$layout_178 = Ws_Map::select('*')->where('no_seat', 178)->where('area', '=', 'Layout')->first();
$layout_179 = Ws_Map::select('*')->where('no_seat', 179)->where('area', '=', 'Layout')->first();
$layout_180 = Ws_Map::select('*')->where('no_seat', 180)->where('area', '=', 'Layout')->first();
$layout_181 = Ws_Map::select('*')->where('no_seat', 181)->where('area', '=', 'Layout')->first();
$layout_182 = Ws_Map::select('*')->where('no_seat', 182)->where('area', '=', 'Layout')->first();
$layout_183 = Ws_Map::select('*')->where('no_seat', 183)->where('area', '=', 'Layout')->first();
$layout_184 = Ws_Map::select('*')->where('no_seat', 184)->where('area', '=', 'Layout')->first();
$layout_185 = Ws_Map::select('*')->where('no_seat', 185)->where('area', '=', 'Layout')->first();
$layout_186 = Ws_Map::select('*')->where('no_seat', 186)->where('area', '=', 'Layout')->first();
$layout_187 = Ws_Map::select('*')->where('no_seat', 187)->where('area', '=', 'Layout')->first();
$layout_188 = Ws_Map::select('*')->where('no_seat', 188)->where('area', '=', 'Layout')->first();
$layout_189 = Ws_Map::select('*')->where('no_seat', 189)->where('area', '=', 'Layout')->first();
$layout_190 = Ws_Map::select('*')->where('no_seat', 190)->where('area', '=', 'Layout')->first();
$layout_191 = Ws_Map::select('*')->where('no_seat', 191)->where('area', '=', 'Layout')->first();
$layout_192 = Ws_Map::select('*')->where('no_seat', 192)->where('area', '=', 'Layout')->first();
$layout_193 = Ws_Map::select('*')->where('no_seat', 193)->where('area', '=', 'Layout')->first();
$layout_194 = Ws_Map::select('*')->where('no_seat', 194)->where('area', '=', 'Layout')->first();
$layout_195 = Ws_Map::select('*')->where('no_seat', 195)->where('area', '=', 'Layout')->first();
$layout_196 = Ws_Map::select('*')->where('no_seat', 196)->where('area', '=', 'Layout')->first();
$layout_197 = Ws_Map::select('*')->where('no_seat', 197)->where('area', '=', 'Layout')->first();
$layout_198 = Ws_Map::select('*')->where('no_seat', 198)->where('area', '=', 'Layout')->first();
$layout_199 = Ws_Map::select('*')->where('no_seat', 199)->where('area', '=', 'Layout')->first();
$layout_200 = Ws_Map::select('*')->where('no_seat', 200)->where('area', '=', 'Layout')->first();
$layout_201 = Ws_Map::select('*')->where('no_seat', 201)->where('area', '=', 'Layout')->first();
$layout_202 = Ws_Map::select('*')->where('no_seat', 202)->where('area', '=', 'Layout')->first();
$layout_203 = Ws_Map::select('*')->where('no_seat', 203)->where('area', '=', 'Layout')->first();
$layout_204 = Ws_Map::select('*')->where('no_seat', 204)->where('area', '=', 'Layout')->first();
$layout_205 = Ws_Map::select('*')->where('no_seat', 205)->where('area', '=', 'Layout')->first();
$layout_206 = Ws_Map::select('*')->where('no_seat', 206)->where('area', '=', 'Layout')->first();
$layout_207 = Ws_Map::select('*')->where('no_seat', 207)->where('area', '=', 'Layout')->first();
$layout_208 = Ws_Map::select('*')->where('no_seat', 208)->where('area', '=', 'Layout')->first();
$layout_209 = Ws_Map::select('*')->where('no_seat', 209)->where('area', '=', 'Layout')->first();
$layout_210 = Ws_Map::select('*')->where('no_seat', 210)->where('area', '=', 'Layout')->first();
$layout_211 = Ws_Map::select('*')->where('no_seat', 211)->where('area', '=', 'Layout')->first();
$layout_212 = Ws_Map::select('*')->where('no_seat', 212)->where('area', '=', 'Layout')->first();
$layout_213 = Ws_Map::select('*')->where('no_seat', 213)->where('area', '=', 'Layout')->first();
$layout_214 = Ws_Map::select('*')->where('no_seat', 214)->where('area', '=', 'Layout')->first();
$layout_215 = Ws_Map::select('*')->where('no_seat', 215)->where('area', '=', 'Layout')->first();
$layout_216 = Ws_Map::select('*')->where('no_seat', 216)->where('area', '=', 'Layout')->first();
$layout_217 = Ws_Map::select('*')->where('no_seat', 217)->where('area', '=', 'Layout')->first();
$layout_218 = Ws_Map::select('*')->where('no_seat', 218)->where('area', '=', 'Layout')->first();
$layout_219 = Ws_Map::select('*')->where('no_seat', 219)->where('area', '=', 'Layout')->first();
$layout_220 = Ws_Map::select('*')->where('no_seat', 220)->where('area', '=', 'Layout')->first();
$layout_221 = Ws_Map::select('*')->where('no_seat', 221)->where('area', '=', 'Layout')->first();
$layout_222 = Ws_Map::select('*')->where('no_seat', 222)->where('area', '=', 'Layout')->first();
$layout_223 = Ws_Map::select('*')->where('no_seat', 223)->where('area', '=', 'Layout')->first();
$layout_224 = Ws_Map::select('*')->where('no_seat', 224)->where('area', '=', 'Layout')->first();
$layout_225 = Ws_Map::select('*')->where('no_seat', 225)->where('area', '=', 'Layout')->first();
$layout_226 = Ws_Map::select('*')->where('no_seat', 226)->where('area', '=', 'Layout')->first();
$layout_227 = Ws_Map::select('*')->where('no_seat', 227)->where('area', '=', 'Layout')->first();
$layout_228 = Ws_Map::select('*')->where('no_seat', 228)->where('area', '=', 'Layout')->first();
$layout_229 = Ws_Map::select('*')->where('no_seat', 229)->where('area', '=', 'Layout')->first();
$layout_230 = Ws_Map::select('*')->where('no_seat', 230)->where('area', '=', 'Layout')->first();
$layout_231 = Ws_Map::select('*')->where('no_seat', 231)->where('area', '=', 'Layout')->first();
$layout_232 = Ws_Map::select('*')->where('no_seat', 232)->where('area', '=', 'Layout')->first();
$layout_233 = Ws_Map::select('*')->where('no_seat', 233)->where('area', '=', 'Layout')->first();
$layout_234 = Ws_Map::select('*')->where('no_seat', 234)->where('area', '=', 'Layout')->first();
$layout_235 = Ws_Map::select('*')->where('no_seat', 235)->where('area', '=', 'Layout')->first();
$layout_236 = Ws_Map::select('*')->where('no_seat', 236)->where('area', '=', 'Layout')->first();
$layout_237 = Ws_Map::select('*')->where('no_seat', 237)->where('area', '=', 'Layout')->first();
$layout_238 = Ws_Map::select('*')->where('no_seat', 238)->where('area', '=', 'Layout')->first();
$layout_239 = Ws_Map::select('*')->where('no_seat', 239)->where('area', '=', 'Layout')->first();
$layout_240 = Ws_Map::select('*')->where('no_seat', 240)->where('area', '=', 'Layout')->first();
$layout_241 = Ws_Map::select('*')->where('no_seat', 241)->where('area', '=', 'Layout')->first();
$layout_242 = Ws_Map::select('*')->where('no_seat', 242)->where('area', '=', 'Layout')->first();
$layout_243 = Ws_Map::select('*')->where('no_seat', 243)->where('area', '=', 'Layout')->first();
$layout_244 = Ws_Map::select('*')->where('no_seat', 244)->where('area', '=', 'Layout')->first();
$layout_245 = Ws_Map::select('*')->where('no_seat', 245)->where('area', '=', 'Layout')->first();
$layout_246 = Ws_Map::select('*')->where('no_seat', 246)->where('area', '=', 'Layout')->first();
$layout_247 = Ws_Map::select('*')->where('no_seat', 247)->where('area', '=', 'Layout')->first();
$layout_248 = Ws_Map::select('*')->where('no_seat', 248)->where('area', '=', 'Layout')->first();
$layout_249 = Ws_Map::select('*')->where('no_seat', 249)->where('area', '=', 'Layout')->first();
$layout_250 = Ws_Map::select('*')->where('no_seat', 250)->where('area', '=', 'Layout')->first();
$layout_251 = Ws_Map::select('*')->where('no_seat', 251)->where('area', '=', 'Layout')->first();
$layout_252 = Ws_Map::select('*')->where('no_seat', 252)->where('area', '=', 'Layout')->first();
$layout_253 = Ws_Map::select('*')->where('no_seat', 253)->where('area', '=', 'Layout')->first();

return view::make(
'IT.WS_MAP.Layout.index_layout',
[
'animasii' => $animasii,
'layout_160' => $layout_160,
'layout_161' => $layout_161,
'layout_162' => $layout_162,
'layout_163' => $layout_163,
'layout_164' => $layout_164,
'layout_165' => $layout_165,
'layout_166' => $layout_166,
'layout_167' => $layout_167,
'layout_168' => $layout_168,
'layout_169' => $layout_169,
'layout_170' => $layout_170,
'layout_171' => $layout_171,
'layout_172' => $layout_172,
'layout_173' => $layout_173,
'layout_174' => $layout_174,
'layout_175' => $layout_175,
'layout_176' => $layout_176,
'layout_177' => $layout_177,
'layout_178' => $layout_178,
'layout_179' => $layout_179,
'layout_180' => $layout_180,
'layout_181' => $layout_181,
'layout_182' => $layout_182,
'layout_183' => $layout_183,
'layout_184' => $layout_184,
'layout_185' => $layout_185,
'layout_186' => $layout_186,
'layout_187' => $layout_187,
'layout_188' => $layout_188,
'layout_189' => $layout_189,
'layout_190' => $layout_190,
'layout_191' => $layout_191,
'layout_192' => $layout_192,
'layout_193' => $layout_193,
'layout_194' => $layout_194,
'layout_195' => $layout_195,
'layout_196' => $layout_196,
'layout_197' => $layout_197,
'layout_198' => $layout_198,
'layout_199' => $layout_199,
'layout_200' => $layout_200,
'layout_201' => $layout_201,
'layout_202' => $layout_202,
'layout_203' => $layout_203,
'layout_204' => $layout_204,
'layout_205' => $layout_205,
'layout_206' => $layout_206,
'layout_207' => $layout_207,
'layout_208' => $layout_208,
'layout_209' => $layout_209,
'layout_210' => $layout_210,
'layout_211' => $layout_211,
'layout_212' => $layout_212,
'layout_213' => $layout_213,
'layout_214' => $layout_214,
'layout_215' => $layout_215,
'layout_216' => $layout_216,
'layout_217' => $layout_217,
'layout_218' => $layout_218,
'layout_219' => $layout_219,
'layout_220' => $layout_220,
'layout_221' => $layout_221,
'layout_222' => $layout_222,
'layout_223' => $layout_223,
'layout_224' => $layout_224,
'layout_225' => $layout_225,
'layout_226' => $layout_226,
'layout_227' => $layout_227,
'layout_228' => $layout_228,
'layout_229' => $layout_229,
'layout_230' => $layout_230,
'layout_231' => $layout_231,
'layout_232' => $layout_232,
'layout_233' => $layout_233,
'layout_234' => $layout_234,
'layout_235' => $layout_235,
'layout_236' => $layout_236,
'layout_237' => $layout_237,
'layout_238' => $layout_238,
'layout_239' => $layout_239,
'layout_240' => $layout_240,
'layout_241' => $layout_241,
'layout_242' => $layout_242,
'layout_243' => $layout_243,
'layout_244' => $layout_244,
'layout_245' => $layout_245,
'layout_246' => $layout_246,
'layout_247' => $layout_247,
'layout_248' => $layout_248,
'layout_249' => $layout_249,
'layout_250' => $layout_250,
'layout_251' => $layout_251,
'layout_252' => $layout_252,
'layout_253' => $layout_253,
]
);
}

public function postDataLayout(Request $request, $id)
{

$animasi = Ws_Map::where('id', '=', $id)->first();

$AvailabilityMap = ws_Availability::orderBy('hostname', 'asc')->get();

$ws_availability = ws_Availability::where('hostname', '=', $animasi->workstation)->first();

$ws_after = ws_Availability::where('hostname', '=', $animasi->workstation)->first();

$workstation = ws_Availability::select('hostname')->orderBy('hostname', 'asc')->pluck('hostname');

return view::make('IT.WS_MAP.Layout.editWSMAP', [
'animasi' => $animasi,
'AvailabilityMap' => $AvailabilityMap,
'ws_availability' => $ws_availability,
'ws_after' => $ws_after,
]);
}

public function postInputDataLayout(Request $request, $id)
{
$animasi = Ws_Map::where('id', '=', $id)->first();

if ($request->input('workstation') != null) {
$ws_availability = ws_Availability::where('hostname', '=', $request->input('workstation'))->first();
}
if ($request->input('secondary_workstation') != null) {
$ws_availability2 = ws_Availability::where('hostname', '=', $request->input('secondary_workstation'))->first();
}

$rules = [
'no_seat' => 'required',
'area' => 'required',
];

if ($request->input('secondary_workstation') === null and $request->input('workstation') === null) {
$data = [
'user' => $request->input('username'),
'workstation' => $request->input('workstation'),
'workstation1_id' => null,
'secondary_workstation' => $request->input('secondary_workstation'),
'workstation2_id' => null,
'monitor1' => $request->input('monitor1'),
'monitor2' => $request->input('monitor2'),
'wacom' => $request->input('wacom'),
'no_seat' => $request->input('no_seat'),
'area' => $request->input('area'),
'updated_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
];
} elseif ($request->input('secondary_workstation') === null and $request->input('workstation') != null) {
$findmainsecondws = null;
$findmainws = db::table('asseting_barcode')->select('*')->where('addtional', 'like', '%' .
$request->input('workstation') . '%')->first();

if ($findmainws != null) {
$barcode = $findmainws->instansi_id . $findmainws->barcode_id . $findmainws->id;
} else {
$barcode = null;
}

$data = [
'user' => $request->input('username'),
'workstation' => $request->input('workstation'),
'workstation1_id' => $barcode,
'secondary_workstation' => $request->input('secondary_workstation'),
'workstation2_id' => $findmainsecondws,
'monitor1' => $request->input('monitor1'),
'monitor2' => $request->input('monitor2'),
'wacom' => $request->input('wacom'),
'no_seat' => $request->input('no_seat'),
'area' => $request->input('area'),
'updated_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
];
} elseif ($request->input('secondary_workstation') != null and $request->input('workstation') === null) {
$findmainws = null;
$findmainsecondws = db::table('asseting_barcode')->select('*')->where('addtional', 'like', '%' .
$request->input('secondary_workstation') . '%')->first();

if ($findmainsecondws != null) {
$barcode = $findmainsecondws->instansi_id . $findmainsecondws->barcode_id . $findmainsecondws->id;
} else {
$barcode = null;
}
$data = [
'user' => $request->input('username'),
'workstation' => $request->input('workstation'),
'workstation1_id' => $findmainws,
'secondary_workstation' => $request->input('secondary_workstation'),
'workstation2_id' => $findmainsecondws->instansi_id . $findmainsecondws->barcode_id . $findmainsecondws->id,
'monitor1' => $request->input('monitor1'),
'monitor2' => $request->input('monitor2'),
'no_seat' => $request->input('no_seat'),
'wacom' => $request->input('wacom'),
'area' => $request->input('area'),
'updated_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
];
} elseif ($request->input('secondary_workstation') != null and $request->input('workstation') != null) {
$findmainsecondws = db::table('asseting_barcode')->select('*')->where('addtional', 'like', '%' .
$request->input('secondary_workstation') . '%')->first();
$findmainws = db::table('asseting_barcode')->select('*')->where('addtional', 'like', '%' .
$request->input('workstation') . '%')->first();

if ($findmainsecondws != null) {
$barcodews = $findmainsecondws->instansi_id . $findmainsecondws->barcode_id . $findmainsecondws->id;
} else {
$barcodews = null;
}


if ($findmainws != null) {
$barcode = $findmainws->instansi_id . $findmainws->barcode_id . $findmainws->id;
} else {
$barcode = null;
}

$data = [
'user' => $request->input('username'),
'workstation' => $request->input('workstation'),
'workstation1_id' => $barcode,
'secondary_workstation' => $request->input('secondary_workstation'),
'workstation2_id' => $barcodews,
'monitor1' => $request->input('monitor1'),
'monitor2' => $request->input('monitor2'),
'wacom' => strtoupper($request->input('wacom')),
'no_seat' => $request->input('no_seat'),
'area' => $request->input('area'),
'updated_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
];
}

if ($request->input('workstation') != null) {
$data2 = [
'hostname' => $request->input('workstation'),
'type' => $ws_availability->type,
'user' => $request->input('username'),
'os' => $ws_availability->os,
'Memory' => $ws_availability->memory,
'vga' => $ws_availability->vga,
'location' => $request->input('area'),
'notes' => $ws_availability->notes,
];
}

if ($request->input('secondary_workstation') != null) {
$data3 = [
'hostname' => $request->input('secondary_workstation'),
'type' => $ws_availability2->type,
'user' => $request->input('username'),
'os' => $ws_availability2->os,
'Memory' => $ws_availability2->memory,
'vga' => $ws_availability2->vga,
'location' => $request->input('area'),
'notes' => $ws_availability2->notes,
];
}
$validator = Validator::make($request->all(), $rules);

if ($validator->fails()) {
Session::flash('message', Lang::get('messages.data_error', ['data' => 'Sorry, Data']));
return Redirect::route('postDataLayout', [$id])
->withErrors($validator)
->withInput();
} else {
if ($request->input('workstation') != null) {
db::table('ws_Availability')->where('hostname', '=', $ws_availability->hostname)->update($data2);
db::table('log_ws_Availability')->insert($data2);
}
if ($request->input('secondary_workstation') != null) {
db::table('ws_Availability')->where('hostname', '=', $ws_availability2->hostname)->update($data3);
db::table('log_ws_Availability')->insert($data3);
}
db::table('ws_map')->where('id', '=', $id)->update($data);
Session::flash('message', Lang::get('messages.data_map_updated', ['data' => 'Data Map']));
return Redirect::route('indexLayout');
}
}

public function loadHTMLLayout()
{
$layout_160 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 160)->where('area', '=', 'Layout')->first();
$layout_161 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 161)->where('area', '=', 'Layout')->first();
$layout_162 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 162)->where('area', '=', 'Layout')->first();
$layout_163 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 163)->where('area', '=', 'Layout')->first();
$layout_164 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 164)->where('area', '=', 'Layout')->first();
$layout_165 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 165)->where('area', '=', 'Layout')->first();
$layout_166 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 166)->where('area', '=', 'Layout')->first();
$layout_167 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 167)->where('area', '=', 'Layout')->first();
$layout_168 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 168)->where('area', '=', 'Layout')->first();
$layout_169 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 169)->where('area', '=', 'Layout')->first();
$layout_170 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 170)->where('area', '=', 'Layout')->first();
$layout_171 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 171)->where('area', '=', 'Layout')->first();
$layout_172 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 172)->where('area', '=', 'Layout')->first();
$layout_173 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 173)->where('area', '=', 'Layout')->first();
$layout_174 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 174)->where('area', '=', 'Layout')->first();
$layout_175 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 175)->where('area', '=', 'Layout')->first();
$layout_176 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 176)->where('area', '=', 'Layout')->first();
$layout_177 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 177)->where('area', '=', 'Layout')->first();
$layout_178 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 178)->where('area', '=', 'Layout')->first();
$layout_179 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 179)->where('area', '=', 'Layout')->first();
$layout_180 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 180)->where('area', '=', 'Layout')->first();
$layout_181 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 181)->where('area', '=', 'Layout')->first();
$layout_182 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 182)->where('area', '=', 'Layout')->first();
$layout_183 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 183)->where('area', '=', 'Layout')->first();
$layout_184 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 184)->where('area', '=', 'Layout')->first();
$layout_185 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 185)->where('area', '=', 'Layout')->first();
$layout_186 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 186)->where('area', '=', 'Layout')->first();
$layout_187 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 187)->where('area', '=', 'Layout')->first();
$layout_188 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 188)->where('area', '=', 'Layout')->first();
$layout_189 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 189)->where('area', '=', 'Layout')->first();
$layout_190 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 190)->where('area', '=', 'Layout')->first();
$layout_191 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 191)->where('area', '=', 'Layout')->first();
$layout_192 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 192)->where('area', '=', 'Layout')->first();
$layout_193 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 193)->where('area', '=', 'Layout')->first();
$layout_194 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 194)->where('area', '=', 'Layout')->first();
$layout_195 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 195)->where('area', '=', 'Layout')->first();
$layout_196 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 196)->where('area', '=', 'Layout')->first();
$layout_197 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 197)->where('area', '=', 'Layout')->first();
$layout_198 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 198)->where('area', '=', 'Layout')->first();
$layout_199 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 199)->where('area', '=', 'Layout')->first();
$layout_200 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 200)->where('area', '=', 'Layout')->first();
$layout_201 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 201)->where('area', '=', 'Layout')->first();
$layout_202 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 202)->where('area', '=', 'Layout')->first();
$layout_203 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 203)->where('area', '=', 'Layout')->first();
$layout_204 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 204)->where('area', '=', 'Layout')->first();
$layout_205 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 205)->where('area', '=', 'Layout')->first();
$layout_206 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 206)->where('area', '=', 'Layout')->first();
$layout_207 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 207)->where('area', '=', 'Layout')->first();
$layout_208 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 208)->where('area', '=', 'Layout')->first();
$layout_209 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 209)->where('area', '=', 'Layout')->first();
$layout_210 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 210)->where('area', '=', 'Layout')->first();
$layout_211 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 211)->where('area', '=', 'Layout')->first();
$layout_212 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 212)->where('area', '=', 'Layout')->first();
$layout_213 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 213)->where('area', '=', 'Layout')->first();
$layout_214 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 214)->where('area', '=', 'Layout')->first();
$layout_215 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 215)->where('area', '=', 'Layout')->first();
$layout_216 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 216)->where('area', '=', 'Layout')->first();
$layout_217 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 217)->where('area', '=', 'Layout')->first();
$layout_218 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 218)->where('area', '=', 'Layout')->first();
$layout_219 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 219)->where('area', '=', 'Layout')->first();
$layout_220 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 220)->where('area', '=', 'Layout')->first();
$layout_221 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 221)->where('area', '=', 'Layout')->first();
$layout_222 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 222)->where('area', '=', 'Layout')->first();
$layout_223 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 223)->where('area', '=', 'Layout')->first();
$layout_224 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 224)->where('area', '=', 'Layout')->first();
$layout_225 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 225)->where('area', '=', 'Layout')->first();
$layout_226 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 226)->where('area', '=', 'Layout')->first();
$layout_227 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 227)->where('area', '=', 'Layout')->first();
$layout_228 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 228)->where('area', '=', 'Layout')->first();
$layout_229 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 229)->where('area', '=', 'Layout')->first();
$layout_230 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 230)->where('area', '=', 'Layout')->first();
$layout_231 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 231)->where('area', '=', 'Layout')->first();
$layout_232 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 232)->where('area', '=', 'Layout')->first();
$layout_233 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 233)->where('area', '=', 'Layout')->first();
$layout_234 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 234)->where('area', '=', 'Layout')->first();
$layout_235 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 235)->where('area', '=', 'Layout')->first();
$layout_236 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 236)->where('area', '=', 'Layout')->first();
$layout_237 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 237)->where('area', '=', 'Layout')->first();
$layout_238 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 238)->where('area', '=', 'Layout')->first();
$layout_239 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 239)->where('area', '=', 'Layout')->first();
$layout_240 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 240)->where('area', '=', 'Layout')->first();
$layout_241 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 241)->where('area', '=', 'Layout')->first();
$layout_242 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 242)->where('area', '=', 'Layout')->first();
$layout_243 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 243)->where('area', '=', 'Layout')->first();
$layout_244 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 244)->where('area', '=', 'Layout')->first();
$layout_245 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 245)->where('area', '=', 'Layout')->first();
$layout_246 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 246)->where('area', '=', 'Layout')->first();
$layout_247 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 247)->where('area', '=', 'Layout')->first();
$layout_248 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 248)->where('area', '=', 'Layout')->first();
$layout_249 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 249)->where('area', '=', 'Layout')->first();
$layout_250 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 250)->where('area', '=', 'Layout')->first();
$layout_251 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 251)->where('area', '=', 'Layout')->first();
$layout_252 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 252)->where('area', '=', 'Layout')->first();
$layout_253 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 253)->where('area', '=', 'Layout')->first();
$total_seat = Ws_Map::where('area', '=', 'Layout')->count();
$pdf = App::make('dompdf.wrapper');
ini_set("memory_limit", '512M');
$customPaper = array(0, 0, 850, 700);
$pdf->loadview('IT.WS_MAP.Layout.pdf', [
'total_seat' => $total_seat,
'layout_160' => $layout_160,
'layout_161' => $layout_161,
'layout_162' => $layout_162,
'layout_163' => $layout_163,
'layout_164' => $layout_164,
'layout_165' => $layout_165,
'layout_166' => $layout_166,
'layout_167' => $layout_167,
'layout_168' => $layout_168,
'layout_169' => $layout_169,
'layout_170' => $layout_170,
'layout_171' => $layout_171,
'layout_172' => $layout_172,
'layout_173' => $layout_173,
'layout_174' => $layout_174,
'layout_175' => $layout_175,
'layout_176' => $layout_176,
'layout_177' => $layout_177,
'layout_178' => $layout_178,
'layout_179' => $layout_179,
'layout_180' => $layout_180,
'layout_181' => $layout_181,
'layout_182' => $layout_182,
'layout_183' => $layout_183,
'layout_184' => $layout_184,
'layout_185' => $layout_185,
'layout_186' => $layout_186,
'layout_187' => $layout_187,
'layout_188' => $layout_188,
'layout_189' => $layout_189,
'layout_190' => $layout_190,
'layout_191' => $layout_191,
'layout_192' => $layout_192,
'layout_193' => $layout_193,
'layout_194' => $layout_194,
'layout_195' => $layout_195,
'layout_196' => $layout_196,
'layout_197' => $layout_197,
'layout_198' => $layout_198,
'layout_199' => $layout_199,
'layout_200' => $layout_200,
'layout_201' => $layout_201,
'layout_202' => $layout_202,
'layout_203' => $layout_203,
'layout_204' => $layout_204,
'layout_205' => $layout_205,
'layout_206' => $layout_206,
'layout_207' => $layout_207,
'layout_208' => $layout_208,
'layout_209' => $layout_209,
'layout_210' => $layout_210,
'layout_211' => $layout_211,
'layout_212' => $layout_212,
'layout_213' => $layout_213,
'layout_214' => $layout_214,
'layout_215' => $layout_215,
'layout_216' => $layout_216,
'layout_217' => $layout_217,
'layout_218' => $layout_218,
'layout_219' => $layout_219,
'layout_220' => $layout_220,
'layout_221' => $layout_221,
'layout_222' => $layout_222,
'layout_223' => $layout_223,
'layout_224' => $layout_224,
'layout_225' => $layout_225,
'layout_226' => $layout_226,
'layout_227' => $layout_227,
'layout_228' => $layout_228,
'layout_229' => $layout_229,
'layout_230' => $layout_230,
'layout_231' => $layout_231,
'layout_232' => $layout_232,
'layout_233' => $layout_233,
'layout_234' => $layout_234,
'layout_235' => $layout_235,
'layout_236' => $layout_236,
'layout_237' => $layout_237,
'layout_238' => $layout_238,
'layout_239' => $layout_239,
'layout_240' => $layout_240,
'layout_241' => $layout_241,
'layout_242' => $layout_242,
'layout_243' => $layout_243,
'layout_244' => $layout_244,
'layout_245' => $layout_245,
'layout_246' => $layout_246,
'layout_247' => $layout_247,
'layout_248' => $layout_248,
'layout_249' => $layout_249,
'layout_250' => $layout_250,
'layout_251' => $layout_251,
'layout_252' => $layout_252,
'layout_253' => $layout_253,
])
->setPaper('A3', 'potrait')
->setOptions(['dpi' => 200, 'defaultFont' => 'sans-serif']);
return $pdf->stream();
}

public function indexRender()
{
$animasii = WS_MAP::where('area', 'Render')->get();

$Render_254 = Ws_Map::select('*')->where('no_seat', 254)->where('area', '=', 'Render')->first();
$Render_255 = Ws_Map::select('*')->where('no_seat', 255)->where('area', '=', 'Render')->first();
$Render_256 = Ws_Map::select('*')->where('no_seat', 256)->where('area', '=', 'Render')->first();
$Render_257 = Ws_Map::select('*')->where('no_seat', 257)->where('area', '=', 'Render')->first();
$Render_258 = Ws_Map::select('*')->where('no_seat', 258)->where('area', '=', 'Render')->first();
$Render_259 = Ws_Map::select('*')->where('no_seat', 259)->where('area', '=', 'Render')->first();
$Render_260 = Ws_Map::select('*')->where('no_seat', 260)->where('area', '=', 'Render')->first();
$Render_261 = Ws_Map::select('*')->where('no_seat', 261)->where('area', '=', 'Render')->first();
$Render_262 = Ws_Map::select('*')->where('no_seat', 262)->where('area', '=', 'Render')->first();
$Render_263 = Ws_Map::select('*')->where('no_seat', 263)->where('area', '=', 'Render')->first();
$Render_264 = Ws_Map::select('*')->where('no_seat', 264)->where('area', '=', 'Render')->first();
$Render_265 = Ws_Map::select('*')->where('no_seat', 265)->where('area', '=', 'Render')->first();
$Render_266 = Ws_Map::select('*')->where('no_seat', 266)->where('area', '=', 'Render')->first();
$Render_267 = Ws_Map::select('*')->where('no_seat', 267)->where('area', '=', 'Render')->first();
$Render_268 = Ws_Map::select('*')->where('no_seat', 268)->where('area', '=', 'Render')->first();
$Render_269 = Ws_Map::select('*')->where('no_seat', 269)->where('area', '=', 'Render')->first();
$Render_270 = Ws_Map::select('*')->where('no_seat', 270)->where('area', '=', 'Render')->first();
$Render_271 = Ws_Map::select('*')->where('no_seat', 271)->where('area', '=', 'Render')->first();
$Render_272 = Ws_Map::select('*')->where('no_seat', 272)->where('area', '=', 'Render')->first();
$Render_273 = Ws_Map::select('*')->where('no_seat', 273)->where('area', '=', 'Render')->first();
$Render_274 = Ws_Map::select('*')->where('no_seat', 274)->where('area', '=', 'Render')->first();
$Render_275 = Ws_Map::select('*')->where('no_seat', 275)->where('area', '=', 'Render')->first();
$Render_276 = Ws_Map::select('*')->where('no_seat', 276)->where('area', '=', 'Render')->first();
$Render_277 = Ws_Map::select('*')->where('no_seat', 277)->where('area', '=', 'Render')->first();
$Render_278 = Ws_Map::select('*')->where('no_seat', 278)->where('area', '=', 'Render')->first();
$Render_279 = Ws_Map::select('*')->where('no_seat', 279)->where('area', '=', 'Render')->first();
$Render_280 = Ws_Map::select('*')->where('no_seat', 280)->where('area', '=', 'Render')->first();
$Render_281 = Ws_Map::select('*')->where('no_seat', 281)->where('area', '=', 'Render')->first();
$Render_282 = Ws_Map::select('*')->where('no_seat', 282)->where('area', '=', 'Render')->first();
$Render_283 = Ws_Map::select('*')->where('no_seat', 283)->where('area', '=', 'Render')->first();
$Render_284 = Ws_Map::select('*')->where('no_seat', 284)->where('area', '=', 'Render')->first();
$Render_285 = Ws_Map::select('*')->where('no_seat', 285)->where('area', '=', 'Render')->first();
$Render_286 = Ws_Map::select('*')->where('no_seat', 286)->where('area', '=', 'Render')->first();
$Render_287 = Ws_Map::select('*')->where('no_seat', 287)->where('area', '=', 'Render')->first();
$Render_288 = Ws_Map::select('*')->where('no_seat', 288)->where('area', '=', 'Render')->first();
$Render_289 = Ws_Map::select('*')->where('no_seat', 289)->where('area', '=', 'Render')->first();
$Render_290 = Ws_Map::select('*')->where('no_seat', 290)->where('area', '=', 'Render')->first();
$Render_291 = Ws_Map::select('*')->where('no_seat', 291)->where('area', '=', 'Render')->first();
$Render_292 = Ws_Map::select('*')->where('no_seat', 292)->where('area', '=', 'Render')->first();
$Render_293 = Ws_Map::select('*')->where('no_seat', 293)->where('area', '=', 'Render')->first();
$Render_294 = Ws_Map::select('*')->where('no_seat', 294)->where('area', '=', 'Render')->first();
$Render_295 = Ws_Map::select('*')->where('no_seat', 295)->where('area', '=', 'Render')->first();
$Render_296 = Ws_Map::select('*')->where('no_seat', 296)->where('area', '=', 'Render')->first();
$Render_297 = Ws_Map::select('*')->where('no_seat', 297)->where('area', '=', 'Render')->first();
$Render_298 = Ws_Map::select('*')->where('no_seat', 298)->where('area', '=', 'Render')->first();
$Render_299 = Ws_Map::select('*')->where('no_seat', 299)->where('area', '=', 'Render')->first();
$Render_300 = Ws_Map::select('*')->where('no_seat', 300)->where('area', '=', 'Render')->first();
$Render_301 = Ws_Map::select('*')->where('no_seat', 301)->where('area', '=', 'Render')->first();
$Render_302 = Ws_Map::select('*')->where('no_seat', 302)->where('area', '=', 'Render')->first();
$Render_303 = Ws_Map::select('*')->where('no_seat', 303)->where('area', '=', 'Render')->first();
$Render_304 = Ws_Map::select('*')->where('no_seat', 304)->where('area', '=', 'Render')->first();
$Render_305 = Ws_Map::select('*')->where('no_seat', 305)->where('area', '=', 'Render')->first();
$Render_306 = Ws_Map::select('*')->where('no_seat', 306)->where('area', '=', 'Render')->first();
$Render_307 = Ws_Map::select('*')->where('no_seat', 307)->where('area', '=', 'Render')->first();
$Render_308 = Ws_Map::select('*')->where('no_seat', 308)->where('area', '=', 'Render')->first();
$Render_309 = Ws_Map::select('*')->where('no_seat', 309)->where('area', '=', 'Render')->first();
$Render_310 = Ws_Map::select('*')->where('no_seat', 310)->where('area', '=', 'Render')->first();
$Render_311 = Ws_Map::select('*')->where('no_seat', 311)->where('area', '=', 'Render')->first();
$Render_312 = Ws_Map::select('*')->where('no_seat', 312)->where('area', '=', 'Render')->first();
$Render_313 = Ws_Map::select('*')->where('no_seat', 313)->where('area', '=', 'Render')->first();
$Render_314 = Ws_Map::select('*')->where('no_seat', 314)->where('area', '=', 'Render')->first();
$Render_315 = Ws_Map::select('*')->where('no_seat', 315)->where('area', '=', 'Render')->first();
$Render_316 = Ws_Map::select('*')->where('no_seat', 316)->where('area', '=', 'Render')->first();
$Render_317 = Ws_Map::select('*')->where('no_seat', 317)->where('area', '=', 'Render')->first();
$Render_318 = Ws_Map::select('*')->where('no_seat', 318)->where('area', '=', 'Render')->first();
$Render_319 = Ws_Map::select('*')->where('no_seat', 319)->where('area', '=', 'Render')->first();
$Render_320 = Ws_Map::select('*')->where('no_seat', 320)->where('area', '=', 'Render')->first();
$Render_321 = Ws_Map::select('*')->where('no_seat', 321)->where('area', '=', 'Render')->first();
$Render_322 = Ws_Map::select('*')->where('no_seat', 322)->where('area', '=', 'Render')->first();
$Render_323 = Ws_Map::select('*')->where('no_seat', 323)->where('area', '=', 'Render')->first();
$Render_324 = Ws_Map::select('*')->where('no_seat', 324)->where('area', '=', 'Render')->first();
$Render_325 = Ws_Map::select('*')->where('no_seat', 325)->where('area', '=', 'Render')->first();
$Render_326 = Ws_Map::select('*')->where('no_seat', 326)->where('area', '=', 'Render')->first();
$Render_327 = Ws_Map::select('*')->where('no_seat', 327)->where('area', '=', 'Render')->first();
$Render_328 = Ws_Map::select('*')->where('no_seat', 328)->where('area', '=', 'Render')->first();
$Render_329 = Ws_Map::select('*')->where('no_seat', 329)->where('area', '=', 'Render')->first();
$Render_330 = Ws_Map::select('*')->where('no_seat', 330)->where('area', '=', 'Render')->first();
$Render_331 = Ws_Map::select('*')->where('no_seat', 331)->where('area', '=', 'Render')->first();
$Render_332 = Ws_Map::select('*')->where('no_seat', 332)->where('area', '=', 'Render')->first();
$Render_333 = Ws_Map::select('*')->where('no_seat', 333)->where('area', '=', 'Render')->first();
$Render_334 = Ws_Map::select('*')->where('no_seat', 334)->where('area', '=', 'Render')->first();
$Render_335 = Ws_Map::select('*')->where('no_seat', 335)->where('area', '=', 'Render')->first();
$Render_336 = Ws_Map::select('*')->where('no_seat', 336)->where('area', '=', 'Render')->first();
$Render_337 = Ws_Map::select('*')->where('no_seat', 337)->where('area', '=', 'Render')->first();
$Render_338 = Ws_Map::select('*')->where('no_seat', 338)->where('area', '=', 'Render')->first();
$Render_339 = Ws_Map::select('*')->where('no_seat', 339)->where('area', '=', 'Render')->first();
$Render_340 = Ws_Map::select('*')->where('no_seat', 340)->where('area', '=', 'Render')->first();
$Render_341 = Ws_Map::select('*')->where('no_seat', 341)->where('area', '=', 'Render')->first();
$Render_342 = Ws_Map::select('*')->where('no_seat', 342)->where('area', '=', 'Render')->first();
$Render_343 = Ws_Map::select('*')->where('no_seat', 343)->where('area', '=', 'Render')->first();
$Render_344 = Ws_Map::select('*')->where('no_seat', 344)->where('area', '=', 'Render')->first();
$Render_345 = Ws_Map::select('*')->where('no_seat', 345)->where('area', '=', 'Render')->first();
$Render_346 = Ws_Map::select('*')->where('no_seat', 346)->where('area', '=', 'Render')->first();
$Render_347 = Ws_Map::select('*')->where('no_seat', 347)->where('area', '=', 'Render')->first();
$Render_348 = Ws_Map::select('*')->where('no_seat', 348)->where('area', '=', 'Render')->first();
$Render_349 = Ws_Map::select('*')->where('no_seat', 349)->where('area', '=', 'Render')->first();
$Render_350 = Ws_Map::select('*')->where('no_seat', 350)->where('area', '=', 'Render')->first();
$Render_351 = Ws_Map::select('*')->where('no_seat', 351)->where('area', '=', 'Render')->first();
$Render_352 = Ws_Map::select('*')->where('no_seat', 352)->where('area', '=', 'Render')->first();
$Render_353 = Ws_Map::select('*')->where('no_seat', 353)->where('area', '=', 'Render')->first();
$Render_354 = Ws_Map::select('*')->where('no_seat', 354)->where('area', '=', 'Render')->first();
$Render_355 = Ws_Map::select('*')->where('no_seat', 355)->where('area', '=', 'Render')->first();
$Render_356 = Ws_Map::select('*')->where('no_seat', 356)->where('area', '=', 'Render')->first();
$Render_357 = Ws_Map::select('*')->where('no_seat', 357)->where('area', '=', 'Render')->first();
$Render_358 = Ws_Map::select('*')->where('no_seat', 358)->where('area', '=', 'Render')->first();
$Render_359 = Ws_Map::select('*')->where('no_seat', 359)->where('area', '=', 'Render')->first();
$Render_360 = Ws_Map::select('*')->where('no_seat', 360)->where('area', '=', 'Render')->first();
$Render_361 = Ws_Map::select('*')->where('no_seat', 361)->where('area', '=', 'Render')->first();
$Render_362 = Ws_Map::select('*')->where('no_seat', 362)->where('area', '=', 'Render')->first();
$Render_363 = Ws_Map::select('*')->where('no_seat', 363)->where('area', '=', 'Render')->first();
$Render_364 = Ws_Map::select('*')->where('no_seat', 364)->where('area', '=', 'Render')->first();
$Render_365 = Ws_Map::select('*')->where('no_seat', 365)->where('area', '=', 'Render')->first();
$Render_366 = Ws_Map::select('*')->where('no_seat', 366)->where('area', '=', 'Render')->first();
$Render_367 = Ws_Map::select('*')->where('no_seat', 367)->where('area', '=', 'Render')->first();
$Render_368 = Ws_Map::select('*')->where('no_seat', 368)->where('area', '=', 'Render')->first();
$Render_369 = Ws_Map::select('*')->where('no_seat', 369)->where('area', '=', 'Render')->first();
$Render_370 = Ws_Map::select('*')->where('no_seat', 370)->where('area', '=', 'Render')->first();
$Render_371 = Ws_Map::select('*')->where('no_seat', 371)->where('area', '=', 'Render')->first();
$Render_372 = Ws_Map::select('*')->where('no_seat', 372)->where('area', '=', 'Render')->first();
$Render_373 = Ws_Map::select('*')->where('no_seat', 373)->where('area', '=', 'Render')->first();
$Render_374 = Ws_Map::select('*')->where('no_seat', 374)->where('area', '=', 'Render')->first();
$Render_375 = Ws_Map::select('*')->where('no_seat', 375)->where('area', '=', 'Render')->first();
$Render_376 = Ws_Map::select('*')->where('no_seat', 376)->where('area', '=', 'Render')->first();
$Render_377 = Ws_Map::select('*')->where('no_seat', 377)->where('area', '=', 'Render')->first();
$Render_378 = Ws_Map::select('*')->where('no_seat', 378)->where('area', '=', 'Render')->first();
$Render_379 = Ws_Map::select('*')->where('no_seat', 379)->where('area', '=', 'Render')->first();

return view::make(
'IT.WS_MAP.Render.index_render',
[
'animasii' => $animasii,
'Render_254' => $Render_254,
'Render_255' => $Render_255,
'Render_256' => $Render_256,
'Render_257' => $Render_257,
'Render_258' => $Render_258,
'Render_259' => $Render_259,
'Render_260' => $Render_260,
'Render_261' => $Render_261,
'Render_262' => $Render_262,
'Render_263' => $Render_263,
'Render_264' => $Render_264,
'Render_265' => $Render_265,
'Render_266' => $Render_266,
'Render_267' => $Render_267,
'Render_268' => $Render_268,
'Render_269' => $Render_269,
'Render_270' => $Render_270,
'Render_271' => $Render_271,
'Render_272' => $Render_272,
'Render_273' => $Render_273,
'Render_274' => $Render_274,
'Render_275' => $Render_275,
'Render_276' => $Render_276,
'Render_277' => $Render_277,
'Render_278' => $Render_278,
'Render_279' => $Render_279,
'Render_280' => $Render_280,
'Render_281' => $Render_281,
'Render_282' => $Render_282,
'Render_283' => $Render_283,
'Render_284' => $Render_284,
'Render_285' => $Render_285,
'Render_286' => $Render_286,
'Render_287' => $Render_287,
'Render_288' => $Render_288,
'Render_289' => $Render_289,
'Render_290' => $Render_290,
'Render_291' => $Render_291,
'Render_292' => $Render_292,
'Render_293' => $Render_293,
'Render_294' => $Render_294,
'Render_295' => $Render_295,
'Render_296' => $Render_296,
'Render_297' => $Render_297,
'Render_298' => $Render_298,
'Render_299' => $Render_299,
'Render_300' => $Render_300,
'Render_301' => $Render_301,
'Render_302' => $Render_302,
'Render_303' => $Render_303,
'Render_304' => $Render_304,
'Render_305' => $Render_305,
'Render_306' => $Render_306,
'Render_307' => $Render_307,
'Render_308' => $Render_308,
'Render_309' => $Render_309,
'Render_310' => $Render_310,
'Render_311' => $Render_311,
'Render_312' => $Render_312,
'Render_313' => $Render_313,
'Render_314' => $Render_314,
'Render_315' => $Render_315,
'Render_316' => $Render_316,
'Render_317' => $Render_317,
'Render_318' => $Render_318,
'Render_319' => $Render_319,
'Render_320' => $Render_320,
'Render_321' => $Render_321,
'Render_322' => $Render_322,
'Render_323' => $Render_323,
'Render_324' => $Render_324,
'Render_325' => $Render_325,
'Render_326' => $Render_326,
'Render_327' => $Render_327,
'Render_328' => $Render_328,
'Render_329' => $Render_329,
'Render_330' => $Render_330,
'Render_331' => $Render_331,
'Render_332' => $Render_332,
'Render_333' => $Render_333,
'Render_334' => $Render_334,
'Render_335' => $Render_335,
'Render_336' => $Render_336,
'Render_337' => $Render_337,
'Render_338' => $Render_338,
'Render_339' => $Render_339,
'Render_340' => $Render_340,
'Render_341' => $Render_341,
'Render_342' => $Render_342,
'Render_343' => $Render_343,
'Render_344' => $Render_344,
'Render_345' => $Render_345,
'Render_346' => $Render_346,
'Render_347' => $Render_347,
'Render_348' => $Render_348,
'Render_349' => $Render_349,
'Render_350' => $Render_350,
'Render_351' => $Render_351,
'Render_352' => $Render_352,
'Render_353' => $Render_353,
'Render_354' => $Render_354,
'Render_355' => $Render_355,
'Render_356' => $Render_356,
'Render_357' => $Render_357,
'Render_358' => $Render_358,
'Render_359' => $Render_359,
'Render_360' => $Render_360,
'Render_361' => $Render_361,
'Render_362' => $Render_362,
'Render_363' => $Render_363,
'Render_364' => $Render_364,
'Render_365' => $Render_365,
'Render_366' => $Render_366,
'Render_367' => $Render_367,
'Render_368' => $Render_368,
'Render_369' => $Render_369,
'Render_370' => $Render_370,
'Render_371' => $Render_371,
'Render_372' => $Render_372,
'Render_373' => $Render_373,
'Render_374' => $Render_374,
'Render_375' => $Render_375,
'Render_376' => $Render_376,
'Render_377' => $Render_377,
'Render_378' => $Render_378,
'Render_379' => $Render_379,
]
);
}

public function postDataRender(Request $request, $id)
{

$animasi = Ws_Map::where('id', '=', $id)->first();

$AvailabilityMap = ws_Availability::orderBy('hostname', 'asc')->get();

$ws_availability = ws_Availability::where('hostname', '=', $animasi->workstation)->first();

$ws_after = ws_Availability::where('hostname', '=', $animasi->workstation)->first();

$workstation = ws_Availability::select('hostname')->orderBy('hostname', 'asc')->pluck('hostname');

return view::make('IT.WS_MAP.Render.editWSMAP', [
'animasi' => $animasi,
'AvailabilityMap' => $AvailabilityMap,
'ws_availability' => $ws_availability,
'ws_after' => $ws_after,
]);
}

public function postDataRenderLightings(Request $request, $id)
{
$animasi = Ws_Map::where('id', '=', $id)->first();

$AvailabilityMap = ws_Availability::orderBy('hostname', 'asc')->get();

$ws_availability = ws_Availability::where('hostname', '=', $animasi->workstation)->first();

$ws_after = ws_Availability::where('hostname', '=', $animasi->workstation)->first();

$workstation = ws_Availability::select('hostname')->orderBy('hostname', 'asc')->pluck('hostname');

return view::make('IT.WS_MAP.Render.editWSMAP2', [
'animasi' => $animasi,
'AvailabilityMap' => $AvailabilityMap,
'ws_availability' => $ws_availability,
'ws_after' => $ws_after,
]);
}

public function postInputDataRender(Request $request, $id)
{
$animasi = Ws_Map::where('id', '=', $id)->first();
if ($request->input('workstation') != null) {
$ws_availability = ws_Availability::where('hostname', '=', $request->input('workstation'))->first();
}
if ($request->input('secondary_workstation') != null) {
$ws_availability2 = ws_Availability::where('hostname', '=', $request->input('secondary_workstation'))->first();
}

$rules = [
'no_seat' => 'required',
'area' => 'required',
];

if ($request->input('secondary_workstation') === null and $request->input('workstation') === null) {
$data = [
'user' => $request->input('username'),
'workstation' => $request->input('workstation'),
'workstation1_id' => null,
'secondary_workstation' => $request->input('secondary_workstation'),
'workstation2_id' => null,
'monitor1' => $request->input('monitor1'),
'monitor2' => $request->input('monitor2'),
'wacom' => $request->input('wacom'),
'no_seat' => $request->input('no_seat'),
'area' => $request->input('area'),
'updated_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
];
} elseif ($request->input('secondary_workstation') === null and $request->input('workstation') != null) {
$findmainsecondws = null;
$findmainws = db::table('asseting_barcode')->select('*')->where('addtional', 'like', '%' .
$request->input('workstation') . '%')->first();

if ($findmainws != null) {
$barcode = $findmainws->instansi_id . $findmainws->barcode_id . $findmainws->id;
} else {
$barcode = null;
}

$data = [
'user' => $request->input('username'),
'workstation' => $request->input('workstation'),
'workstation1_id' => $barcode,
'secondary_workstation' => $request->input('secondary_workstation'),
'workstation2_id' => $findmainsecondws,
'monitor1' => $request->input('monitor1'),
'monitor2' => $request->input('monitor2'),
'wacom' => $request->input('wacom'),
'no_seat' => $request->input('no_seat'),
'area' => $request->input('area'),
'updated_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
];
} elseif ($request->input('secondary_workstation') != null and $request->input('workstation') === null) {
$findmainws = null;
$findmainsecondws = db::table('asseting_barcode')->select('*')->where('addtional', 'like', '%' .
$request->input('secondary_workstation') . '%')->first();

if ($findmainsecondws != null) {
$barcode = $findmainsecondws->instansi_id . $findmainsecondws->barcode_id . $findmainsecondws->id;
} else {
$barcode = null;
}
$data = [
'user' => $request->input('username'),
'workstation' => $request->input('workstation'),
'workstation1_id' => $findmainws,
'secondary_workstation' => $request->input('secondary_workstation'),
'workstation2_id' => $findmainsecondws->instansi_id . $findmainsecondws->barcode_id . $findmainsecondws->id,
'monitor1' => $request->input('monitor1'),
'monitor2' => $request->input('monitor2'),
'no_seat' => $request->input('no_seat'),
'wacom' => $request->input('wacom'),
'area' => $request->input('area'),
'updated_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
];
} elseif ($request->input('secondary_workstation') != null and $request->input('workstation') != null) {
$findmainsecondws = db::table('asseting_barcode')->select('*')->where('addtional', 'like', '%' .
$request->input('secondary_workstation') . '%')->first();
$findmainws = db::table('asseting_barcode')->select('*')->where('addtional', 'like', '%' .
$request->input('workstation') . '%')->first();

if ($findmainsecondws != null) {
$barcodews = $findmainsecondws->instansi_id . $findmainsecondws->barcode_id . $findmainsecondws->id;
} else {
$barcodews = null;
}


if ($findmainws != null) {
$barcode = $findmainws->instansi_id . $findmainws->barcode_id . $findmainws->id;
} else {
$barcode = null;
}

$data = [
'user' => $request->input('username'),
'workstation' => $request->input('workstation'),
'workstation1_id' => $barcode,
'secondary_workstation' => $request->input('secondary_workstation'),
'workstation2_id' => $barcodews,
'monitor1' => $request->input('monitor1'),
'monitor2' => $request->input('monitor2'),
'wacom' => strtoupper($request->input('wacom')),
'no_seat' => $request->input('no_seat'),
'area' => $request->input('area'),
'updated_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
];
}

if ($request->input('workstation') != null) {
$data2 = [
'hostname' => $request->input('workstation'),
'type' => $ws_availability->type,
'user' => $request->input('username'),
'os' => $ws_availability->os,
'Memory' => $ws_availability->memory,
'vga' => $ws_availability->vga,
'location' => $request->input('area'),
'notes' => $ws_availability->notes,
];
}

if ($request->input('secondary_workstation') != null) {
$data3 = [
'hostname' => $request->input('secondary_workstation'),
'type' => $ws_availability2->type,
'user' => $request->input('username'),
'os' => $ws_availability2->os,
'Memory' => $ws_availability2->memory,
'vga' => $ws_availability2->vga,
'location' => $request->input('area'),
'notes' => $ws_availability2->notes,
];
}

$validator = Validator::make($request->all(), $rules);

if ($validator->fails()) {
Session::flash('message', Lang::get('messages.data_error', ['data' => 'Sorry, Data']));
return Redirect::route('postDataLayout', [$id])
->withErrors($validator)
->withInput();
} else {
if ($request->input('workstation') != null) {
db::table('ws_Availability')->where('hostname', '=', $ws_availability->hostname)->update($data2);
db::table('log_ws_Availability')->insert($data2);
}
if ($request->input('secondary_workstation') != null) {
db::table('ws_Availability')->where('hostname', '=', $ws_availability2->hostname)->update($data3);
db::table('log_ws_Availability')->insert($data3);
}
db::table('ws_map')->where('id', '=', $id)->update($data);
Session::flash('message', Lang::get('messages.data_map_updated', ['data' => 'Data Map']));
return Redirect::route('indexRender');
}
}

public function loadHTMLRender()
{
$Render_254 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 254)->where('area', '=', 'Render')->first();
$Render_255 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 255)->where('area', '=', 'Render')->first();
$Render_256 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 256)->where('area', '=', 'Render')->first();
$Render_257 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 257)->where('area', '=', 'Render')->first();
$Render_258 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 258)->where('area', '=', 'Render')->first();
$Render_259 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 259)->where('area', '=', 'Render')->first();
$Render_260 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 260)->where('area', '=', 'Render')->first();
$Render_261 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 261)->where('area', '=', 'Render')->first();
$Render_262 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 262)->where('area', '=', 'Render')->first();
$Render_263 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 263)->where('area', '=', 'Render')->first();
$Render_264 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 264)->where('area', '=', 'Render')->first();
$Render_265 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 265)->where('area', '=', 'Render')->first();
$Render_266 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 266)->where('area', '=', 'Render')->first();
$Render_267 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 267)->where('area', '=', 'Render')->first();
$Render_268 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 268)->where('area', '=', 'Render')->first();
$Render_269 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 269)->where('area', '=', 'Render')->first();
$Render_270 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 270)->where('area', '=', 'Render')->first();
$Render_271 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 271)->where('area', '=', 'Render')->first();
$Render_272 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 272)->where('area', '=', 'Render')->first();
$Render_273 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 273)->where('area', '=', 'Render')->first();
$Render_274 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 274)->where('area', '=', 'Render')->first();
$Render_275 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 275)->where('area', '=', 'Render')->first();
$Render_276 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 276)->where('area', '=', 'Render')->first();
$Render_277 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 277)->where('area', '=', 'Render')->first();
$Render_278 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 278)->where('area', '=', 'Render')->first();
$Render_279 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 279)->where('area', '=', 'Render')->first();
$Render_280 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 280)->where('area', '=', 'Render')->first();
$Render_281 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 281)->where('area', '=', 'Render')->first();
$Render_282 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 282)->where('area', '=', 'Render')->first();
$Render_283 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 283)->where('area', '=', 'Render')->first();
$Render_284 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 284)->where('area', '=', 'Render')->first();
$Render_285 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 285)->where('area', '=', 'Render')->first();
$Render_286 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 286)->where('area', '=', 'Render')->first();
$Render_287 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 287)->where('area', '=', 'Render')->first();
$Render_288 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 288)->where('area', '=', 'Render')->first();
$Render_289 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 289)->where('area', '=', 'Render')->first();
$Render_290 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 290)->where('area', '=', 'Render')->first();
$Render_291 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 291)->where('area', '=', 'Render')->first();
$Render_292 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 292)->where('area', '=', 'Render')->first();
$Render_293 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 293)->where('area', '=', 'Render')->first();
$Render_294 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 294)->where('area', '=', 'Render')->first();
$Render_295 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 295)->where('area', '=', 'Render')->first();
$Render_296 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 296)->where('area', '=', 'Render')->first();
$Render_297 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 297)->where('area', '=', 'Render')->first();
$Render_298 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 298)->where('area', '=', 'Render')->first();
$Render_299 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 299)->where('area', '=', 'Render')->first();
$Render_300 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 300)->where('area', '=', 'Render')->first();
$Render_301 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 301)->where('area', '=', 'Render')->first();
$Render_302 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 302)->where('area', '=', 'Render')->first();
$Render_303 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 303)->where('area', '=', 'Render')->first();
$Render_304 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 304)->where('area', '=', 'Render')->first();
$Render_305 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 305)->where('area', '=', 'Render')->first();
$Render_306 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 306)->where('area', '=', 'Render')->first();
$Render_307 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 307)->where('area', '=', 'Render')->first();
$Render_308 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 308)->where('area', '=', 'Render')->first();
$Render_309 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 309)->where('area', '=', 'Render')->first();
$Render_310 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 310)->where('area', '=', 'Render')->first();
$Render_311 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 311)->where('area', '=', 'Render')->first();
$Render_312 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 312)->where('area', '=', 'Render')->first();
$Render_313 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 313)->where('area', '=', 'Render')->first();
$Render_314 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 314)->where('area', '=', 'Render')->first();
$Render_315 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 315)->where('area', '=', 'Render')->first();
$Render_316 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 316)->where('area', '=', 'Render')->first();
$Render_317 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 317)->where('area', '=', 'Render')->first();
$Render_318 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 318)->where('area', '=', 'Render')->first();
$Render_319 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 319)->where('area', '=', 'Render')->first();
$Render_320 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 320)->where('area', '=', 'Render')->first();
$Render_321 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 321)->where('area', '=', 'Render')->first();
$Render_322 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 322)->where('area', '=', 'Render')->first();
$Render_323 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 323)->where('area', '=', 'Render')->first();
$Render_324 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 324)->where('area', '=', 'Render')->first();
$Render_325 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 325)->where('area', '=', 'Render')->first();
$Render_326 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 326)->where('area', '=', 'Render')->first();
$Render_327 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 327)->where('area', '=', 'Render')->first();
$Render_328 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 328)->where('area', '=', 'Render')->first();
$Render_329 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 329)->where('area', '=', 'Render')->first();
$Render_330 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 330)->where('area', '=', 'Render')->first();
$Render_331 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 331)->where('area', '=', 'Render')->first();
$Render_332 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 332)->where('area', '=', 'Render')->first();
$Render_333 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 333)->where('area', '=', 'Render')->first();
$Render_334 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 334)->where('area', '=', 'Render')->first();
$Render_335 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 335)->where('area', '=', 'Render')->first();
$Render_336 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 336)->where('area', '=', 'Render')->first();
$Render_337 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 337)->where('area', '=', 'Render')->first();
$Render_338 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 338)->where('area', '=', 'Render')->first();
$Render_339 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 339)->where('area', '=', 'Render')->first();
$Render_340 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 340)->where('area', '=', 'Render')->first();
$Render_341 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 341)->where('area', '=', 'Render')->first();
$Render_342 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 342)->where('area', '=', 'Render')->first();
$Render_343 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 343)->where('area', '=', 'Render')->first();
$Render_344 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 344)->where('area', '=', 'Render')->first();
$Render_345 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 345)->where('area', '=', 'Render')->first();
$Render_346 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 346)->where('area', '=', 'Render')->first();
$Render_347 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 347)->where('area', '=', 'Render')->first();
$Render_348 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 348)->where('area', '=', 'Render')->first();
$Render_349 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 349)->where('area', '=', 'Render')->first();
$Render_350 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 350)->where('area', '=', 'Render')->first();
$Render_351 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 351)->where('area', '=', 'Render')->first();
$Render_352 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 352)->where('area', '=', 'Render')->first();
$Render_353 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 353)->where('area', '=', 'Render')->first();
$Render_354 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 354)->where('area', '=', 'Render')->first();
$Render_355 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 355)->where('area', '=', 'Render')->first();
$Render_356 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 356)->where('area', '=', 'Render')->first();
$Render_357 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 357)->where('area', '=', 'Render')->first();
$Render_358 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 358)->where('area', '=', 'Render')->first();
$Render_359 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 359)->where('area', '=', 'Render')->first();
$Render_360 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 360)->where('area', '=', 'Render')->first();
$Render_361 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 361)->where('area', '=', 'Render')->first();
$Render_362 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 362)->where('area', '=', 'Render')->first();
$Render_363 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 363)->where('area', '=', 'Render')->first();
$Render_364 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 364)->where('area', '=', 'Render')->first();
$Render_365 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 365)->where('area', '=', 'Render')->first();
$Render_366 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 366)->where('area', '=', 'Render')->first();
$Render_367 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 367)->where('area', '=', 'Render')->first();
$Render_368 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 368)->where('area', '=', 'Render')->first();
$Render_369 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 369)->where('area', '=', 'Render')->first();
$Render_370 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 370)->where('area', '=', 'Render')->first();
$Render_371 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 371)->where('area', '=', 'Render')->first();
$Render_372 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 372)->where('area', '=', 'Render')->first();
$Render_373 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 373)->where('area', '=', 'Render')->first();
$Render_374 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 374)->where('area', '=', 'Render')->first();
$Render_375 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 375)->where('area', '=', 'Render')->first();
$Render_376 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 376)->where('area', '=', 'Render')->first();
$Render_377 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 377)->where('area', '=', 'Render')->first();
$Render_378 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 378)->where('area', '=', 'Render')->first();
$Render_379 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 379)->where('area', '=', 'Render')->first();
$total_seat = Ws_Map::where('area', '=', 'Render')->count();
$pdf = App::make('dompdf.wrapper');
ini_set("memory_limit", '512M');
$customPaper = array(0, 0, 1200, 1000);
$pdf->loadview('IT.WS_MAP.Render.print', [
'total_seat' => $total_seat,
'Render_254' => $Render_254,
'Render_255' => $Render_255,
'Render_256' => $Render_256,
'Render_257' => $Render_257,
'Render_258' => $Render_258,
'Render_259' => $Render_259,
'Render_260' => $Render_260,
'Render_261' => $Render_261,
'Render_262' => $Render_262,
'Render_263' => $Render_263,
'Render_264' => $Render_264,
'Render_265' => $Render_265,
'Render_266' => $Render_266,
'Render_267' => $Render_267,
'Render_268' => $Render_268,
'Render_269' => $Render_269,
'Render_270' => $Render_270,
'Render_271' => $Render_271,
'Render_272' => $Render_272,
'Render_273' => $Render_273,
'Render_274' => $Render_274,
'Render_275' => $Render_275,
'Render_276' => $Render_276,
'Render_277' => $Render_277,
'Render_278' => $Render_278,
'Render_279' => $Render_279,
'Render_280' => $Render_280,
'Render_281' => $Render_281,
'Render_282' => $Render_282,
'Render_283' => $Render_283,
'Render_284' => $Render_284,
'Render_285' => $Render_285,
'Render_286' => $Render_286,
'Render_287' => $Render_287,
'Render_288' => $Render_288,
'Render_289' => $Render_289,
'Render_290' => $Render_290,
'Render_291' => $Render_291,
'Render_292' => $Render_292,
'Render_293' => $Render_293,
'Render_294' => $Render_294,
'Render_295' => $Render_295,
'Render_296' => $Render_296,
'Render_297' => $Render_297,
'Render_298' => $Render_298,
'Render_299' => $Render_299,
'Render_300' => $Render_300,
'Render_301' => $Render_301,
'Render_302' => $Render_302,
'Render_303' => $Render_303,
'Render_304' => $Render_304,
'Render_305' => $Render_305,
'Render_306' => $Render_306,
'Render_307' => $Render_307,
'Render_308' => $Render_308,
'Render_309' => $Render_309,
'Render_310' => $Render_310,
'Render_311' => $Render_311,
'Render_312' => $Render_312,
'Render_313' => $Render_313,
'Render_314' => $Render_314,
'Render_315' => $Render_315,
'Render_316' => $Render_316,
'Render_317' => $Render_317,
'Render_318' => $Render_318,
'Render_319' => $Render_319,
'Render_320' => $Render_320,
'Render_321' => $Render_321,
'Render_322' => $Render_322,
'Render_323' => $Render_323,
'Render_324' => $Render_324,
'Render_325' => $Render_325,
'Render_326' => $Render_326,
'Render_327' => $Render_327,
'Render_328' => $Render_328,
'Render_329' => $Render_329,
'Render_330' => $Render_330,
'Render_331' => $Render_331,
'Render_332' => $Render_332,
'Render_333' => $Render_333,
'Render_334' => $Render_334,
'Render_335' => $Render_335,
'Render_336' => $Render_336,
'Render_337' => $Render_337,
'Render_338' => $Render_338,
'Render_339' => $Render_339,
'Render_340' => $Render_340,
'Render_341' => $Render_341,
'Render_342' => $Render_342,
'Render_343' => $Render_343,
'Render_344' => $Render_344,
'Render_345' => $Render_345,
'Render_346' => $Render_346,
'Render_347' => $Render_347,
'Render_348' => $Render_348,
'Render_349' => $Render_349,
'Render_350' => $Render_350,
'Render_351' => $Render_351,
'Render_352' => $Render_352,
'Render_353' => $Render_353,
'Render_354' => $Render_354,
'Render_355' => $Render_355,
'Render_356' => $Render_356,
'Render_357' => $Render_357,
'Render_358' => $Render_358,
'Render_359' => $Render_359,
'Render_360' => $Render_360,
'Render_361' => $Render_361,
'Render_362' => $Render_362,
'Render_363' => $Render_363,
'Render_364' => $Render_364,
'Render_365' => $Render_365,
'Render_366' => $Render_366,
'Render_367' => $Render_367,
'Render_368' => $Render_368,
'Render_369' => $Render_369,
'Render_370' => $Render_370,
'Render_371' => $Render_371,
'Render_372' => $Render_372,
'Render_373' => $Render_373,
'Render_374' => $Render_374,
'Render_375' => $Render_375,
'Render_376' => $Render_376,
'Render_377' => $Render_377,
'Render_378' => $Render_378,
'Render_379' => $Render_379,
])
->setPaper('A3', 'potrait')
->setOptions(['dpi' => 230, 'defaultFont' => 'sans-serif']);
return $pdf->stream();
}


public function indexMAPOfficer()
{
$animasii = WS_MAP::where('area', 'Officer')->get();

$Officer_380 = Ws_Map::select('*')->where('no_seat', 380)->where('area', '=', 'Officer')->first();
$Officer_381 = Ws_Map::select('*')->where('no_seat', 381)->where('area', '=', 'Officer')->first();
$Officer_382 = Ws_Map::select('*')->where('no_seat', 382)->where('area', '=', 'Officer')->first();
$Officer_383 = Ws_Map::select('*')->where('no_seat', 383)->where('area', '=', 'Officer')->first();
$Officer_384 = Ws_Map::select('*')->where('no_seat', 384)->where('area', '=', 'Officer')->first();
$Officer_385 = Ws_Map::select('*')->where('no_seat', 385)->where('area', '=', 'Officer')->first();
$Officer_386 = Ws_Map::select('*')->where('no_seat', 386)->where('area', '=', 'Officer')->first();
$Officer_387 = Ws_Map::select('*')->where('no_seat', 387)->where('area', '=', 'Officer')->first();
$Officer_388 = Ws_Map::select('*')->where('no_seat', 388)->where('area', '=', 'Officer')->first();
$Officer_389 = Ws_Map::select('*')->where('no_seat', 389)->where('area', '=', 'Officer')->first();
$Officer_390 = Ws_Map::select('*')->where('no_seat', 390)->where('area', '=', 'Officer')->first();
$Officer_391 = Ws_Map::select('*')->where('no_seat', 391)->where('area', '=', 'Officer')->first();
$Officer_392 = Ws_Map::select('*')->where('no_seat', 392)->where('area', '=', 'Officer')->first();
$Officer_393 = Ws_Map::select('*')->where('no_seat', 393)->where('area', '=', 'Officer')->first();
$Officer_394 = Ws_Map::select('*')->where('no_seat', 394)->where('area', '=', 'Officer')->first();
$Officer_395 = Ws_Map::select('*')->where('no_seat', 395)->where('area', '=', 'Officer')->first();

$mobile_24 = Asseting_IT::select('*')->where('ifw_code', 'like', '%' . $Officer_380->workstation . '%')->first();

return View::make('IT.WS_MAP.Officer.index_officer', [
'animasii' => $animasii,
'Officer_380' => $Officer_380,
'Officer_381' => $Officer_381,
'Officer_382' => $Officer_382,
'Officer_383' => $Officer_383,
'Officer_384' => $Officer_384,
'Officer_385' => $Officer_385,
'Officer_386' => $Officer_386,
'Officer_387' => $Officer_387,
'Officer_388' => $Officer_388,
'Officer_389' => $Officer_389,
'Officer_390' => $Officer_390,
'Officer_391' => $Officer_391,
'Officer_392' => $Officer_392,
'Officer_393' => $Officer_393,
'Officer_394' => $Officer_394,
'Officer_395' => $Officer_395,
'mobile_24' => $mobile_24,
]);
}

public function loadHTMLOfficer()
{
$Officer_380 = Ws_Map::select('*')->where('no_seat', 380)->where('area', '=', 'Officer')->first();
$Officer_381 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 381)->where(
'area',
'=',
'Officer'
)->first();
$Officer_382 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 382)->where(
'area',
'=',
'Officer'
)->first();
$Officer_383 = Ws_Map::select('*')->where('no_seat', 383)->where('area', '=', 'Officer')->first();
$Officer_384 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 384)->where(
'area',
'=',
'Officer'
)->first();
$Officer_385 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 385)->where(
'area',
'=',
'Officer'
)->first();
$Officer_386 = Ws_Map::select('*')->where('no_seat', 386)->where('area', '=', 'Officer')->first();
$Officer_387 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 387)->where(
'area',
'=',
'Officer'
)->first();
$Officer_388 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 388)->where(
'area',
'=',
'Officer'
)->first();
$Officer_389 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 389)->where(
'area',
'=',
'Officer'
)->first();
$Officer_390 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 390)->where(
'area',
'=',
'Officer'
)->first();
$Officer_391 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 391)->where(
'area',
'=',
'Officer'
)->first();
$Officer_392 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 392)->where(
'area',
'=',
'Officer'
)->first();
$Officer_393 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 393)->where(
'area',
'=',
'Officer'
)->first();
$Officer_394 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 394)->where(
'area',
'=',
'Officer'
)->first();
$Officer_395 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 395)->where(
'area',
'=',
'Officer'
)->first();

$pdf = App::make('dompdf.wrapper');
ini_set("memory_limit", '512M');
$pdf->loadview('IT.WS_MAP.Officer.print', [
'Officer_380' => $Officer_380,
'Officer_381' => $Officer_381,
'Officer_382' => $Officer_382,
'Officer_383' => $Officer_383,
'Officer_384' => $Officer_384,
'Officer_385' => $Officer_385,
'Officer_386' => $Officer_386,
'Officer_387' => $Officer_387,
'Officer_388' => $Officer_388,
'Officer_389' => $Officer_389,
'Officer_390' => $Officer_390,
'Officer_391' => $Officer_391,
'Officer_392' => $Officer_392,
'Officer_393' => $Officer_393,
'Officer_394' => $Officer_394,
'Officer_395' => $Officer_395,
])
->setPaper('A3', 'landscape')
->setOptions(['dpi' => 140, 'defaultFont' => 'sans-serif']);
return $pdf->stream();
}

public function postDataOfficerMap(Request $request, $id)
{

$animasi = Ws_Map::where('id', '=', $id)->first();

$AvailabilityMap = ws_Availability::orderBy('hostname', 'asc')->get();
$laptop_availability = db::table('laptop_availability')->orderBy('hostname_laptop', 'asc')->get();
$ws_availability = ws_Availability::where('hostname', '=', $animasi->workstation)->first();

$ws_after = ws_Availability::where('hostname', '=', $animasi->workstation)->first();

$workstation = ws_Availability::select('hostname')->orderBy('hostname', 'asc')->pluck('hostname');



return view::make('IT.WS_MAP.Officer.editWSMAP', [
'animasi' => $animasi,
'AvailabilityMap' => $AvailabilityMap,
'laptop_availability' => $laptop_availability,
'ws_availability' => $ws_availability,
'ws_after' => $ws_after,
]);
}

public function postInputDataOfficerMap(Request $request, $id)
{
$animasi = Ws_Map::where('id', '=', $id)->first();

if ($request->input('workstation') != null) {
$ws_availability = ws_Availability::where('hostname', '=', $request->input('workstation'))->first();
}
if ($request->input('secondary_workstation') != null) {
$ws_availability2 = ws_Availability::where('hostname', '=', $request->input('secondary_workstation'))->first();
}

$rules = [
'no_seat' => 'required',
'area' => 'required',
];

if ($request->input('secondary_workstation') === null and $request->input('workstation') === null) {
$data = [
'user' => $request->input('username'),
'workstation' => $request->input('workstation'),
'workstation1_id' => null,
'secondary_workstation' => $request->input('secondary_workstation'),
'workstation2_id' => null,
'monitor1' => $request->input('monitor1'),
'monitor2' => $request->input('monitor2'),
'wacom' => $request->input('wacom'),
'no_seat' => $request->input('no_seat'),
'area' => $request->input('area'),
'updated_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
];
} elseif ($request->input('secondary_workstation') === null and $request->input('workstation') != null) {
$findmainsecondws = null;
$findmainws = db::table('asseting_barcode')->select('*')->where('addtional', 'like', '%' .
$request->input('workstation') . '%')->first();

if ($findmainws != null) {
$barcode = $findmainws->instansi_id . $findmainws->barcode_id . $findmainws->id;
} else {
$barcode = null;
}

$data = [
'user' => $request->input('username'),
'workstation' => $request->input('workstation'),
'workstation1_id' => $barcode,
'secondary_workstation' => $request->input('secondary_workstation'),
'workstation2_id' => $findmainsecondws,
'monitor1' => $request->input('monitor1'),
'monitor2' => $request->input('monitor2'),
'wacom' => $request->input('wacom'),
'no_seat' => $request->input('no_seat'),
'area' => $request->input('area'),
'updated_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
];
} elseif ($request->input('secondary_workstation') != null and $request->input('workstation') === null) {
$findmainws = null;
$findmainsecondws = db::table('asseting_barcode')->select('*')->where('addtional', 'like', '%' .
$request->input('secondary_workstation') . '%')->first();

if ($findmainsecondws != null) {
$barcode = $findmainsecondws->instansi_id . $findmainsecondws->barcode_id . $findmainsecondws->id;
} else {
$barcode = null;
}
$data = [
'user' => $request->input('username'),
'workstation' => $request->input('workstation'),
'workstation1_id' => $findmainws,
'secondary_workstation' => $request->input('secondary_workstation'),
'workstation2_id' => $findmainsecondws->instansi_id . $findmainsecondws->barcode_id . $findmainsecondws->id,
'monitor1' => $request->input('monitor1'),
'monitor2' => $request->input('monitor2'),
'no_seat' => $request->input('no_seat'),
'wacom' => $request->input('wacom'),
'area' => $request->input('area'),
'updated_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
];
} elseif ($request->input('secondary_workstation') != null and $request->input('workstation') != null) {
$findmainsecondws = db::table('asseting_barcode')->select('*')->where('addtional', 'like', '%' .
$request->input('secondary_workstation') . '%')->first();
$findmainws = db::table('asseting_barcode')->select('*')->where('addtional', 'like', '%' .
$request->input('workstation') . '%')->first();

if ($findmainsecondws != null) {
$barcodews = $findmainsecondws->instansi_id . $findmainsecondws->barcode_id . $findmainsecondws->id;
} else {
$barcodews = null;
}


if ($findmainws != null) {
$barcode = $findmainws->instansi_id . $findmainws->barcode_id . $findmainws->id;
} else {
$barcode = null;
}

$data = [
'user' => $request->input('username'),
'workstation' => $request->input('workstation'),
'workstation1_id' => $barcode,
'secondary_workstation' => $request->input('secondary_workstation'),
'workstation2_id' => $barcodews,
'monitor1' => $request->input('monitor1'),
'monitor2' => $request->input('monitor2'),
'wacom' => strtoupper($request->input('wacom')),
'no_seat' => $request->input('no_seat'),
'area' => $request->input('area'),
'updated_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
];
}

if ($request->input('workstation') != null) {
$data2 = [
'hostname' => $request->input('workstation'),
'type' => $ws_availability->type,
'user' => $request->input('username'),
'os' => $ws_availability->os,
'Memory' => $ws_availability->memory,
'vga' => $ws_availability->vga,
'location' => $request->input('area'),
'notes' => $ws_availability->notes,
];
}

if ($request->input('secondary_workstation') != null) {
$data3 = [
'hostname' => $request->input('secondary_workstation'),
'type' => $ws_availability2->type,
'user' => $request->input('username'),
'os' => $ws_availability2->os,
'Memory' => $ws_availability2->memory,
'vga' => $ws_availability2->vga,
'location' => $request->input('area'),
'notes' => $ws_availability2->notes,
];
}

$validator = Validator::make($request->all(), $rules);

if ($validator->fails()) {
Session::flash('message', Lang::get('messages.data_error', ['data' => 'Sorry, Data']));
return Redirect::route('postDataOfficerMap', [$id])
->withErrors($validator)
->withInput();
} else {
if ($request->input('workstation') != null) {
db::table('ws_Availability')->where('hostname', '=', $ws_availability->hostname)->update($data2);
db::table('log_ws_Availability')->insert($data2);
}
if ($request->input('secondary_workstation') != null) {
db::table('ws_Availability')->where('hostname', '=', $ws_availability2->hostname)->update($data3);
db::table('log_ws_Availability')->insert($data3);
}
db::table('ws_map')->where('id', '=', $id)->update($data);
Session::flash('message', Lang::get('messages.data_map_updated', ['data' => 'Data Map']));
return Redirect::route('indexMAPOfficer');
}
}

public function postDataOfficerMobileMap(Request $request, $id)
{

$animasi = Ws_Map::where('id', '=', $id)->first();

$AvailabilityMap = ws_Availability::orderBy('hostname', 'asc')->get();

$laptop_availability = db::table('laptop_availability')->orderBy('hostname_laptop', 'asc')->get();

$ws_availability = ws_Availability::where('hostname', '=', $animasi->workstation)->first();

$ws_after = ws_Availability::where('hostname', '=', $animasi->workstation)->first();

$workstation = ws_Availability::select('hostname')->orderBy('hostname', 'asc')->pluck('hostname');

return view::make('IT.WS_MAP.Officer.editMobileMAP', [
'animasi' => $animasi,
'AvailabilityMap' => $AvailabilityMap,
'laptop_availability' => $laptop_availability,
'ws_availability' => $ws_availability,
'ws_after' => $ws_after,
]);
}

public function postInputDataOfficerMobileMap(Request $request, $id)
{
$animasi = Ws_Map::where('id', '=', $id)->first();

$role = $request->input('secondary_workstation');
$role1 = $request->input('workstation');

if ($role1 != Null) {
$findmainws = db::table('asseting_barcode')->when($role1, function ($query) use ($role1) {
return $query->where('ifw_code', 'like', '%' . $role1 . '%')->orWhere('addtional', 'like', '%' . $role1 . '%');
})->first();
} else {
$findmainws = null;
}

if ($role != Null) {
$findmainsecondws = db::table('asseting_barcode')->when($role, function ($query) use ($role) {
return $query->where('ifw_code', 'like', '%' . $role . '%')->orWhere('addtional', 'like', '%' . $role . '%');
})->first();
} else {
$findmainsecondws = null;
}

if ($findmainsecondws != null) {
$barcodews = $findmainsecondws->instansi_id . $findmainsecondws->barcode_id . $findmainsecondws->id;
} else {
$barcodews = null;
}


if ($findmainws != null) {
$barcode = $findmainws->instansi_id . $findmainws->barcode_id . $findmainws->id;
} else {
$barcode = null;
}

$rules = [
'no_seat' => 'required',
'area' => 'required',
];


$data = [
'user' => $request->input('username'),
'workstation' => $request->input('workstation'),
'secondary_workstation' => $request->input('secondary_workstation'),
'workstation1_id' => $barcode,
'workstation2_id' => $barcodews,
'no_seat' => $request->input('no_seat'),
'area' => $request->input('area'),
'updated_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
];

$data2 = [
'users_laptop' => $request->input('username'),
'location_laptop' => $request->input('area'),
'updated_by' => auth::user()->first_name . ' ' . auth::user()->last_name,

];

$data3 = [
'users_laptop' => Null,
'location_laptop' => 'IT Room',
'updated_by' => auth::user()->first_name . ' ' . auth::user()->last_name,
];

$validator = Validator::make($request->all(), $rules);

if ($validator->fails()) {
Session::flash('message', Lang::get('messages.data_error', ['data' => 'Sorry, Data']));
return Redirect::route('postDataOfficerMap', [$id])
->withErrors($validator)
->withInput();
} else {
db::table('ws_map')->where('id', '=', $id)->update($data);
db::table('laptop_availability')->where('hostname_laptop', '=', $request->input('workstation'))->update($data2);
db::table('laptop_availability')->where('hostname_laptop', '=', $animasi->workstation)->update($data3);
Session::flash('message', Lang::get('messages.data_map_updated', ['data' => 'Data Map']));
return Redirect::route('indexMAPOfficer');
}
}

public function tes()
{
$getmonitor = db::table('asseting_barcode')->select('*')->where('category_name', '=', 5)->orderBy('id', 'asc')->get();


foreach ($getmonitor as $key) {
$value = str_after($key->addtional, 'IFWCode : ');
$limit = str_limit($value, 4);
$data = [
'ifw_code' => $key->addtional,
];

db::table('asseting_barcode')->where('category_name', '=', 5)->where('id', '=', $key->id)->update($data);
}
return Redirect::back();
}

public function loadHTMLITRoom()
{
$IT_396 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 396)->where('area', '=', 'IT Room')->first();
$IT_397 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 397)->where('area', '=', 'IT Room')->first();
$IT_398 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 398)->where('area', '=', 'IT Room')->first();
$IT_399 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 399)->where('area', '=', 'IT Room')->first();
$IT_400 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 400)->where('area', '=', 'IT Room')->first();
$IT_401 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 401)->where('area', '=', 'IT Room')->first();
$IT_402 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 402)->where('area', '=', 'IT Room')->first();
$IT_403 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 403)->where('area', '=', 'IT Room')->first();
$IT_404 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 404)->where('area', '=', 'IT Room')->first();
$IT_405 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 405)->where('area', '=', 'IT Room')->first();
$IT_406 = Ws_Map::select('*')->where('no_seat', 406)->where('area', '=', 'IT Room')->first();
$IT_407 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 407)->where('area', '=', 'IT Room')->first();
$IT_408 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 408)->where('area', '=', 'IT Room')->first();
$IT_409 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 409)->where('area', '=', 'IT Room')->first();
$IT_410 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 410)->where('area', '=', 'IT Room')->first();
$IT_411 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 411)->where('area', '=', 'IT Room')->first();
$IT_412 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 412)->where('area', '=', 'IT Room')->first();
$IT_413 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 413)->where('area', '=', 'IT Room')->first();
$IT_414 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 414)->where('area', '=', 'IT Room')->first();
$IT_415 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 415)->where('area', '=', 'IT Room')->first();
$IT_416 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 416)->where('area', '=', 'IT Room')->first();
$IT_417 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 417)->where('area', '=', 'IT Room')->first();
$IT_418 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 418)->where('area', '=', 'IT Room')->first();
$IT_419 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 419)->where('area', '=', 'IT Room')->first();
$IT_420 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 420)->where('area', '=', 'IT Room')->first();
$IT_421 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 421)->where('area', '=', 'IT Room')->first();
$IT_422 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 422)->where('area', '=', 'IT Room')->first();
$IT_423 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 423)->where('area', '=', 'IT Room')->first();
$IT_424 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 424)->where('area', '=', 'IT Room')->first();
$IT_425 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 425)->where('area', '=', 'IT Room')->first();
$IT_426 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 426)->where('area', '=', 'IT Room')->first();
$IT_427 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 427)->where('area', '=', 'IT Room')->first();
$IT_428 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 428)->where('area', '=', 'IT Room')->first();
$IT_429 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 429)->where('area', '=', 'IT Room')->first();
$IT_430 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 430)->where('area', '=', 'IT Room')->first();
$IT_431 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 431)->where('area', '=', 'IT Room')->first();
$IT_432 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 432)->where('area', '=', 'IT Room')->first();
$IT_433 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 433)->where('area', '=', 'IT Room')->first();
$IT_434 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 434)->where('area', '=', 'IT Room')->first();
$IT_435 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 435)->where('area', '=', 'IT Room')->first();
$IT_436 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 436)->where('area', '=', 'IT Room')->first();
$IT_437 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 437)->where('area', '=', 'IT Room')->first();

$pdf = App::make('dompdf.wrapper');
ini_set("memory_limit", '512M');
$pdf->loadview('IT.WS_MAP.IT_room.print', [
"IT_396" => $IT_396,
"IT_397" => $IT_397,
"IT_398" => $IT_398,
"IT_399" => $IT_399,
"IT_400" => $IT_400,
"IT_401" => $IT_401,
"IT_402" => $IT_402,
"IT_403" => $IT_403,
"IT_404" => $IT_404,
"IT_405" => $IT_405,
"IT_406" => $IT_406,
"IT_407" => $IT_407,
"IT_408" => $IT_408,
"IT_409" => $IT_409,
"IT_410" => $IT_410,
"IT_411" => $IT_411,
"IT_412" => $IT_412,
"IT_413" => $IT_413,
"IT_414" => $IT_414,
"IT_415" => $IT_415,
"IT_416" => $IT_416,
"IT_417" => $IT_417,
"IT_418" => $IT_418,
"IT_419" => $IT_419,
"IT_420" => $IT_420,
"IT_421" => $IT_421,
"IT_422" => $IT_422,
"IT_423" => $IT_423,
"IT_424" => $IT_424,
"IT_425" => $IT_425,
"IT_426" => $IT_426,
"IT_427" => $IT_427,
"IT_428" => $IT_428,
"IT_429" => $IT_429,
"IT_430" => $IT_430,
"IT_431" => $IT_431,
"IT_432" => $IT_432,
"IT_433" => $IT_433,
"IT_434" => $IT_434,
"IT_435" => $IT_435,
"IT_436" => $IT_436,
'IT_437' => $IT_437,
])
->setPaper('A3', 'potrait')
->setOptions(['dpi' => 120, 'defaultFont' => 'sans-serif']);
return $pdf->stream();
}

public function excellLayout()
{
$layout_160 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 160)->where('area', '=', 'Layout')->first();
$layout_161 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 161)->where('area', '=', 'Layout')->first();
$layout_162 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 162)->where('area', '=', 'Layout')->first();
$layout_163 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 163)->where('area', '=', 'Layout')->first();
$layout_164 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 164)->where('area', '=', 'Layout')->first();
$layout_165 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 165)->where('area', '=', 'Layout')->first();
$layout_166 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 166)->where('area', '=', 'Layout')->first();
$layout_167 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 167)->where('area', '=', 'Layout')->first();
$layout_168 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 168)->where('area', '=', 'Layout')->first();
$layout_169 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 169)->where('area', '=', 'Layout')->first();
$layout_170 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 170)->where('area', '=', 'Layout')->first();
$layout_171 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 171)->where('area', '=', 'Layout')->first();
$layout_172 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 172)->where('area', '=', 'Layout')->first();
$layout_173 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 173)->where('area', '=', 'Layout')->first();
$layout_174 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 174)->where('area', '=', 'Layout')->first();
$layout_175 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 175)->where('area', '=', 'Layout')->first();
$layout_176 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 176)->where('area', '=', 'Layout')->first();
$layout_177 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 177)->where('area', '=', 'Layout')->first();
$layout_178 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 178)->where('area', '=', 'Layout')->first();
$layout_179 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 179)->where('area', '=', 'Layout')->first();
$layout_180 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 180)->where('area', '=', 'Layout')->first();
$layout_181 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 181)->where('area', '=', 'Layout')->first();
$layout_182 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 182)->where('area', '=', 'Layout')->first();
$layout_183 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 183)->where('area', '=', 'Layout')->first();
$layout_184 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 184)->where('area', '=', 'Layout')->first();
$layout_185 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 185)->where('area', '=', 'Layout')->first();
$layout_186 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 186)->where('area', '=', 'Layout')->first();
$layout_187 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 187)->where('area', '=', 'Layout')->first();
$layout_188 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 188)->where('area', '=', 'Layout')->first();
$layout_189 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 189)->where('area', '=', 'Layout')->first();
$layout_190 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 190)->where('area', '=', 'Layout')->first();
$layout_191 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 191)->where('area', '=', 'Layout')->first();
$layout_192 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 192)->where('area', '=', 'Layout')->first();
$layout_193 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 193)->where('area', '=', 'Layout')->first();
$layout_194 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 194)->where('area', '=', 'Layout')->first();
$layout_195 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 195)->where('area', '=', 'Layout')->first();
$layout_196 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 196)->where('area', '=', 'Layout')->first();
$layout_197 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 197)->where('area', '=', 'Layout')->first();
$layout_198 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 198)->where('area', '=', 'Layout')->first();
$layout_199 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 199)->where('area', '=', 'Layout')->first();
$layout_200 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 200)->where('area', '=', 'Layout')->first();
$layout_201 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 201)->where('area', '=', 'Layout')->first();
$layout_202 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 202)->where('area', '=', 'Layout')->first();
$layout_203 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 203)->where('area', '=', 'Layout')->first();
$layout_204 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 204)->where('area', '=', 'Layout')->first();
$layout_205 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 205)->where('area', '=', 'Layout')->first();
$layout_206 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 206)->where('area', '=', 'Layout')->first();
$layout_207 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 207)->where('area', '=', 'Layout')->first();
$layout_208 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 208)->where('area', '=', 'Layout')->first();
$layout_209 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 209)->where('area', '=', 'Layout')->first();
$layout_210 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 210)->where('area', '=', 'Layout')->first();
$layout_211 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 211)->where('area', '=', 'Layout')->first();
$layout_212 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 212)->where('area', '=', 'Layout')->first();
$layout_213 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 213)->where('area', '=', 'Layout')->first();
$layout_214 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 214)->where('area', '=', 'Layout')->first();
$layout_215 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 215)->where('area', '=', 'Layout')->first();
$layout_216 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 216)->where('area', '=', 'Layout')->first();
$layout_217 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 217)->where('area', '=', 'Layout')->first();
$layout_218 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 218)->where('area', '=', 'Layout')->first();
$layout_219 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 219)->where('area', '=', 'Layout')->first();
$layout_220 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 220)->where('area', '=', 'Layout')->first();
$layout_221 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 221)->where('area', '=', 'Layout')->first();
$layout_222 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 222)->where('area', '=', 'Layout')->first();
$layout_223 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 223)->where('area', '=', 'Layout')->first();
$layout_224 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 224)->where('area', '=', 'Layout')->first();
$layout_225 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 225)->where('area', '=', 'Layout')->first();
$layout_226 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 226)->where('area', '=', 'Layout')->first();
$layout_227 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 227)->where('area', '=', 'Layout')->first();
$layout_228 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 228)->where('area', '=', 'Layout')->first();
$layout_229 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 229)->where('area', '=', 'Layout')->first();
$layout_230 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 230)->where('area', '=', 'Layout')->first();
$layout_231 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 231)->where('area', '=', 'Layout')->first();
$layout_232 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 232)->where('area', '=', 'Layout')->first();
$layout_233 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 233)->where('area', '=', 'Layout')->first();
$layout_234 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 234)->where('area', '=', 'Layout')->first();
$layout_235 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 235)->where('area', '=', 'Layout')->first();
$layout_236 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 236)->where('area', '=', 'Layout')->first();
$layout_237 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 237)->where('area', '=', 'Layout')->first();
$layout_238 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 238)->where('area', '=', 'Layout')->first();
$layout_239 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 239)->where('area', '=', 'Layout')->first();
$layout_240 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 240)->where('area', '=', 'Layout')->first();
$layout_241 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 241)->where('area', '=', 'Layout')->first();
$layout_242 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 242)->where('area', '=', 'Layout')->first();
$layout_243 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 243)->where('area', '=', 'Layout')->first();
$layout_244 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 244)->where('area', '=', 'Layout')->first();
$layout_245 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 245)->where('area', '=', 'Layout')->first();
$layout_246 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 246)->where('area', '=', 'Layout')->first();
$layout_247 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 247)->where('area', '=', 'Layout')->first();
$layout_248 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 248)->where('area', '=', 'Layout')->first();
$layout_249 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 249)->where('area', '=', 'Layout')->first();
$layout_250 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 250)->where('area', '=', 'Layout')->first();
$layout_251 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 251)->where('area', '=', 'Layout')->first();
$layout_252 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 252)->where('area', '=', 'Layout')->first();
$layout_253 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 253)->where('area', '=', 'Layout')->first();

Excel::create('2D Layout', function ($excel) use (
$layout_160,
$layout_161,
$layout_162,
$layout_163,
$layout_164,
$layout_165,
$layout_166,
$layout_167,
$layout_168,
$layout_169,
$layout_170,
$layout_171,
$layout_172,
$layout_173,
$layout_174,
$layout_175,
$layout_176,
$layout_177,
$layout_178,
$layout_179,
$layout_180,
$layout_181,
$layout_182,
$layout_183,
$layout_184,
$layout_185,
$layout_186,
$layout_187,
$layout_188,
$layout_189,
$layout_190,
$layout_191,
$layout_192,
$layout_193,
$layout_194,
$layout_195,
$layout_196,
$layout_197,
$layout_198,
$layout_199,
$layout_200,
$layout_201,
$layout_202,
$layout_203,
$layout_204,
$layout_205,
$layout_206,
$layout_207,
$layout_208,
$layout_209,
$layout_210,
$layout_211,
$layout_212,
$layout_213,
$layout_214,
$layout_215,
$layout_216,
$layout_217,
$layout_218,
$layout_219,
$layout_220,
$layout_221,
$layout_222,
$layout_223,
$layout_224,
$layout_225,
$layout_225,
$layout_226,
$layout_227,
$layout_228,
$layout_229,
$layout_230,
$layout_231,
$layout_232,
$layout_233,
$layout_234,
$layout_235,
$layout_236,
$layout_237,
$layout_238,
$layout_239,
$layout_240,
$layout_241,
$layout_242,
$layout_243,
$layout_244,
$layout_245,
$layout_246,
$layout_247,
$layout_248,
$layout_249,
$layout_250,
$layout_251,
$layout_252,
$layout_253
) {

$excel->sheet('2D Layout', function ($sheet) use (
$layout_160,
$layout_161,
$layout_162,
$layout_163,
$layout_164,
$layout_165,
$layout_166,
$layout_167,
$layout_168,
$layout_169,
$layout_170,
$layout_171,
$layout_172,
$layout_173,
$layout_174,
$layout_175,
$layout_176,
$layout_177,
$layout_178,
$layout_179,
$layout_180,
$layout_181,
$layout_182,
$layout_183,
$layout_184,
$layout_185,
$layout_186,
$layout_187,
$layout_188,
$layout_189,
$layout_190,
$layout_191,
$layout_192,
$layout_193,
$layout_194,
$layout_195,
$layout_196,
$layout_197,
$layout_198,
$layout_199,
$layout_200,
$layout_201,
$layout_202,
$layout_203,
$layout_204,
$layout_205,
$layout_206,
$layout_207,
$layout_208,
$layout_209,
$layout_210,
$layout_211,
$layout_212,
$layout_213,
$layout_214,
$layout_215,
$layout_216,
$layout_217,
$layout_218,
$layout_219,
$layout_220,
$layout_221,
$layout_222,
$layout_223,
$layout_224,
$layout_225,
$layout_225,
$layout_226,
$layout_227,
$layout_228,
$layout_229,
$layout_230,
$layout_231,
$layout_232,
$layout_233,
$layout_234,
$layout_235,
$layout_236,
$layout_237,
$layout_238,
$layout_239,
$layout_240,
$layout_241,
$layout_242,
$layout_243,
$layout_244,
$layout_245,
$layout_246,
$layout_247,
$layout_248,
$layout_249,
$layout_250,
$layout_251,
$layout_252,
$layout_253
) {
$sheet->cell('O6:O25', function ($cell) {
$cell->setBorder('none', 'none', 'none', 'thin');
});
$sheet->cell('R6', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('R7:R10', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('S6', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('S7:S10', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('S7:S10', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('R11', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('R12:R15', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('S11', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('S12:S15', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('R16', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('R17:R20', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('S16', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('S17:S20', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('R21', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('R22:R25', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('S21', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('S22:S25', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
/**/
$sheet->cell('J13', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('J14', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('K14', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('J15', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('B19', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});
$sheet->cell('B20:B22', function ($cell) {
$cell->setBorder('thin', 'thin', 'thin', 'thin');
});

$sheet->loadView('IT.WS_MAP.excel.excelLayout', [
'layout_160' => $layout_160,
'layout_161' => $layout_161,
'layout_162' => $layout_162,
'layout_163' => $layout_163,
'layout_164' => $layout_164,
'layout_165' => $layout_165,
'layout_166' => $layout_166,
'layout_167' => $layout_167,
'layout_168' => $layout_168,
'layout_169' => $layout_169,
'layout_170' => $layout_170,
'layout_171' => $layout_171,
'layout_172' => $layout_172,
'layout_173' => $layout_173,
'layout_174' => $layout_174,
'layout_175' => $layout_175,
'layout_176' => $layout_176,
'layout_177' => $layout_177,
'layout_178' => $layout_178,
'layout_179' => $layout_179,
'layout_180' => $layout_180,
'layout_181' => $layout_181,
'layout_182' => $layout_182,
'layout_183' => $layout_183,
'layout_184' => $layout_184,
'layout_185' => $layout_185,
'layout_186' => $layout_186,
'layout_187' => $layout_187,
'layout_188' => $layout_188,
'layout_189' => $layout_189,
'layout_190' => $layout_190,
'layout_191' => $layout_191,
'layout_192' => $layout_192,
'layout_193' => $layout_193,
'layout_194' => $layout_194,
'layout_195' => $layout_195,
'layout_196' => $layout_196,
'layout_197' => $layout_197,
'layout_198' => $layout_198,
'layout_199' => $layout_199,
'layout_200' => $layout_200,
'layout_201' => $layout_201,
'layout_202' => $layout_202,
'layout_203' => $layout_203,
'layout_204' => $layout_204,
'layout_205' => $layout_205,
'layout_206' => $layout_206,
'layout_207' => $layout_207,
'layout_208' => $layout_208,
'layout_209' => $layout_209,
'layout_210' => $layout_210,
'layout_211' => $layout_211,
'layout_212' => $layout_212,
'layout_213' => $layout_213,
'layout_214' => $layout_214,
'layout_215' => $layout_215,
'layout_216' => $layout_216,
'layout_217' => $layout_217,
'layout_218' => $layout_218,
'layout_219' => $layout_219,
'layout_220' => $layout_220,
'layout_221' => $layout_221,
'layout_222' => $layout_222,
'layout_223' => $layout_223,
'layout_224' => $layout_224,
'layout_225' => $layout_225,
'layout_226' => $layout_226,
'layout_227' => $layout_227,
'layout_228' => $layout_228,
'layout_229' => $layout_229,
'layout_230' => $layout_230,
'layout_231' => $layout_231,
'layout_232' => $layout_232,
'layout_233' => $layout_233,
'layout_234' => $layout_234,
'layout_235' => $layout_235,
'layout_236' => $layout_236,
'layout_237' => $layout_237,
'layout_238' => $layout_238,
'layout_239' => $layout_239,
'layout_240' => $layout_240,
'layout_241' => $layout_241,
'layout_242' => $layout_242,
'layout_243' => $layout_243,
'layout_244' => $layout_244,
'layout_245' => $layout_245,
'layout_246' => $layout_246,
'layout_247' => $layout_247,
'layout_248' => $layout_248,
'layout_249' => $layout_249,
'layout_250' => $layout_250,
'layout_251' => $layout_251,
'layout_252' => $layout_252,
'layout_253' => $layout_253,
]);
});
})->download('xls');
}




//end
}