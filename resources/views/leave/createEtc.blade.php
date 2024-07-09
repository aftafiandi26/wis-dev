@extends('layout')

@section('title')
Applying Leave
@stop

@section('top')
@include('assets_css_1')
@include('assets_css_2')
@include('asset_select2')

@stop

@section('navbar')
@include('navbar_top')
@include('navbar_left', [
'c2' => 'active',
'c16' => 'active'
])
@stop

@push('style')
<style>
    .text-red {
        color: red;
    }
    .visibility-hidden {        
        visibility: hidden;
    }
    .uppercase-text {
        text-transform: uppercase;
    }
</style>    
@endpush
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Applying <span id="HeadName">Sick</span> Leave
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
                {!! Form::open(['route' => 'leaveEtc/store', 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}     
                        
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
                                            <span style="color: red;">{!! Form::label('back_work', 'Back to Work at') !!}</span>
                                            <br>
                                            {!! Form::date('back_work', old('back_work'), ['class' => 'form-control', 'placeholder' => 'Back to Work at', 'maxlength' => 100, 'required' => true, 'id' => 'back_work']) !!}
                                            <p class="help-block">{!! $errors->first('back_work') !!}</p>

                                        </div>
                                    </div>
                                    @endif
                             
                                {{-- ini dya --}}
                                <div class="col-lg-1">
                                    @if ($errors->has('back_work'))
                                    <div class="form-group has-error">
                                        @else
                                        <div class="form-group">                                         
                                            <span style="color: red;">{!! Form::label('perhitungan', 'Day') !!}</span>
                                            <br>
                                            <input type="text" name="perhitungan" id="perhitungan" class="form-control" readonly required>
                                            <p class="help-block">{!! $errors->first('back_work') !!}</p>

                                        </div>
                                    </div>
                                    @endif
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
                                                {!! Form::select('leave_category_id', $leave, old('leave_category_id'), ['class' => 'form-control', 'required' => true, 'id' => 'sickness']) !!}
                                                <p class="help-block">{!! $errors->first('leave_category_id') !!}</p>
                                            </div>
                                        </div>

                                        <div class="col-lg-1">
                                            <div class="form-group">
                                                <label id="entitlement">Balance</label>
                                                {!! Form::text('entitlement', '3', ['class' => 'form-control', 'maxlength' => 100, 'autofocus' => true, 'readonly' => true, 'min' => true, 'id' => 'balanceID']) !!}
                                                <p class="help-block">{!! $errors->first('entitlement') !!}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <div class="form-group">
                                                <label for="remaining">Remains</label>
                                                <input type="text" name="remaining" id="remaining" class="form-control" readonly required>
                                                <p class="help-block">{!! $errors->first('remaining') !!}</p>
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
                                            <div class="col-lg-2"></div>
                                            <div class="col-lg-2" id="divFile">
                                                <label for="fileInput" class="text-red">Attachment <sup><small>(JPG, PNG)</small></sup> </label>
                                                <input type="file" name="fileInput" id="fileInput" class="form-control" required accept=".jpg, .jpeg, .png" capture="user"> 
                                            </div>
                                            <div class="col-lg-2" id="divHospital">
                                                <label for="hospital" class="text-red">Hospital Name</label>
                                                <input type="text" name="hospital" id="hospital" class="form-control uppercase-text" required>
                                            </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            {!! Form::label('city', 'Destination City') !!}
                                            <select class="form-control" name="nama_city" required="true" id="nama_kota" required="true"></select>
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
                                                        <!-- {!! Form::select('sendto', $proe, old('sendto'), ['class' => 'form-control', 'required' => true]) !!} -->

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
                                                            {!! Form::label('sendtoProducer', 'Select Your Producer :') !!}
                                                            <!-- {!! Form::select('sendtoProducer', $producer, old('sendtoProducer'), ['class' => 'form-control', 'required' => true]) !!}     -->
                                                            <select class="form-control" name="sendtoProducer" required>
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
                                        <input type="text" class="hidden" value="{{ $adminFacility }}" name="adminFacility">
                                    </div>
                                </div>                              
                                {{-- <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal">Apply</button> --}}
                                <button class="btn btn-sm btn-success"type="submit" id="apply-form">Apply</button>                               
                                <a class="btn btn-sm btn-warning" href="{!! URL::route('leave/apply') !!}">Back</a>
                                {{-- @include('leave.modal.self_declaration') --}}
                            {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div> 
@stop
@section('bottom')
    @include('assets_script_1')
    <script src="{!! URL::route('assets/js/jquery') !!}"></script>   
@stop     
@push('js')
<script type="text/javascript">               
    $('#ada').change(function() {
        $('#nama_kota').html('');
        var myElements = $("#ada").val();
        // var situs = 'https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' + myElements + '.json';
        let situs = '{{ route("leave/ecek", ":element") }}'.replace(':element', myElements);
    
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

    const hariLibur = '<?= $holiday; ?>';

    function dapatkanHariSabtuMingguDanLibur(tanggalAwal, tanggalAkhir, hariLibur) {
        var hasil = {
            sabtu: [],
            minggu: [],
            libur: []
        };

        // Loop melalui setiap hari antara tanggalAwal dan tanggalAkhir
        var tanggal = new Date(tanggalAwal);
        while (tanggal <= tanggalAkhir) {
            var hari = tanggal.getDay(); // Mendapatkan hari dalam seminggu (0 untuk Minggu, 1 untuk Senin, dst.)

            // Memeriksa apakah hari adalah Sabtu atau Minggu
            if (hari === 0 || hari === 6) {
            hasil[hari === 0 ? 'minggu' : 'sabtu'].push(new Date(tanggal));
            }

            // Memeriksa apakah hari adalah hari libur
            var tanggalISO = tanggal.toISOString().split('T')[0];
            if (hariLibur.includes(tanggalISO)) {
            hasil.libur.push(new Date(tanggal));
            }

            tanggal.setDate(tanggal.getDate() + 1); // Pindah ke hari berikutnya
        }

        return hasil;
    }

    function hitungHariKerja(tanggalAwal, tanggalAkhir, hariLibur) {
        var selisihHari = 0;

        while (tanggalAwal <= tanggalAkhir) {
            var hari = tanggalAwal.getDay(); // Mendapatkan hari dalam seminggu (0 untuk Minggu, 1 untuk Senin, dst.)

            // Memeriksa apakah hari adalah hari kerja (Senin hingga Jumat) dan bukan hari libur
            if (hari >= 1 && hari <= 5 && !hariLibur.includes(tanggalAwal.toISOString().split('T')[0])) {
            selisihHari++;
            }

            tanggalAwal.setDate(tanggalAwal.getDate() + 1); // Pindah ke hari berikutnya
        }

        return selisihHari;
    }     

    $('input#endLeave').on('change', function(e) 
    {
        
        var endLeave = $(this).val();                   
        var startLeave = $('input#startLeave').val();
        var backWork = $('input#back_work').val();

        var balanceID = $('input#balanceID').val();

        // Mendefinisikan dua tanggal
        const tanggal1 = new Date(startLeave);
        const tanggal2 = new Date(endLeave);                   

        // Menghitung selisih hari
        const selisihHari = Math.floor((tanggal2.getTime() - tanggal1.getTime()) / (1000 * 60 * 60 * 24));                 
        var hasil = hitungHariKerja(tanggal1, tanggal2, hariLibur);

        if (backWork == endLeave) {
            var hasil = hasil - 0.5;
        }
        document.getElementById('perhitungan').value = hasil;


        var hasilRemains = parseFloat(balanceID) - parseFloat(hasil);   
        document.getElementById('remaining').value = parseFloat(hasilRemains);      
        

        if(hasilRemains < 0) {     
            e.preventdefault();                   
            alert("Sorry, your leave balance is not enough");
            alert("This page will be reload");
            location.reload();
        }                    

        if (startLeave > endLeave) {
            document.getElementById('endLeave').value = null;
            document.getElementById('back_work').value = null;
        }

        if (endLeave > backWork) {
            document.getElementById('back_work').value = null;
        }

        if (!startLeave) {           
            document.getElementById('back_work').value = null;
            document.getElementById('perhitungan').value = 0;
            document.getElementById('remaining').value = balanceID;
        }
        
    });

    $('input#startLeave').on('change', function() 
    { 
        var endLeave = $('input#endLeave').val();                   
        var balanceID = $('input#balanceID').val();
        var startLeave = $(this).val();  

        var backWork = $('input#back_work').val();

        // Mendefinisikan dua tanggal
        const tanggal1 = new Date(startLeave);
        const tanggal2 = new Date(endLeave);                   

        // Menghitung selisih hari
        const selisihHari = Math.floor((tanggal2.getTime() - tanggal1.getTime()) / (1000 * 60 * 60 * 24));
        var ape = selisihHari + 1;

        var hasil = hitungHariKerja(tanggal1, tanggal2, hariLibur);

        document.getElementById('perhitungan').value = hasil;

        var hasilRemains = parseFloat(balanceID) - parseFloat(hasil);
        document.getElementById('remaining').value = parseFloat(hasilRemains);

        if(hasilRemains < 0) {    
            e.preventdefault();                    
            alert("Sorry, your leave balance is not enough");
            alert("This page will be reload");
            location.reload();
        }

        if (startLeave > endLeave) {
            document.getElementById('endLeave').value = null;
            document.getElementById('back_work').value = null;
        }

        if (endLeave > backWork) {
            document.getElementById('back_work').value = null;
        }
    });

    $('input#back_work').on('change', function() {
        var endLeave = $('input#endLeave').val();
        var startLeave = $('input#startLeave').val();
        var backWork = $(this).val();
        var balanceID = $('input#balanceID').val();

        // Mendefinisikan dua tanggal
        const tanggal1 = new Date(startLeave);
        const tanggal2 = new Date(endLeave);    

        if (backWork == endLeave) {
            var count = 0.5;

            var perhitungan = $('input#perhitungan').val();
            var output = parseFloat(perhitungan) - count;

            document.getElementById('perhitungan').value = output;
        
            var hasilRemains = parseFloat(balanceID) - output;
            document.getElementById('remaining').value = hasilRemains;                    
        }

        if (backWork < endLeave) {
            $(this).value = null;
        }

        if (backWork > endLeave) {  
            // Menghitung selisih hari
            const selisihHari = Math.floor((tanggal2.getTime() - tanggal1.getTime()) / (1000 * 60 * 60 * 24));                 
            var hasil = hitungHariKerja(tanggal1, tanggal2, hariLibur);
            document.getElementById('perhitungan').value = hasil;

            var hasilRemains = parseFloat(balanceID) - parseFloat(hasil);
            document.getElementById('remaining').value = parseFloat(hasilRemains);
        }     
        
        if (startLeave > endLeave) {
            document.getElementById('endLeave').value = null;
            document.getElementById('startLeave').value = null;
            document.getElementById('back_work').value = null;
            alert('Sorry, "End Leave Date" must be greater than "Start Leave Date"" !!');                    
        }
    });

    $('select#sickness').on('change', function() {
        var category = $(this).val(); 
        var fileInput = document.getElementById('divFile');
        var hospitalInput = document.getElementById('divHospital');

        var file = document.getElementById('fileInput');
        var hospital = document.getElementById('hospital');

        var perhitungan = $('input#perhitungan').val();

        var nameCategory = category.replace(/\([^)]*\)/g, '').trim();
        var angkaIndexAwal = category.indexOf("(") + 1;
        var angkaIndexAkhir = category.indexOf(")");
        var nilaiAngka = angkaIndexAwal > 0 && angkaIndexAkhir > angkaIndexAwal ? category.substring(angkaIndexAwal, angkaIndexAkhir) : null;
        var teksTanpaAngka = nilaiAngka ? nilaiAngka.replace(/\d+/g, '').trim() : null;

        var amount = 1;           
        
        if (nameCategory == "Sick") {
            var nilaiAngka = 3;
            fileInput.classList.remove('visibility-hidden');
            file.setAttribute("required", "required");
            hospitalInput.classList.remove('visibility-hidden');
            hospital.setAttribute("required", "required");
        }
        if (nameCategory !== "Sick") {                    
            fileInput.classList.add('visibility-hidden');
            file.removeAttribute("required");
            hospitalInput.classList.add('visibility-hidden');
            hospital.removeAttribute("required");
        }

        if (nameCategory == "Unpaid" || nameCategory == "Others") {
            var nilaiAngka = 5;
        }

        if (teksTanpaAngka == "Month") {
            var amount = 22;
        }        

        var angka = nilaiAngka ? parseFloat(nilaiAngka) * amount : null;

        document.getElementById('HeadName').innerText = nameCategory;

        document.getElementById('balanceID').value = angka;

        var remaining = parseFloat(angka) - parseFloat(perhitungan);

        document.getElementById('remaining').value = remaining;
    });

    $('input#fileInput').on('change', function(e) {                
        const fileInput = document.getElementById("fileInput");

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0]; 

            const fileSizeInBytes = fileInput.files[0].size;
            const fileSizeInKB = fileSizeInBytes / 1024;
            const fileSizeInMB = fileSizeInKB / 1024;
            
            const roundedMB = Math.round(fileSizeInMB);

            if (roundedMB > 7) {
                window.alert('Sorry, your file is too large !!');

                fileInput.value = null;
            }
                                
        } else {
            console.error("Please select a file");
        }
    });  
</script>
 @endpush