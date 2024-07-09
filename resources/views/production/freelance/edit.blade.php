@extends('layout')

@section('title')
    Edit Freelance
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c1' => 'active'
    ])
@stop

@push('style')
@include('asset_select2')
<style>
    .text-red {
        color: red;
    }
</style>
@endpush

@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Data Freelance</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default" id="formDate">
            <div class="panel-heading">Form Data</div>
            <div class="panel-body">
                <form action="{{ route('freelance/update', $data->id) }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">                        
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="firstName">First Name:</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required placeholder="first name" value="{{ isset($data->first_name) ? $data->first_name : '' }}">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="lastName">Last Name:</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required placeholder="last name" value="{{ isset($data->last_name) ? $data->last_name : '' }}">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="joinDate">Join Date:</label>
                                <input type="date" class="form-control" id="joindDate" name="joinDate" value="{{ $data->joinDate }}" required>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="endDate">End Date:</label>
                                <input type="date" class="form-control" id="endDate" name="endDate" value="{{ $data->endDate }}" required>
                            </div>
                        </div>                                              
                    </div>

                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="project">Project:</label>
                                <select name="project[]" id="project" class="form-control" multiple="multiple" required>
                                    <option></option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}" {{ in_array($project->id, $selectedProjects) ? 'selected' : '' }}>{{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <input type="text" class="form-control" value="Freelance" name="status" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="position">Position:</label>
                                <input type="text" class="form-control" id="position" name="position" required placeholder="position" value="{{ isset($data->position) ? $data->position : '' }}">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="personal email" value="{{ isset($data->email) ? $data->email : '' }}">
                            </div>
                        </div>                         
                    </div>

                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-warning">Update</button>
                                <a href="{{ route('freelance/view') }}" class="btn btn-sm btn-default">View</a>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
     @include('assets_script_7')
@stop

@section('script')
    $('#project').select2({
        placeholder: "Select a project",
        allowClear: true,
        tags: true,
        tokenSeparators: [',', ' ']
    });
@stop
>