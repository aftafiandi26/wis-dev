@extends('layout')

@section('title')
    Summary Attendance (Onsite)
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
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
            <h1 class="page-header">Summary Attendance (Onsite of Studios)</h1>
        </div>
    </div>
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-lg-10">
            <form action="{{ route('attendance/finger/search') }}" method="get" class="form-inline pull-left">
                {{ csrf_field() }}
                <label for="findName">Name :</label>
                <input type="text" name="findName" placeholder="find name..." class="form-control" id="findName">
                <input type="hidden" name="date1" value="{{ request('date1') }}">
                <input type="hidden" name="date2" value="{{ request('date2') }}">
                <button type="submit" class="btn btn-sm btn-default">find</button>
            </form>
        </div>
        <div class="col-lg-2">
            <a href="{{ route('attendance/onsite') }}" class="btn btn-sm btn-default pull-right">back to page</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped table-hover" width="100%" id="attendance">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Employe</td>
                        <td>Position</td>
                        <td>Department</td>
                        <td>Time</td>
                        <td>Status</td>
                        <td>Date</td>
                        <td>Phone (ID)</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fingerPrint as $finger => $spot)
                    @php
                        $user = App\User::where(function ($query) use ($spot) {
                                $query->where('first_name', $spot->first_name)->orWhere('last_name', $spot->last_name);
                        })->first();

                        $dept = App\Dept_Category::find($user['dept_category_id']);
                    @endphp
                        <tr>
                            <td>{{ $finger + $fingerPrint->firstItem() }}</td>
                            <td>{{ $spot->first_name }} {{ $spot->last_name }}</td>
                            <td>{{ $user['position'] }}</td>
                            <td>{{ $dept['dept_category_name'] }}</td>
                            <td>{{ date('H:i:s', strtotime($spot->scan_date)) }}</td>
                            <td>
                                @if ($spot->verify_mode == "1")
                                    In
                                @elseif ($spot->verify_mode == "2")
                                    Out
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                {{ date('Y-m-d', strtotime($spot->scan_date)) }}
                            </td>
                            <td>{{ $user['phone'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <span class="pull-left">Showing {{ $fingerPrint->firstItem() }} to {{ $fingerPrint->lastItem() }} from {{ $fingerPrint->total() }} data</span>
            <span class="pull-right">{{ $fingerPrint->appends(request()->query())->links() }}</span>
        </div>
    </div>
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
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
    @include('assets_script_4')
    @include('assets_script_7')
@stop

@section('script')

@stop
