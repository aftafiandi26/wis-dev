<div class="navbar-default sidebar grogol" role="navigation" style="margin-top: -10px">
    <div class="sidebar-nav navbar-collapse ">
        <ul class="nav" id="side-menu">
            <li>
                @if (Auth::user()->prof_pict === null)
                <a style="color: black">
                    <i>&nbsp&nbsp Hi, <b>{!! Auth::user()->first_name !!}</b></i>
                    @endif

                    @if (Auth::user()->prof_pict !== null)
                    <a style="color: black">
                        <img src="{{ asset('storage/app/prof_pict/'.Auth::user()->prof_pict.'') }}" class="img-circle" style="width: 50px; height: 50px;" alt="img">
                        <i>&nbsp&nbsp Hi, <b>{!! Auth::user()->first_name !!}</b></i>
                        @endif
                    </a>
            </li>

            <!-- Start Leave Menu -->
            @if (
            Auth::user()->user === 1 ||
            Auth::user()->hr === 1 ||
            Auth::user()->hd === 1 ||
            Auth::user()->hrd === 1 ||
            Auth::user()->koor === 1 ||
            Auth::user()->gm === 1 ||
            Auth::user()->spv === 1 ||
            Auth::user()->pm === 1 ||
            Auth::user()->producer === 1 ||
            Auth::user()->infiniteApprove === 1
            )
            <li>
                <a class="{!! $c2 or '' !!}" href="#"><i class="fa fa-fw fa-file-text-o"></i> Leave <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level {!! $c1u or '' !!}">


                    <li>
                        <a class="{!! $c16 or '' !!}" href="{!! URL::route('leave/apply') !!}"><i class="fa fa-fw fa fa-genderless"></i> Applying Leave </a>
                    </li>

                    <li>
                        <a class="{!! $c16 or '' !!}" href="#" id="undermaintanance" title="Applying Leave" time="02:00 PM"><i class="fa fa-fw fa fa-genderless"></i> Applying Leave (under maintenance) </a>
                    </li>

                    <li>
                        <a class="{!! $c16 or '' !!}" href="{!! URL::route('leave/transaction') !!}"><i class="fa fa-fw fa fa-genderless"></i> Leave Transaction </a>
                    </li>
                    @if (Auth::user()->koor === 1)
                    <li>
                        <a class="{!! $c16 or '' !!}" href="{!! URL::route('Koordinator/indexApproval') !!}"><i class="fa fa-fw fa fa-genderless"></i> Leave Approval <br><i>(Coordinator)</i></a>
                    </li>
                    <li>
                        <a class="{!! $c16 or '' !!}" href="{{ route('indexSummaryApprovedCoordinator') }}"><i class="fa fa-fw fa fa-genderless"></i> Summary Approved </a>
                    </li>
                    @endif

                    @if (Auth::user()->spv === 1)
                    <li>
                        <a class="{!! $c16 or '' !!}" href="{!! URL::route('Supervisor/indexApproval') !!}"><i class="fa fa-fw fa fa-genderless"></i> Leave Approval <br><i>(SPV)</i></a>
                    </li>
                    <li>
                        <a class="{!! $c16 or '' !!}" href="{{ route('indexSummaryApprovedSPV') }}"><i class="fa fa-fw fa fa-genderless"></i> Summary Approved</a>
                    </li>
                    @endif

                    @if (Auth::user()->pm === 1)
                    <li>
                        <a class="{!! $c16 or '' !!}" href="{!! URL::route('ProjectManager/indexApproval') !!}"><i class="fa fa-fw fa fa-genderless"></i> Leave Approval <i>(pm)</i></a>
                    </li>
                    <li>
                        <a class="{!! $c16 or '' !!}" href="{{ route('indexSummaryApprovedPM') }}"><i class="fa fa-fw fa fa-genderless"></i> Summary Approved </a>
                    </li>
                    @endif
                    <li>
                        <a class="{!! $c16 or '' !!}" href="{!! URL::route('employee/forfeited/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Forfeited</a>
                    </li>

                    @if (Auth::user()->hd === 1)
                    <li>
                        <a class="{!! $c16 or '' !!}" href="{!! URL::route('leave/HD_approval') !!}"><i class="fa fa-fw fa fa-genderless"></i> Leave Approval <br> <i>(<?php $dept =  DB::table('dept_category')->where('dept_category.id', '=', Auth::user()->dept_category_id)->value('dept_category_name');
                                                                                                                                                                        echo $dept; ?> Department)</i></a>
                    </li>
                    @if (auth::user()->dept_ApprovedHOD === 1)
                    <li>
                        <a class="{!! $c16 or '' !!}" href="{!! URL::route('head-of-approval/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Leave Approval <i>(Head of Department)</i></a>
                    </li>
                    @endif
                    @if (Auth::user()->dept_category_id === 6 )
                    <li>
                        <a class="{!! $c16 or '' !!}" href="{!! URL::route('index-Grafik') !!}"><i class="fa fa-fw fa fa-genderless"></i> Summary of Leave <br> <i></i></a>
                    </li>
                    @endif
                    <li>
                        <a class="{!! $c16 or '' !!}" href="{!! URL::route('index-History') !!}"><i class="fa fa-fw fa fa-genderless"></i> History of Leave
                        </a>
                    </li>
                    @endif
                    @if (Auth::user()->gm === 1)
                    <li>
                        <a class="{!! $c16 or '' !!}" href="{!! URL::route('leave/GM_approval') !!}"><i class="fa fa-fw fa fa-genderless"></i> Leave Approval <i>(gm)</i></a>
                    </li>
                    <li>
                        <a class="{!! $c16 or '' !!}" href="{!! URL::route('leave/alltransaction') !!}"><i class="fa fa-fw fa fa-genderless"></i> All Leave Transaction <i>(gm)</i></a>
                    </li>
                    @endif
                   
                    <li>
                        <a class="{!! $c16 or '' !!}" href="{!! URL::route('leave/calender/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Calender of Leave</a>
                    </li>
                    
                    @if (Auth::user()->hrd === 1)

                    <li>
                        <a class="{!! $c16 or '' !!}" href="{!! URL::route('leave/HRD_approval') !!}"><i class="fa fa-fw fa fa-genderless"></i> Leave Approval <i><br> (Approval For Head of Department)</i></a>
                    </li>
                    <li>
                        <a class="{!! $c16 or '' !!}" href="{!! URL::route('indexAllEmployee') !!}"><i class="fa fa-fw fa fa-genderless"></i> Leave Approval <i><br> (Employee Verification)</i></a>
                    </li>
            </li>
            @endif
            @if(Auth::user()->infiniteApprove === 1)
            <li>
                <a class="{!! $c16 or '' !!}" href="{!! URL::route('indexApprovalInfinite') !!}"><i class="fa fa-fw fa fa-genderless"></i> Kinema Leave Approval </a>
            </li>
            @endif

            @if (Auth::user()->hr === 1)
            <li>
                <a class="{!! $c16 or '' !!}" href="{!! URL::route('leave/HR_ver') !!}"><i class="fa fa-fw fa fa-genderless"></i> Leave Verification </a>
            </li>
            <li>
                <a class="{!! $c16 or '' !!}" href="{!! URL::route('indexSummaryVerified') !!}"><i class="fa fa-fw fa fa-genderless"></i> Summary Verified </a>
            </li>
            @endif
            @if (Auth::user()->level_hrd === 'Senior Pipeline')
            <li>
                <a class="{!! $c16 or '' !!}" href="{!! URL::route('indexApprovalPipeline') !!}"><i class="fa fa-fw fa fa-genderless"></i> Leave Approval <i>(Pipeline)</i> </a>
            </li>
            @endif
            @if (Auth::user()->level_hrd === 'Senior Technical')
            <li>
                <a class="{!! $c61 or '' !!}" href="{!! URL::route('PipeLineTechnicalIndexApproval') !!}"><i class="fa fa-fw fa fa-genderless"></i> Leave Approval <i>(beta)</i> </a>
            </li>
            @endif
            @if (Auth::user()->dept_category_id == 5 and Auth::user()->position == 'Admin Facility')
            <li>
                <a class="{!! $c61 or '' !!}" href="{!! URL::route('facilities/admin/verify') !!}"><i class="fa fa-fw fa fa-genderless"></i> Summary Leave <small>(Facility)</small></i> </a>
            </li>
            @endif
        </ul>
        </li>
        @endif

        <!-- End Leave Menu -->
        @if (Auth::user()->hrd === 1)
        <li>
            <a class="{!! $c4 or '' !!}" href=""><i class="fa fa-fw fa fa-bars"></i> Leave Report<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <!--<a class="{!! $c16 or '' !!}" href="{!! URL::route('management-data/leaveEntitledReport') !!}"><i class="fa fa-fw fa fa-genderless"></i> Leave Entitled Report-->
                    <!--</a>-->
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('hr/entitled/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Leave Entitled Report
                    </a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('management-data/historical') !!}"><i class="fa fa-fw fa fa-genderless"></i>Histori Leave Transaction</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="{!! $c4 or '' !!}" href=""><i class="fa fa-fw fa fa-cloud"></i> Management HRD<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('Employee-HRD') !!}"><i class="fa fa-fw fa fa-genderless"></i> Employee
                    </a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('rusun-HRD') !!}"><i class="fa fa-fw fa fa-genderless"></i> Rusun
                    </a>
                </li>
            </ul>
        </li>
        @endif
        <li>
            <a class="{!! $c30001 or '' !!}" href="{!! URL::route('attendance/index') !!}"><i class="fa fa-fw fa fa fa-bar-chart"></i> Attendance
            </a>
        </li>
        @if(auth::user()->dept_category_id === 3)
        <li>
            <a class="{!! $c3 or '' !!}" href=""><i class="fa fa-fw fa fa-soundcloud"></i> Public Holiday<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c16 or '' !!}" href="{{route('indexAllSummary')}}"><i class="fa fa-fw fa fa-genderless"></i> All of Summary </a>
                </li>
                @if(auth::user()->level_hrd === 'Payroll')
                <li>
                    <a class="{!! $c16 or '' !!}" href="{{route('indexUnpaidLeave')}}"><i class="fa fa-fw fa fa-genderless"></i> Unpaid Employee</a>
                </li>
                @endif
                @if(auth::user()->hr === 1)
                <li>
                    <a class="{!! $c3003 or '' !!}" href="{{route('indexViewOffYears')}}"><i class="fa fa-fw fa fa-genderless"></i> Public Holiday</a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        <!-- IT Menu -->
        @if (auth::user()->dept_category_id === 1)
        <!-- WS Availability -->

        <li>
            <a class="{!! $c3 or '' !!}" href="#"><i class="fa fa-fw fa-home"></i> WS Availability<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                 <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('workstations/availability/add') !!}"><i class="fa fa-fw fa fa-genderless"></i> Add Workstation</a>
                </li>
                 <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('workstations/availability/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> List Workstation</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('workstations/availability/idle/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Workstations Idle</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('workstations/availability/fails/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Workstations Fail</a>
                </li>
                  <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('workstations/availability/scrapped/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Workstations Scrapped</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('History/Availability') !!}"><i class="fa fa-fw fa fa-genderless"></i> History Workstation</a>
                </li>
                 <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('legend') !!}"><i class="fa fa-fw fa fa-genderless"></i> Legend Availability</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{!! $c3 or '' !!}" href="#"><i class="fa fa-fw fa-refresh"></i> Management User<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c16 or '' !!}" href="{{route('indexResetPassswordIT')}}"><i class="fa fa-fw fa fa-user"></i> Users</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{!! $c3 or '' !!}" href="#"><i class="fa fa-fw fa-registered"></i> Register Access<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c16 or '' !!}" href="{{route('it/registration/form/overtimes/index')}}"><i class="fa fa-fw fa fa-genderless"></i> List Request Remote Access</a>
                </li>
                 <li>
                    <a class="{!! $c15 or '' !!}" href="{{route('form/overtime/progress/index')}}"><i class="fa fa-fw fa fa-genderless"></i> Form is in progress</a>
                </li>
                <li>
                    <a class="{!! $c13 or '' !!}" href="{{route('form/overtime/summary/index')}}"><i class="fa fa-fw fa fa-genderless"></i> Summary Register</a>
                </li>
                 @if(auth()->user()->id === 226)
                     <li>
                        <a class="{!! $c13 or '' !!}" href="{{route('it/form/history/user/index')}}"><i class="fa fa-fw fa fa-genderless"></i> User of Duration Access</a>
                    </li>
                @endif
            </ul>
        </li>

        @if(auth::user()->id === 226)
        <li>
            <a class="{!! $c3 or '' !!}" href="#"><i class="fa fa-fw fa fa-wpforms"></i> Progress WIS<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">

                <li>
                    <a class="{!! $c3 or '' !!}" href="#"><i class="fa fa-fw fa fa-wpforms"></i> IT Request Form<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level {!! $c1u or '' !!}">
                        <li>
                            <a class="{!! $c16 or '' !!}" href="{{route('IndexForm')}}"><i class="fa fa-fw fa fa-genderless"></i> Requisition</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="{!! $c3 or '' !!}" href="#"><i class="glyphicon glyphicon-plus"></i> Create Employee<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level {!! $c1u or '' !!}">
                        <li>
                            <a class="{!! $c16 or '' !!}" href="{!! URL::route('index-audit') !!}"><i class="fa fa-fw fa fa-user-md"></i> Username & Email</a>
                        </li>
                        <li>
                            <a class="{!! $c16 or '' !!}" href="{!! URL::route('IT-EMploye_all') !!}"><i class="fa fa-fw fa fa-users"></i> Employes</a>
                        </li>
                        <li>
                            <a class="{!! $c16 or '' !!}" href="{!! URL::route('IT-EMploye_all') !!}"><i class="fa fa-fw fa fa-user-times"></i> Ex-Employes</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="{!! $c3 or '' !!}" href="#"><i class="fa fa-calendar-times-o"></i> Meeting Schedule<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level {!! $c1u or '' !!}">
                        <li>
                            <a class="{!! $c3 or '' !!}" href="{{route('meeting')}}"><i class="fa fa-fw fa fa-genderless"></i> Meeting Room</a>
                        </li>
                        <li>
                            <a class="{!! $c3 or '' !!}" href="{{route('meeting/audit')}}"><i class="fa fa-fw fa fa-genderless"></i> Meeting Auditing</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="{!! $c3 or '' !!}" href="#"><i class="fa fa-calendar-times-o"></i> HRD<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level {!! $c1u or '' !!}">
                        <li>
                            <a class="{!! $c123 or '' !!}" href="{{route('forfeited/encounter')}}"><i class="fa fa-fw fa fa-genderless"></i> Encounter Forfeit</a>
                        </li>
                        <li>
                            <a class="{!! $c123 or '' !!}" href="{{ route('dev/exdo/expired') }}" title="cutting exdo for exdo expired"><i class="fa fa-fw fa fa-genderless"></i> Exdo Expired</a>
                        </li>

                        <li>
                            <a class="{!! $c1232 or '' !!}" href="{{route('dev/indexProgressLeave')}}"><i class="fa fa-fw fa fa-genderless"></i> Leave on Progress</a>
                        </li>
                        <li>
                            <a class="{!! $c1233 or '' !!}" href="{{route('dev/histori/leave')}}"><i class="fa fa-fw fa fa-genderless"></i> History Leave</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="{!! $c4 or '' !!}" href="#"><i class="fa fa-calendar-times-o"></i> Attendance<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level {!! $c1u or '' !!}">
                        <li>
                            <a class="{!! $c223 or '' !!}" href="{{route('dev/attendance/reset')}}"><i class="fa fa-fw fa fa-genderless"></i> Reset Attendance</a>
                        </li>

                    </ul>
                </li>
            </ul>
        </li>
        <!-- End WS MAP -->

        <!-- Username and Email New User -->

        <!-- End WS MAP -->
        @endif
        <!-- asset IT -->
        <li>
            <a class="{!! $c3 or '' !!}" href="#"><i class="glyphicon glyphicon-plus"></i> Asset<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('asset-it') !!}"><i class="fa fa-fw fa fa-genderless"></i> IT</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('indexAssetPS') !!}"><i class="fa fa-fw fa fa-genderless"></i> Production Services</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{!! $c3 or '' !!}" href="#"><i class="glyphicon glyphicon-plus"></i> Inventory<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('indexUtamaAsset') !!}"><i class="fa fa-fw fa fa-genderless"></i> List Inventory</a>
                </li>
            </ul>
        </li>


        <li>
            <a class="{!! $c3 or '' !!}" href="#"><i class="fa fa-calendar-times-o"></i> WS Mapping<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c3 or '' !!}" href="{{route('indexMAP')}}"><i class="fa fa-fw fa fa-genderless"></i> 3D Animation</a>
                </li>
                <li>
                    <a class="{!! $c3 or '' !!}" href="{{route('indexLayout')}}"><i class="fa fa-fw fa fa-genderless"></i> Layout</a>
                </li>
                <li>
                    <a class="{!! $c3 or '' !!}" href="{{route('indexRender')}}"><i class="fa fa-fw fa fa-genderless"></i> Render</a>
                </li>
                <li>
                    <a class="{!! $c3 or '' !!}" href="{{route('indexITMap')}}"><i class="fa fa-fw fa fa-genderless"></i> IT Room</a>
                </li>
                <li>
                    <a class="{!! $c3 or '' !!}" href="{{route('indexMAPOfficer')}}"><i class="fa fa-fw fa fa-genderless"></i> Officer</a>
                </li>
            </ul>
        </li>


        @endif

        @if (Auth::user()->level_hrd === 'Senior Pipeline' or Auth::user()->level_hrd === 'Technical Director')
        <li>
            <a class="{!! $c3 or '' !!}" href="#"><i class="fa fa-fw fa-home"></i> WS Availability<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('pipeline/workstations/availability/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> List Workstations</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('pipeline/workstations/availability/idle/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Workstations Idle</a>
                </li>                
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('pipeline/workstations/availability/fails/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Workstations Fails</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('pipeline/workstations/availability/scrapped/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Workstations Scrapped</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('indexLegendAvailabilityPipeline') !!}"><i class="fa fa-fw fa fa-genderless"></i> Legend Availability</a>
                </li>
            </ul>
        </li>
        @endif
        @if(auth::user()->dept_category_id === 6 and auth::user()->hd === 1)
        <li>
            <a class="{!! $c3 or '' !!}" href="#"><i class="fa fa-fw fa-home"></i> WS Availability<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
               <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('pipeline/workstations/availability/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> List Workstations</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('pipeline/workstations/availability/idle/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Workstations Idle</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('pipeline/workstations/availability/fails/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Workstations Fails</a>
                </li>               
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('pipeline/workstations/availability/scrapped/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Workstations Scrapped</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('indexLegendAvailabilityManager') !!}"><i class="fa fa-fw fa fa-genderless"></i> Legend Availability</a>
                </li>
            </ul>
        </li>
        @endif
        @if(auth::user()->hr === 1)
        <li>
            <a class="{!! $c3 or '' !!}" href="#"><i class="fa fa-fw fa fa-pencil"></i> Stationery<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('stationery/atk/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Stationery Stock</i></a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('stationery/mineral/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Mineral Stock</i></a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('indexKategoryStationary') !!}"><i class="fa fa-fw fa fa-genderless"></i> Category Stationery</i></a>
                </li>
                <li>
                    <a class="{!! $c11 or '' !!}" href="{!! URL::route('stationery/summary/stock/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Summary Stationery</i></a>
                </li>
            </ul>
        </li>
        @endif
        <!-- End WS Availability -->

        <!-- End IT Menu -->
        <!-- Start HR Rusun Menu -->
        @if (Auth::user()->hr === 1)
        <li>
            <a class="{!! $c3 or '' !!}" href="#"><i class="fa fa-fw fa-home"></i> Dormitories <i>(hr)</i><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('hr/management/dorm/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Summary Dormitories</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="{!! $c4 or '' !!}" href="#"><i class="fa fa-fw fa-file-excel-o"></i> Leave Report<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <!--<a class="{!! $c16 or '' !!}" href="{!! URL::route('hr_mgmt-data/leaveEntitledReport') !!}"><i class="fa fa-fw fa fa-genderless"></i> Leave Entitled Report</a>-->
                     <a class="{!! $c16 or '' !!}" href="{!! URL::route('hr/entitled/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Leave Entitled Report
                    </a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('hr_mgmt-data/leaveTransactionReport') !!}"><i class="fa fa-fw fa fa-genderless"></i> Leave Transaction Report</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('hr_mgmt-data/historyTransactionReport') !!}"><i class="fa fa-fw fa fa-genderless"></i> History Leave Transaction Report</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('hr_mgmt-data/getchart') !!}"><i class="fa fa-fw fa fa-genderless"></i> Traffic Reporting</a>
                </li>
            </ul>
        </li>
        @endif
        @if (Auth::user()->level_hrd === 'GA')
        <li>
            <a class="{!! $c3 or '' !!}" href="#"><i class="fa fa-fw fa-home"></i> Rusun <i>(GA)</i><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('rusun') !!}"><i class="fa fa-fw fa fa-genderless"></i> Rusun Report</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="{!! $c3 or '' !!}" href="#"><i class="fa fa-fw fa-cogs"></i> Commitee <i>(GA)</i><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('dateSeacrhingCanteen') !!}"><i class="fa fa-fw fa fa-genderless"></i> List Canteen</a>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('DesiredFood') !!}"><i class="fa fa-fw fa fa-genderless"></i> Desired Food</a>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('UndesiredFood') !!}"><i class="fa fa-fw fa fa-genderless"></i> Undesired Food</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="{!! $c1 or '' !!}" href="#"><i class="fa fa-fw fa-bar-chart"></i> Attendance<i> (GA)</i><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c30003 or '' !!}" href="{!! URL::route('indexHrGaAttendace') !!}"><i class="fa fa-fw fa fa-genderless"></i> Summary</a>
                </li>
            </ul>
        </li>
        @endif
        @if (Auth::user()->dept_category_id === 3)
        <li>
            <a class="{!! $c3 or '' !!}" href="#"><i class="fa fa-fw fa fa-database"></i> Management Data <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('employee') !!}"><i class="fa fa-fw fa fa-genderless"></i> Employee</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('hr/ex-employes/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Ex-Employee</a>
                </li>
                <li>
                    <a class="{!! $c3 or '' !!}" href="#"><i class="fa fa-fw fa fa-users"></i> Contract Employee<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level {!! $c1u or '' !!}">
                        <li>
                            <a class="{!! $c16 or '' !!}" href="{!! URL::route('contract-employee') !!}"><i class="fa fa-fw fa fa-genderless"></i> End Contract</a>
                        </li>
                        <li>
                            <a class="{!! $c16 or '' !!}" href="{!! URL::route('indexEndEmployee') !!}"><i class="fa fa-fw fa fa-genderless"></i> Contract is Over Soon</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('privilege') !!}"><i class="fa fa-fw fa fa-genderless"></i> Employee Privilege</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('projectHRD') !!}"><i class="fa fa-fw fa fa-genderless"></i> Project</a>
                </li>
            </ul>
        </li>
        @endif

        <!-- Start IT Management Data Menu -->
        @if (Auth::user()->admin === 1)
        <li>
            <a class="{!! $c1 or '' !!}" href="#"><i class="fa fa-fw fa-cogs"></i> Management Data <i>(HRD)</i><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('mgmt-data/user') !!}"><i class="fa fa-fw fa fa-genderless"></i> Users</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('mgmt-data/All_User') !!}"><i class="fa fa-fw fa fa-genderless"></i> All Users</a>
                </li>
                <!--   <li>
                            <a class="{!! $c16 or '' !!}" href="{!! URL::route('mgmt-data/initial') !!}"><i class="fa fa-fw fa fa-genderless"></i> Entitlement Exdo Leave</a>
                        </li> -->
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('mgmt-data/department') !!}"><i class="fa fa-fw fa fa-genderless"></i> Department</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('mgmt-data/previlege') !!}"><i class="fa fa-fw fa fa-genderless"></i> User Previlege</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('HRD-Access') !!}"><i class="fa fa-fw fa fa-genderless"></i> Level Access HR</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('indexProduction') !!}"><i class="fa fa-fw fa fa-genderless"></i> Level Access Production</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('admin/statOfficer/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Level Access Officer</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('admin/head-of-department/access') !!}"><i class="fa fa-fw fa fa-genderless"></i> Level Access Head Department</a>
                </li>
            </ul>
        </li>
        <!--   <li> -->
        <!--   <a class="{!! $c1 or '' !!}" href="{!! URL::route('annual/index') !!}"><i class="fa fa-fw fa-cogs"></i> Annual Leave</a>

                <a class="{!! $c16 or '' !!} " href="{!! URL::route('annual/index') !!}" class="fa fa-fw fa-cogs"> Annual Post  1</a>-->

        <!--         </li> -->
        <li>
            <a class="{!! $c1 or '' !!}" href="#"><i class="fa fa-fw fa-cogs"></i> Trafic Light<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('getchart') !!}"><i class="fa fa-fw fa fa-genderless"></i> Trafic Chart</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('getonline') !!}"><i class="fa fa-fw fa fa-genderless"></i> Trafic Online</a>
                </li>

            </ul>
        </li>
        <li>
            <a class="{!! $c1 or '' !!}" href="#"><i class="fa fa-fw fa-cogs"></i> Maintanace<i>(adm)</i><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('Contract-Staff') !!}"><i class="fa fa-fw fa fa-genderless"></i> Contract</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('Birthday-Staff') !!}"><i class="fa fa-fw fa fa-genderless"></i> Birhtday</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="{!! $c1 or '' !!}" href="#"><i class="fa fa-fw fa-cogs"></i> Human Resource<i>(adm)</i><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c1 or '' !!}" href="#"><i class="fa fa-fw fa-cogs"></i> General Affair<i>(adm)</i><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level {!! $c1u or '' !!}">
                        <li>
                            <a class="{!! $c16 or '' !!}" href="{!! URL::route('indexVotingCanteenAdministrator') !!}"><i class="fa fa-fw fa fa-genderless"></i> Canteen</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="{!! $c1 or '' !!}" href="#"><i class="fa fa-fw fa-cogs"></i> Frontdesk<i>(adm)</i><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level {!! $c1u or '' !!}">
                        <li>
                            <a class="{!! $c16 or '' !!}" href="{!! URL::route('Birthday-Staff') !!}"><i class="fa fa-fw fa fa-genderless"></i> Statoonery</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        @endif
        <!-- End IT Management Data Menu -->

        <!-- Start HR Management Data Menu -->
        @if (Auth::user()->hr === 1)
        <li>
            <a class="{!! $c1 or '' !!}" href="#"><i class="fa fa-fw fa-cogs"></i> Management Data <i>(hr)</i><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('hr_mgmt-data/user') !!}"><i class="fa fa-fw fa fa-genderless"></i> Users</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('End-Contract-Staff') !!}"><i class="fa fa-fw fa fa-genderless"></i> Staff End Contract</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('hr_mgmt-data/initial') !!}"><i class="fa fa-fw fa fa-genderless"></i> Entitlement Exdo Leave</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('hr_mgmt-data/department') !!}"><i class="fa fa-fw fa fa-genderless"></i> Department</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('hr_mgmt-data/project') !!}"><i class="fa fa-fw fa fa-genderless"></i> Project</a>
                </li>
                <li>
                    <a class="{!! $c16 or '' !!}" href="{!! URL::route('hr_mgmt-data/previlege') !!}"><i class="fa fa-fw fa fa-genderless"></i> User Previlege</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="{!! $c17 or '' !!}" href="#"><i class="fa fa-fw fa-cogs"></i> Management Leave <i>(hr)</i><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c17 or '' !!}" href="{!! URL::route('hr_mgmt-data/leave/tempInitialLeave') !!}"><i class="fa fa-fw fa fa-genderless"></i> Initial Leave Transaction <i>(temp)</i></a>
                </li>
                <li>
                    <a class="{!! $c17 or '' !!}" href="{!! URL::route('forfeited/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Forfeited Leave (report)</i></a>
                </li>
                <li>
                    <a class="{!! $c19 or '' !!}" href="{!! URL::route('leave/reschedule/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Reschedule Leave</i></a>
                </li>
                <li>
                    <a class="{!! $c173 or '' !!}" href="{!! URL::route('hrd/summary/leave/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Summary Leave</i></a>
                </li>
            </ul>
        </li>
        <li>
            <a class="{!! $c18 or '' !!}" href="#"><i class="fa fa-fw fa-hospital-o"></i> Medical Records <i>(hr)</i><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c18 or '' !!}" href="{!! URL::route('index/sicked') !!}"><i class="fa fa-fw fa fa-genderless"></i> Employee Sicked</i></a>
                </li>
                <li>
                    <a class="{!! $c18 or '' !!}" href="{!! URL::route('sicked/summary') !!}"><i class="fa fa-fw fa fa-genderless"></i> Summary Sicked</i></a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{!! $c1 or '' !!}" href="{!! URL::route('hr_mgmt-data/leave/tempInitialLeave') !!}"><i class="fa fa-fw fa-bar-chart"></i> Attendance<i> (hr)</i><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">                
                <li>
                    <a class="{!! $c30003 or '' !!}" href="{!! URL::route('hr/summary/attendance/index') !!}"><i class="fa fa-fw fa fa-genderless"></i> Summary</a>
                </li>
            </ul>
        </li>
        @endif
        @if (auth::user()->dept_category_id === 6 and auth::user()->hd === 0)
        @if (auth::user()->dept_category_id === 6 and auth::user()->pm === 1)
        <li>
            <a class="{!! $c1 or '' !!}" href=" {!! URL::route('List-Member') !!} "><i class="fa fa-fw fa fa-user"></i> Members</a>
        </li>
        @endif
        @if (auth::user()->dept_category_id === 6 and auth::user()->koor === 1)
        <li>
            <a class="{!! $c1 or '' !!}" href=" {!! URL::route('List-Member-Koor') !!} "><i class="fa fa-fw fa fa-user"></i> Members</a>
        </li>
        @endif

        <li>
            <a class="{!! $c1 or '' !!}" href=" {!! URL::route('indexYourProjects') !!} "><i class="fa fa-fw fa-file"></i> Project Handled</a>
        </li>
        @endif

        <!-- End HR Management Data Menu -->
        <!-- Finance Menu  -->
        @if(auth::user()->dept_category_id === 2)
        <li>
            <a class="{!! $c100 or '' !!}" href="#"><i class="fa fa-bullseye"></i> Inventory<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c1001 or '' !!}" href="{{route('indexListSoftware')}}"><i class="fa fa-fw fa fa-genderless"></i> Software</a>
                </li>
                <li>
                    <a class="{!! $c1002 or '' !!}" href="{{route('indexListAssetTracking')}}"><i class="fa fa-fw fa fa-genderless"></i> Hardware</a>
                </li>
            </ul>
        </li>
        @endif
        <!-- End Finance Menu -->

        @if (Auth::user()->koor === 1)
        <li>
            <a class="{!! $c16 or '' !!}" href="{!! URL::route('Koordinator/Histori') !!}"><i class="fa fa-fw fa fa-file-text-o"></i> Histori Leave Transaction</a>
        </li>
        @endif
        @if (Auth::user()->spv === 1)
        <li>
            <a class="{!! $c16 or '' !!}" href="{!! URL::route('Supervisor/Histori') !!}"><i class="fa fa-fw fa fa-file-text-o"></i> Histori Leave Transaction</a>
        </li>
        @endif
        <!-- AllEmployee WS MAP -->
        @if(Auth::user()->dept_category_id != 1)
        <li>
            <a class="{!! $c3 or '' !!}" href="#"><i class="fa fa-calendar-times-o"></i> WS Mapping<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c3 or '' !!}" href="{{route('3D-Animation')}}"><i class="fa fa-fw fa fa-genderless"></i> 3D Animation</a>
                </li>
                <li>
                    <a class="{!! $c3 or '' !!}" href="{{route('2D-Layout')}}"><i class="fa fa-fw fa fa-genderless"></i> Layout</a>
                </li>
                <li>
                    <a class="{!! $c3 or '' !!}" href="{{route('Render-Area')}}"><i class="fa fa-fw fa fa-genderless"></i> Render</a>
                </li>
            </ul>
        </li>
        @endif
        @if(auth::user()->dept_category_id === 5)
        <li>
            <a class="{!! $c2 or '' !!}" href="#"><i class="fa fa-calendar-times-o"></i> List Transportation<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c16 or '' !!}" href="{{route('indexTransportationBUS')}}"><i class="fa fa-fw fa fa-genderless"></i>List Booking</a>
                </li>
            </ul>
        </li>
        <li>
            @endif
        <li>
            <a class="{!! $c3 or '' !!}" href="{{route('indexPolingKantinEmployee')}}"><i class="fa fa-fw fa fa-genderless"></i> Canteen Assessment</a>
        </li>
        @if(auth::user()->id === "226")
        <li>
            <a class="{!! $c3 or '' !!}" href="{{route('indexHousingAssessment')}}"><i class="fa fa-fw fa fa-spinner fa-spin"></i> Housing Assessment</a>
        </li>
        @endif
        <!-- End AllEmployee WS MAP -->
        <!-- sementara -->

        <li>
            <a class="{!! $c33 or '' !!}" href="#"><i class="fa fa-calendar-times-o"></i> Transportation<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c33 or '' !!}" href="{{route('bookingg')}}"><i class="fa fa-fw fa fa-genderless"></i> Booking Bus</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{!! $c33 or '' !!}" href="#"><i class="fa fa-line-chart"></i> Management Summary<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c34 or '' !!}" href="{{ route('headOfProduction/index') }}"><i class="fa fa-fw fa fa-genderless"></i> Attendance</a>
                </li>
            </ul>
        </li>

        {{-- overtime --}}
        <li>
            <a class="{!! $c63 or '' !!}" href="#"><i class="fa fa-fw fa fa-wpforms"></i> Production Form<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c663 or '' !!}" href="#"><i class="fa fa-fw fa fa-wpforms"></i> VPN<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level {!! $c11u or '' !!}">
                        {{--  --}}
                        @if (auth()->user()->koor == 1)
                            <li>
                                <a class="{!! $c64 or '' !!}" href="{{ route('form/approval/coordinator/index') }}"><i class="fa fa-fw fa fa-genderless"></i> Approval Form (coor)</a>
                            </li>
                        @endif
                        @if (auth()->user()->pm == 1 or auth()->user()->producer == 1)
                            <li>
                                <a class="{!! $c64 or '' !!}" href="{{ route('form/approval/projectmanager/index') }}"><i class="fa fa-fw fa fa-genderless"></i> Approval Form (VPN)</a>
                            </li>
                        @endif
                        @if (auth()->user()->gm == 1)
                            <li>
                                <a class="{!! $c68 or '' !!}" href="{{ route('form/approval/generalmanager/index') }}"><i class="fa fa-fw fa fa-genderless"></i> Approval Form (gm)</a>
                            </li>
                        @endif
                            <li>
                                <a class="{!! $c65 or '' !!}" href="{{ route('form/progressing/index') }}"><i class="fa fa-fw fa fa-genderless"></i> Form Status Registraion</a>
                            </li>
                            @if (auth()->user()->koor == 0 and auth()->user()->pm == 0 and auth()->user()->hd === 0 and auth()->user()->spv == 0)
                            <li>
                                <a class="{!! $c66 or '' !!}" href="{{ route('form/overtime/index') }}"><i class="fa fa-fw fa fa-genderless"></i> Form Remote Access Request VPN (WFH)</a>
                            </li>
                            @endif
                            @if(auth()->user()->level_hrd ==="Senior Pipeline" or auth()->user()->level_hrd === "Junior Pipeline")
                                <li>
                                    <a class="{!! $c15 or '' !!}" href="{{route('pipeline/form/overtime/progress/index')}}"><i class="fa fa-fw fa fa-genderless"></i> Form is in progress</a>
                                </li>                    
                            @endif
                            @if (auth()->user()->koor == 1 or auth()->user()->pm == 1 or auth()->user()->gm == 1)
                            <li>
                                <a class="{!! $c69 or '' !!}" href="{{ route('form/summary/overtime/index') }}"><i class="fa fa-fw fa fa-genderless"></i> Summary</a>
                            </li>
                            @endif
                        {{--  --}}
                    </ul>
                </li>               

                @if(auth()->user()->koor == 1 or auth()->user()->gm == 1 or auth()->user()->producer == 1 or auth()->user()->hr == 1)
                <li>
                    <a class="{!! $c664 or '' !!}" href="#"><i class="fa fa-fw fa fa-wpforms"></i> Weekend Crew<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level {!! $c12u or '' !!}">
                        @if (auth()->user()->koor == 1)
                        <li>
                            <a class="{!! $c69 or '' !!}" href="{{ route('coordinator/working/weekends/form') }}"><i class="fa fa-fw fa fa-genderless"></i> Form Registration</a>
                            <a class="{!! $c69 or '' !!}" href="{{ route('working-on-weekends/summary/index') }}"><i class="fa fa-fw fa fa-genderless"></i> Summary</a>
                        </li>
                        @endif
                        @if (auth()->user()->pm === 1)
                        <li>
                            <a class="{!! $c69 or '' !!}" href="{{ route('producer/weekend-crew/index') }}"><i class="fa fa-fw fa fa-genderless"></i> Approved (producer)</a>
                            <a class="{!! $c69 or '' !!}" href="{{ route('producer/weekend-crew/summary') }}"><i class="fa fa-fw fa fa-genderless"></i> Summary</a>
                        </li>    
                        @endif
                        @if (auth()->user()->gm == 1)
                        <li>
                            <a class="{!! $c69 or '' !!}" href="{{ route('gm/working-on-weekends/index') }}"><i class="fa fa-fw fa fa-genderless"></i> Approved (gm)</a>
                            <a class="{!! $c69 or '' !!}" href="{{ route('gm/working-on-weekends/summary') }}"><i class="fa fa-fw fa fa-genderless"></i> Summary</a>
                        </li>                            
                        @endif
                        @if (auth()->user()->hr == true)
                        <li>
                            <a class="{!! $c69 or '' !!}" href="{{ route('hrd/weekend-crew/index') }}"><i class="fa fa-fw fa fa-genderless"></i>Summary</a>
                            <a class="{!! $c69 or '' !!}" href="{{ route('hrd/weekend-crew/history/index') }}"><i class="fa fa-fw fa fa-genderless"></i> History</a>
                        </li>                            
                        @endif
                    </ul>
                </li>
                @endif
                
                @if (auth()->user()->koor == true)
                <li>
                    <a class="{!! $c33 or '' !!}" href="#"><i class="fa fa-users"></i> Freelancer<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level {!! $c1u or '' !!}">
                        <li>
                            <a class="{!! $c34 or '' !!}" href="{{ route('freelance/create') }}"><i class="fa fa-fw fa fa-genderless"></i> Create</a>
                            <a class="{!! $c34 or '' !!}" href="{{ route('freelance/view') }}"><i class="fa fa-fw fa fa-genderless"></i> List</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="{!! $cs34 or '' !!}" href="{{ route('coordinator/exdo-extends/index') }}"><i class="fa fa-fw fa fa-genderless"></i> Extends Exdo</a>                    
                </li>
                @endif

                @if(auth()->user()->producer == true)               
                <li>
                    <a class="{!! $cs34 or '' !!}" href="{{ route('producer/exdo-exntend/index') }}"><i class="fa fa-fw fa fa-genderless"></i> Extends Exdo</a>                    
                </li>
                @endif

            </ul>
        </li>

        <li>
            <a class="{!! $c63 or '' !!}" href="#"><i class="fa fa-fw fa fa-wpforms"></i> Guideline<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level {!! $c1u or '' !!}">
                <li>
                    <a class="{!! $c1 or '' !!}" href="{{route('guided')}}" style="color: red;"><i class="fa fa-fw fa fa-genderless"></i> Booklet</a>
                    <a class="{!! $c1 or '' !!}" href="{{ route('guideline/induction') }}"><i class="fa fa-fw fa fa-genderless"></i> Induction</a>
                    <a class="{!! $c1 or '' !!}" href="{{ route('guideline/orginazation') }}"><i class="fa fa-fw fa fa-genderless"></i> Orginazation Chart</a>
                    <a class="{!! $c1 or '' !!}" href="{{route('production/phonebook')}}"><i class="fa fa-fw fa fa-genderless" aria-hidden="true"></i> Phone Book</a>                  
                    <a class="{!! $c1 or '' !!}" href="https://3.basecamp.com/4952258/buckets/20262700/message_boards/7482724197" target="_blank" rel="noopener noreferrer"><i class="fa fa-fw fa fa-genderless"></i> Wiki</a>
                    <a class="{!! $c1 or '' !!}" href="{{ route('guideline/wfh') }}"><i class="fa fa-fw fa fa-genderless"></i> WFH</a>                 
                </li>                

            </ul>
        </li>
        <li>
            <a class="{!! $c1 or '' !!}" href=" {!! URL::route('structute-organitation') !!} "><i class="fa fa-fw fa fa-sitemap"></i> Organizational Chart</a>
        </li>
        <li>
            <a class="{!! $c1994 or '' !!}" href="{{ route('guidelines') }}"><i class="fa fa-fw fa fa-book"></i> Troubleshooting Guidelines (WFH)</a>
        </li> 

        <?php if (auth::user()->id === 226) : ?>
            <li>
                <a class="{!! $c1994 or '' !!}" href="{{ route('indexEmployeeExitInterview') }}"><i class="fa fa-fw fa fa-book"></i> Form HR</a>
            </li>
        <?php endif ?>
        
        </ul>

    </div>
</div>
