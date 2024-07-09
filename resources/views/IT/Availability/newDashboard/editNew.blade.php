@extends('layout')

@section('title')
    (it) Edit Data WS Availability
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

@push('style')
<style>
    .font-red {
        color: red;
    }
</style>
@endpush

@section('body')
<div class="row">
    <div class="col-lg-12"> s
        <h1 class="page-header">Edit Data Workstations</h1>
    </div>
</div>

<div class="row">
   <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                Form Edit
            </div>

            <div class="panel-body">

                <form action="{{ route('workstations/availability/update', [$workstations->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="font-red">Workstation</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="findUser">Find User:</label>
                                <select name="findUser" id="findUser" class="form-control" required>
                                    <option value=""></option>                             
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" @if ($user->id === $workstations->user_id)
                                            selected
                                        @endif>{{ $user->getFullName() }}</option>
                                    @endforeach
                                </select>
                                <div style="margin-top: 5px;">
                                        <a class="btn btn-sm btn-default" id="enable">Enable</a>
                                        <a class="btn btn-sm btn-default" id="disable">Disable</a>
                                </div>
                            </div>
                        </div>                      
                    </div>

                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="hostname">Hostname:</label>
                                <input type="text" name="hostname" id="hostname" class="form-control" value="{{ $workstations->hostname }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="type">Type:<sup class="font-red">*</sup></label>
                                <select name="type" id="type" class="form-control" required>
                                    @foreach ($wsType as $type)
                                        <option value="{{ $type }}" @if ($workstations->type == $type)
                                            selected
                                        @endif>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="user">User:<sup class="font-red">*</sup></label>
                                <input type="text" name="user" id="user" class="form-control" value="{{ $workstations->user }}" required disabled>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="os">OS:<sup class="font-red">*</sup></label>
                                    <select name="os" id="os" class="form-control" required>                                     
                                            <optgroup label="Windows">
                                            @foreach ($windows as $win)
                                                <option value="{{ $win }}" @if ($workstations->os == $win)
                                                    selected
                                                @endif>{{ $win }}</option>
                                            @endforeach
                                            </optgroup>
                                            <optgroup label="Linux">
                                                @foreach ($linux as $linuxs)
                                                    <option value="{{ $linuxs }}" @if ($workstations->os == $linuxs)
                                                        selected
                                                    @endif>{{ $linuxs }}</option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Unknown">
                                                <option value="">Nothing</option>                                                
                                            </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group col-lg-12">
                                <label for="memory">Memory:<sup class="font-red">*</sup></label>
                                <input type="text" name="memory" id="memory" class="form-control" value="{{ $workstations->memory }}">                              
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="vga">VGA:<sup class="font-red">*</sup></label>
                                <input type="text" name="vga" id="vga" class="form-control" value="{{ $workstations->vga }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="gateway">Gateway:<sup class="font-red">*</sup></label>
                                <select name="gateway" id="gateway" class="form-control" required>
                                    <option value="">- choose -</option>
                                    @foreach ($gateway as $gate)
                                        <option value="{{ $gate }}" @if ($workstations->gateway == $gate)
                                            selected
                                        @endif> {{ $gate }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="antivirus">Antivirus:<sup class="font-red">*</sup></label>
                                <input type="text" name="antivirus" id="antivirus" class="form-control text-uppercase" required value="{{ $workstations->antivirus ? : ''}}">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="usb">USB Port:<sup class="font-red">*</sup></label>
                                <select name="usb" id="usb" class="form-control" required>
                                    <option value="0" @if ($workstations->usb == false)
                                        selected
                                    @endif>No</option>
                                    <option value="1" @if ($workstations->usb == true)
                                        selected
                                    @endif>Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <label class="radio-inline"><input type="radio" name="status" id="status" required value="1" @if ($workstations->status === 1)
                                    checked
                                @endif>OK</label>
                                <label class="radio-inline"><input type="radio" name="status" id="status" required value="0" @if ($workstations->status === 2)
                                    checked
                                @endif>Fails</label>
                                <label class="radio-inline"><input type="radio" name="status" id="status" required value="2" @if ($workstations->status === 3)
                                    checked
                                @endif>Scrapped</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="font-red">Location</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="area">Area:</label>
                                <select name="area" id="area" class="form-control">
                                    <option value="">-select arae-</option>
                                    @foreach ($mapArea as $area)
                                        <option value="{{ $area }}" @if ($area === $workstations->location)
                                            selected
                                        @endif>{{ $area }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="used">Used:</label>
                                <select name="used" id="used" class="form-control">
                                    <option value="">-select used-</option>
                                    <option value="Main Workstation" @if (!empty($firstWS))
                                        selected
                                    @endif>Main Workstation</option>
                                    <option value="Second Workstation" @if(!empty($secondWS))
                                        selected
                                    @endif>Second Workstation</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group"></div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group"></div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group"></div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                    <label for="notes">Note:</label>
                                    <textarea name="notes" id="notes" cols="30" rows="3" class="form-control">{{ $workstations->notes }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-sm btn-success">Update</button>
                            <a href="{{ route('workstations/availability/index') }}" class="btn btn-sm btn-default">Back</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
   </div>
</div>

@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
@push('style')
<link href="{{ asset('assets/assets/plugins/select2/css/select2.css') }}" rel="stylesheet" />
<script src="{{ asset('assets/assets/plugins/select2/js/select2.js') }}" defer></script>
@endpush


@section('script')

$('select#findUser').select2({
    placeholder: 'type name user',
    allowClear: true,
    tags: true,
});

$("a#disable").on("click", function () {
    $("select#findUser").prop("disabled", true);
    $("input#user").prop("disabled", false);
});

$("a#enable").on("click", function () {
    $("select#findUser").prop("disabled", false);
    $("input#user").prop("disabled", true);
});
  

@endsection