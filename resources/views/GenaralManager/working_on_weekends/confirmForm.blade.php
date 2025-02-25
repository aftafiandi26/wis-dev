@extends('layout')

@section('title')
    Working on Weekends - Approved
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
    @include('asset_select2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'workingWeekends01' => 'active',
    ])
@stop
@push('style')
    <style>
        table a#detail {
            background-color: greenyellow;
            color: black;
            border-radius: 7px;
        }

        table a#detail:hover {
            background-color: rgb(143, 215, 36);
            color: black;
            border-radius: 7px;
        }

        .panel-heading {
            text-align: center;
        }

        span#homan {
            color: red;
        }

        .panel:hover {
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3);
        }
    </style>
@endpush
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Weekend Crew - Form</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <p>Coordinator : {{ $getId->coordinator()->getFullName() }}</p>
            <p>Producer : {{ $getId->producer()->getFullName() }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-condensed table-hover table-striped table-bordered" id="list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Employes</th>
                        <th>Position</th>
                        <th>Project</th>
                        <th>Started</th>
                        <th>ended</th>
                        <th>Work Status</th>
                        <th>Time</th>
                        <th>Change WIth:</th>
                        <th>Approved</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($works as $key => $work)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $work->user()->getFullname() }}</td>
                            <td>{{ $work->user()->position }}</td>
                            <td>{{ $work->project }}</td>
                            <td>{{ $work->start }}</td>
                            <td>{{ $work->end }}</td>
                            <td>{{ strtoupper($work->workStat) }}</td>
                            <td>{{ sprintf('%02d:%02d', $work->hourly, $work->minutely) }}</td>
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
    @include('assets_script_3')
    @include('assets_script_7')
@stop
