@extends('layout')

@section('title')
    (hr) Index Summary of Leave - Detail {{ $leaveCategory->leave_category_name }} {{ $user->first_name.' '.$user->last_name }}
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
        <h1 class="page-header">
            Detail Summary {{ $leaveCategory->leave_category_name }} {{ $user->first_name.' '.$user->last_name }}
        </h1>
    </div>
</div>
<div class="row" style="margin-bottom: 10px;">
    <div class="col-lg-12">
        <form action="{{ route('hr/summary/leave/download/excel/employee') }}" method="post">
            <a href="{{ route('hrd/summary/leave/index') }}" class="btn btn-sm btn-default">back</a>
            {{ csrf_field() }}
            <input type="text" value="{{ $id }}" name="id" hidden>
            <input type="text" value="{{ $category }}" name="category" hidden>
            <input type="text" value="{{ $year }}" name="year" hidden>
            <button type="submit" class="btn btn-sm btn-default">Excel</button>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-condensed table-bordered table-hover" id="tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Employee</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Leave Date</th>
                    <th>End Leave Date</th>
                    <th>Back to Work</th>
                    <th>Total Day</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $value)
                <tr>
                    <td>{{ ++$key  }}</td>
                    <td>{{ $value->request_nik }}</td>
                    <td>{{ $value->request_by }}</td>
                    <td>{{ $value->request_dept_category_name }}</td>
                    <td>{{ $value->request_position }}</td>
                    <td>{{ $value->leave_date }}</td>
                    <td>{{ $value->end_leave_date }}</td>
                    <td>{{ $value->back_work }}</td>
                    <td>{{ $value->total_day }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')  
@stop


