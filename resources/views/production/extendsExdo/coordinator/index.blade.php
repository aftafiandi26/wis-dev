@extends('layout')

@section('title')
    Coordinator - Extended of Exdo
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
    @include('asset_select2')
@stop

@push('style')
<style>
    .text-red {
        color: red;
    }
</style>
@endpush

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active'
    ])
@stop

@section('body')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Extended of Exdo</h1>
    </div>
</div>  

<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('coordinator/exdo-extends/cookies') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="emp">Employes:</label>
                        <select name="emp" id="emp" class="form-control">
                            <option></option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->getFullName() }}</option>                                
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-xs btn-default">get-data</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover table-stripped table-condensed table-bordered" width="100%" id="tableExtends">
            <thead>
                <tr>
                    <th>No</th>                    
                    <th>Employes</th>
                    <th>Exdo</th>
                    <th>Expired</th>
                    <th>Changed</th>
                    <th>Status</th>
                </tr>
            </thead>
        </table>
        
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
    @include('assets_script_2')
    @include('assets_script_3')
    @include('assets_script_7')
@stop

@section('script')

var redNames = '{{ $eoc }}';

$("select#emp").select2({
    placeholder: "Select a employee",
    theme: "classic",
    templateResult: function (data) {
        if (!data.id) {
            return data.text;
        }

        var $result = $('<span></span>');
        $result.text(data.text);
        if (redNames.includes(data.text)) {
            $result.addClass('text-red');
        }
        console.log($result);

        return $result;
    }
}).on('select2:select', function (e) {
    var selectedText = e.params.data.text;
    var $container = $('#select2-emp-container').text();

    if (redNames.includes(selectedText)) {
        window.alert($container + " contract period will end soon, please note this");
    }
});

$('#tableExtends').DataTable({
    processing: true,
    responsive: true,
    ajax: {
        "url": "{{ route('coordinator/exdo-extends/data') }}",
        "type": "GET",
    },
    columns: [
        { data: 'DT_Row_Index', orderable: false, searchable : false},   
        { data: 'employee'},
        { data: 'amount'},
        { data: 'init_expired'},
        { data: 'expired'},
        { data: 'status'},
    ],
});
@stop