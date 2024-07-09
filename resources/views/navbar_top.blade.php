<div class="paijo">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{!! URL::route('index') !!}">      
            <img width="60px" height="40px" class="img" src="{{asset('assets/Graphic2.png')}}" alt="logo">
        </a>
        <a href="{!! URL::route('index') !!}" class="navbar-brand text-center" id="ceklek"><b>Wide Information System</b><br> <span style="font-size: 14px;" class="anic">Kinema Systrans Multimedia</span><br><span style="font-size: 14px;" class="anic2">Infinite Studios</span></a>        
    </div>
    
    <ul class="nav navbar-top-links navbar-right santa">
        <li class="dropdown">
            <a class="dropdown-toggle  " data-toggle="dropdown" href="#">
                <i></i> {!! Auth::user()->first_name !!} {!! Auth::user()->last_name !!} <i class="fa fa-caret-down"></i>
            </a>
    
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="{!! URL::route('employes/profile/index') !!}"><i class="fa fa-user fa-fw" aria-hidden="true"></i> Profile </a>
                </li>
                <li>
                    <a href="{!! URL::route('get_change-password') !!}"><i class="fa fa-lock fa-fw"></i> Change Password </a>
                </li>
    
                <li class="divider"></li>
    
                <li>
                    <a href="{!! URL::route('logout') !!}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
        </li>
    </ul>
</div>