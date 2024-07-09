@extends('layout')

@section('title')
    Summary Attendance
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
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Summary Attendance (WFH)</h1>
        </div>
    </div>
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-lg-6">
            <a href="{{ route('headOfProduction/index') }}" class="btn btn-sm btn-default">back</a>
        </div>   
        <div class="col-lg-6 ">
            <form action="{{ route('headOfProduction/findName') }}" method="get" class="form-inline pull-right">
                {{ csrf_field() }}
                <label for="findName">Name :</label>
                <input type="text" name="findName" placeholder="find name..." class="form-control" id="findName">
                <input type="hidden" name="dept" value="{{ $dept }}">
                <input type="hidden" name="date1" value="{{ $date1 }}">
                <input type="hidden" name="date2" value="{{ $date2 }}">
                <button type="submit" class="btn btn-sm btn-default">find</button>
            </form>
        </div>   
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped table-hover" width="100%" id="attendance">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>NIK</td>
                        <td>Employe</td>
                        <td>Position</td>
                        <td>Deparment</td>
                        <td>Time In</td>
                        <td>Time Out</td>
                        <td>Working Hours</td>
                        <td>Date</td>
                        <td style="width: 78px;">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absences as  $key => $abs )
                        <tr>
                            <td>{{ $key + $absences->firstItem() }}</td>
                            <td>{{ $abs->nik }}</td>
                            <td>{{ $abs->first_name.' '.$abs->last_name }}</td>
                            <td>{{ $abs->position }}</td>
                            <td>
                                <?php $dept = App\Dept_Category::find($abs->dept_category_id); ?>
                                {{ $dept->dept_category_name }}
                            </td>
                            <td>{{ $abs->timeIN }}</td>
                            <td>{{ $abs->timeOUT }}</td>
                            <td>
                                <?php
                                $waktu = "--";

                                if ($abs->date_check_in === date('Y-m-d')) {
                                    $waktu = "'still working";
                                }
                                
                                 if ($abs->check_out === 1) {
                                        $awal  = strtotime($abs->timeIN); //waktu awal
                                        $akhir = strtotime($abs->timeOUT); //waktu akhir

                                        $diff  = $akhir - $awal;

                                        $jam   = floor($diff / (60 * 60));
                                        $menit = $diff - $jam * (60 * 60);

                                        $waktu = $jam . ' jam, ' . floor($menit / 60) . ' menit';
                                    }                                   
                                 ?>
                                 {{ $waktu }}
                            </td>
                            <td>{{ $abs->date_check_in }}</td>
                            <td>
                                <a class="btn btn-xs btn-info" title="Detail" data-toggle="modal" data-target="#showModal" data-role="{{ route('headOfProduction/index/modal', $abs->id) }}">view</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          <span class="pull-left">Showing {{ $absences->firstItem() }} to {{ $absences->lastItem() }} from {{ $absences->total() }} data</span>          
          <span class="pull-right">{{ $absences->appends(request()->query())->links() }}</span>          
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
    @include('assets_script_3')
    @include('assets_script_2')
@stop
@section('script')
    $('[data-toggle="tooltip"]').tooltip();

    $(document).on('click','#attendance tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id,
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });
@stop