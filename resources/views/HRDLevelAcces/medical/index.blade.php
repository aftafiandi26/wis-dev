@extends('layout')

@section('title')
    (hr) Index Employee
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c181' => 'active'
    ])
@stop
@section('body')

  <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Employee Leave (Sicked)</h1>
            <a href="https://www.alodokter.com/penyakit-a-z" target="_blank" class="pull-right" style="color: gray; margin-bottom: 10px;">www.alodoktr.com</a>
        </div>
    </div>

     <div class="row">
        <div class="col-lg-12">
            <div>
            <table class="table table-striped table-bordered table-hover" width="100%" id="tablesMedical">
                <thead>
                    <tr style="white-space:nowrap">
                        <td>No</td>
                        <td>NIK</td>                        
                        <td>Employee</td>                      
                        <td>Department</td>
                        <td>Position</td>
                        <td>Period</td>
                        <td>Start leave Date</td> 
                        <td>End leave Date</td>
                        <td>Action</td>
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
    @include('assets_script_7')
@stop
@section('script')

    $('#tablesMedical').DataTable({
                processing: true,
                responsive: true,
                ajax: '{{ route('data/sicked') }}',
                columns: [
                    { data: 'DT_Row_Index', orderable: false, searchable : false},  
                    { data: 'request_nik'},
                    { data: 'fullname'}  ,
                    { data: 'dept'},
                    { data: 'request_position'},
                    { data: 'period'},
                    { data: 'leave_date'},
                    { data: 'end_leave_date'},
                    { data: 'action'}
                ],
                dom: 'Bfrtip',
                buttons: [
                     'excel'
                ]                 
    });


     $(document).on('click','#tablesMedical tr td a[title="Detail"]',function(e) {
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
