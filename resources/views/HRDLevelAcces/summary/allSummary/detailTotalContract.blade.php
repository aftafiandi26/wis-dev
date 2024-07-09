@extends('layout')

@section('title')
   (hr) Data Employee
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
@section('body')
<div class="row">
    <h2>Total Employee (Contract)</h2>
    <hr class="my-5">
</div>
<div class="row" style="margin-bottom:  10px;">
    <a href=" {{route('indexAllSummary')}} " class="btn btn-warning btn-sm"> Back</a>    
</div>
 <div class="row">
        <div class="col-lg-12">            
            <div>
                <table class="table table-striped table-bordered table-hover text-nowrap" width="100%" id="tables">
                    <thead>
                        <tr>
                           <th>ID</th>                           
                            <th>NIK</th>
                            <th>Fist Name</th>
                            <th>Last Name</th>
                            <th>Join Date</th>                           
                            <th>Position</th>
                            <th>Department</th>
                            <th>Employee Status</th>
                            <th>View</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
               
            </div>
        </div>
    </div>
</script>
@stop
@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
@section('script')
    $('#tables').DataTable({


        "columnDefs": [
           { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
        "order": [
           [2, "asc" ]
        ],
        responsive: true,      
         "dom": 'Blfrtip', 
          "buttons": [{
                extend:    'excelHtml5',
                text:      '<i class="glyphicon glyphicon-download-alt" style="font-size: 18px;"></i>',
                titleAttr: 'Generate Data Employee',
            }],
       ajax: '{!! URL::route("getdetailTotalContract") !!}' ,

    }); 

      $(document).on('click','#tables tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    }); 
@stop
