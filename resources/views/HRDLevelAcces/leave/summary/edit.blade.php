@extends('layout')

@section('title')
(hr) Edit Summary of Leave
@stop

@section('top')
@include('assets_css_1')
@include('assets_css_2')
@include('assets_css_4')
@stop

@section('navbar')
@include('navbar_top')
@include('navbar_left', [
'c173' => 'active'
])
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Summary of Leave (report)</h1>
    </div>
</div>
@foreach ($errors->all() as $e)
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissible fade-out">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ $e }}
        </div>
    </div>
</div>
@endforeach
<form action="{{ route('hrd/summary/leave/update', $id) }}" method="post">
    {{ csrf_field() }}
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading">
                <b>form leave transacton</b>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="request_by">Request by:</label>
                            <input type="text" class="form-control" id="request_by" value="{{ $data->first_name.' '.$data->last_name }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="nik">NIK:</label>
                            <input type="text" class="form-control" id="nik" value="{{ $data->nik }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="startLeaveDate" style="color: red;">Start Leave Date</label>
                            <input type="date" class="form-control" id="startLeaveDate" name="startLeaveDate" required value="{{ $data->leave_date }}">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="endLeaveDate" style="color: red;">End Leave Date</label>
                            <input type="date" class="form-control" id="endLeaveDate" name="endLeaveDate" required value="{{ $data->end_leave_date }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="period">Period:</label>
                            <input type="text" class="form-control" id="period" value="{{ $data->period }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="position">Positon:</label>
                            <input type="text" class="form-control" id="position" value="{{ $data->position }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="backWork" style="color: red;">Back to Work at</label>
                            <input type="date" class="form-control" id="backWork" name="backWork" value="{{ $data->back_work }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="joinDate">Join Date</label>
                            <input type="date" class="form-control" id="join_date" value="{{ $data->join_date }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="dept">Department</label>
                            <input type="text" class="form-control" id="dept" value="{{ $data->dept_category_name }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="category">Leave Category</label>
                            <select name="category" id="category" class="form-control" name="category">
                                @foreach ($category as $c)
                                <option value="{{ $c->id }}" @if ($c->id == $data->leave_category_id)
                                    selected
                                    @endif>{{ $c->leave_category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="request_day">Request Day</label>
                            <input type="text" name="request_day" id="request_day" class="form-control" value="{{ $data->total_day }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="endDate">End Date</label>
                            <input type="text" name="endDate" id="endDate" class="form-control" value="@if ($data->end_date) {{ $data->end_date }} @else --
                                @endif" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="destination">Province of Destination</label>
                            <select name="destination" id="destination" class="form-control">
                                <option value="">-select provinsi-</option>
                                @foreach ($provinsi as $p)
                                <option value="{{ $p['id'] }}" @if ($p['nama']==$data->r_departure)
                                    selected
                                    @endif>{{ $p['nama'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="city">City of Destination</label>
                            <input type="text" name="city" id="city" class="form-control" value="{{ $data->r_after_leaving }}">
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="available">Available Annual <sup>(+ forfeited)</sup></label>
                            <input type="text" name="available" id="available" class="form-control" value="{{ $annualCount->leaveCount()->annual_leave_balance  }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="reason">Reason of Leave</label>
                            <textarea name="reason" id="reason" cols="20" rows="5" class="form-control" maxlength="100" required>{{ $data->reason_leave }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="exdo">Total Exdo</label>
                            <input type="text" name="exdo" id="exdo" value="{{ $annualCount->leaveCount()->day_off_balance  }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-success">Update</button>
                            <a href="{{ route('hrd/summary/leave/index') }}" class="btn btn-sm btn-default">Back</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</form>
@stop

@section('bottom')
@include('assets_script_1')
@stop