@extends('layout')

@section('title')
    (hr) Create Leave Forfeited
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c173' => 'active'
    ])
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Create Leave Forfeited</h1>
    </div>
</div>
@foreach ($errors->all() as $e)
<div class="row">
    <div class="col-lg-12">  
        <div class="alert alert-danger alert-dismissible fade-out">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>     
            {{ $e }}
         </div>
    </div>
</div>
@endforeach
<form action="{{ route('forfeited/cutOff/post') }}" method="post">
   {{ csrf_field() }}
    <div class="row">       
            <div class="panel panel-info">
                <div class="panel-heading">
                    <b>form leave transacton (forfeited {{$forfeited->year}})</b>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="request_by">Request by:</label>
                                <input type="text" class="form-control" id="request_by" name="request_by" value="{{ $data->first_name.' '.$data->last_name }}" readonly>
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="hidden" name="req_advance" value="2">
                                <input type="hidden" name="idForfeited" value="{{ $forfeited->id }}">
                            </div>   
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="nik">NIK:</label>
                                <input type="text" name="nik" class="form-control" id="nik" value="{{ $data->nik }}" readonly>
                            </div>   
                        </div> 
                        <div class="col-lg-4"></div>                   
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="startLeaveDate" style="color: red;">Start Leave Date</label>
                                <input type="date" class="form-control" id="startLeaveDate" name="startLeaveDate" value="{{ $dated }}" read>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="endLeaveDate" style="color: red;">End Leave Date</label>
                                <input type="date" class="form-control" id="endLeaveDate" name="endLeaveDate" value="{{ $dated }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="period">Period:</label>
                                <input type="text" class="form-control" id="period" value="{{ $forfeited->year + 1 }}" readonly>
                            </div>   
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="position">Positon:</label>
                                <input type="text" name="position" class="form-control" id="position" value="{{ $data->position }}" readonly>
                            </div>   
                        </div>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="backWork" style="color: red;">Back to Work at</label>
                                <input type="date" class="form-control" id="backWork" name="backWork" value="{{ $dated }}" required>
                            </div>
                        </div>                       
                    </div>

                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="joinDate">Join Date</label>
                                <input type="date" name="joindDate" class="form-control" id="joinDate" value="{{ $data->join_date }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="dept">Department</label>
                                <input type="text" name="dept" class="form-control" id="dept" value="{{ $data->dept_category_name }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="category">Leave Category</label>
                                <select name="category" id="category" class="form-control" required>
                                    <option value="1">Annual</option>                                   
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="request_day">Request Day</label>
                                <input type="text" name="request_day" id="request_day" class="form-control" maxlength="2" value="{{ $forfeited->countAnnual }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="endDate">End Date</label>
                                <input type="text" name="endDate" id="endDate" class="form-control" value="@if ($data->end_date){{ $data->end_date }} @else --
                                @endif" readonly>
                            </div>
                        </div>                      
                    
                        <div class="col-lg-6"></div>                       
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="countAnnual">Forfeited ({{ $forfeited->year }})</label>
                                <input type="text" name="countAnnual" id="countAnnual" class="form-control" value="{{ $countAnnual }}" readonly>
                            </div>
                        </div>  
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="amount">Taken Forfeited</label>
                                <input type="text" name="amount" id="amount" class="form-control" readonly value="{{ $amount }}">
                            </div>
                        </div>                     
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="reason">Reason of Leave</label>
                                <textarea name="reason" id="reason" cols="20" rows="5" class="form-control" maxlength="100" required>Forfoited leave {{ $forfeited->year }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                @if ($countAnnual > 0)
                                    <button type="submit" class="btn btn-sm btn-success">Insert</button>                                    
                                @endif
                                <a href="{{ route('forfeited/detail', $id) }}" class="btn btn-sm btn-default">Back</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
    </div>
    
</form>
@stop

@section('bottom')
    @include('assets_script_1') 
@stop

@section('script')
$('#destination').change(function() {
    var destination = $('#destination').val();

    $('#city').html('');

    var situs = 'https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi='+ destination +''; 

       $.ajax({           
            url: situs,    
            dataType: 'json',   
            success: function (result){                           
                var result = result.kota_kabupaten;
                $.each(result, function (nama, data){ 
                  $('#city').append(`
                      <option value="`+ data.nama +`">`+ data.nama +`</option>
                  `);             
                });
            }
          });
});
@stop
