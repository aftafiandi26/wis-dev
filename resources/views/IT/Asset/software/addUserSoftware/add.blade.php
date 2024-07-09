@extends('layout')

@section('title')
    (it) New Asset Item
@stop

@section('top')
    @include('assets_css_1')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left')
@stop

@section('body')


<div class="row">
    <div class="col-lg-12">
    <h1 class="page-header">Add User {{$select->product}} {{$select->name_software}}</h1>                     
    </div>
</div>
<div class="row">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

</div>
<form action="{{route('storeAddUserSoftware', [$select->id])}}"  method="post">
{{ csrf_field() }}
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-2 form-group">
            <label for="Product"><font style="color: red;">*</font>Expiring Date:</label>
            <input type="text" name="Product" class="form-control" value="{{date('M, d Y', strtotime($select->expiring_date))}}" readonly="true">
        </div>
        <div class="col-lg-2 form-group">
            <label for="Product"><font style="color: red;">*</font>Licensed ID:</label>
            <input type="text" name="Product" class="form-control" value="{{$select->licensed_id}}" readonly="true">
        </div>
        <div class="col-lg-3 form-group">
            <label for="Product"><font style="color: red;">*</font>Email Registration:</label>
            <input type="text" name="Product" class="form-control" value="{{$select->email_registrations}}" readonly="true">
        </div>
        <div class="col-lg-2 form-group">
            <label for="Product"><font style="color: red;">*</font>Number of Licensed:</label>
            <input type="text" name="Product" class="form-control" value="{{$select->remains_licenses}}" readonly="true">
        </div>
        <div class="col-lg-2 form-group">
            <label for="Product"><font style="color: red;">*</font>Status Software:</label>
            <input type="text" name="Product" class="form-control" value="{{$select->status_software}}" readonly="true">
        </div>
     </div>   
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-2 form-group">
            <label for="Product"><font style="color: red;">*</font>User:</label>
            <select class="form-control" name="nameuser" >
                <option value="">-select-</option>
                <?php foreach ($userss as $userss_value): ?>
                <option value="{{$userss_value->id}}">{{$userss_value->first_name}} {{$userss_value->last_name}}</option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-lg-2 form-group">
            <label for="Product"><font style="color: red;">*</font>Workstaions:</label>
            <select class="form-control" name="name_workstation" >
                <option value="">-select-</option>
                <?php foreach ($availability as $availability_value): ?>
                <option value="{{$availability_value->id}}">{{$availability_value->hostname}}</option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-4 form-group">          
           <button type="sumbit" class="btn btn-sm btn-success">Add</button>
           <button type="reset" class="btn btn-sm btn-warning">Reset</button>
           <a href="{{route('indexAssetSoftware')}}" class="btn btn-sm btn-danger" title="back to inventory">Go back</a>
        </div> 
    </div>
</div>
</form>
@stop

@section('bottom')
    @include('assets_script_1')
@stop
