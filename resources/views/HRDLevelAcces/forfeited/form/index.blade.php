@extends('layout')

@section('title')
    (hr) Forfeited Leave
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_4')
    @include('asset_select2')

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c3' => 'active'
    ])
@stop

@section('style')
<style>
    #findButton {
        background-color: red;
    }
</style>
@endsection

@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Forfeited of Record</h1>
    </div>
</div>

<form action="{{ route('forfeited/form/reloadPage') }}" method="post" class="form-inline" id="form">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="Employee">Employee:</label>
                <select name="emp" id="emp" class="form-control">
                    <option></option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->getFullName() }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-sm btn-default" id="findButton">find</button>
                <a href="{{ route('forfeited/index') }}" class="btn btn-sm btn-default" id="findButton">back</a>
            </div>
        </div>        
    </div>
</form>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-condensed table-hover table-striped table-bordered" id="forfaitedTables" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Employes</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>ID Form</th>
                    <th>Amount</th>
                    <th>Start Leave</th>
                    <th>form</th>
                </tr>
            </thead>            
        </table>
    </div>
</div>

<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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

$('select#emp').select2({
    placeholder: "Select a employee",
    allowClear: true
});

$('#forfaitedTables').DataTable({
    processing: true,
    responsive: true,
    ajax: '{{ route('forfeited/form/index/datatables') }}',
    columns: [
        { data: 'DT_Row_Index', orderable: true, searchable : false},
        { data: 'nik'},
        { data: 'fullname'},
        { data: 'position'},
        { data: 'department'},
        { data: 'leave_id'},
        { data: 'amount'},
        { data: 'startLeave'},
        { data: 'form'},       
    ],
    dom: 'Bfrtip',
    buttons: [
        'excel'
    ]

});


$(document).on('click','#forfaitedTables tr td a[id="formLeave"]',function(e) {
    e.preventDefault();
    var id = $(this).attr('data-role');

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content").html(e);
        }
    });
});
@endsection

