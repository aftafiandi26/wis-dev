@extends('layout')

@section('title')
    Form Access Remote
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
    <link rel="stylesheet" href="{{ asset('assets/js/datetimepicker/jquery.datetimepicker.min.css') }}">
    <style>
        .text-red {
            color: red;
        }
        .text-lightgray {
            color: lightgray; 
        }
    </style>
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c66' => 'active'
    ])
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Registration Form</h1>
    </div>
</div>

@foreach ($errors->all() as $message)
<div class="row">
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <label for="">{{$message}}<label>
    </div>
</div>
@endforeach

<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading text-center"><b>Form Remote Access Request VPN</b></div>
        <div class="panel-body">

            <form action="{{ route('form/overtime/post') }}" method="post" class="needs-validation">
                {{ csrf_field() }}                        
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="requested">Request By:</label>
                            <input type="text" name="requested" id="requested" class="form-control" value="{{ auth()->user()->getFullName() }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="nik">NIK:</label>
                            <input type="text" name="nik" id="nik" class="form-control" value="{{ auth()->user()->nik }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-4"></div>

                    <div class="col-lg-2" id="startPicker"> 
                        <div class="form-group">
                            <label for="startOvertime" class="text-red">Start:</label>
                            <div class="input-group date" data-date-format="dd.mm.yyyy">
                                <input type="text" name="startOvertime" id="startOvertime" class="form-control" placeholder="dd.mm.yyyy" required>
                                <span id="startOvertime"></span>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2" id="endPicker">
                        <div class="form-group">
                            <label for="endOvertime" class="text-red">End:</label>
                            <div class="input-group date" data-date-format="dd.mm.yyyy">
                                <input type="text" name="endOvertime" id="endOvertime" class="form-control"placeholder="dd.mm.yyyy" required>
                                <span id="endOvertime"></span>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="period">Period:</label>
                            <input type="text" name="period" id="period" class="form-control" value="{{ date('Y') }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="position">Position:</label>
                            <input type="text" name="position" id="position" class="form-control" value="{{ auth()->user()->position }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-2" id="workFrom">
                        <div class="form-group">
                            <label for="worker" class="text-red">Work From..</label>
                            <select name="worker" id="worker" class="form-control" required>
                                <option value="1">Home</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="joinDate">Join Date:</label>
                            <input type="text" name="joinDate" id="joinDate" class="form-control" value="{{ auth()->user()->join_date }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="endDate">End Date:</label>
                            <input type="text" name="endDate" id="endDate" class="form-control" value="{{ auth()->user()->end_date }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-2" id="selectCoor">
                        <div class="form-group">
                            <label for="coordinator">Your Need Approval:</label>
                            <select name="coordinator" id="coordinator" class="form-control"  required>
                                <option value=""><span class="text-lightgray">-select approval-</span></option>
                                <optgroup label="Coordinator">
                                    @foreach ($coordinator as $coor)
                                        <option value="{{ $coor->id }}">{{ $coor->getFullName() }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Project Manager & Producer">
                                    @foreach ($projectManager as $project)
                                        <option value="{{ $project->id }}">{{ $project->getFullName() }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="department">Department:</label>
                            <input type="text" name="department" id="department" class="form-control" value="{{ auth()->user()->department['dept_category_name'] }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                </div>

                <div class="row" id="rowVPN">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="checkbox-inline" for="vpn"><input type="checkbox" name="vpn" id="vpn" checked>Open Remote Access (VPN)</label>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                </div>

                <div class="row">
                    <div class="col-lg-4" id="divReason">
                        <div class="form-group">
                            <label for="reason">Reason:</label>
                            <textarea name="reason" id="reason" cols="30" rows="10" class="form-control"  placeholder="minimal 15 character" required></textarea>
                        </div>
                    </div>
                </div>    

                <div class="row">
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        <a href="{{ route('form/progressing/index')}}" class="btn btn-sm btn-default">Form List</a>
                    </div>
                </div>
            </form>

        </div>
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
   <script src="{{ asset('assets/js/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
@stop

@section('script')

$('input#startOvertime').datetimepicker({});
$('input#endOvertime').datetimepicker({});

$("input#startOvertime").hover(
    function() {
        const inputPosition = $(this).offset();
        const hoverDiv = $("span#startOvertime");
        hoverDiv.css({
            top: inputPosition.top + $(this).outerHeight(),
            left: inputPosition.left
        });
        hoverDiv.show();
    },
    function() {       
        $("span#startOvertime").hide();
    }
);
    $("input#endOvertime").hover(
        function() {
            // Saat mouse masuk, tampilkan div hover dan sesuaikan posisinya
            const inputPosition = $(this).offset();
            const hoverDiv = $("span#endOvertime");
            hoverDiv.css({
                top: inputPosition.top + $(this).outerHeight(),
                left: inputPosition.left
            });
            hoverDiv.show();
        },
        function() {
            // Saat mouse keluar, sembunyikan div hover
            $("span#endOvertime").hide();
        }
    );
@stop
