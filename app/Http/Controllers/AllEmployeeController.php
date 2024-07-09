<?php

namespace App\Http\Controllers;

use App;
use App\Dept_Category;
use App\Http\Controllers\Controller;
use App\Initial_Leave;
use App\Leave;
use App\Meeting;
use App\Leave_backup;
use App\Leave_Category;
use App\NewUser;
use App\Project_Category;
use App\User;
use App\Ws_Map;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Storage;

class AllEmployeeController extends Controller
{
   public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function index3DAnimation()
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


		return view::make('all_employee.ws_map.3D.index_3D',[
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

	public function pdf3DAnimation()
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
		$pdf = App::make('dompdf.wrapper'); ini_set("memory_limit", '512M');

		$pdf->loadview('all_employee.ws_map.3D.pdf', [
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

		return view::make('all_employee.ws_map.Layout.index_layout',
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

	public function pdfLayout()
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
		$pdf = App::make('dompdf.wrapper'); ini_set("memory_limit", '512M');
		$customPaper = array(0,0,850,700);
		$pdf->loadview('all_employee.ws_map.Layout.pdf', [
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

		return view::make('all_employee.ws_map.Render.index_render',
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

	public function pdfRender()
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
		$pdf = App::make('dompdf.wrapper'); ini_set("memory_limit", '512M');
		$customPaper = array(0,0,1200,1000);
		$pdf->loadview('all_employee.ws_map.Render.print', [
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


//end
}
