<?php

namespace App\Http\Controllers;

use App;
use App\Absences;
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
use Carbon\Carbon;
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

class TestingController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth', 'active']);
	}
	public function excellLayout2()
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

	public function ExcellAnimation()
	{
		Excel::create('3D Animation', function ($excel) {

			$excel->sheet('3D Animation', function ($sheet) {
				$sheet->loadView('IT.WS_MAP.excel.excelAnim');
			});
		})->download('xls');
	}

	public function testingblablabalba()
	{
		return View::make('IT.Progress.testingaja');
	}

	public function Covid19()
	{
		/* $covid = file_get_contents('https://api.kawalcorona.com/indonesia/provinsi');

        $corona = json_decode($covid, true);*/

		$covid = file_get_contents('https://data.covid19.go.id/public/api/prov.json');

		$corona = json_decode($covid, true);

		$list_data = $corona['list_data'];

		/*  dd($list_data);      */

		return View::make('pandemi.tableCorona', [
			'corona' 	=> $corona,
			'list_data'	=> $list_data
		]);
	}

	public function random()
	{
		$startTimestamp = strtotime('07:50');
		$endTimestamp = strtotime('08:15');

		// Menghasilkan waktu acak dalam rentang 07:15 sampai 08:15
		$randomTimestamp = mt_rand($startTimestamp, $endTimestamp);

		// Memformat waktu menjadi format yang diinginkan (misalnya, H:i)
		$randomTime = date('H:i', $randomTimestamp);

		$date = date_create(date('Y-m-d') . ' ' . $randomTime);

		$data = [
			'id_user'       => auth()->user()->id,
			'check_in'      => 1,
			'date_check_in' => $date,
			'timeIN'        => $randomTime,
			'updated_at'    => $date,
		];

		dd($data);
		Absences::insert($data);
	}
}