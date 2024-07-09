@extends('layout')

@section('title')
    Preview Leave Report
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active'
    ])
@stop
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Preview Entitled Leave Report</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            {!! Form::open(['route' => 'hr_mgmt-data/printLeaveReport', 'role' => 'form', 'autocomplete' => 'off', 'id' => 'form']) !!}
                <div style="width: 100%;" class="table-responsive">
                        <table style="border: 1px medium #000000;">
                            <tbody>
                                <tr>
                                    <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 35px; font-weight: bold; background-color: #D9D9D9;">No.</td>
                                    <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 80px; font-weight: bold; background-color: #D9D9D9;">NIK</td>
                                    <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 100px; font-weight: bold; background-color: #D9D9D9;">First Name</td>
                                    <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 400px; font-weight: bold; background-color: #D9D9D9;">Last Name</td>
                                    <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 85px; font-weight: bold; background-color: #D9D9D9;">Status</td>
                                    <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 200px; font-weight: bold; background-color: #D9D9D9;">Department</td>
                                    <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 120px; font-weight: bold; background-color: #D9D9D9;">End Contract</td>
                                    <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 90px; font-weight: bold; background-color: #D9D9D9;">Entitled Leave</td>
                                    <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 90px; font-weight: bold; background-color: #D9D9D9;">Entitled Day Off</td>
                                    <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 90px; font-weight: bold; background-color: #D9D9D9;">Total Leave and Day Off</td>
                                    <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 90px; font-weight: bold; background-color: #D9D9D9;">Leave Taken</td>
                                    <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 90px; font-weight: bold; background-color: #D9D9D9;">Day Off Taken</td>
                                    <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 90px; font-weight: bold; background-color: #D9D9D9;">Total Leave and Day off Taken</td>
                                    <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 90px; font-weight: bold; background-color: #D9D9D9;">Annual Leave Balance</td>
                                    <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 90px; font-weight: bold; background-color: #D9D9D9;">Day Off Balance</td>
                                    <td style="border: 1px solid #000000; text-align: center; vertical-align: middle; width: 90px; font-weight: bold; background-color: #D9D9D9;">Total Leave and Day Off Balance</td>
                                </tr>

                                @foreach($leave_data as $key => $value)
                                    <tr style="white-space:nowrap;">
                                        <td style="border: 1px solid #000000; text-align: center; vertical-align: middle;">{!! $key + 1 !!}</td>
                                        <td style="border: 1px solid #000000; text-align: left; vertical-align: middle;">&nbsp {!! $value->nik !!}</td>
                                        <td style="border: 1px solid #000000; text-align: left; vertical-align: left;">&nbsp {!! $value->first_name !!}</td>
                                        <td style="border: 1px solid #000000; text-align: left; vertical-align: left;">&nbsp {!! $value->last_name !!}</td>
                                        <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->emp_status !!}</td>
                                        <td style="border: 1px solid #000000; text-align: left; vertical-align: left;">&nbsp {!! App\Dept_category::find($value->dept_category_id)->dept_category_name !!}</td>
                                        <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! date("M d, Y", strtotime($value->end_date)) !!}</td>
                                        <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->entitled_leave !!}</td>
                                        <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->entitled_day_off!!}</td>
                                        <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->total_leave_and_day_off !!}</td>
                                        <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->leave_taken !!}</td>
                                        <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->day_off_taken !!}</td>
                                        <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->total_leave_and_day_off_taken !!}</td>
                                        <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->annual_leave_balance !!}</td>
                                        <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->day_off_balance !!}</td>
                                        <td style="border: 1px solid #000000; text-align: center; vertical-align: left;">{!! $value->total_leave_and_day_off_balance !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    <br>
                </div>
                
                {!! Form::submit('Print', ['class' => 'btn btn-sm btn-primary', 'id' => 'print']) !!}
                <a class="btn btn-sm btn-warning" href="{!! URL::route('hr_mgmt-data/leaveReport') !!}">Back</a>
            {!! Form::close() !!}
        </div>
    </div> 
    <br>   
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
@stop

@section('script')
	$('[data-toggle="tooltip"]').tooltip();

    $('#tables').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
    	"order": [
    		[ 0, "asc" ]
    	],
        
        responsive: true,        
        ajax: '{!! URL::route("leave/getindexTransaction") !!}'
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