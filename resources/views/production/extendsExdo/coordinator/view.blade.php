@extends('layout')

@section('title')
    Coordinator - Extended of Exdo
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
    @include('asset_select2')
@stop

@push('style')
<style>
    .text-red {
        color: black;
    }
</style>
@endpush

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active'
    ])
@stop

@section('body')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Extended of Exdo</h1>
    </div>
</div>  

<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('coordinator/exdo-extends/cookies') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="emp">Employes:</label>
                        <select name="emp" id="emp" class="form-control">
                            <option></option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $id ? 'selected' : '' }}>{{ $user->getFullName() }}</option>                                
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-xs btn-default">get-data</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover table-stripped table-condensed table-bordered" id="tableExdo" width="100%">
            <thead>
                <tr>
                    <th>No</th>                    
                    <th>Employes</th>
                    <th>Amount</th>
                    <th>Expired</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="showExtend" tabindex="-1" role="dialog" aria-labelledby="showExtendLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content">
            <!--  -->
        </div>
    </div>
</div>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_3')
    @include('assets_script_7')
@stop

@section('script')

$("select#emp").select2({
    placeholder: "Select a employee",
    theme: "classic",
});

$('#tableExdo').DataTable({
    processing: true,
    responsive: true,
    ajax: {
        "url": "{{ route('coordinator/exdo-extends/datatables') }}",
        "type": "GET",
        "data": function (d) {
            d.id = '{{ $id }}';
        }
    },
    columns: [
        { data: 'DT_Row_Index', orderable: false, searchable : false},   
        { data: 'fullname'},    
        { data: 'initial'},    
        { data: 'expired'},    
        { data: 'input_date'}, 
        { data: 'actions'}, 
    ],
});

$(document).on('click','#tableExdo tr td button[id="edit"]',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id, 
        success: function(e) {
            $("#modal-content").html(e);
        }
    });
});
@stop