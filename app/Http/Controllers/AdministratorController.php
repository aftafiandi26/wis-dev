<?php

namespace App\Http\Controllers;

use App;
use App\Dept_Category;
use App\Entitled_leave_view;
use App\Events\LeaveVerificatedByHr;
use App\Http\Controllers\Controller;
use App\NewUser;
use App\Project_Category;
use App\User;
use App\PolingKantin;
use Illuminate\Support\Facades\DB;
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

use Yajra\Datatables\Facades\Datatables;

class AdministratorController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth', 'active', 'admin']);
    }

   public function indexVotingCanteen()
	{	
		$select = PolingKantin::latest()->first();		
		if ($select != null) {
		$semua = PolingKantin::where('date_entry', '=', $select->date_entry)->paginate(10);

		$total_point = PolingKantin::select('total_point')->where('date_entry', '=', $select->date_entry)->pluck('total_point')->sum();
		$averange = PolingKantin::select('averange')->where('date_entry','=', $select->date_entry)->pluck('averange')->avg();
		//
		$taste = PolingKantin::select('point_1')->where('date_entry', $select->date_entry)->pluck('point_1')->avg();
		$quantity = PolingKantin::select('point_2')->where('date_entry', $select->date_entry)->pluck('point_2')->avg();
		$quality = PolingKantin::select('point_3')->where('date_entry', $select->date_entry)->pluck('point_3')->avg();
		$nutritional = PolingKantin::select('point_4')->where('date_entry', $select->date_entry)->pluck('point_4')->avg();
		$menu = PolingKantin::select('point_5')->where('date_entry', $select->date_entry)->pluck('point_5')->avg();
		$fresness = PolingKantin::select('point_6')->where('date_entry', $select->date_entry)->pluck('point_6')->avg();
		$cleanliness = PolingKantin::select('point_7')->where('date_entry', $select->date_entry)->pluck('point_7')->avg();
		$service = PolingKantin::select('point_8')->where('date_entry', $select->date_entry)->pluck('point_8')->avg();

		$it_point_1 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 1)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_1')->avg();
		$finance_point_1 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 2)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_1')->avg();
		$hr_point_1 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 3)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_1')->avg();
		$production_point_1 = PolingKantin::JoinUsers()->select('*')->whereIN('users.dept_category_id', [4, 6])->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_1')->avg();
		$facilities_point_1 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 5)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_1')->avg();
		$general_point_1 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 8)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_1')->avg();

		$it_point_2 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 1)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_2')->avg();
		$finance_point_2 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 2)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_2')->avg();
		$hr_point_2 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 3)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_2')->avg();
		$production_point_2 = PolingKantin::JoinUsers()->select('*')->whereIN('users.dept_category_id', [4, 6])->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_2')->avg();
		$facilities_point_2 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 5)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_2')->avg();
		$general_point_2 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 8)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_2')->avg();

		$it_point_3 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 1)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_3')->avg();
		$finance_point_3 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 2)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_3')->avg();
		$hr_point_3 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 3)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_3')->avg();
		$production_point_3 = PolingKantin::JoinUsers()->select('*')->whereIN('users.dept_category_id', [4, 6])->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_3')->avg();
		$facilities_point_3 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 5)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_3')->avg();
		$general_point_3 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 8)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_3')->avg();

		$it_point_4 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 1)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_4')->avg();
		$finance_point_4 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 2)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_4')->avg();
		$hr_point_4 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 3)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_4')->avg();
		$production_point_4 = PolingKantin::JoinUsers()->select('*')->whereIN('users.dept_category_id', [4, 6])->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_4')->avg();
		$facilities_point_4 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 5)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_4')->avg();
		$general_point_4 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 8)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_4')->avg();

		$it_point_5 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 1)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_5')->avg();
		$finance_point_5 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 2)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_5')->avg();
		$hr_point_5 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 3)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_5')->avg();
		$production_point_5 = PolingKantin::JoinUsers()->select('*')->whereIN('users.dept_category_id', [4, 6])->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_5')->avg();
		$facilities_point_5 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 5)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_5')->avg();
		$general_point_5 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 8)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_5')->avg();

		$it_point_6 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 1)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_6')->avg();
		$finance_point_6 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 2)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_6')->avg();
		$hr_point_6 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 3)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_6')->avg();
		$production_point_6 = PolingKantin::JoinUsers()->select('*')->whereIN('users.dept_category_id', [4, 6])->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_6')->avg();
		$facilities_point_6 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 5)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_6')->avg();
		$general_point_6 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 8)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_6')->avg();

		$it_point_7 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 1)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_7')->avg();
		$finance_point_7 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 2)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_7')->avg();
		$hr_point_7 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 3)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_7')->avg();
		$production_point_7 = PolingKantin::JoinUsers()->select('*')->whereIN('users.dept_category_id', [4, 6])->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_7')->avg();
		$facilities_point_7 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 5)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_7')->avg();
		$general_point_7 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 8)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_7')->avg();

		$it_point_8 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 1)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_8')->avg();
		$finance_point_8 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 2)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_8')->avg();
		$hr_point_8 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 3)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_8')->avg();
		$production_point_8 = PolingKantin::JoinUsers()->select('*')->whereIN('users.dept_category_id', [4, 6])->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_8')->avg();
		$facilities_point_8 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 5)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_8')->avg();
		$general_point_8 = PolingKantin::JoinUsers()->select('*')->where('users.dept_category_id', 8)->where('voting_canteen.date_entry', $select->date_entry)->pluck('voting_canteen.point_8')->avg();
		}else{
		$semua = null;
		$total_point = null;
		$averange =null;
		//
		$taste = null;
		$quantity = null;
		$quality =null;
		$nutritional = null;
		$menu = null;
		$fresness = null;
		$cleanliness = null;
		$service = null;

		$it_point_1 = null;
		$finance_point_1 = null;
		$hr_point_1 = null;
		$production_point_1 = null;
		$facilities_point_1 = null;
		$general_point_1 = null;

		$it_point_2 = null;
		$finance_point_2 = null;
		$hr_point_2 = null;
		$production_point_2 =null;
		$facilities_point_2 = null;
		$general_point_2 = null;

		$it_point_3 = null;
		$finance_point_3 = null;
		$hr_point_3 = null;
		$production_point_3 =null;
		$facilities_point_3 = null;
		$general_point_3 =null;

		$it_point_4 = null;
		$finance_point_4 = null;
		$hr_point_4 = null;
		$production_point_4 = null;
		$facilities_point_4 = null;
		$general_point_4 = null;

		$it_point_5 = null;
		$finance_point_5 = null;
		$hr_point_5 = null;
		$production_point_5 =null;
		$facilities_point_5 =null;
		$general_point_5 = null;

		$it_point_6 = null;
		$finance_point_6 = null;
		$hr_point_6 = null;
		$production_point_6 = null;
		$facilities_point_6 = null;
		$general_point_6 = null;

		$it_point_7 = null;
		$finance_point_7 = null;
		$hr_point_7 =null;
		$production_point_7 = null;
		$facilities_point_7 = null;
		$general_point_7 = null;

		$it_point_8 = null;
		$finance_point_8 = null;
		$hr_point_8 = null;
		$production_point_8 = null;
		$facilities_point_8 = null;
		$general_point_8 = null;
		}

		return view('admin.Maintanace.Human_Resouce.General_Affair.canteen_comitee.index', [
			'total_point' => $total_point, 'averange' => $averange, 'select' => $select, 'semua' => $semua,
			'taste' 			 => $taste, 
			'quantity' 			 => $quantity, 
			'quality'			 => $quality,
			'nutritional'		 => $nutritional,
			'menu'				 => $menu,
			'freshness'			 => $fresness,
			'cleanliness'		 => $cleanliness,
			'service'			 => $service,

			'it_point_1' 		 => $it_point_1,
			'finance_point_1'	 => $finance_point_1,
			'hr_point_1'		 => $hr_point_1,
			'production_point_1' => $production_point_1,
			'facilities_point_1' => $facilities_point_1,
			'general_point_1'	 => $general_point_1,

			'it_point_2' 		 => $it_point_2,
			'finance_point_2'	 => $finance_point_2,
			'hr_point_2'		 => $hr_point_2,
			'production_point_2' => $production_point_2,
			'facilities_point_2' => $facilities_point_2,
			'general_point_2'	 => $general_point_2,

			'it_point_3' 		 => $it_point_3,
			'finance_point_3'	 => $finance_point_3,
			'hr_point_3'		 => $hr_point_3,
			'production_point_3' => $production_point_3,
			'facilities_point_3' => $facilities_point_3,
			'general_point_3'	 => $general_point_3,

			'it_point_4' 		 => $it_point_4,
			'finance_point_4'	 => $finance_point_4,
			'hr_point_4'		 => $hr_point_4,
			'production_point_4' => $production_point_4,
			'facilities_point_4' => $facilities_point_4,
			'general_point_4'	 => $general_point_4,

			'it_point_5' 		 => $it_point_5,
			'finance_point_5'	 => $finance_point_5,
			'hr_point_5'		 => $hr_point_5,
			'production_point_5' => $production_point_5,
			'facilities_point_5' => $facilities_point_5,
			'general_point_5'	 => $general_point_5,

			'it_point_6' 		 => $it_point_6,
			'finance_point_6'	 => $finance_point_6,
			'hr_point_6'		 => $hr_point_6,
			'production_point_6' => $production_point_6,
			'facilities_point_6' => $facilities_point_6,
			'general_point_6'	 => $general_point_6,

			'it_point_7' 		 => $it_point_7,
			'finance_point_7'	 => $finance_point_7,
			'hr_point_7'		 => $hr_point_7,
			'production_point_7' => $production_point_7,
			'facilities_point_7' => $facilities_point_7,
			'general_point_7'	 => $general_point_7,

			'it_point_8' 		 => $it_point_8,
			'finance_point_8'	 => $finance_point_8,
			'hr_point_8'		 => $hr_point_8,
			'production_point_8' => $production_point_8,
			'facilities_point_8' => $facilities_point_8,
			'general_point_8'	 => $general_point_8,


		]);
	}

	public function getVotingCanteen()
	{	
		$pp = PolingKantin::latest()->first();

		$select = PolingKantin::JoinUsers()->leftJoin('dept_category', 'users.dept_category_id', '=', 'dept_category.id')->select([
			'voting_canteen.id', 'users.nik', 'voting_canteen.name_employee', 'dept_category.dept_category_name', 'voting_canteen.total_point', 'voting_canteen.averange', 'voting_canteen.date_entry', 'voting_canteen.want', 'voting_canteen.unwant','voting_canteen.comment'
		])
		->where('voting_canteen.date_entry', '=', $pp->date_entry)		
		->get();
	  
		return Datatables::of($select)
			->edit_column('voting_canteen.id', '{{$id}}') 
			->edit_column('want', '{{voting_canteen.1_main_dishes}}')
			->edit_column('date_entry', '{!! date("M, d Y", strtotime($date_entry)) !!} WIB')
			->make();
	}

	public function statOfficer()
	{
		return view('admin.stat_officer.index');
	}

	public function dataStatOfficer()
	{
		$user = User::where('active', 1)->whereNotIn('nik', [123456789])->whereNotIn('dept_category_id', [6, 4])->orderby('first_name', 'asc')->get();

		return Datatables::of($user)
				->addIndexColumn()
				->editColumn('dept_category_id', function(User $user){
					$dept = Dept_Category::findOrFail($user->dept_category_id);

					return $dept->dept_category_name;
				})
				->editColumn('stat_officer', function(USer $user){
					$return = '';
					if ($user->stat_officer === 0) {
						$return = 'dont need Coordinator';
					} else {
						$return = 'need Coordinator';
					}
					return $return;
				})
				->addColumn('fullname', function(User $user){
					return $user->first_name.' '.$user->last_name;
				})
				->addColumn('coordinator', function(User $user){
					$getCoordinator = User::where('dept_category_id', $user->dept_category_id)->where('active', 1)->where('koor', 1)->first();
					$named = $getCoordinator['first_name'].' '.$getCoordinator['last_name'];
					if ($user->stat_officer === 0) {
						$return = '';
					} else {
						$return = $named;
					}
					
					return $return;
				})
				->addColumn('action', function(User $user){
					$button1 = "<a href='".route('admin/statOfficer/update', [$user->id])."' class='btn btn-xs btn-warning'>On</a>";
					$button2 = "<a href='".route('admin/statOfficer/deupdate', [$user->id])."' class='btn btn-xs btn-info'>Off</a>";
					$button3 = "<a href='".route('admin/statOfficer/edit', [$user->id])."' class='btn btn-xs btn-danger'>Up</a>";

					return $button1.' '.$button2.' '.$button3;
				})
				->rawColumns(['action'])
				->make(true);
	}

	public function editStatOfficer($id)
	{
		$user = User::findOrFail($id);
		$dept = Dept_Category::find($user->dept_category_id);
		$coordinator = User::where('dept_category_id', $user->dept_category_id)->whereNotIn('nik', [123456789])->whereNotNull('nik')->where('active', 1)->where('hd', 0)->get();

		return view('admin.stat_officer.edit', compact(['user', 'dept', 'coordinator']));
	}

	public function updateStatOfficer($id)
	{		
		User::where('id', $id)->update([
			'stat_officer' => 1
		]);
		Session::flash('success', Lang::get('messages.data_updated', ['data' => 'Officer Accessed']));
		return redirect()->route('admin/statOfficer/index');
	}
	
	public function deupdateSetOfficer($id)
	{
		User::where('id', $id)->update([
			'stat_officer' => 0
		]);
		Session::flash('success', Lang::get('messages.data_updated', ['data' => 'Officer Accessed']));
		return redirect()->route('admin/statOfficer/index');
	}

	public function upSetOfficer(Request $request,$id)
	{	

		$data = [
			'koor' => $request->input('coor'),
			'spv'  => $request->input('spv')
		];
		User::where('id', $id)->update($data);
		Session::flash('success', Lang::get('messages.data_updated', ['data' => 'Officer Accessed']));
		return redirect()->route('admin/statOfficer/index');
	}
}
