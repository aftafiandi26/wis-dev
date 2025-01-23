@extends('layout')

@section('title')
    (hr) New Project
@stop

@section('top')
    @include('assets_css_1')
    @include('asset_select2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c1' => 'active',
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
            <h1 class="page-header">Add New Project</h1>
        </div>
    </div>
    @include('asset_feedbackErrors')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <b>Form New Project</b>
                    </h5>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('postNewPrivilege') }}" method="post" class="form-inline"
                                id="formPost">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="group">Group From:</label>
                                    <select name="group" id="group" class="form-control" required>
                                        <option value=""></option>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Project Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        value="{{ old('name') }}">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 ">
                            <a class="btn btn-sm btn-default  pull-right" href="{{ route('projectHRD') }}">Back</a>
                            <button class="btn btn-sm btn-success pull-right" id="save">Save</button>
                        </div>
                    </div>
                </div>

                <div class="panel-footer"></div>
            </div>
        </div>

    </div>
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
            document.getElementById('save').addEventListener('click', function() {
                document.getElementById('formPost').submit();
            });
            $('#group').select2({
                placeholder: "select this group",
            });
        });
    </script>
@endpush
