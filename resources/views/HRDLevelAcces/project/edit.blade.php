@extends('layout')

@section('title')
    (hr) Change Name Project
@stop

@section('top')
    @include('assets_css_1')
    @include('asset_select2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c1u' => 'collape in',
        'c1' => 'active',
        'c15' => 'active',
    ])
@stop
@push('style')
    <style>
        #save {
            margin-right: 5px;
        }
    </style>
@endpush
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Name Project</h1>
        </div>
    </div>
    @include('asset_feedbackErrors')
    <!-- 'route' => ['hr_mgmt-data/previlege/update-previlege', $users->id], -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <b>Form Edit Name Project</b>
                    </h5>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('postEditprojectHRD', $project->id) }}" method="post" id="formPost"
                                class="form-inline">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="group">Group From:</label>
                                    <select name="group" id="group" class="form-control" required>
                                        <option value=""></option>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}"
                                                @if ($group->id == $project->group) selected @endif>{{ $group->group_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Project Name:</label>
                                    <input type="text" class="form-control" name="name" id="name" required
                                        value="{{ $project->project_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select name="status" id="status" required class="form-control">
                                        <option value="1" @if ($project->actived == true) selected @endif>Active
                                        </option>
                                        <option value="0" @if ($project->actived == false) selected @endif>Deactive
                                        </option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{ route('projectHRD') }}" class="btn btn-sm btn-default pull-right">Back</a>
                            <button class="btn btn-sm btn-success pull-right" id="save">Update</button>
                        </div>
                    </div>
                </div>
                <div class="panel-footer"></div>
            </div>
        </div>
    </div>
@stop

@section('bottom')
    @include('assets_script_1')
@stop

@push('js')
    <script>
        $(document).ready(function() {
            $('#group').select2({
                placeholder: 'Select this project'
            });
            document.getElementById('save').addEventListener('click', function() {
                document.getElementById('formPost').submit();
            });
        })
    </script>
@endpush
