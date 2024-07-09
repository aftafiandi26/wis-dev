@extends('layout')

@section('title')
    (hr) Change Data User
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
     @include('assets_css_3')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c1u' => 'collape in',
        'c1' => 'active', 'c15' => 'active'
    ])
@stop

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Change Data Employes e</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <b>Form Change User Employee</b>
                    </h5>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['updateEmployee/HRD', $users->id], 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-2">
                                @if ($errors->has('username'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('username', 'Username') !!}
                                    {!! Form::text('username', $users->username, ['class' => 'form-control', 'placeholder' => 'Username', 'maxlength' => 20, 'readonly' => true]) !!}
                                    <p class="help-block">{!! $errors->first('username') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('nik'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('nik', 'NIK') !!}<font color="red"> (*)</font>
                                    {!! Form::text('nik', $users->nik, ['class' => 'form-control', 'placeholder' => 'NIK', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('nik') !!}</p>
                            </div>
                        </div>

                            <div class="col-lg-2">
                                @if ($errors->has('first_name'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('first_name', 'First Name') !!}<font color="red"> (*)</font>
                                    {!! Form::text('first_name', $users->first_name, ['class' => 'form-control', 'placeholder' => 'First Name', 'maxlength' => 100]) !!}
                                    <p class="help-block">{!! $errors->first('first_name') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('last_name'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('last_name', 'Last Name') !!}
                                    {!! Form::text('last_name', $users->last_name, ['class' => 'form-control', 'placeholder' => 'Name User', 'maxlength' => 100]) !!}
                                    <p class="help-block">{!! $errors->first('last_name') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                @if ($errors->has('active'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('active', 'Active') !!}</br>
                                    @if ($users->active === 1)
                                        {!! Form::checkbox('active', 'Active', true, ['placeholder' => 'Active', 'maxlength' => 5]) !!} Active
                                    @else
                                        {!! Form::checkbox('active', 'Active', false, ['placeholder' => 'Active', 'maxlength' => 5]) !!} Active
                                    @endif
                                    <p class="help-block">{!! $errors->first('active') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-1">
                                @if ($errors->has('sp'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('sp', 'GM Approval') !!}</br>
                                    @if ($users->sp === 1)
                                        {!! Form::checkbox('sp', '2nd Approval', true, ['placeholder' => '2nd Approval', 'maxlength' => 5]) !!} Yes
                                    @else
                                        {!! Form::checkbox('sp', '2nd Approval', false, ['placeholder' => '2nd Approval', 'maxlength' => 5]) !!} Yes
                                    @endif
                                    <p class="help-block">{!! $errors->first('sp') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('ticket'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('ticket', 'Ticket Allowance') !!}</br>
                                    @if ($users->ticket === 1)
                                        {!! Form::checkbox('ticket', 'Ticket Allowance', true, ['placeholder' => 'Ticket Allowance', 'maxlength' => 5]) !!} Yes
                                    @else
                                        {!! Form::checkbox('ticket', 'Ticket Allowance', false, ['placeholder' => 'Ticket Allowance', 'maxlength' => 5]) !!} Yes
                                    @endif
                                    <p class="help-block">{!! $errors->first('ticket') !!}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                @if ($errors->has('position'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('position', 'Position') !!}<font color="red"> (*)</font>
                                    {!! Form::text('position', $users->position, ['class' => 'form-control', 'placeholder' => 'Position', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('position') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('dept_category_id'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('dept_category_id', 'Department') !!}<font color="red"> (*)</font>
                                    {!! Form::select('dept_category_id', $department, $dept, ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('dept_category_id') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('nationality'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('nationality', 'Nationality') !!}
                                    {!! Form::text('nationality', $users->nationality, ['class' => 'form-control', 'placeholder' => 'Nationality', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('nationality') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('emp_status'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('emp_status', 'Emp. Status') !!}<font color="red"> (*)</font>
                                    {!! Form::select('emp_status', $emp_status, old('emp_status'), ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('emp_status') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('join_date'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('join_date', 'Join Date') !!}
                                    {!! Form::date('join_date', $users->join_date, ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('join_date') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('end_date'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('end_date', 'End Date') !!}
                                    {!! Form::date('end_date', $users->end_date, ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('end_date') !!}</p>
                                </div>
                            </div>
                        </div>

                            <div class="row">
                            <div class="col-lg-2">
                                @if ($errors->has('maiden_name'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('maiden_name', 'Maiden Name') !!}
                                    {!! Form::text('maiden_name', $users->maiden_name, ['class' => 'form-control', 'placeholder' => 'Maiden Name', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('maiden_name') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('dob'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('dob', 'Date of Birth') !!}
                                    {!! Form::date('dob', $users->dob, ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('dob') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                 @if ($errors->has('pob'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('pob', 'Place of Birth') !!}
                                    {!! Form::text('pob', $users->pob, ['class' => 'form-control', 'placeholder' => 'Place of Birth', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('pob') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('province'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('province', 'Province') !!}
                                    {!! Form::text('province', $users->province, ['class' => 'form-control', 'placeholder' => 'Province', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('province') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('gender'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('gender', 'Gender') !!}
                                    {!! Form::select('gender', $gender, old('gender'), ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('gender') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('id_card'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('id_card', 'ID Card') !!}
                                    {!! Form::text('id_card', $users->id_card, ['class' => 'form-control', 'placeholder' => 'ID Card', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('id_card') !!}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                @if ($errors->has('email'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('email', 'Email') !!}<font color="red"> (*)</font>
                                    {!! Form::text('email', $users->email, ['class' => 'form-control', 'placeholder' => 'Email', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('email') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('phone'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('phone', 'Phone Number') !!}
                                    {!! Form::text('phone', $users->phone, ['class' => 'form-control', 'placeholder' => 'Phone Number', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('phone') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('address'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('address', 'Address') !!}
                                    {!! Form::text('address', $users->address, ['class' => 'form-control', 'placeholder' => 'Address', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('address') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('area'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('area', 'Area') !!}
                                    {!! Form::text('area', $users->area, ['class' => 'form-control', 'placeholder' => 'Area', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('area') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('city'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('city', 'City') !!}
                                    {!! Form::text('city', $users->city, ['class' => 'form-control', 'placeholder' => 'City', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('city') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('education'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('education', 'Education') !!}
                                    {!! Form::text('education', $users->education, ['class' => 'form-control', 'placeholder' => 'Education', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('education') !!}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                @if ($errors->has('marital_status'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('marital_status', 'Marital Status') !!}
                                    {!! Form::select('marital_status', $marital_status, old('Marital Status'), ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('marital_status') !!}</p>
                                </div>
                            </div>

                          <!--  <div class="col-lg-2">
                                @if ($errors->has('race'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('race', 'Race') !!}
                                    {!! Form::text('race', $users->race, ['class' => 'form-control', 'placeholder' => 'Race', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('race') !!}</p>
                                </div>
                            </div>   -->                         

                            <div class="col-lg-2">
                                @if ($errors->has('npwp'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('npwp', 'NPWP') !!}
                                    {!! Form::text('npwp', $users->npwp, ['class' => 'form-control', 'placeholder' => 'NPWP', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('npwp') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('kk'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('kk', 'KK') !!}
                                    {!! Form::text('kk', $users->kk, ['class' => 'form-control', 'placeholder' => 'KK', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('kk') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('religion'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('religion', 'Religion') !!}
                                    {!! Form::text('religion', $users->religion, ['class' => 'form-control', 'placeholder' => 'Religion', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('religion') !!}</p>
                                </div>
                           

                           <!-- <div class="col-lg-2">
                                @if ($errors->has('dependent'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('dependent', 'Dependent') !!}
                                    {!! Form::text('dependent', $users->dependent, ['class' => 'form-control', 'placeholder' => 'Dependent', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('dependent') !!}</p>
                                </div>
                            </div>-->
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-lg-2">
                                @if ($errors->has('bpjs_ketenagakerjaan'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('bpjs_ketenagakerjaan', 'BPJS Ketenagakerjaan') !!}
                                    {!! Form::text('bpjs_ketenagakerjaan', $users->bpjs_ketenagakerjaan, ['class' => 'form-control', 'placeholder' => 'BPJS Ketenagakerjaan', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('bpjs_ketenagakerjaan') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('bpjs_kesehatan'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('bpjs_kesehatan', 'BPJS Kesehatan') !!}
                                    {!! Form::text('bpjs_kesehatan', $users->bpjs_kesehatan, ['class' => 'form-control', 'placeholder' => 'BPJS Kesehatan', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('bpjs_kesehatan') !!}</p>
                                </div>
                            </div>
                       

                            <!-- <div class="col-lg-2">
                                @if ($errors->has('bpjs_jht'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('bpjs_jht', 'BPJS JHT') !!}
                                    {!! Form::text('bpjs_jht', $users->bpjs_jht, ['class' => 'form-control', 'placeholder' => 'BPJS JHT', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('bpjs_jht') !!}</p>
                                </div>
                            </div>-->

                            <div class="col-lg-2">
                                @if ($errors->has('rusun'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('rusun', 'Address in Rusun') !!} (<font color="red">ex: TB 99-999</font>)
                                    {!! Form::text('rusun', $users->rusun, ['class' => 'form-control', 'placeholder' => 'BL 99-999', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('rusun') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('rusun_stat'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('rusun_stat', 'Rusun Status') !!}
                                    {!! Form::select('rusun_stat', $rusun_stat, old('Rusun Status'), ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('rusun_stat') !!}</p>
                                </div>
                            </div>

                           <!-- <div class="col-lg-2">
                                @if ($errors->has('reason_off_leaving'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('reason_off_leaving', 'Reason Off Leaving') !!}
                                    {!! Form::text('reason_off_leaving', $users->reason_off_leaving, ['class' => 'form-control', 'placeholder' => 'Reason Off Leaving', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('reason_off_leaving') !!}</p>
                                </div>
                            </div>
                            
                            <div class="col-lg-2">
                                @if ($errors->has('reentry_to_company'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('reentry_to_company', 'Reentry to Company') !!}
                                    {!! Form::text('reentry_to_company', $users->reentry_to_company, ['class' => 'form-control', 'placeholder' => 'Reentry to Company', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('reentry_to_company') !!}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                @if ($errors->has('source_company'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('source_company', 'Source Company') !!}
                                    {!! Form::text('source_company', $users->source_company, ['class' => 'form-control', 'placeholder' => 'Source Company', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('source_company') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('global_id'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('global_id', 'Global ID') !!}
                                    {!! Form::text('global_id', $users->global_id, ['class' => 'form-control', 'placeholder' => 'Global ID', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('global_id') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('init_date'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('init_date', 'Init Date') !!}
                                    {!! Form::date('init_date', $users->init_date, ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('init_date') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('tax_cut_in'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('tax_cut_in', 'Tax Cut In') !!}
                                    {!! Form::text('tax_cut_in', $users->tax_cut_in, ['class' => 'form-control', 'placeholder' => 'Tax Cut In', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('tax_cut_in') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('tax_cut_off'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('tax_cut_off', 'Tax Cut Off') !!}
                                    {!! Form::text('tax_cut_off', $users->tax_cut_off, ['class' => 'form-control', 'placeholder' => 'Tax Cut Off', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('tax_cut_off') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('cob'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('cob', 'COB') !!}
                                    {!! Form::text('cob', $users->cob, ['class' => 'form-control', 'placeholder' => 'COB', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('cob') !!}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                @if ($errors->has('reentry_to_otherco'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('reentry_to_otherco', 'Reentry to other company') !!}
                                    {!! Form::text('reentry_to_otherco', $users->reentry_to_otherco, ['class' => 'form-control', 'placeholder' => 'Reentry to other company', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('reentry_to_otherco') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('remark'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('remark', 'Remark') !!}
                                    {!! Form::text('remark', $users->remark, ['class' => 'form-control', 'placeholder' => 'Remark', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('remark') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('jpk'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('jpk', 'JPK') !!}
                                    {!! Form::text('jpk', $users->jpk, ['class' => 'form-control', 'placeholder' => 'JPK', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('jpk') !!}</p>
                                </div>
                            </div>-->

                            <div class="col-lg-2">
                                @if ($errors->has('initial_annual'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('initial_annual', 'Annual Entitlement') !!}
                                    @if ($users->emp_status === 'Contract')
                                        {!! Form::text('initial_annual', $users->initial_annual, ['class' => 'form-control', 'placeholder' => 'Annual Entitlement', 'maxlength' => 100, 'autofocus' => true, 'readonly' => true]) !!}
                                    @else
                                        {!! Form::text('initial_annual', $users->initial_annual, ['class' => 'form-control', 'placeholder' => 'Annual Entitlement', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    @endif
                                    <p class="help-block">{!! $errors->first('initial_annual') !!}</p>
                                </div>
                           </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                @if ($errors->has('project_category_id_1'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('project_category_id_1', 'Main Project') !!}
                                    @if ($users->project_category_id_1 != null)
                                        {!! Form::select('project_category_id_1', $project1, $proj1, ['class' => 'form-control', 'placeholder' => '']) !!}
                                    @else
                                        {!! Form::select('project_category_id_1', $project1, $proj1, ['class' => 'form-control']) !!}
                                    @endif                                    
                                    <p class="help-block">{!! $errors->first('project_category_id_1') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('project_category_id_2'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('project_category_id_2', 'Second Project') !!}
                                    @if ($users->project_category_id_2 != null)
                                        {!! Form::select('project_category_id_2', $project2, $proj2, ['class' => 'form-control', 'placeholder' => '']) !!}
                                    @else
                                        {!! Form::select('project_category_id_2', $project2, $proj2, ['class' => 'form-control']) !!}
                                    @endif
                                    <p class="help-block">{!! $errors->first('project_category_id_2') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('project_category_id_3'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('project_category_id_3', 'Third Project') !!}
                                    @if ($users->project_category_id_3 != null)
                                        {!! Form::select('project_category_id_3', $project3, $proj3, ['class' => 'form-control', 'placeholder' => '']) !!}
                                    @else
                                        {!! Form::select('project_category_id_3', $project3, $proj3, ['class' => 'form-control']) !!}
                                    @endif
                                    <p class="help-block">{!! $errors->first('project_category_id_3') !!}</p>
                                </div>
                            </div>
                        </div>
                 


                        <div class="row">
                            <div class="col-lg-8">
                                @if ($errors->has('prof_pict'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('prof_pict', 'Profile Picture') !!}
                                    {!! Form::file('prof_pict', ['autofocus' => true, 'max' => true]) !!} <br>
                                    &nbsp&nbsp
                                    <img src="{{ asset('storage/app/prof_pict/'.$users->prof_pict)  }}" class="img-circle" style="width: 40px; height: 40px;">
                                    <p class="help-block">{!! $errors->first('prof_pict') !!}</p>
                                </div>
                            </div>
                        </div>

                      <!-- {!! Form::submit('Save', ['onclick' => 'myFunction', 'title' => 'Save', 'class' => 'btn btn-sm btn-success', 'data-toggle' => 'modal', 'data-target' => '#Save'])!!}-->
                        <!--<button  class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal">Save</button>-->
                        
                       <!--  <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal">Save</button> -->
                       <a class="btn btn-sm btn-warning" href="{!! URL::route('Employee-HRD') !!}">Back</a>
                     

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>         
        </div>
        <div class="modal-body">
          <p>Are you sure want to update data.</p>
        </div>
        <div class="modal-footer">
        {!! Form::submit('Save', ['onclick' => 'myFunction', 'title' => 'Save', 'class' => 'btn btn-sm btn-success', 'data-toggle' => 'modal', 'data-target' => '#Save'])!!}
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
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
    
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
@stop

