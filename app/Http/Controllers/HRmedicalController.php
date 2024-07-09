<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Validator;

use App\Absences;
use App\User;
use App\NewUser;
use App\Leave;
use App\Dept_Category;
use App\Leave_Category;
use App\MedicStaff;
use App\MedicalDisease;

use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HRmedicalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function indexSicked()
    {
        return view('HRDLevelAcces.medical.index');
    }

    public function dataSicked()
    {
        $model = Leave::joinUsers()->select([
            'leave_transaction.id',
            'leave_transaction.user_id',
            'leave_transaction.request_nik',
            'leave_transaction.period',
            'leave_transaction.leave_date',
            'leave_transaction.end_leave_date',
            'leave_transaction.request_position',
            'users.active'
        ])->where('leave_transaction.leave_category_id', 3)
            ->orderBy('leave_transaction.leave_date', 'desc')
            ->where('users.active', 1)
            ->get();

        return Datatables::of($model)
            ->addIndexColumn()
            ->addColumn('fullname', function (leave $leave) {
                $user = User::findOrFail($leave->user_id);
                return $user->first_name . ' ' . $user->last_name;
            })
            ->addColumn('dept', function (Leave $leave) {
                $user = User::find($leave->user_id);
                $dept = Dept_Category::find($user->dept_category_id);

                return $dept->dept_category_name;
            })
            ->addColumn('action', function (Leave $leave) {

                $medic = MedicStaff::where('leave_id', $leave->id)->first();

                $add = '<a href="' . route('sicked/add', [$leave->id]) . '" class="btn btn-xs btn-primary" title="add MC"><i class="fa fa-plus"></i></a>';
                $view = null;
                $edit = null;
                $delete = null;

                if ($medic != null) {
                    $add = null;
                    $view = '<a class="btn btn-xs btn-success" title="Detail" data-toggle="modal" data-target="#showModal" data-role="' . route('sicked/detail', [$medic->id]) . '"><span class="fa fa-eye"></span></a>';
                    $edit = '<a href="' . route('sicked/edit', [$leave->id]) . '" class="btn btn-xs btn-warning" title="edit MC"><i class="fa fa-pencil"></i></a>';
                    $delete = '<a href="' . route('sicked/delete', [$medic->id]) . '" class="btn btn-xs btn-danger" title="delete MC"><i class="fa fa-trash"></i></a>';
                }

                return $add . ' ' . $view . ' ' . $edit . ' ' . $delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function addMedicalStaff($id)
    {
        $leave = Leave::find($id);
        $user = User::find($leave->user_id);
        $dept = Dept_Category::find($user->dept_category_id);

        $jenis_penyakit = [
            'Accident'      => 'Accident',
            'Brain'         => 'Brain',
            'Cancer'        => 'Cancer',
            'Deficiency'    => 'Deficiency',
            'Digestion'     => 'Digestion',
            'Eye'           => 'Eye',
            'Heart'         => 'Heart',
            'Infection'     => 'Infection',
            'Psychology'    => 'Psychology',
            'Virus'         => 'Virus',
            'Others'        => 'Others'
        ];

        return view('HRDLevelAcces.medical.add', compact(['leave', 'user', 'dept', 'jenis_penyakit']));
    }

    public function updateMedicalStaff(Request $request)
    {
        $prof_pict = null;
        $categoryDisease = $request->input('categoryDisease');
        $diseaseName = $request->input('diseaseName');
        $period = $request->input('period');

        $user = User::findOrFail($request->input('idUser'));

        $rules = [
            'nameHospital'          => 'required|string',
            'age'                   => 'required|numeric',
            'diseaseName'           => 'required',
            'categoryDisease'       => 'required',
            'dateSicked'            => 'required|date',
            // 'dateHealed'            => 'required|date',
            'totDay'                => 'required|numeric',
            'scan'                  => 'sometimes|file|image|nullable|mimes:jpeg,png,jpg|max:1024',
        ];

        if ($request->hasFile('scan') && $request->file('scan')->isValid()) {
            $file      =  $request->file('scan');
            $prof_pict = $request->input('idLeave') . '-' . strtolower($user->first_name) . '-' . strtolower($user->last_name) . '--' . time() . '.' . strtolower($file->getClientOriginalExtension());
            $file->storeAs('HR/MedicStaff', $prof_pict);
        } else {
            $prof_pict = null;
        }

        $data = [
            'leave_id'           => $request->input('idLeave'),
            'user_id'            => $request->input('idUser'),
            'hospital_name'      => strtoupper($request->input('nameHospital')),
            'age'                => $request->input('age'),
            'address_sick'       => $request->input('address'),
            'sicked_date'        => $request->input('dateSicked'),
            'count_sicked'       => $request->input('totDay'),
            'image'              => $prof_pict
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('sicked/add', $request->input('idLeave'))
                ->withErrors($validator)
                ->withInput();
        } else {

            MedicStaff::insert($data);

            $medic = MedicStaff::where('leave_id', $request->input('idLeave'))->latest()->first();
            foreach ($categoryDisease as $key => $value) {

                $disease = [
                    'medic_id'      => $medic->id,
                    'leave_id'      => $request->input('idLeave'),
                    'user_id'       => $request->input('idUser'),
                    'category'      => $value,
                    'date_disease'  => $request->input('dateSicked'),
                    'disease'       => $diseaseName[$key],
                    'period'        => $period[$key]
                ];
                // dd($disease);
                MedicalDisease::insert($disease);
            }

            Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data MC']));
            return Redirect::route('index/sicked');
        }
    }

    public function editMedicalStaff($id)
    {
        $leave = Leave::find($id);
        $user = User::find($leave->user_id);
        $dept = Dept_Category::find($user->dept_category_id);
        $medic = MedicStaff::where('leave_id', $id)->first();

        $disease = MedicalDisease::where('medic_id', $medic->id)->get();
        // dd($disease);
        foreach ($disease as $valueDisease)
            $diseaseName[$valueDisease->category] = $valueDisease->category;

        $storageImg = asset('storage/app/HR/MedicStaff/' . $medic->image);

        $jenis_penyakit = [
            'Accident'      => 'Accident',
            'Brain'         => 'Brain',
            'Cancer'        => 'Cancer',
            'Deficiency'    => 'Deficiency',
            'Digestion'     => 'Digestion',
            'Eye'           => 'Eye',
            'Heart'         => 'Heart',
            'Infection'     => 'Infection',
            'Psychology'    => 'Psychology',
            'Virus'         => 'Virus',
            'Others'        => 'Others'
        ];

        return view('HRDLevelAcces.medical.edit', compact(['leave', 'user', 'dept', 'medic', 'storageImg', 'jenis_penyakit', 'disease']));
    }

    public function uploadMedicalStaff(Request $request, $id)
    {
        $medic = MedicStaff::find($id);
        $user = User::where('id', $medic->user_id)->first();
        $categoryDisease = $request->input('categoryDisease');
        $diseaseName = $request->input('diseaseName');
        $period = $request->input('period');

        $rules = [
            'nameHospital'          => 'required|string',
            'age'                   => 'required|numeric',
            'diseaseName'           => 'required',
            'dateSicked'            => 'required|date',
            'totDay'                => 'required|numeric',
            'scan'                  => 'sometimes|file|image|nullable|mimes:jpeg,png,jpg|max:1024',
        ];

        $prof_pict = null;

        $cover = $request->file('scan');

        if ($cover === null) {
            if ($medic->image !== null) {
                $prof_pict = $medic->image;
            }
        } else {
            if ($request->hasFile('scan') && $request->file('scan')->isValid()) {

                if ($medic->image !== null) {
                    Storage::disk('local')->delete('HR/MedicStaff/' . $medic->image);
                }

                $file      =  $request->file('scan');
                $prof_pict = $request->input('idLeave') . '-' . strtolower($user->first_name) . '-' . strtolower($user->last_name) . '--' . time() . '.' . strtolower($file->getClientOriginalExtension());
                $file->storeAs('HR/MedicStaff', $prof_pict);
            }
        }

        $data = [
            'leave_id'           => $request->input('idLeave'),
            'user_id'            => $request->input('idUser'),
            'hospital_name'      => strtoupper($request->input('nameHospital')),
            'age'                => $request->input('age'),
            'address_sick'       => $request->input('address'),
            'sicked_date'        => $request->input('dateSicked'),
            'count_sicked'       => $request->input('totDay'),
            'image'              => $prof_pict
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('sicked/edit', $request->input('idLeave'))
                ->withErrors($validator)
                ->withInput();
        } else {
            MedicStaff::where('id', $medic->id)->update($data);
            foreach ($categoryDisease as $key => $value) {
                $disease = [
                    'medic_id'      => $medic->id,
                    'leave_id'      => $request->input('idLeave'),
                    'user_id'       => $request->input('idUser'),
                    'category'      => $value,
                    'date_disease'  => $request->input('dateSicked'),
                    'disease'       => $diseaseName[$key],
                    'period'        => $period[$key]
                ];
                // dd($disease);
                MedicalDisease::where('medic_id', $medic->id)->update($disease);
            }
            Session::flash('success', Lang::get('messages.data_updated', ['data' => 'Data MC ' . $user->first_name . ' ' . $user->last_name . ' ']));
            return Redirect::route('index/sicked');
        }
    }

    public function deleteMC($id)
    {
        $medic = MedicStaff::find($id);
        $user = User::where('id', $medic->user_id)->first();
        Session::flash('getError', Lang::get('messages.data_deleted', ['data' => 'Data MC ' . $user->first_name . ' ' . $user->last_name . ' ']));
        Storage::disk('local')->delete('HR/MedicStaff/' . $medic->image);
        MedicStaff::where('id', $id)->delete();
        MedicalDisease::where('medic_id', $id)->delete();
        return Redirect::route('index/sicked');
    }

    public function detailMC($id)
    {

        $medic = MedicStaff::find($id);

        $user = User::find($medic->user_id);

        $leave = Leave::find($medic->leave_id);

        $dept = Dept_Category::find($user->dept_category_id);

        $disease = MedicalDisease::where('medic_id', $id)->first();

        $storageImg = asset('storage/app/HR/MedicStaff/' . $medic->image);

        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Medical Certificate $user->first_name $user->last_name</h4>
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <strong> Hospital </strong>: $medic->hospital_name <br>
                    <strong> Employee </strong>: $user->first_name $user->last_name <br>
                    <strong> NIK </strong>: $user->nik <br>
                    <strong> Age </strong>: $medic->age (th) <br>
                    <strong> Department </strong>: $dept->dept_category_name <br>
                    <strong> Address </strong>: $user->address <br>
                    <strong> Disease </strong>: $disease->category <br>
                    <strong> Sicked </strong>: $medic->sicked_date <br>
                    <img src='" . $storageImg . "' class='img-responsive img-rounded' style='margin-top: 10px;' alt='mc-Image' height='150px' width='150px'>
                    <br>                    
                </div               
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function summaryMC()
    {
        $jenis_penyakit = [
            'Accident'      => 'Accident',
            'Brain'         => 'Brain',
            'Cancer'        => 'Cancer',
            'Deficiency'    => 'Deficiency',
            'Digestion'     => 'Digestion',
            'Eye'           => 'Eye',
            'Heart'         => 'Heart',
            'Infection'     => 'Infection',
            'Psychology'    => 'Psychology',
            'Virus'         => 'Virus',
            'Others'        => 'Others',
        ];

        $accident       = MedicalDisease::JoinUsers()->select(['medical_disease.id', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Accident')->where('medical_disease.period', date('Y'))->get();
        $brain          = MedicalDisease::JoinUsers()->select(['medical_disease.id', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Brain')->where('medical_disease.period', date('Y'))->get();
        $cancer         = MedicalDisease::JoinUsers()->select(['medical_disease.id', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Cancer')->where('medical_disease.period', date('Y'))->get();
        $deficiency     = MedicalDisease::JoinUsers()->select(['medical_disease.id', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Deficiency')->where('medical_disease.period', date('Y'))->get();
        $digestion      = MedicalDisease::JoinUsers()->select(['medical_disease.id', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Digestion')->where('medical_disease.period', date('Y'))->get();
        $eye            = MedicalDisease::JoinUsers()->select(['medical_disease.id', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Eye')->where('medical_disease.period', date('Y'))->get();
        $heart          = MedicalDisease::JoinUsers()->select(['medical_disease.id', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Heart')->where('medical_disease.period', date('Y'))->get();

        $infection      = MedicalDisease::JoinUsers()->select(['medical_disease.id', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Infection')->where('medical_disease.period', date('Y'))->get();

        $psychology     = MedicalDisease::JoinUsers()->select(['medical_disease.id', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Psychology')->where('medical_disease.period', date('Y'))->get();
        $virus          = MedicalDisease::JoinUsers()->select(['medical_disease.id', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Virus')->where('medical_disease.period', date('Y'))->get();
        $others          = MedicalDisease::JoinUsers()->select(['medical_disease.id', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Others')->where('medical_disease.period', date('Y'))->get();

        $daftar = [
            'accident'      => $accident->count(),
            'brain'         => $brain->count(),
            'cancer'        => $cancer->count(),
            'deficiency'    => $deficiency->count(),
            'digestion'     => $digestion->count(),
            'eye'           => $eye->count(),
            'heart'         => $heart->count(),
            'infection'     => $infection->count(),
            'psychology'    => $psychology->count(),
            'virus'         => $virus->count(),
            'Others'        => $others->count()
        ];

        $total = $brain->count() + $cancer->count() + $deficiency->count() + $digestion->count() + $eye->count() + $heart->count() + $infection->count() + $psychology->count() + $virus->count() + $others->count();

        return view('HRDLevelAcces.medical.records.index', compact([
            'jenis_penyakit', 'accident', 'brain', 'cancer', 'deficiency', 'digestion', 'eye', 'heart', 'infection', 'psychology', 'virus', "others",
        ]));
    }

    public function dataSummaryMC()
    {
        $modal = MedicStaff::joinUsers()->select([
            'medical_staff.id', 'medical_staff.leave_id', 'medical_staff.user_id', 'medical_staff.age', 'medical_staff.sicked_date', 'users.active', 'medical_staff.healed_date',
            'medical_staff.count_sicked',
        ])->where('users.active', 1)->orderBy('medical_staff.sicked_date', 'desc')->get();

        return Datatables::of($modal)
            ->addIndexColumn()
            ->editColumn('sicked_date', '{{ date("d-M-Y", strtotime($sicked_date)) }}')
            ->addColumn('fullname', function (MedicStaff $medic) {
                $user = User::findOrFail($medic->user_id);
                return $user->first_name . ' ' . $user->last_name;
            })
            ->addColumn('nik', function (MedicStaff $medic) {
                $user = User::findOrFail($medic->user_id);
                return $user->nik;
            })
            ->addColumn('dept', function (MedicStaff  $medic) {
                $user = User::findOrFail($medic->user_id);
                $dept = Dept_Category::findOrFail($user->dept_category_id);
                return $dept->dept_category_name;
            })
            ->addColumn('position', function (MedicStaff $medic) {
                $user = User::findOrFail($medic->user_id);
                return $user->position;
            })
            ->addColumn('disease', function (MedicStaff $medic) {
                $disease = MedicalDisease::where('medic_id', $medic->id)->get();

                $return1 = '';

                if (!empty($disease->pluck('disease'))) {
                    $return1 = $disease->pluck('disease');
                    $return1 = json_decode($return1, true);
                }
                return $return1;
            })
            ->addColumn('category', function (MedicStaff $medic) {
                $category = MedicalDisease::where('medic_id', $medic->id)->get();

                $return1 = '';

                if (!empty($category->pluck('category'))) {
                    $return1 = $category->pluck('category');
                    $return1 = json_decode($return1, true);
                }
                return $return1;
            })
            ->addColumn('action', function (MedicStaff $medic) {
                $view =  '<a class="btn btn-xs btn-success" title="Detail" data-toggle="modal" data-target="#showModal" data-role="' . route('sicked/summary/view', [$medic->id]) . '"><span class="fa fa-eye"></span></a>';
                $edit = '<a class="btn btn-xs btn-warning" title="edit" href="' . route('sicked/summary/edit', [$medic->id]) . '"><span class="fa fa-pencil"></span></a>';

                return $view . ' ' . $edit;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function editSummmaryMC($id)
    {
        $medic = MedicStaff::find($id);

        $leave = Leave::find($medic->leave_id);

        $user = User::find($leave->user_id);
        $dept = Dept_Category::find($user->dept_category_id);

        $disease = MedicalDisease::where('medic_id', $id)->get();
        // dd($disease);
        foreach ($disease as $valueDisease)
            $diseaseName[$valueDisease->category] = $valueDisease->category;

        $storageImg = asset('storage/app/HR/MedicStaff/' . $medic->image);

        $jenis_penyakit = [
            'Accident'      => 'Accident',
            'Brain'         => 'Brain',
            'Cancer'        => 'Cancer',
            'Deficiency'    => 'Deficiency',
            'Digestion'     => 'Digestion',
            'Eye'           => 'Eye',
            'Heart'         => 'Heart',
            'Infection'     => 'Infection',
            'Psychology'    => 'Psychology',
            'Virus'         => 'Virus',
            'Others'        => 'Others'
        ];

        return view('HRDLevelAcces.medical.records.edit', compact(['leave', 'user', 'dept', 'medic', 'storageImg', 'jenis_penyakit', 'disease']));
    }

    public function updateSummaryMC(Request $request, $id)
    {
        $medic = MedicStaff::find($id);
        $user = User::where('id', $medic->user_id)->first();
        $categoryDisease = $request->input('categoryDisease');
        $diseaseName = $request->input('diseaseName');
        $period = $request->input('period');

        $rules = [
            'nameHospital'          => 'required|string',
            'age'                   => 'required|numeric',
            'diseaseName'           => 'required',
            'dateSicked'            => 'required|date',
            'dateHealed'            => 'required|date',
            'totDay'                => 'required|numeric',
            'scan'                  => 'sometimes|file|image|nullable|mimes:jpeg,png,jpg|max:1024',
        ];

        $prof_pict = null;

        $cover = $request->file('scan');

        if ($cover === null) {
            if ($medic->image !== null) {
                $prof_pict = $medic->image;
            }
        } else {
            if ($request->hasFile('scan') && $request->file('scan')->isValid()) {

                if ($medic->image !== null) {
                    Storage::disk('local')->delete('HR/MedicStaff/' . $medic->image);
                }

                $file      =  $request->file('scan');
                $prof_pict = $request->input('idLeave') . '-' . strtolower($user->first_name) . '-' . strtolower($user->last_name) . '--' . time() . '.' . strtolower($file->getClientOriginalExtension());
                $file->storeAs('HR/MedicStaff', $prof_pict);
            }
        }

        $data = [
            'leave_id'           => $request->input('idLeave'),
            'user_id'            => $request->input('idUser'),
            'hospital_name'      => strtoupper($request->input('nameHospital')),
            'age'                => $request->input('age'),
            'address_sick'       => $request->input('address'),
            'sicked_date'        => $request->input('dateSicked'),
            'healed_date'        => $request->input('dateHealed'),
            'count_sicked'       => $request->input('totDay'),
            'image'              => $prof_pict
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('sicked/edit', $request->input('idLeave'))
                ->withErrors($validator)
                ->withInput();
        } else {
            MedicStaff::where('id', $medic->id)->update($data);
            foreach ($categoryDisease as $key => $value) {
                $disease = [
                    'medic_id'      => $medic->id,
                    'leave_id'      => $request->input('idLeave'),
                    'user_id'       => $request->input('idUser'),
                    'category'      => $value,
                    'date_disease'  => $request->input('dateSicked'),
                    'disease'       => $diseaseName[$key],
                    'period'        => $period[$key]
                ];
                // dd($disease);
                MedicalDisease::where('medic_id', $medic->id)->update($disease);
            }
            Session::flash('success', Lang::get('messages.data_updated', ['data' => 'Data MC ' . $user->first_name . ' ' . $user->last_name . ' ']));
            return Redirect::route('sicked/summary');
        }
    }

    public function viewImageMC($id)
    {
        $medic = MedicStaff::find($id);

        $user = User::find($medic->user_id);

        $storageImg = asset('storage/app/HR/MedicStaff/' . $medic->image);

        $print =  '<a class="btn btn-primary" title="Print" href="' . route('sicked/download/mc', [$medic->id]) . '" target="_blank"><span class="fa fa-print"></span></a>';

        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Medical Certificate $user->first_name $user->last_name</h4> 
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <img src='" . $storageImg . "' class='img-responsive img-rounded' style='margin-top: 10px;' alt='mc-Image'>
                    <br>                    
                </div               
            </div>
            <div class='modal-footer'>
                $print
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function downloadMC($id)
    {
        $medic = MedicStaff::find($id);

        $storageImg = asset('storage/app/HR/MedicStaff/' . $medic->image);

        $url = Storage::url('app/HR/MedicStaff/' . $medic->image);

        // dd($url);

        return response()->download($url);
    }

    public function deleteMedicalDisease($id)
    {
        $disease = MedicalDisease::find($id);

        $user = User::where('id', $disease->user_id)->first();

        Session::flash('getError', Lang::get('messages.data_deleted', ['data' => 'Data Disease ' . $user->first_name . ' ' . $user->last_name . ' ']));

        MedicalDisease::where('id', $id)->delete();

        return Redirect::back();
    }

    public function dataSementara($id)
    {
        $medic = MedicStaff::find($id);

        $disease = MedicalDisease::where('medic_id', $id)->get();

        $user = User::find($medic->user_id);

        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Medical Certificate $user->first_name $user->last_name</h4>
            </div>
            <div class='modal-body'>
                <div class='well'>

                </div               
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function detailDataSummaryMC(Request $request)
    {
        $category = $request->input('selectDisease');

        $dateFrom = $request->input('dateFrom');
        $dateToo  = $request->input('dateTo');

        if ($category === "All") {

            return redirect()->route('details/summary/all', [$dateFrom, $dateToo, $category]);
        } else {
            return redirect()->route('details/summary/category', [$dateFrom, $dateToo, $category]);
        }
    }

    public function detailAllDataSummaryMC($dateFrom, $dateToo, $category)
    {
        $medic = MedicStaff::joinUsers()->select([
            'medical_staff.*',
            'users.active',
            'users.first_name',
            'users.last_name',
            'users.nik',
            'users.dept_category_id',
            'users.position',

        ])->where('users.active', 1)->where('medical_staff.sicked_date', '>=', $dateFrom)->where('medical_staff.sicked_date', '<=', $dateToo)->orderBy('medical_staff.sicked_date', 'desc')->paginate(10);

        $accident       = MedicalDisease::joinMedicStaff()->JoinUsers()->select(['medical_disease.id', 'medical_staff.sicked_date', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Accident')->where('medical_staff.sicked_date', '>=', $dateFrom)->where('medical_staff.sicked_date', '<=', $dateToo)->get();
        $brain          = MedicalDisease::joinMedicStaff()->JoinUsers()->select(['medical_disease.id', 'medical_staff.sicked_date', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Brain')->where('medical_staff.sicked_date', '>=', $dateFrom)->where('medical_staff.sicked_date', '<=', $dateToo)->get();
        $cancer         = MedicalDisease::joinMedicStaff()->JoinUsers()->select(['medical_disease.id', 'medical_staff.sicked_date', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Cancer')->where('medical_staff.sicked_date', '>=', $dateFrom)->where('medical_staff.sicked_date', '<=', $dateToo)->get();
        $deficiency     = MedicalDisease::joinMedicStaff()->JoinUsers()->select(['medical_disease.id', 'medical_staff.sicked_date', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Deficiency')->where('medical_staff.sicked_date', '>=', $dateFrom)->where('medical_staff.sicked_date', '<=', $dateToo)->get();
        $digestion      = MedicalDisease::joinMedicStaff()->JoinUsers()->select(['medical_disease.id', 'medical_staff.sicked_date', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Digestion')->where('medical_staff.sicked_date', '>=', $dateFrom)->where('medical_staff.sicked_date', '<=', $dateToo)->get();
        $eye            = MedicalDisease::joinMedicStaff()->JoinUsers()->select(['medical_disease.id', 'medical_staff.sicked_date', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Eye')->where('medical_staff.sicked_date', '>=', $dateFrom)->where('medical_staff.sicked_date', '<=', $dateToo)->get();
        $heart          = MedicalDisease::joinMedicStaff()->JoinUsers()->select(['medical_disease.id', 'medical_staff.sicked_date', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Heart')->where('medical_staff.sicked_date', '>=', $dateFrom)->where('medical_staff.sicked_date', '<=', $dateToo)->get();
        $infection      = MedicalDisease::joinMedicStaff()->JoinUsers()->select(['medical_disease.id', 'medical_staff.sicked_date', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Infection')->where('medical_staff.sicked_date', '>=', $dateFrom)->where('medical_staff.sicked_date', '<=', $dateToo)->get();

        $psychology     = MedicalDisease::joinMedicStaff()->JoinUsers()->select(['medical_disease.id', 'medical_staff.sicked_date', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Psychology')->where('medical_staff.sicked_date', '>=', $dateFrom)->where('medical_staff.sicked_date', '<=', $dateToo)->get();
        $virus          = MedicalDisease::joinMedicStaff()->JoinUsers()->select(['medical_disease.id', 'medical_staff.sicked_date', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Virus')->where('medical_staff.sicked_date', '>=', $dateFrom)->where('medical_staff.sicked_date', '<=', $dateToo)->get();
        $others          = MedicalDisease::joinMedicStaff()->JoinUsers()->select(['medical_disease.id', 'medical_staff.sicked_date', 'users.active'])->where('users.active', 1)->where('medical_disease.category', 'Others')->where('medical_staff.sicked_date', '>=', $dateFrom)->where('medical_staff.sicked_date', '<=', $dateToo)->get();

        return view('HRDLevelAcces.medical.detail.indexAll', compact(['medic', 'dateFrom', 'dateToo', 'category', 'accident', 'brain', 'cancer', 'deficiency', 'digestion', 'eye', 'heart', 'infection', 'psychology', 'virus', 'others']));
    }

    public function excelAllDataSummaryMC($dateFrom, $dateToo, $category)
    {
        $no = 1;

        $medic = MedicStaff::joinUsers()->select([
            'medical_staff.*',
            'users.active',
            'users.first_name',
            'users.last_name',
            'users.nik',
            'users.dept_category_id',
            'users.position',

        ])->where('users.active', 1)->where('medical_staff.sicked_date', '>=', $dateFrom)->where('medical_staff.sicked_date', '<=', $dateToo)->orderBy('medical_staff.sicked_date', 'desc')->get();

        Excel::create('Sick Employee Summary (All)', function ($excel) use ($medic, $no, $dateFrom, $dateToo, $category) {

            $excel->sheet('Sick Employee Summary (all)', function ($sheet) use ($medic, $no, $dateFrom, $dateToo, $category) {
                $sheet->loadView('HRDLevelAcces.medical.detail.excelAll', [
                    'medic'     => $medic,
                    'no'        => $no,
                    'dateFrom'  => $dateFrom,
                    'dateToo'   => $dateToo,
                    'category'  => $category
                ]);
            });
        })->export('xls');
    }

    public function detailCategorySummaryMC($dateFrom, $dateToo, $category)
    {
        $medic = MedicStaff::joinUsers()->select([
            'medical_staff.*',
            'users.active',
            'users.first_name',
            'users.last_name',
            'users.nik',
            'users.dept_category_id',
            'users.position',

        ])->where('users.active', 1)->where('medical_staff.sicked_date', '>=', $dateFrom)->where('medical_staff.sicked_date', '<=', $dateToo)->orderBy('medical_staff.sicked_date', 'desc')->get();

        $no = 1;

        return view('HRDLevelAcces.medical.detail.index', compact(['medic', 'dateFrom', 'dateToo', 'category', 'no']));
    }

    public function getExcelSummaryExcel($dateFrom, $dateToo, $category)
    {
        $no = 1;

        $medic = MedicStaff::joinUsers()->select([
            'medical_staff.*',
            'users.active',
            'users.first_name',
            'users.last_name',
            'users.nik',
            'users.dept_category_id',
            'users.position',
        ])->where('users.active', 1)->where('medical_staff.sicked_date', '>=', $dateFrom)->where('medical_staff.sicked_date', '<=', $dateToo)->orderBy('medical_staff.sicked_date', 'desc')->get();

        Excel::create('Sick Employee Summary', function ($excel) use ($medic, $no, $dateFrom, $dateToo, $category) {

            $excel->sheet('Sick Employee Summary', function ($sheet) use ($medic, $no, $dateFrom, $dateToo, $category) {
                $sheet->loadView('HRDLevelAcces.medical.detail.excel', [
                    'medic'     => $medic,
                    'no'        => $no,
                    'dateFrom'  => $dateFrom,
                    'dateToo'   => $dateToo,
                    'category'  => $category
                ]);
            });
        })->download('xls');
    }

    public function pushSementara()
    {
        $medic = MedicStaff::all();

        foreach ($medic as $key => $data) {
            MedicalDisease::where('medic_id', $data->id)->update([
                'date_disease' => $data->sicked_date
            ]);
        }

        return redirect()->back();
    }

    /// end
}