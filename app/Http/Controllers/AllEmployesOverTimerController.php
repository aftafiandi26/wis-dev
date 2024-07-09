<?php

namespace App\Http\Controllers;

use App\FormOvertimes;
use App\Mail\Form\OvertimesMails;
use App\User;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;

use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AllEmployesOverTimerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function index()
    {
        $generalManager = User::find(69);

        $request_anggarda = User::find(4);

        $temp = 6;

        $coordinator = User::where('active', 1)->where('dept_category_id', $temp)->where('koor', 1)->orderBy('first_name', 'asc')->get();

        $projectManager = User::where('active', 1)->where('dept_category_id', $temp)->where('pm', 1)->orderBy('first_name', 'asc')->get();

        $hiddenCoor = null;
        $hiddenPM = null;
        $hiddenFri = null;

        $day = "Fri";

        $test = '2023-10-06';

        if (date("D")  === $day) {
            $hiddenFri = "hidden";
        }

        if (auth()->user()->koor == 1) {
            $hiddenCoor = "hidden";
        }

        if (auth()->user()->pm == 1) {
            $hiddenPM = "hidden";
            $hiddenCoor = "hidden";
        }

        $hidden = [
            'hiddenCoor' => $hiddenCoor,
            'hiddenPM' => $hiddenPM,
            'hiddenFri' => $hiddenFri,
        ];

        return view('all_employee.Form.Overtime.index_new', compact(['coordinator', 'projectManager', 'generalManager', 'hidden', 'day']));
    }

    public function index1()
    {
        $generalManager = User::find(69);

        $request_anggarda = User::find(4);

        $temp = 6;

        $coordinator = User::where('active', 1)->where('dept_category_id', $temp)->where('koor', 1)->orderBy('first_name', 'asc')->get();

        $projectManager = User::where('active', 1)->where('dept_category_id', $temp)->where('pm', 1)->orderBy('first_name', 'asc')->get();

        $hiddenCoor = null;
        $hiddenPM = null;
        $hiddenFri = null;

        $day = "Fri";

        $test = '2023-10-06';

        if (date("D")  === $day) {
            $hiddenFri = "hidden";
        }

        if (auth()->user()->koor == 1) {
            $hiddenCoor = "hidden";
        }

        if (auth()->user()->pm == 1) {
            $hiddenPM = "hidden";
            $hiddenCoor = "hidden";
        }

        $hidden = [
            'hiddenCoor' => $hiddenCoor,
            'hiddenPM' => $hiddenPM,
            'hiddenFri' => $hiddenFri,
        ];

        return view('all_employee.Form.Overtime.index', compact(['coordinator', 'projectManager', 'generalManager', 'hidden', 'day']));
    }

    public function post(Request $request)
    {
        $rules = [
            'startOvertime'    => 'required',
            'endOvertime'      => 'required',
            'coordinator'      => 'required',
            'reason'           => 'required|min:10',
            'vpn'              => 'required'
        ];

        $startOvertime = new DateTime($request->input('startOvertime'));
        $endOvertime = new DateTime($request->input('endOvertime'));
        $count_time = $endOvertime->diff($startOvertime);

        if ($count_time->invert === 0) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, Please check your time and date !!']));
            return redirect()->route('form/overtime/index');
        }

        $countHours = 24 * $count_time->d;

        $blockHours = $count_time->h + $countHours;

        if ($blockHours > 12) {
            Session::flash('reminder', Lang::get('messages.data_custom', ['data' => 'Sorry, You exceeded the fetching expiration time limit for remote access.
            Maximum limit of 12 hours a day, for that the system will convert the end limit of your remote access session. !!']));
            $endOvertime = $startOvertime->add(new DateInterval('PT' . 12 . 'H'));
        }

        $vpn = 1;
        if (empty($request->input('vpn'))) {
            $vpn = 0;
        }

        $gm = User::find(69);

        $data = [
            'user_id'           => auth()->user()->id,
            'type'              => 'Remote Access Request',
            'coor_id'           => $request->input('coordinator'),
            'app_coor'          => false,
            'gm_id'             => $gm->id,
            'app_gm'            => false,
            'startovertime'     => $request->input('startOvertime'),
            'endovertime'       => $endOvertime,
            'workfrom'          => $request->input('worker'),
            'vpn'               => $vpn,
            'reason'            => $request->input('reason'),
            'done'              => false,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('form/overtime/index')
                ->withErrors($validator)
                ->withInput();
        } else {
            FormOvertimes::create($data);

            $this->sendMails();

            Session::flash('success', Lang::get('messages.data_custom', ['data' => 'Form successfully created, please contact your leader to apprval']));
            return redirect()->route('form/progressing/index');
        }
    }

    public function post1(Request $request)
    {
        $vpnFriday = $request->input('vpnFriday');
        $vpnSaturday = $request->input('vpnSaturyday');
        $vpnSunday = $request->input('vpnSunday');

        $day = "Fri";

        if (date('D') !== $day) {
            $rules = [
                'startOvertime'    => 'required',
                'endOvertime'      => 'required',
                'coordinator'      => 'required',
                'reason'           => 'required|min:15'
            ];

            $coordinator = User::find($request->input('coordinator'));
        } else {
            if ($vpnFriday) {
                $rules = [
                    'startOvertime'    => 'required',
                    'endOvertime'      => 'required',
                    'coordinator'      => 'required',
                    'reason'           => 'required|min:15'
                ];

                $coordinator = User::find($request->input('coordinator'));
            }
        }

        if (date('D') !== $day) {
            if (empty($coordinator)) {
                Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, requesting approval unknown, please contact administratos!!']));
                return redirect()->route('form/overtime/index');
            }

            $startOvertime = new DateTime($request->input('startOvertime'));
            $endOvertime = new DateTime($request->input('endOvertime'));
            $count_time = $endOvertime->diff($startOvertime);

            if ($count_time->invert === 0) {
                Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, Please check your time and date !!']));
                return redirect()->route('form/overtime/index');
            }

            $countHours = 24 * $count_time->d;

            $blockHours = $count_time->h + $countHours;

            if ($blockHours > 12) {
                Session::flash('reminder', Lang::get('messages.data_custom', ['data' => 'Sorry, You exceeded the fetching expiration time limit for remote access.
                Maximum limit of 12 hours a day, for that the system will convert the end limit of your remote access session. !!']));
                $endOvertime = $startOvertime->add(new DateInterval('PT' . 12 . 'H'));
            }
        } else {
            if ($vpnFriday) {
                if (empty($coordinator)) {
                    Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, requesting approval unknown, please contact administratos!!']));
                    return redirect()->route('form/overtime/index');
                }

                $startOvertime = new DateTime($request->input('startOvertime'));
                $endOvertime = new DateTime($request->input('endOvertime'));
                $count_time = $endOvertime->diff($startOvertime);

                if ($count_time->invert === 0) {
                    Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, Please check your time and date !!']));
                    return redirect()->route('form/overtime/index');
                }

                $startOvertime = new DateTime($request->input('startOvertime'));
                $endOvertime = new DateTime($request->input('endOvertime'));
                $count_time = $endOvertime->diff($startOvertime);

                if ($count_time->invert === 0) {
                    Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, Please check your time and date !!']));
                    return redirect()->route('form/overtime/index');
                }

                $countHours = 24 * $count_time->d;

                $blockHours = $count_time->h + $countHours;

                if ($blockHours > 12) {
                    Session::flash('reminder', Lang::get('messages.data_custom', ['data' => 'Sorry, You exceeded the fetching expiration time limit for remote access.
                    Maximum limit of 12 hours a day, for that the system will convert the end limit of your remote access session. !!']));
                    $endOvertime = $startOvertime->add(new DateInterval('PT' . 12 . 'H'));
                }
            }
        }

        if ($request->input('vpnSaturday')) {
            if ($request->input('startSaturday') < $request->input('endOvertime')) {
                Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, Please pay attention your date inputted !!']));
                return redirect()->route('form/overtime/index');
            }
        }

        if ($request->input('vpnSunday')) {
            if ($request->input('startSunday') < $request->input('endSaturday')) {
                Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, Please pay attention your date inputted !!']));
                return redirect()->route('form/overtime/index');
            }
        }

        $coor_ap = false;
        $pm_ap = false;

        if (auth()->user()->koor == 1) {
            $coor_ap = true;
        }

        if (auth()->user()->pm == 1) {
            $coor_ap    = true;
            $pm_ap      = true;
        }

        $vpn = 1;
        if (empty($request->input('vpn'))) {
            $vpn = 0;
        }

        if (date('D') !== $day) {
            $data = [
                'user_id'           => auth()->user()->id,
                'type'              => 'Remote Access Request',
                'coor_id'           => $request->input('coordinator'),
                'app_coor'          => $coor_ap,
                'gm_id'             => $request->input('generalManager'),
                'app_gm'            => false,
                'startovertime'     => $request->input('startOvertime'),
                'endovertime'       => $endOvertime,
                'workfrom'          => $request->input('worker'),
                'vpn'               => $vpn,
                'reason'            => $request->input('reason'),
                'done'              => false,
            ];
        } else {
            if ($vpnFriday) {
                $data = [
                    'user_id'           => auth()->user()->id,
                    'type'              => 'Remote Access Request',
                    'coor_id'           => $request->input('coordinator'),
                    'app_coor'          => $coor_ap,
                    'gm_id'             => $request->input('generalManager'),
                    'app_gm'            => false,
                    'startovertime'     => $request->input('startOvertime'),
                    'endovertime'       => $endOvertime,
                    'workfrom'          => $request->input('worker'),
                    'vpn'               => $vpn,
                    'reason'            => $request->input('reason'),
                    'done'              => false,
                ];
            }
        }

        if (date('D') !== $day) {
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->route('form/overtime/index')
                    ->withErrors($validator)
                    ->withInput();
            }
        } else {
            if ($vpnFriday) {
                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return redirect()->route('form/overtime/index')
                        ->withErrors($validator)
                        ->withInput();
                }
            }
        }



        if ($request->input('vpnSaturday')) {
            $dataSaturday = $this->saturday($request->all(), $coor_ap, $pm_ap);
        }
        if ($request->input('vpnSunday')) {
            $dataSunday = $this->sunday($request->all(), $coor_ap, $pm_ap);
        }

        if (date('D') === $day) {
            if ($vpnFriday) {
                FormOvertimes::create($data);
            }
        } else {
            FormOvertimes::create($data);
        }

        if ($request->input('vpnSaturday')) {
            FormOvertimes::create($dataSaturday);
        }
        if ($request->input('vpnSunday')) {
            FormOvertimes::create($dataSunday);
        }

        $this->sendMails();

        Session::flash('success', Lang::get('messages.data_custom', ['data' => 'Form successfully created, please contact your leader to apprval']));
        return redirect()->route('form/progressing/index');
    }

    public function saturday(array $request, $coor_ap, $pm_ap)
    {
        $saturdayRules = [
            'startSaturday' => 'required',
            'endSaturday'   => 'required',
            'saturdayCoordinator'      => 'required',
            'reasonSaturday'           => 'required|min:15',
        ];

        $startSaturday = new DateTime($request['startSaturday']);
        $endSaturday = new DateTime($request['endSaturday']);
        $count_time_saturday = $endSaturday->diff($startSaturday);

        if ($count_time_saturday->invert !== 1) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, Please check your time and date on saturday !!']));
            return redirect()->route('form/overtime/index');
        }

        $countHours = 24 * $count_time_saturday->d;

        $blockHours = $count_time_saturday->h + $countHours;

        if ($blockHours > 12) {
            Session::flash('reminder', Lang::get('messages.data_custom', ['data' => 'Sorry, You exceeded the fetching expiration time limit for remote access.
            Maximum limit of 12 hours a day, for that the system will convert the end limit of your remote access session. !!']));
            $endSaturday = $startSaturday->add(new DateInterval('PT' . 12 . 'H'));
        }

        $dataSaturday = [
            'user_id'           => auth()->user()->id,
            'type'              => 'Remote Access Request (Weekend)',
            'coor_id'           => $request['saturdayCoordinator'],
            'app_coor'          => $coor_ap,
            'gm_id'             => $request['generalManager'],
            'app_gm'            => false,
            'startovertime'     => $request['startSaturday'],
            'endovertime'       => $endSaturday,
            'workfrom'          => $request['workderSaturday'],
            'vpn'               => true,
            'reason'            => $request['reasonSaturday'],
            'done'              => false,
        ];

        $validatorSaturay = Validator::make($request, $saturdayRules);

        // if ($validatorSaturay->fails()) {
        //     return redirect()->route('form/overtime/index')
        //         ->withErrors($validatorSaturay)
        //         ->withInput();
        // }

        return $dataSaturday;
    }

    public function sunday(array $request, $coor_ap, $pm_ap)
    {
        $sundayRules = [
            'startSunday' => 'required',
            'endSunday'   => 'required',
            'sundayCoordinator'      => 'required',
            'reasonSunday'          => 'required|min:15',
        ];

        $startSunday = new DateTime($request['startSunday']);
        $endSunday = new DateTime($request['endSunday']);
        $count_time_sunday = $endSunday->diff($startSunday);

        if ($count_time_sunday->invert !== 1) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, Please check your time and date on sunday !!']));
            return redirect()->route('form/overtime/index');
        }

        $countHours = 24 * $count_time_sunday->d;

        $blockHours = $count_time_sunday->h + $countHours;

        if ($blockHours > 12) {
            Session::flash('reminder', Lang::get('messages.data_custom', ['data' => 'Sorry, You exceeded the fetching expiration time limit for remote access.
            Maximum limit of 12 hours a day, for that the system will convert the end limit of your remote access session. !!']));
            $endSunday = $startSunday->add(new DateInterval('PT' . 12 . 'H'));
        }

        $dataSunday = [
            'user_id'           => auth()->user()->id,
            'type'              => 'Remote Access Request (Weekend)',
            'coor_id'           => $request['sundayCoordinator'],
            'app_coor'          => $coor_ap,
            'gm_id'             => $request['generalManager'],
            'app_gm'            => false,
            'startovertime'     => $request['startSunday'],
            'endovertime'       => $endSunday,
            'workfrom'          => $request['workderSunday'],
            'vpn'               => true,
            'reason'            => $request['reasonSunday'],
            'done'              => false,
        ];

        $validatorSunday = Validator::make($request, $sundayRules);

        // if ($validatorSunday->fails()) {
        //     return redirect()->route('form/overtime/index')
        //         ->withErrors($validatorSunday)
        //         ->withInput();
        // }

        return $dataSunday;
    }

    private function sendMails()
    {
        $formOvertime = FormOvertimes::with(['user', 'coordinator'])->where('user_id', auth()->user()->id)->latest()->first();

        Mail::to($formOvertime->coordinator->email)->send(new OvertimesMails($formOvertime));
    }

    public function summaryOvetime()
    {
        if (auth()->user()->koor == 1) {
            return redirect()->route('form/summary/overtime/coordinator/index');
        }

        if (auth()->user()->gm == 1) {
            return redirect()->route('form/summary/overtime/generalmanager/index');
        }

        return redirect()->back()->withErrors("sorry, this page cannot load")->withInput();
    }

    public function summaryOvertimeCoordinator()
    {
        return view('all_employee.Form.Overtime.Approval.Coordinator.summary');
    }

    public function dataSummaryCoordinator()
    {
        $data = FormOvertimes::where('coor_id', auth()->user()->id)->where('app_coor', '!=', 0)->get();
        return $this->datatablaseSummary($data);
    }

    public function summaryOvertimeProjectManager()
    {
        return view('all_employee.Form.Overtime.Approval.Manager.summary');
    }

    public function dataSummaryProjectManager()
    {
        $data = FormOvertimes::where('pm_id', auth()->user()->id)->where('app_pm', '!=', 0)->get();
        return $this->datatablaseSummary($data);
    }

    public function summaryOvertimeGeneralManager()
    {
        return view('all_employee.Form.Overtime.Approval.GeneralManager.summary');
    }

    public function dataSummaryGeneralManager()
    {
        $data = FormOvertimes::where('gm_id', auth()->user()->id)->where('app_gm', '!=', 0)->get();
        return $this->datatablaseSummary($data);
    }

    public function datatablaseSummary($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('fullname', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->getFullName();
            })
            ->addColumn('nik', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->nik;
            })
            ->addColumn('position', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->position;
            })
            ->editColumn('app_coor', function (FormOvertimes $form) {
                $app_coor =  new AllEmployesFormProgressingController;
                $app_coor = $app_coor->appCoordinator($form);
                return $app_coor;
            })
            ->editColumn('app_gm', function (FormOvertimes $form) {
                $app_gm = new AllEmployesFormProgressingController;
                $app_gm = $app_gm->appGeneralManager($form);

                return $app_gm;
            })
            ->editColumn('verify_it', function (FormOvertimes $form) {
                $return = $this->verifyIT($form);

                return $return;
            })
            ->make(true);
    }

    private function verifyIT($form)
    {
        $return = "";

        if ($form->verify_it == 1) {
            $return = "Verified";
        } elseif ($form->verify_it == 0) {
            $return = "Waiting";

            if ($form->app_coor === 2 or $form->app_pm === 2 or $form->app_gm === 2) {
                $return = "--";
            }
        } else {
            $return = "Unverified";
        }

        return $return;
    }

    public function rest()
    {
        return "hallo";
    }
}