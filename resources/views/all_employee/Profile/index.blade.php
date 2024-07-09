@extends('layout')

@section('title')
    Account Profile
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
    <style>
        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            left: 14rem;
            top: 14rem;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .image {
            opacity: 1;
            width: 250px;
            max-height: 320px;
        }

        .imgHover:hover .image {
            opacity: 0.3;
        }

        .imgHover:hover .middle {
            opacity: 1;
        }

        .rowBottom {
            margin-bottom: 15px;
        }
    </style>
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active'
    ])
@stop
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Account Profile</h1>
        </div>
    </div>
    @foreach ($errors->all() as $message)
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> {{ $message }}
              </div>
        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-lg-12">
           <div class="col-lg-2">
                <span class="imgHover">
                    <img src="{{ asset('storage/app/prof_pict/'.Auth::user()->prof_pict.'') }}" alt="img" srcset="" class="img img-circle img-thumbnail image">
                    <button type="button" class="btn btn-default btn-sm middle" data-toggle="modal" data-target="#myModal">Change</button>
                </span>
            </div>
            <div class="col-lg-10">
                <div class="row rowBottom">
                    <div class="col-lg-12">
                        <div class="col-lg-2">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->first_name.' '.auth()->user()->last_name }}" id="name" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->nik }}" readonly id="nik">
                        </div>
                        <div class="col-lg-2">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->position }}" readonly id="position">
                        </div>
                        <div class="col-lg-2">
                            <label for="department">Department</label>
                            <input type="text" class="form-control" value="{{ $dept->dept_category_name }}" readonly id="department">
                        </div>                       
                    </div>
                </div>
                <div class="row rowBottom">
                    <div class="col-lg-12">
                        <div class="col-lg-2">
                            <label for="emp_stat">Employee Status</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->emp_status}}" id="emp_stat" readonly>
                        </div>     
                        <div class="col-lg-2">
                            <label for="joinDate">Join Date</label>
                            <input type="text" class="form-control" value="{{ $joinDate }}" id="joinDate" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label for="endDate">End of Contract</label>
                            <input type="text" class="form-control" value="{{ $endDate }}" id="endDate" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label for="workMail">Framework Mail</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->email }}" id="workMail" readonly>
                        </div>
                    </div>
                </div>
                <div class="row rowBottom">
                    <div class="col-lg-12">
                        <div class="col-lg-2">
                            <label for="mainProject">Project 1</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ $yourProjects['mainProject'] }}" id="mainProject">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalProject" data-role={{ route('employes/profile/modal', [1, auth()->user()->project_category_id_1]) }} id="ajaxModalProject" title="Change your project"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label for="secondProject">Project 2</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ $yourProjects['secondProject'] }}" id="secondProject">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalProject" data-role={{ route('employes/profile/modal', [2, auth()->user()->project_category_id_2]) }} id="ajaxModalProject" title="Change your project"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label for="thirdProject">Project 3</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ $yourProjects['thirdProject'] }}" id="thirdProject">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalProject" data-role={{ route('employes/profile/modal', [3, auth()->user()->project_category_id_3]) }} id="ajaxModalProject" title="Change your project"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label for="fourProject">Project 4</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ $yourProjects['fourProject'] }}" id="fourProject">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalProject" data-role={{ route('employes/profile/modal', [4, auth()->user()->project_category_id_3]) }} id="ajaxModalProject" title="Change your project"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                       
                </div>
            </div>
        </div>        
    </div>

    <div class="row">
       <div class="col-lg-12">
        <h3>Personal Data</h3>
       </div>       
    </div>
    <hr>
    <div class="row rowBottom">
        <div class="col-lg-12">
            <div class="col-lg-2">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" value="{{ auth()->user()->first_name }}" id="firstName">
            </div>
            <div class="col-lg-2">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" value="{{ auth()->user()->last_name }}" id="lastName">
            </div>
            <div class="col-lg-2">
                <label for="dateBirth">Date of Birth</label>
                <input type="date" id="dateBirth" class="form-control" value="{{ auth()->user()->dob }}">
            </div>
            <div class="col-lg-2">
                <label for="placeBirth">Place of Birth</label>
                <input type="text" id="placeBirth" class="form-control" value="{{ auth()->user()->pob }}">
            </div>
            <div class="col-lg-2">
                <label for="province">Province</label>
                <input type="text" class="form-control" id="province" value="{{ auth()->user()->province }}">
            </div>
            <div class="col-lg-2">
                <label for="gender">Gender</label>                
                <select name="" id="gender" class="form-control">
                    <option value="Male" @if (auth()->user()->gender == "Male")
                        selected
                    @endif>Male</option>
                    <option value="Female" @if (auth()->user()->gender == "Female")
                        selected
                    @endif>Female</option>
                </select>
            </div>
            
        </div>
    </div>
    <div class="row rowBottom">
        <div class="col-lg-12">
            <div class="col-lg-2">
                <label for="nickname">Nickname</label>
                <form action="{{ route('employes/profile/post/nickname') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" name="nickname" id="nickname" class="form-control" value="{{ auth()->user()->nickname }}">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-2">
                <label for="idCard">ID Card</label>
                <input type="text" class="form-control" id="idCard" value="{{ auth()->user()->id_card }}">
            </div>
            <div class="col-lg-2">              
                <form action="{{ route('employes/profile/post/phone') }}" method="post">                    
                    {{ csrf_field() }}
                    <label for="phoneNumber">Phone Number</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="phoneNumber" value="{{ auth()->user()->phone }}" name="phoneNumber">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            </div>
                        </div>
                </form>
            </div>
            <div class="col-lg-2">
                <label for="address">Domicile</label>
                <input type="text" class="form-control" id="address" value="{{ auth()->user()->address }}">
            </div>
            <div class="col-lg-2">
                <label for="area">Area</label>
                <input type="text" class="form-control" value="{{ auth()->user()->area }}" id="area">
            </div>
            <div class="col-lg-2">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" value="{{ auth()->user()->city }}">
            </div>            
        </div>
    </div>
    <div class="row rowBottom">
        <div class="col-lg-12">
            <div class="col-lg-2">
                <label for="education">Education</label>
                <input type="text" class="form-control" id="education" value="{{ auth()->user()->education }}">
            </div>
            <div class="col-lg-2">
                <label for="education_institution">Education Institution</label>
                <form action="{{ route('employes/profile/post/educationInstitution') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" class="form-control" id="education_institution" name="education_institution" value="{{ auth()->user()->education_institution }}">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-2">
                <label for="marital">Marital Status</label>
                <input type="text" class="form-control" id="marital" value="{{ auth()->user()->marital_status }}">
            </div>
            <div class="col-lg-2">
                <label for="npwp">NPWP</label>
                <input type="text" class="form-control" id="npwp" value="{{ auth()->user()->npwp }}">
            </div>
            <div class="col-lg-2">
                <label for="kk">KK</label>
                <input type="text" class="form-control" id="kk" value="{{ auth()->user()->kk }}">
            </div>
            <div class="col-lg-2">
                <label for="religion">Religion</label>
                <input type="text" class="form-control" id="religion" value="{{ auth()->user()->religion }}">
            </div>                                
        </div>
    </div>
    <div class="row rowBottom">
        <div class="col-lg-12">
            <div class="col-lg-2">
                <label for="ketenagakerjaan">BPJS Ketenagakerjaan</label>
                <input type="text" class="form-control" id="Ketenagakerjaan" value="{{ auth()->user()->bpjs_ketenagakerjaan }}">
            </div>  
            <div class="col-lg-2">
                <label for="kesehatan">BPJS Kesehatan</label>
                <input type="text" class="form-control" id="kesehatan" value="{{ auth()->user()->bpjs_kesehatan  }}">
            </div>
            <div class="col-lg-2">
                <label for="dormRoom">Dorm Room</label>
                <form action="{{ route('employes/profile/post/dormRoom') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" class="form-control" id="dormRoom" name="dormRoom" value="{{ auth()->user()->rusun }}">                        
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-2">
                <label for="dormStatus">Dorm Status</label>
                <form action="{{ route('employes/profile/post/dormStat') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <select name="dormStatus" id="dormStatus" class="form-control">
                            @foreach ($dorm_stat as $share)
                                <option value="{{ $share }}" @if ($share == auth()->user()->rusun_stat)
                                    selected
                                @endif>{{ $share }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <form action="{{ route('employes/profile/post', auth()->user()->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Picture</h4>
                </div>
                <div class="modal-body">
                    <input type="file" name="imgUpload" id="imgUpload" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success">Change</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>

    </div>
  </div>

  <div class="modal fade" id="modalProject" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" id="modal-content">
            <!--  -->
        </div>
    </div>
</div>

@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_3')
    @include('assets_script_2')
@stop

@section('script')
$(document).on('click','#ajaxModalProject',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id, 
        success: function(e) {
            $("#modal-content").html(e);
        }
    });
});
@stop
