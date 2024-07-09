@extends('layout')

@section('title')
Applying Leave
@stop

@section('top')
@include('assets_css_1')
@include('assets_css_2')

@stop

@section('navbar')
@include('navbar_top')
@include('navbar_left', [
'c2' => 'active',
'c16' => 'active'
])
@stop
@section('body')
<style type="text/css">
    div.ex1 {
        background-color: transparent;
        width: 100%;
        height: 600px;
        overflow: scroll;
    }

    /* cek modal untuk self declaertion*/
</style>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Applying Annual Leave</sup>
        </h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                {!! Form::open(['route' => 'leave/store', 'role' => 'form', 'autocomplete' => 'off']) !!}
               

                <div class="row">
                    <div class="col-lg-12" align="center">
                        <b class="panel-title">LEAVE APPLICATION FORM</b>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 form-group">
                        {!! Form::label('username', 'Request by') !!}
                        {!! Form::text('username', Auth::user()->first_name.' '.Auth::user()->last_name , ['class' => 'form-control', 'placeholder' => 'Username', 'maxlength' => 100, 'autofocus' => true, 'readonly' => true]) !!}
                    </div>



                    <div class="col-lg-3 form-group">
                        {!! Form::label('nik', 'NIK') !!}
                        {!! Form::text('nik', Auth::user()->nik, ['class' => 'form-control', 'placeholder' => 'NIK', 'maxlength' => 100, 'autofocus' => true, 'readonly' => true]) !!}
                    </div>

                    <div class="col-lg-2">
                    </div>

                    <div class="col-lg-2">
                        @if ($errors->has('leave_date'))
                        <div class="form-group has-error">
                            @else
                            <div class="form-group">
                                @endif
                                <span style="color: red;">{!! Form::label('leave_date', 'Start Leave Date') !!}</span>

                                {!! Form::date('leave_date', null, ['class' => 'form-control', 'required' => true, 'id' => 'startLeave']) !!}
                                <p class="help-block">{!! $errors->first('leave_date') !!}</p>
                            </div>
                        </div>

                        <div class="col-lg-2" id="tgl2">
                            @if ($errors->has('end_leave_date'))
                            <div class="form-group has-error">
                                @else
                                <div class="form-group">
                                    @endif
                                    <span style="color: red;">{!! Form::label('end_leave_date', 'End Leave Date') !!}</span>
                                    <br>
                                    {!! Form::date('end_leave_date', null, ['class' => 'form-control', 'required' => true, 'id' => 'endLeave']) !!}
                                    <p class="help-block">{!! $errors->first('end_leave_date') !!}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                @if ($errors->has('period'))
                                <div class="form-group has-error">
                                    @else
                                    <div class="form-group">
                                        @endif
                                        {!! Form::label('period', 'Period') !!}
                                        {!! Form::text('period', date('Y'), ['class' => 'form-control', 'maxlength' => 100, 'autofocus' => true, 'required' => true, 'readonly' => true]) !!}
                                        <p class="help-block">{!! $errors->first('period') !!}</p>
                                    </div>
                                </div>



                                <div class="col-lg-3">
                                    <div class="form-group">
                                        {!! Form::label('position', 'Position') !!}
                                        {!! Form::text('position', Auth::user()->position, ['class' => 'form-control', 'placeholder' => 'Position', 'maxlength' => 100, 'readonly' => true]) !!}
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                </div>

                                <div class="col-lg-2">
                                    @if ($errors->has('back_work'))
                                    <div class="form-group has-error">
                                        @else
                                        <div class="form-group">
                                            @endif
                                            <span style="color: red;">{!! Form::label('back_work', 'Back to Work at') !!}</span>
                                            <br>
                                            {!! Form::date('back_work', old('back_work'), ['class' => 'form-control', 'placeholder' => 'Back to Work at', 'maxlength' => 100, 'required' => true]) !!}
                                            <p class="help-block">{!! $errors->first('back_work') !!}</p>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            {!! Form::label('join_date', 'Join Date') !!}
                                            {!! Form::text('join_date', Auth::user()->join_date, ['class' => 'form-control', 'placeholder' => 'Join Date', 'maxlength' => 100, 'autofocus' => true, 'required' => true, 'readonly' => true]) !!}
                                        </div>
                                    </div>



                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            {!! Form::label('department', 'Department') !!}
                                            {!! Form::text('department', $department, ['class' => 'form-control', 'placeholder' => 'Department', 'maxlength' => 100, 'autofocus' => true, 'readonly' => true]) !!}
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                    </div>

                                    <div class="col-lg-2">
                                        @if ($errors->has('leave_category_id'))
                                        <div class="form-group has-error">
                                            @else
                                            <div class="form-group">
                                                @endif
                                                {!! Form::label('leave_category_id', 'Leave Category') !!}
                                                {!! Form::text('leave_category_id', 'Annual', ['class' => 'form-control', 'placeholder' => 'Leave Category', 'maxlength' => 100, 'required' => true, 'readonly' => true]) !!}
                                                <p class="help-block">{!! $errors->first('leave_category_id') !!}</p>
                                            </div>
                                        </div>

                                        <div class="col-lg-1">
                                            <div class="form-group">
                                                <label id="entitlement">Balance</label>
                                                {!! Form::text('entitlement', $leave, ['class' => 'form-control', 'maxlength' => 100, 'autofocus' => true, 'readonly' => true, 'min' => true]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                {!! Form::label('email', 'Email') !!}
                                                {!! Form::text('email', Auth::user()->email, ['class' => 'form-control', 'placeholder' => 'Email', 'maxlength' => 100, 'autofocus' => true, 'readonly' => true]) !!}
                                            </div>
                                        </div>
                                        @if(auth::user()->nationality === 'Indonesia')
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                {!! Form::label('province', 'Province of Destination') !!}
                                                <select class="form-control" name="nama_provin" required="true" id="ada">
                                                    <option>-select departure</option>
                                                    <?php foreach ($provinsi as $nama_provinsi) : ?>
                                                        <option value="{{$nama_provinsi['id'] }}">{{ title_case($nama_provinsi['name']) }}</option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                {!! Form::label('city', 'Destination City') !!}
                                                <select class="form-control" name="nama_city" required="true" id="nama_kota" required="true">
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    @else

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            {!! Form::label('province', 'Country of destination') !!}
                                            <input type="text" name="nama_provin" class="form-control" required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            {!! Form::label('city', 'Destination City') !!}
                                            <input type="text" name="nama_city" class="form-control" required="true">
                                        </div>
                                    </div>
                                </div>

                                @endif

                                <?php if (auth::user()->dept_category_id === 6 and auth::user()->hd === 0 and auth::user()->koor === 0 and auth::user()->pm === 0 and auth::user()->producer === 0) : ?>
                                    <?php if (auth::user()->level_hrd === '0') : ?>
                                        <?php if (auth::user()->spv === 0) : ?>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        {!! Form::label('sendto', 'Select Your Coordinator :') !!}
                                                        <select class="form-control" name="sendto" required>
                                                            <option value=""></option>
                                                            <?php foreach ($pro_category as $coor) : ?>
                                                                <option value="{{ $coor->email }}">{{ $coor->first_name.' '.$coor->last_name }}</option>
                                                            <?php endforeach ?>
                                                        </select>

                                                    </div>
                                                </div>


                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        {!! Form::label('sendtoSPV', 'Select Your Supervisor :') !!}
                                                        <select class="form-control" name="sendtoSPV">
                                                            <option value=""></option>
                                                            <?php foreach ($supervisor as $spv) : ?>
                                                                <option value="{{ $spv->email }}">{{ $spv->first_name.' '.$spv->last_name }}</option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php endif ?>
                                    <?php else : ?>
                                        <?php if (auth::user()->level_hrd === 'Junior Pipeline') : ?>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        {!! Form::label('sendto', 'Select Your Supervisor :') !!}
                                                        {!! Form::select('sendto', $level, old('sendto'), ['class' => 'form-control', 'required' => true]) !!}
                                                    </div>
                                                </div>

                                                <div class="col-lg-9">
                                                </div>
                                            </div>

                                        <?php elseif (auth::user()->level_hrd == 'Junior Technical') : ?>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        {!! Form::label('sendto', 'Select Your Supervisor :') !!}
                                                        {!! Form::select('sendto', $ricky, old('sendto'), ['class' => 'form-control', 'required' => true]) !!}
                                                    </div>
                                                </div>

                                                <div class="col-lg-9">
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    <?php endif ?>

                                <?php endif ?>
                                <!-- Rule Production PM and HOD -->
                                <?php if (auth::user()->dept_category_id === 6) : ?>
                                    <!-- Head Production -->
                                    <?php if (auth::user()->hd === 1) : ?>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    {!! Form::label('sendtoPM', 'Send to :') !!}
                                                    <input class="form-control" name="sendtoPM" readonly="true" placeholder="HR department"></input>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                            </div>
                                        </div>
                                        <!-- Staff Production Send to PM -->
                                    <?php else : ?>
                                        <!-- PM send to HOD Production -->
                                        <?php if (auth::user()->pm === 1) : ?>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        {!! Form::label('sendtoPM', 'Head of Deaprtment :') !!}
                                                        {!! Form::select('sendtoPM', $emailHOD, old('sendtoPM'), ['class' => 'form-control', 'required' => true]) !!}
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                </div>
                                            </div>

                                        <?php else : ?>
                                            <?php if (auth::user()->level_hrd === '0') : ?>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">

                                                            <?php if (auth::user()->lineGM === 1) : ?>
                                                                {!! Form::label('sendtoPM', 'Head of Deparment :') !!}
                                                                {!! Form::select('sendtoPM', $emailHOD, old('sendtoPM'), ['class' => 'form-control', 'required' => true]) !!}
                                                            <?php else : ?>
                                                                {!! Form::label('sendtoPM', 'Select Your PM :') !!}
                                                                <!-- {!! Form::select('sendtoPM', $pmm, old('sendtoPM'), ['class' => 'form-control', 'required' => true]) !!} -->
                                                                <select class="form-control" name="sendtoPM" required>
                                                                    <option value=""></option>
                                                                    <?php foreach ($pm_category as $pmCategory) : ?>
                                                                        <option value="{{ $pmCategory->email }}">{{ $pmCategory->first_name.' '.$pmCategory->last_name }}</option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <?php if (auth::user()->spv === 1 or auth::user()->koor === 1) : ?>
                                                            {!! Form::label('sendtoProducer', 'Select Your Producer :') !!}                                                                                                                       <select class="form-control" name="sendtoProducer" required>
                                                                <option value=""></option>
                                                                <?php foreach ($producer as $producers) : ?>
                                                                    <option value="{{ $producers->email }}">{{ $producers->first_name.' '.$producers->last_name }}</option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            <?php else : ?>
                                                <?php if (auth::user()->level_hrd === 'Senior Pipeline' or auth::user()->level_hrd === 'Senior Technical') : ?>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                {!! Form::label('sendtoPM', 'Head of Deaprtment :') !!}
                                                                {!! Form::select('sendtoPM', $emailHOD, old('sendtoPM'), ['class' => 'form-control', 'required' => true]) !!}
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-9">
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                            <?php endif ?>
                                        <?php endif ?>
                                    <?php endif ?>

                                    <!-- Rule not Production -->
                                <?php else : ?>

                                    <div class="row">
                                        @if (auth::user()->dept_ApprovedHOD != 1)
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <!-- HOD Rule -->
                                                <?php if (auth::user()->hd === 1) : ?>
                                                    @if (auth::user()->gm == 0 and auth::user()->dept_ApprovedHOD == 0 and auth::user()->assistGM == 0)
                                                    {!! Form::label('sendtoPM', 'Send To') !!}
                                                    <select class="form-control" name="sendtoPM" id="sendtoPM" required="true">
                                                        <option value="{{ $generalManager->email }}">{{ $generalManager->getFullName() }}</option>
                                                    </select>
                                                    @endif

                                                <?php else : ?>
                                                    <?php if (auth::user()->dept_category_id === 4) : ?>
                                                        <!-- Office rule -->
                                                        {!! Form::label('sendtoPM', $labelEmailHOD) !!}
                                                        {!! Form::select('sendtoPM', $emailHOD, old('sendtoPM'), ['class' => 'form-control', 'required' => true]) !!}
                                                    <?php else : ?>
                                                        <!-- Office rule -->
                                                        <?php if (auth::user()->dept_category_id === 1) : ?>
                                                            <!-- IT -->
                                                            <?php if (auth::user()->stat_officer === 0) : ?>
                                                                {!! Form::label('sendtoPM', $labelEmailHOD) !!}
                                                                {!! Form::select('sendtoPM', $emailHOD, old('sendtoPM'), ['class' => 'form-control', 'required' => true]) !!}
                                                            <?php else : ?>
                                                                {!! Form::label('sendto', 'Select Your Coordinator :') !!}
                                                                {!! Form::select('sendto', $ITcoor, old('sendto'), ['class' => 'form-control', 'required' => true]) !!}
                                                                <br>
                                                                {!! Form::label('sendtoPM', $labelEmailHOD) !!}
                                                                {!! Form::select('sendtoPM', $emailHOD, old('sendtoPM'), ['class' => 'form-control', 'required' => true]) !!}
                                                            <?php endif ?>
                                                        <?php else : ?>
                                                            <!-- // bella -->
                                                            {!! Form::label('sendtoPM', $labelEmailHOD) !!}
                                                            {!! Form::select('sendtoPM', $emailHOD, old('sendtoPM'), ['class' => 'form-control', 'required' => true]) !!}
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-lg-3">
                                            @if (auth::user()->assistGM === 1)
                                            <div class="form-group">
                                                <label for="sendtoProducer">General Manager</label>
                                                <select name="sendtoProducer" id="sendtoProducer" class="form-control">
                                                    @foreach ($ghea as $gm)
                                                    <option value="{{ $gm }}">{{ $gm }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                <?php endif ?>
                                <!-- End Rule -->
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            {!! Form::label('reason', 'Reason') !!}
                                            {!! Form::textarea('reason', old('reason'), ['class' => 'form-control', 'placeholder' => 'max:50word', 'maxlength' => 50, 'autofocus' => true, 'autosave' => true, 'required' => 'true', 'style' => 'height:100px']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            {!! Form::label('notes', 'NOTES:') !!}<br>
                                            <small>
                                                <p>
                                                    <span style="color: red;">* </span>
                                                    If you want to take a half day leave, please pay attention to the start leave date, end leave date, and back to work.
                                                </p>
                                                <p>
                                                    <span style="color: red;">** </span>
                                                    ex : start leave date => 2021-12-01 | end leave date => 2021-12-02 | back to work => 2021-12-02 | total leave day => 1.5 (by system)
                                                    <br>
                                                    start leave date => 2021-12-01 | end leave date => 2021-12-02 | back to work => 2021-12-03 | total leave day => 2 (by system)
                                                </p>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" class="hidden" value="{{ $adminFacility }}" name="adminFacility">
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal">Apply</button>

                                <a class="btn btn-sm btn-warning" href="{!! URL::route('leave/apply') !!}">Back</a>

                                <div id="modal" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <div class="modal-title">
                                                    <p>
                                                        <center>
                                                            <h3><b>eForm Self Declaration</b></h3>
                                                        </center>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="ex1">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <h4 style="text-align: center;"><b>Surat Pernyataan Cuti Dalam Masa Pandemi Covid-19</b></h4>
                                                            <h5 style="font-style: italic; text-align: center;">Leave Declaration Form During Covid-19 Pandemic</h5>
                                                        </div>
                                                        <br>
                                                        <div class="col-lg-12" style="margin-top: 10px;">
                                                            <p style="text-align: center">--- <b>Keterangan</b> | <span style="font-style: italic;">Information ---</span></p>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="col-lg-6">
                                                                <table class="table table-striped table-condensed">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>Nama</th>
                                                                            <td>:</td>
                                                                            <td>{{ auth::user()->first_name.' '.auth::user()->last_name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="font-style: italic;"><small>Name</small></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Departement</th>
                                                                            <td>:</td>
                                                                            <td>{{ $department }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="font-style: italic;"><small>Department</small></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <table class="table table-striped table-condensed">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>NIK</th>
                                                                            <td>:</td>
                                                                            <td>{{ auth::user()->nik }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="font-style: italic;"><small>Employment ID</small></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Jabatan</th>
                                                                            <td>:</td>
                                                                            <td>{{ auth::user()->position }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="font-style: italic;"><small>Position</small></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div>
                                                                <p style="text-align: center">--- <b>Deklarasi Mandiri</b> | <span style="font-style: italic;">Self Declaration ---</span></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12" style="margin-bottom: 10px;">
                                                            <div class="col-lg-12">
                                                                <p style="text-align: left"><b>Rencana Cuti</b> / <span style="font-style: italic;">Leave Declaration</span></p>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="rencana" value="1" required="true">Di Kota Batam <br> <small><i>In Batam Island</i></small>
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="rencana" required="true" value="2">Keluar Batam <br>
                                                                    <small><i>Out of Batam Island</i></small>
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="rencana" value="3" required="true">Keluar kota Batam yang sifatnya Mendesak/Emergency. <br>
                                                                    Merujuk pada Internal Memorandum Tanggal 5 Agustus 2020
                                                                    <br>
                                                                    <small><i>
                                                                            Out of Batam Island which is Urgent/Emergency. <br> Referring to Internal Memoranddum Date 5 August 2020
                                                                        </i></small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="col-lg-12" style="margin-top: 10px;">
                                                            <div class="col-lg-12">
                                                                <p>Kebijakan Karantina DIri Sendiri (Sefl Quarantine Policy) :</p>
                                                                <br>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="col-lg-12">
                                                                <div class="col-lg-1">
                                                                    <p style="text-align: right;">1.</p>
                                                                </div>
                                                                <div class="col-lg-11" style="text-align: justify;">
                                                                    <p>
                                                                        Bagi karyawan yang melakukan cuti didalam kota dan jika perusahaan mendapatkan informasi bahwa karyawan tersebut terbukti berpergian keluar kota Batam, maka akan dianggap cuti yang tidak dibayarkan dan wajib menjalankan karantina selama 14 hari sesampainya di Batam, yang mana karantina yang dijalankan akan memotong cuti karyawan tersebut dan dapat dikenakan disipliner.
                                                                        <br>
                                                                        <i>

                                                                            For employeess who have taken leave with prior intention of staying in Batam and if the company came to know that the employee traveled out of Batam, it will be considered as unpaid leave and there will be a mandatory 14 days quarantine upon returning to Batan where the quarantine period will deduct employee's annual leave and potentially disciplinary.
                                                                        </i>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="col-lg-12">
                                                                <div class="col-lg-1">
                                                                    <p style="text-align: right;">2.</p>
                                                                </div>
                                                                <div class="col-lg-11" style="text-align: justify;">
                                                                    <p>
                                                                        Bagi karyawan yang melakukan perjalanan cuti yang sifatnya mendesak atau perjalanan bisnis perusahan, setelah masa cuti/tugas nya sudah berakhir wajib melakukan Rapid-test sesampainya di Batam dan biayar Rapid-test sepenuhnya akan menjadi tanggung jawab perusahaan.
                                                                        <br>
                                                                        Wajib menjalankan karantina 14 hari.
                                                                        <br>
                                                                        <i>
                                                                            For employees who take urgent/emergancy leave or business trips, after the leave/duty peroid has ended, they are required to do a Rapid-test upon arrival in Batam. The cost of Rapid-test will be fully paid by the campany.
                                                                            <br>
                                                                            Mandatory quarantine for 14 days upon arrival will apply.
                                                                        </i>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="col-lg-12">
                                                                <div class="col-lg-1">
                                                                    <p style="text-align: right;">3.</p>
                                                                </div>
                                                                <div class="col-lg-11" style="text-align: justify;">
                                                                    <p>
                                                                        Bagi karyawan yang melakukan perjalanan cuti yang sifatnya tidak mendesak, maka setelah masa cutinya sudah berakhir wajib melakukan Rapid-test sesampainya di Batam dan wajib menjalankan karantina selama 14 hari dan selama masa karantina 14 hari karyawan tersebut menunjukan gejala maka wajib melakukan Swab-test.
                                                                        <br>
                                                                        Biaya yang timbul atas tes-tes tersebut sepenuhnya akan menjadi tanggung jawab karyawan itu sendiri.
                                                                        <br>
                                                                        <i>
                                                                            For employees who take non-urgent/emergency leave, after thea leave period has ended, they are required to do a Rapid-test upon the arrival in Batam and must serve quarantine for 14 days. During these 14 days quarantine peroid, if the employee shows symptoms, he/she is obliged to take a Swab-test.
                                                                            <br>
                                                                            Cost incurred for these tests will be borne by the employee.
                                                                        </i>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="col-lg-12">
                                                                <div class="col-lg-1">
                                                                    <p style="text-align: right;">4.</p>
                                                                </div>
                                                                <div class="col-lg-11" style="text-align: justify;">
                                                                    <p>
                                                                        Pada masa karantina bagi karyawan yang melakukan perjalanan cuti yang sifatnya tidak mendesak dan tidak dapat melakukan pekerjaannya dirumah (WFH) selama masa karantina dikarenakan keterbatasan hardware, satu dan lain hal maka akan dipotong cuti. Jika sudah habis maka akan dianggap unpaid leave.
                                                                        <br>
                                                                        <i>
                                                                            For employees who are takin non-urgent/emergency leave, during the quarantine period employees are unable to perform their duty at home (WFH) due to hardware limitations or due to any reasons, the employee will be considered taking annual leave. if the employee does not have sufficient annual leave, then it will be considered as unpaid leave.
                                                                        </i>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="col-lg-12">
                                                                <div class="col-lg-1">
                                                                    <p style="text-align: right;">5.</p>
                                                                </div>
                                                                <div class="col-lg-11" style="text-align: justify;">
                                                                    <p>
                                                                        Sebelum masuk bekerja karyawan wajib menunjukan hasil test disertai <b>Surat Keterangan Sehat</b> ke HRD.
                                                                        <br>
                                                                        <i>
                                                                            Before entering the workplace, employees are required to show the test results <b>accompanied by a healt certificate</b> to the HRD
                                                                        </i>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="col-lg-12" style="text-align: justify;">
                                                                <label class="checkbox-inline pull-left">
                                                                    <input type="checkbox" name="accept" value="1" required="true">
                                                                    <p>
                                                                        Saya dengan ini menyatakan bahwa informasi diatas yang terkandung dalam formulir ini adalah benar dan lengkap. Saya mengerti bahwa jika ditemukan bahwa saya telah membuat pernyataan palsu dalam bentuk ini, tindakan yang diperlukan akan diambil terhadap saya.
                                                                        <br>
                                                                        <i>
                                                                            I hereby declared that the information in this form is true and complete. I understand that if it is known that i have made a false declaration in this form, the necessary action shall be taken against me.
                                                                        </i>
                                                                    </p>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-lg-12">
                                                    <div class="col-lg-12">
                                                        <label class="checkbox-inline pull-left">
                                                            <input type="checkbox" name="agree" value="1" required="true">I agree to the Leave Declaration Form During the Covid-19 Pandemic
                                                        </label>
                                                    </div>
                                                </div>
                                                {!! Form::submit('Apply', ['class' => 'btn btn-sm btn-success']) !!}
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('assets_script_6')
        <script type="text/javascript">
            $('#ada').change(function() {
                $('#nama_kota').html('');
                var myElements = $("#ada").val();
                let situs = '{{ route("leave/findCity", ":element") }}'.replace(':element', myElements);
                $.ajax({
                        url: situs,
                        dataType: 'json',  
                        type: 'GET',                                                          
                        success: function(result) {
                            $.each(result, function(name, data) {
                                $('#nama_kota').append(`
                                <option value="` + titleCase(data.name) + `">` + titleCase(data.name) + `</option>
                                `);
                            });
                        },
                        error: function(xhr, status, error) {                           
                            alert('Destination City: ' + status + ' - ' + error);
                            alert('Please contact administator!! thanks you!');
                        }
                });
            });

            function titleCase(str) {
                str = str.toLowerCase().split(' ');
                for (var i = 0; i < str.length; i++) {
                    str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1);
                }
                return str.join(' ');
            }
        </script>
        @stop

        @section('bottom')
        @include('assets_script_1')
        @stop
