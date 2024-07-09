@extends('layout')

@section('title')
    (hr) Ex Employes
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
        'c3' => 'active'
    ])
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Ex Employes</h1>
    </div>
</div>

            <div class="row">
                <table id="exEmployes" class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nik</th>
                            <th>Employes</th>
                            <th>Gender</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Join Date</th>
                            <th>End Date</th>
                            <th>Emp. Stat. </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-lg" id="modal-content">
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

        $('#exEmployes').DataTable({
                processing: true,
                responsive: true,
                ajax: '{{ route('hr/ex-employes/data') }}',
                columns: [
                    { data: 'DT_Row_Index', orderable: false, searchable : false},
                    { data: 'nik'},
                    { data: 'fullname'},
                    { data: 'gender'},
                    { data: 'department'},
                    { data: 'position'},
                    { data: 'join_date'},
                    { data: 'end_date'},
                    { data: 'emp_status'},
                    { data: 'actions'},
                ],
                dom: 'Bfrtip',
                buttons: [
                     'excel'
                ]

        });

     $(document).on('click','#exEmployes tr td a[title="Detail"]',function(e) {
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
