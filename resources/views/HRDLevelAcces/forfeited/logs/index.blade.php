@extends('layout')

@section('title')
    (hr) Forfeited Leave
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_4')

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c3' => 'active'
    ])
@stop

@push('style')
<style>
    .batas {
        margin-bottom: 5px;
    }

    a#record {
        border-radius: 10px;
        background-color: whitesmoke;
    }

    a#record:hover {
        background-color:lightgoldenrodyellow;
        color: black;      
    }

    a#record:active {      
        transform: translateY(5px);
    }

</style>
@endpush

@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Forfeited Leave {{ date('Y') }}</h1>
    </div>
</div>
<div class="row batas">
    <div class="col-lg-12">
        <a href="{{ route('forfeited/form/index') }}" class="btn btn-sm btn-default pull-right" id="record">Record</a>
    </div>
</div>

<div class="row">
    <div class="table-responsive">
        <div class="col-lg-12">
            <table id="employeeData" class="table table-striped table-bordered table-condensed" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nik</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Status</th>                       
                        <th title="Remaining forfeited leave that exists at this time">Remains It Will Be Forfeited</th>
                        <th title="remaining leave balance in this month">Available AL</th>
                        <th title="remaining leave balance in the coming month">Advance Leave</th>
                        <th>Remains AL</th>
                        <th>Remains Exdo</th>
                        <th>AL + Exdo</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
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
    @include('assets_script_2')
    @include('assets_script_3')
    @include('assets_script_7')
@stop

@section('script')

        $('#employeeData').DataTable({
                processing: true,
                responsive: true,
                ajax: '{{ route('forfieted/logs/index/data') }}',
                columns: [
                    { data: 'DT_Row_Index', orderable: true, searchable : false},
                    { data: 'nik'},
                    { data: 'fullname'},
                    { data: 'department.dept_category_name'},
                    { data: 'position'},
                    { data: 'emp_status'},                  
                    { data: 'DEDE'},
                    { data: 'availableAL'},
                    { data: 'advanceAL1'},
                    { data: 'remainsAL'},
                    { data: 'exdo'},
                    { data: 'AL_Exdo'},
                    { data: 'actions'},
                ],
                dom: 'Bfrtip',
                buttons: [
                     'excel'
                ]
        });


     $(document).on('click','#employeeData tr td a[title="Detail"]',function(e) {
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
