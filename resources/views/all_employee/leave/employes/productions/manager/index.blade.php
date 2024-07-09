@extends('layout')

@section('title')
    Leave
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
        'c2' => 'active'
    ])
@stop
@push('style')
<style>
    table#tables {
        text-align: center;
    }

    a#detail, a#download, a#reminder, a#delete, .modal-footer button {
        border-radius: 10px;       
    } 

    a#download i {
        color: darkblue;        
    }
    a#detail i {
        color: darkgreen;        
    }
    a#reminder i {
        color: magenta;
    }
    a#delete i {
        color: darkred;
    }

    a#download:hover {
        background-color: darkblue;
    }
    a#detail:hover {
        background-color: darkgreen;
    }
    a#reminder:hover {
        background-color: darkmagenta;
    }
    a#delete:hover {
        background-color: darkred;
    }

    a#detail:hover i {
        color: greenyellow;
    }
    a#download:hover i {
        color: lightblue;
    }
    a#reminder:hover i {
        color: white;
    } 
    a#delete:hover i {
        color: wheat;
    }   

    .text-green {
        color: rgb(2, 143, 2);
    }
    .text-green:hover {
        color: rgb(2, 81, 2);
    }
    .text-darkblue {
        color: rgb(0, 0, 255);
    }
    .text-darkblue:hover {
        color: rgb(5, 5, 154);
    }

    div#deleteFooter {
        text-align: center;
    }
    div#deleteFooter button#yes {
        background-color: green;
        color: white;
    }
    div#deleteFooter button#yes:hover {
        background-color: rgb(20, 162, 20);
        color: whitesmoke;
    }    
    div#deleteFooter button#no {
        background-color: maroon;
        color: white;
    }
    div#deleteFooter button#no:hover {
        background-color: rgb(157, 16, 16);
        color: whitesmoke;
    }

</style>
@endpush
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Leave Transactions</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-condensed table-striped table-bordered table-hover" id="tables" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Employes</th>
                    <th>Category</th>
                    <th>Start Leave</th>
                    <th>End Leave</th>
                    <th>Total Day</th>                  
                    <th>General Manager</th>
                    <th>HRD Verification</th>
                    <th>Actions</th>
                </tr>
            </thead>            
        </table>
    </div>
</div>


<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-lg" id="modal-content">
            <!--  -->
        </div>
    </div>
</div>
<div class="modal fade" id="modalReminder" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content-reminder">
            <!--  -->
        </div>
    </div>
</div>
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-sm" id="modal-content-delete">
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
$('table#tables').DataTable({
    processing: true,
    responsive: true,
    ajax: "{{ route('all_employes/leave/transaction/hd/data') }}",
    columns: [
        { data: 'DT_Row_Index', orderable: false, searchable : false},  
        { data: 'request_nik', orderable: false, searchable : false},
        { data: 'request_by', orderable: false, searchable : false},
        { data: 'category'},
        { data: 'leave_date'},
        { data: 'end_leave_date'},
        { data: 'total_day'},       
        { data: 'status_hd'},
        { data: 'status_hr'},
        { data: 'actions'},
    ]
});

$(document).on('click','a#detail',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id, 
        success: function(e) {
            $("div#modal-content").html(e);
        }
    });
});
$(document).on('click','a#reminder',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id, 
        success: function(e) {
            $("div#modal-content-reminder").html(e);
        }
    });
});
$(document).on('click','a#delete',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id, 
        success: function(e) {
            $("div#modal-content-delete").html(e);
        }
    });
});
@stop