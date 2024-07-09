<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use Yajra\Datatables\Facades\Datatables;

use App\Leave;
use App\NewUser;
use App\Dept_Category;
use App\Leave_Category;


class FacilitiesAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['active', 'auth', 'facilityAdmin']);
    }

    public function verifyFacilities()
    {
        return view('Facilities.admin.leave.verify.index');
    }

    public function dataVerifyFacilities()
    {
        $model = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id',
            'leave_transaction.leave_date',
            'leave_transaction.end_leave_date',
            'leave_transaction.request_nik',
            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'dept_category.dept_category_name',
            'leave_transaction.total_day',
            'leave_transaction.ap_hd',
            'leave_transaction.ver_hr',
            'leave_transaction.ap_hrd',
            'leave_transaction.req_advance',
            'users.position'
        ])->where('users.dept_category_id', 5)
            // ->where('leave_transaction.ap_hd', 0)
            ->whereYear('leave_transaction.leave_date', date('Y'))
            ->orderBy('leave_transaction.leave_date', 'desc')
            ->get();

        return Datatables::of($model)
            ->addColumn('action', function (Leave $leave) {
                $detail = '<a class="badge bg-success" title="Detail" data-toggle="modal" data-target="#showModal" data-role="' . route('facilities/admin/verify/id', $leave->id) . '">detail</a>';

                $delete = ' <a href="' . route('facilities/admin/verify/delete', $leave->id) . '" class="badge bg-danger">delete</a>';

                if ($leave->ap_hd == 1) {
                    $delete = null;
                }

                return $detail . ' ' . $delete;
            })
            ->rawColumns(['action'])
            ->editColumn('ap_hd', '@if($ap_hd == 1) {{ "Approved" }} @elseif($ap_hd == 2) {{"Unapproved" }} @else {{ "Pending" }} @endif')
            ->editColumn('ver_hr', '@if($ver_hr == 1) {{ "Approved" }} @elseif($ver_hr == 2) {{"Unapproved" }} @else {{ "Pending" }} @endif')
            ->editColumn('ap_hrd', '@if($ap_hrd == 1) {{ "Approved" }} @elseif($ap_hrd == 2) {{"Unapproved" }} @else {{ "Pending" }} @endif')
            ->make(true);
    }

    public function detailVerify($id)
    {
        $leave = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Detail	</h4>
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <h4><strong><u>Approval	</u></strong></h4>
                    <strong>Request by :</strong> $leave->first_name $leave->last_name<br>
                    <strong>Period :</strong> $leave->period <br>
                    <strong>Join Date :</strong> $leave->join_date <br>
                    <strong>NIK :</strong> $leave->nik <br>
                    <strong>Position :</strong> $leave->position <br>
                    <strong>Department :</strong> $leave->dept_category_name <br>
                    <strong>Contact Address :</strong> $leave->address <br>
                    <strong>Leave Category :</strong> $leave->leave_category_name <br>
                    <strong>Start Leave :</strong> $leave->leave_date <br>
                    <strong>End Leave :</strong> $leave->end_leave_date <br>
                    <strong>Back to Work:</strong> $leave->back_work <br>
                    <strong>Total Annual :</strong> $leave->pending <br>
                    <strong>Request Day :</strong> $leave->total_day <br>
                    <strong>Total Balance :</strong> $leave->remain <br>                  
                </div>
                <div class='well'>
                    <h5><u>Additional</u></h5>
                    <strong>Destination :</strong> $leave->r_departure - $leave->r_after_leaving <br>
                    <strong>Reason :</strong> $leave->reason_leave 
                </div>
            </div>
            <div class='modal-footer'>           
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div> ";

        return $return;
    }

    public function destroyVerify($id)
    {
        $data = Leave::find($id);

        if ($data->ap_hd == 0) {
            $data->delete();
        }

        Session::flash('success', Lang::get('messages.data_deleted', ['data' => 'The leave']));
        return redirect()->route('facilities/admin/verify');
    }
}
