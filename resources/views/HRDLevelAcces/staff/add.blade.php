@extends('layout')

@section('title')
    (hr) New Data Employee
@stop

@section('top')
    @include('assets_css_1')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c1' => 'active'
    ])
@stop

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Data Employee</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <b>Form Data Employee</b>
                    </h5>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => 'saveEmployee', 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
                    {{ csrf_field() }}
                        <div class="row">
                           
                            

                            <div class="col-lg-2">
                                @if ($errors->has('nik'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('nik', 'NIK') !!}<font color="red">(*) </font>
                                    {!! Form::text('nik', old('nik'), ['class' => 'form-control', 'placeholder' => 'NIK', 'maxlength' => 100, 'required' => true]) !!}
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
                					{!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => 'Name User', 'maxlength' => 100, 'required' => true]) !!}
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
                                    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => 'Name User', 'maxlength' => 100]) !!}
                                    <p class="help-block">{!! $errors->first('last_name') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                @if ($errors->has('active'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('active', 'Active') !!}<br>
                                    {!! Form::checkbox('active', 'Active', true, ['placeholder' => 'Active', 'maxlength' => 5]) !!} Active
                                    <p class="help-block">{!! $errors->first('active') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-1">
                                @if ($errors->has('sp'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('sp', 'GM Approval') !!}<br>
                                    {!! Form::checkbox('sp', '2nd Approval', false, ['placeholder' => '2nd Approval', 'maxlength' => 5]) !!} Yes
                                    <p class="help-block">{!! $errors->first('sp') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('ticket'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('ticket', 'Ticket Allowance') !!}<br>
                                    {!! Form::checkbox('ticket', 'Ticket Allowance', true, ['placeholder' => 'Ticket Allowance', 'maxlength' => 5]) !!} Yes
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
                                    {!! Form::text('position', old('position'), ['class' => 'form-control', 'placeholder' => 'Position', 'maxlength' => 100, 'autofocus' => true, 'required' => true]) !!}
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
                                    {!! Form::select('dept_category_id', $department, old('dept_category_id'), ['class' => 'form-control', 'required' => true]) !!}
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
                                    {!! Form::text('nationality', old('nationality'), ['class' => 'form-control', 'placeholder' => 'Nationality', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                    {!! Form::select('emp_status', $emp_status, old('emp_status'), ['class' => 'form-control', 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('emp_status') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('join_date'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('join_date', 'Join Date') !!}<br>
                                    {!! Form::date('join_date', null, ['class' => 'form-control', 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('join_date') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('end_date'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('end_date', 'End Date') !!}<br>
                                    {!! Form::date('end_date', null, ['class' => 'form-control', 'required' => false]) !!}
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
                                    {!! Form::text('maiden_name', old('maiden_name'), ['class' => 'form-control', 'placeholder' => 'Maiden Name', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('maiden_name') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('dob'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('dob', 'Date of Birth') !!}<br>
                                    {!! Form::date('dob', null, ['class' => 'form-control']) !!}
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
                                    {!! Form::text('pob', old('pob'), ['class' => 'form-control', 'placeholder' => 'Place of Birth', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                   {!! Form::select('province', $Province, old('province'), ['class' => 'form-control']) !!}
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
                                    {!! Form::text('id_card', old('id_card'), ['class' => 'form-control', 'placeholder' => 'ID Card', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('id_card') !!}</p>
                                </div>
                            </div>
                            </div>

                            <div class="row">
                            
                            
                            <div class="col-lg-2">
                                @if ($errors->has('phone'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('phone', 'Phone Number') !!}
                                    {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Phone Number', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                    {!! Form::text('address', old('address'), ['class' => 'form-control', 'placeholder' => 'Address', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                    {!! Form::text('area', old('area'), ['class' => 'form-control', 'placeholder' => 'Area', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                    {!! Form::text('city', old('city'), ['class' => 'form-control', 'placeholder' => 'City', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                    {!! Form::select('education', $education, old('education'), ['class' => 'form-control', 'required' => 'true']) !!}
                                    <p class="help-block">{!! $errors->first('education') !!}</p>
                                </div>
                            </div>  
                            <div class="col-lg-2">
                                @if ($errors->has('education_institution'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('education_institution', 'Education Institution') !!}
                                    {!! Form::text('education_institution', old('education_institution'), ['class' => 'form-control', 'required' => 'true']) !!}
                                    <p class="help-block">{!! $errors->first('education_institution') !!}</p>
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
                            <div class="col-lg-2">
                                @if ($errors->has('npwp'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('npwp', 'NPWP') !!}
                                    {!! Form::text('npwp', old('npwp'), ['class' => 'form-control', 'placeholder' => 'NPWP', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                    {!! Form::text('kk', old('kk'), ['class' => 'form-control', 'placeholder' => 'KK', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                   {!! Form::select('religion', $religion, old('religion'), ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('religion') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                @if ($errors->has('wfh'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('wfh', 'Work Status') !!}
                                    {!! Form::select('wfh', $wfh, old('wfh'), ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('wfh') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                @if ($errors->has('statWfh'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('statWfh', 'Worked Hometown') !!}
                                    {!! Form::text('statWfh', old('statWfh'), ['class' => 'form-control', 'placeholder' => 'town', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('statWfh') !!}</p>
                                </div>
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
                                    {!! Form::text('bpjs_ketenagakerjaan', old('bpjs_ketenagakerjaan'), ['class' => 'form-control', 'placeholder' => 'BPJS Ketenagakerjaan', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                    {!! Form::text('bpjs_kesehatan', old('bpjs_kesehatan'), ['class' => 'form-control', 'placeholder' => 'BPJS Kesehatan', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                    {!! Form::text('bpjs_jht', old('bpjs_jht'), ['class' => 'form-control', 'placeholder' => 'BPJS JHT', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('bpjs_jht') !!}</p>
                                </div>-->
                            <!--</div>--> 

                            <div class="col-lg-2">
                                @if ($errors->has('rusun'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('rusun', 'Address in Rusun') !!} (<font color="red">ex: TB 99-999</font>)
                                    {!! Form::text('rusun', old('rusun'), ['class' => 'form-control', 'placeholder' => 'BL 99-999', 'maxlength' => 100, 'autofocus' => true]) !!}
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

                          <!--  <div class="col-lg-2">
                                @if ($errors->has('reason_off_leaving'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('reason_off_leaving', 'Reason Off Leaving') !!}
                                    {!! Form::text('reason_off_leaving', old('reason_off_leaving'), ['class' => 'form-control', 'placeholder' => 'Reason Off Leaving', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                    {!! Form::text('reentry_to_company', old('reentry_to_company'), ['class' => 'form-control', 'placeholder' => 'Reentry to Company', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                    {!! Form::text('source_company', old('source_company'), ['class' => 'form-control', 'placeholder' => 'Source Company', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                    {!! Form::text('global_id', old('global_id'), ['class' => 'form-control', 'placeholder' => 'Global ID', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                    {!! Form::date('dob', null, ['class' => 'form-control']) !!}
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
                                    {!! Form::text('tax_cut_in', old('tax_cut_in'), ['class' => 'form-control', 'placeholder' => 'Tax Cut In', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                    {!! Form::text('tax_cut_off', old('tax_cut_off'), ['class' => 'form-control', 'placeholder' => 'Tax Cut Off', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                    {!! Form::text('cob', old('cob'), ['class' => 'form-control', 'placeholder' => 'COB', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                    {!! Form::text('reentry_to_otherco', old('reentry_to_otherco'), ['class' => 'form-control', 'placeholder' => 'Reentry to other company', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                    {!! Form::text('remark', old('remark'), ['class' => 'form-control', 'placeholder' => 'Remark', 'maxlength' => 100, 'autofocus' => true]) !!}
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
                                    {!! Form::text('jpk', old('jpk'), ['class' => 'form-control', 'placeholder' => 'JPK', 'maxlength' => 100, 'autofocus' => true]) !!}
                                    <p class="help-block">{!! $errors->first('jpk') !!}</p>
                                </div>
                            </div>-->
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                @if ($errors->has('project_category_id_1'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('project_category_id_1', 'Main Project') !!}
                                    {!! Form::select('project_category_id_1', $project1, old('project_category_id_1'), ['class' => 'form-control', 'required' => false]) !!}
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
                                    {!! Form::select('project_category_id_2', $project2, old('project_category_id_1'), ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('project_category_id_2') !!}</p>
                                </div>
                            </div>

                           <!--  <div class="col-lg-2">
                                @if ($errors->has('project_category_id_3'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('project_category_id_3', 'Project 3') !!}
                                    {!! Form::select('project_category_id_3', $project3, old('project_category_id_1'), ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('project_category_id_3') !!}</p>
                                </div>
                            </div> -->
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
                                    <p class="help-block">{!! $errors->first('prof_pict') !!}</p>
                                </div>
                            </div>
                        </div>

                        {!! Form::submit('Save', ['class' => 'btn btn-sm btn-success']) !!}
                        <a class="btn btn-sm btn-warning" href="{!! URL::route('employee') !!}">Back</a>
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
@stop