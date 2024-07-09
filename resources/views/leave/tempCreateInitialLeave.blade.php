@extends('layout')

@section('title')
    (hr) Create Leave
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
        <h1 class="page-header">Create Leave</h1>
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
<form action="{{ route('hr_mgmt-data/leave/tempStoreInitialLeave', $id) }}" method="post">
   {{ csrf_field() }}
    <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <b>form leave transacton</b>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="request_by">Request by:</label>
                                <input type="text" class="form-control" id="request_by" name="request_by" value="{{ $data->first_name.' '.$data->last_name }}" readonly>
                                <input type="hidden" name="id" value="{{ $id }}">
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
                                <input type="date" class="form-control" id="startLeaveDate" name="startLeaveDate" required>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="endLeaveDate" style="color: red;">End Leave Date</label>
                                <input type="date" class="form-control" id="endLeaveDate" name="endLeaveDate" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="period">Period:</label>
                                <input type="text" class="form-control" id="period" value="{{ date('Y') }}" readonly>
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
                                <input type="date" class="form-control" id="backWork" name="backWork" required>
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
                                    <option value="">-select category</option>
                                    @foreach ($category as $c)
                                        <option value="{{ $c->id }}">{{ $c->leave_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="request_day">Request Day</label>
                                <input type="text" name="request_day" id="request_day" class="form-control" maxlength="10" required>
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
                        @if($data->nationality == "Indonesia")
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="destination">Province of Destination</label>
                                <select name="destination" id="destination" class="form-control" required>
                                    <option value="">-select provinsi-</option>
                                    @foreach ($provinsi as $prov)
                                        <option value="{{ $prov['id'] }}">{{ $prov['nama'] }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="city">City of Destination</label>
                                <select name="city" id="city" class="form-control"></select>
                            </div>
                        </div>
                        @else
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="destination">Country of Destination</label>
                                <input type="text" class="form-control" required id="destinations" name="destination" placeholder="input country">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="city">City of Destination</label>
                                <input name="city" id="cities" class="form-control">
                            </div>
                        </div>
                        @endif
                        <div class="col-lg-2"></div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="available">Available Annual <sup>(+ forfeited)</sup></label>
                                <input type="text" name="available" id="available" class="form-control" name="availableLeave" value="{{ $availableLeave }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="available">Advanced Annual</label>
                                <input type="text" name="available" id="available" class="form-control" name="advanceAnnual" value="{{ $advanceAnnual }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="reason">Reason of Leave</label>
                                <textarea name="reason" id="reason" cols="20" rows="5" class="form-control" maxlength="100" required></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="exdo">Total Exdo</label>
                                <input type="text" name="exdo" id="exdo" class="form-control" name="exdo" value="{{ $exdo }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success">Update</button>
                                <a href="{{ route('hr_mgmt-data/leave/tempInitialLeave') }}" class="btn btn-sm btn-default">Back</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </div>

</form>

<div class="row">
    <div class="col-lg-12">
        <center><h4>List of Leave</h4></center>
        <table class="table table-condensed table-hover table-striped" width="95%" id="tables">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Day</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="showModalTables" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
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

$('table#tables').DataTable({
    processing: true,
    responsive: true,
    ajax: '{{ route("hr_mgmt-data/leave/tempCreateInitialLeave/data", $id) }}',
    columns: [
                { data: 'DT_Row_Index', orderable: false, searchable : false},
                { data: 'category'},
                { data: 'leave_date'},
                { data: 'end_leave_date'},
                { data: 'total_day'},
                { data: 'actions'},
            ],
});

$(document).on('click','table#tables tr td a[id="detail"]',function(e) {
    var id = $(this).attr('data-role');
    console.log(id);

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content").html(e);
        }
    });
});
@stop
