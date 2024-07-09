@extends('layout')

@section('title')
    Registration Form Working on Weekends
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
    @include('asset_select2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'workingWeekends01' => 'active'
    ])
@stop
@push('style')
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@5.39.0/dist/css/tempus-dominus.min.css">

<style>
    .text-bold {
        font-weight: bold;
    }
    a#edit {       
        background-color: yellow;
        color: black;
        border-radius: 10px;
    }

    a#edit:hover {       
        background-color: white;
        color: black;
        border-radius: 10px;
    }
    a#delete {
        background-color: maroon;
        color: white;
        border-radius: 10px;
        
    }
    a#delete:hover {
        background-color: white;
        color: black;
        border-radius: 10px;
    }
    button#push {
        border-radius: 10px;  
        background-color: rgb(49, 144, 141);
        color: white;
    }

    button#push:active {
        border-radius: 10px;  
        background-color: rgb(49, 144, 141);
        color: white;
        transform: translateY(3px);
    }

    h4#removed {
        text-align: center;
        color: red;       
    }

    h4#removed:hover {
        text-align: center;
        color: white;
        background-color: red;
        transform: scale(1,1.5)
    }
    p#note {
        font-size: 11px;
    }
    p span{
        color: red;
    } 
    form#formData .form-group {
        margin-bottom: 5px;
    }  
    #attention {     
        animation: changeColor 1.5s infinite;
    }

    @keyframes changeColor {
        0% { color: red; }
        100% { color: maroon; }
    }

    .table-wrapper {
        overflow-y: auto; /* Mengaktifkan scrolling vertikal pada container */
        max-height: 500px; /* Atur ketinggian maksimum sesuai kebutuhan */
        position: relative;
    }

    .table-wrapper table {
        border-collapse: collapse;
        width: 100%;
        white-space: nowrap; /* Menghindari wrapping pada teks dalam sel */
    }

    .table-wrapper thead th {
        position: sticky;
        top: 0;
        z-index: 1;
        background-color: #fff; /* Atur warna latar belakang th sesuai kebutuhan */
    }

    .table-wrapper tbody::-webkit-scrollbar {
        width: 8px; /* Lebar scrollbar */
    }

    .table-wrapper tbody::-webkit-scrollbar-thumb {
        background-color: #888; /* Warna dari thumb scrollbar */
        border-radius: 4px; /* Membuat thumb lebih berbentuk bulat */
    }

    .disabled-option {
        color: red;
    }

    #ngeri {
        background-color: whitesmoke;
        color: black;
    }   

</style>
@endpush
@section('body')
<div class="row">
    <div class="col-lg-12"><h1 class="page-header">Weekend Crew</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading text-center">Form Registration</div>
            <div class="panel-body">
                {{-- content --}}
                
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="text-bold">                          
                            Coordinator : {{ auth()->user()->getFullName() }}
                        </h5>
                    </div> 
                </div>
                <form id="formData" method="post" class="form-inline" >
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="startedDate">Date: </label>
                                <input type="datetime-local" name="local1" id="local1" class="form-control"> -
                                <input type="datetime-local" name="local2" id="local2" class="form-control">
                            </div>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="user1">Employes: </label>
                                <select name="user1" id="user1" class="form-control">
                                    <option></option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->getFullName() }}</option>
                                    @endforeach
                                </select> 
                                :
                                <select name="workStat" id="workStat" class="form-control">
                                    <option></option>
                                    <option value="wfh">WFH</option>
                                    <option value="wfs">WFS</option>
                                </select>
                                :
                                <select name="extra[]" id="extra" class="form-control" title="change overtime with.." multiple>
                                    <option value=""></option>
                                    <option value="allowance">Allowance</option>  
                                    <option value="exdo">Exdo</option>
                                </select>
                                <a class="btn btn-sm btn-default" id="ngeri">insert</a>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-6">
                        <p id="note"><span>*</span>Please send before Thursday 04:00 PM WIB on Weekday.</p>
                    </div>
                    <div class="col-lg-6">
                        @if ($workings)
                            <button class="btn btn-sm btn-default pull-right" id="push" data-toggle="modal" data-target="#modalPusher">Submit</button>
                        @endif                        
                    </div>
                </div>
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-lg-12 table-responsive table-wrapper">
                            <table class="table table-bordered table-condensed">
                                <thead>                                  
                                    <th>No</th>
                                    <th>Employes</th>
                                    <th>Position</th>
                                    <th>Project</th>
                                    <th>Started</th>                                    
                                    <th>Ended</th>  
                                    <th>Time</th> 
                                    <th>Work Status</th>    
                                    <th>Change With:</th>                             
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($workings as $data)
                                        <tr>                                           
                                            <td>{{ $data['no'] }}</td>   
                                            <td>{{ $data['employes'] }}</td>                                         
                                            <td>{{ $data['position'] }}</td>                                         
                                            <td>{{ $data['project'] }}</td>                                         
                                            <td>{{ $data['start'] }}</td>   
                                            <td>{{ $data['end'] }}</td>
                                            <td>{{ $data['time'] }}</td>    
                                            <td>{{ $data['workStat'] }}</td>                                  
                                            <td>@if ($data['extra'])
                                                {{$data['extra']}}
                                            @else
                                                <i id="nulled">Null</i>
                                            @endif</td>
                                            <td>
                                                <a class="btn btn-sm btn-default" id="edit" data-toggle="modal" data-target="#modalEditData" data-role="{{ route('coordinator/working/weekends/edit', $data['id']) }}" title="reschedule this emlpoyee">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a class="btn btn-sm btn-default" id="delete" data-toggle="modal" data-target="#modalDeleteData" data-role="{{ route('coordinator/working/weekends/delete', $data['id']) }}" title="remove this recorded.">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDate" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content-insert">
            <!--  -->
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditData" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content-edit">
            <!--  -->
        </div>
    </div>
</div>

<div class="modal fade" id="modalDeleteData" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content-delete">
            <!--  -->
        </div>
    </div>
</div>


<div class="modal fade" id="modalPusher" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('coordinator/working/weekends/send/data') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title text-center' id='showModalLabel'>Attention !!</h4>
            </div>
            <div class='modal-body'>                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="producers">producer: </label>
                            <select name="producers" id="producers" class="form-control" required>
                                <option value="">-Select a producer -</option>
                                @foreach ($producers as $producer)
                                    <option value="{{ $producer->id }}">{{ $producer->getFulLName() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">               
                        <h4 id="attention" class="text-center">Please double check the data you will send, the data you will send cannot be changed!!</h4>
                    </div>
                </div>
            </div>
            <div class='modal-footer'>
                <button type='submit' class='btn btn-sm btn-primary'>Submit</button>
                <a class='btn btn-sm btn-default' data-dismiss='modal'>Close</a>
            </div> 
        </form>
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

@push('js')
<script src="{{ asset('assets/js/datetimepicker/jquery.datetimepicker.full.js') }}" defer></script>
    
@endpush

@section('script')

$('select#over').select2();

$("a#getDate").on("click", function() {   

    var id = $(this).attr('data-role');

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content-insert").html(e);
        }
    });
});

$("select#user").select2({
    placeholder: "Select a employes",
    theme: "classic"
});

$("select#user").on('change', function() {  

    var tanggalKedaluwarsa = new Date();
    tanggalKedaluwarsa.setTime(tanggalKedaluwarsa.getTime() + (3 * 60 * 60 * 1000)); // 1 menit dalam milidetik

    var kedaluwarsa = "expires=" + tanggalKedaluwarsa.toUTCString();

    document.cookie = "employes=" + $(this).val() + "; " + kedaluwarsa + "; path=/";
});

$("a#edit").on("click", function() {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content-edit").html(e);
        }
    });

});

$("a#delete").on("click", function() {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content-delete").html(e);
        }
    });

});

var redNames = '{{ $eocUser }}';

$("select#user1").select2({
    placeholder: "Select a employee",
    theme: "classic",
    templateResult: function (data) {
        if (!data.id) {
            return data.text;
        }

        var $result = $('<span></span>');
        $result.text(data.text);
        if (redNames.includes(data.text)) {
            $result.addClass('disabled-option');
        }

        return $result;
    }
}).on('select2:select', function (e) {
    var selectedText = e.params.data.text;
    var $container = $('#select2-user1-container').text();

    if (redNames.includes(selectedText)) {
        window.alert($container + " contract period will end soon, please note this");
    }
});

$("select#workStat").select2({
    placeholder: "Select a work from..",
    theme: "classic",
    minimumResultsForSearch: Infinity
});

$("select#extra").select2({
    placeholder: "",
    theme: "classic",
    minimumResultsForSearch: Infinity,
});


$("a#ngeri").on('click', function () {
    var dataLocal1 = document.getElementById('local1').value;
    var local1 = new Date(dataLocal1);

    var dataLocal2 = document.getElementById('local2').value;
    var local2 = new Date(dataLocal2);

    var user1 = document.getElementById('user1').value;

    var workStat = document.getElementById('workStat').value;
    
    if (dataLocal1.trim() === '' || dataLocal2.trim() === '' || !user1 || !workStat) {
        alert('Please fill in all required fields.');
        return;
    }  

    if (local1 > local2) {
        window.alert("Please, check your data");
        return;
    }

    var forms = document.getElementById("formData");
    var formData = new FormData(forms);

    $.ajax({
        url: "{{ route('coordinator/working/weekends/form/insert') }}",
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            location.reload();
        },
        error: function(error) {
            console.log(error);
            alert('Failed to submit form. Please check your data.');
        }
    });
});

$("input#local1").on('change', function() {
    var local1 = $(this).val();

    var tanggalKedaluwarsa = new Date();
    tanggalKedaluwarsa.setTime(tanggalKedaluwarsa.getTime() + (3 * 60 * 60 * 1000)); // 1 menit dalam milidetik

    var kedaluwarsa = "expires=" + tanggalKedaluwarsa.toUTCString();
    
    var datetimeValue = document.getElementById('local1').value; // Ambil nilai dari elemen input datetime-local
    document.cookie = "date-time-1=" + encodeURIComponent(datetimeValue) + "; " + kedaluwarsa + "; path=/";    
});

$("input#local2").on('change', function() {
    var local2 = $(this).val();

    var tanggalKedaluwarsa = new Date();
    tanggalKedaluwarsa.setTime(tanggalKedaluwarsa.getTime() + (3 * 60 * 60 * 1000)); // 1 menit dalam milidetik

    var kedaluwarsa = "expires=" + tanggalKedaluwarsa.toUTCString();
    
    var datetimeValue = document.getElementById('local2').value; // Ambil nilai dari elemen input datetime-local
    document.cookie = "date-time-2=" + encodeURIComponent(datetimeValue) + "; " + kedaluwarsa + "; path=/";    
});

document.getElementById('local1').value = getCookie("date-time-1");
document.getElementById('local2').value = getCookie("date-time-2");

function getCookie(cookieName) {
    var name = cookieName + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var cookieArray = decodedCookie.split(';');
    for(var i = 0; i < cookieArray.length; i++) {
        var cookie = cookieArray[i];
        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1);
        }
        if (cookie.indexOf(name) === 0) {
            return cookie.substring(name.length, cookie.length);
        }
    }
    return "";
}

function deleteCookie(cookieName) {
    document.cookie = cookieName + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

document.getElementById('btnTanggalWaktu').addEventListener('click', function() {
    var inputTanggalWaktu = document.createElement('input');
    inputTanggalWaktu.setAttribute('type', 'datetime-local');
    inputTanggalWaktu.setAttribute('id', 'tanggalWaktu');
    inputTanggalWaktu.setAttribute('name', 'tanggalWaktu');
    inputTanggalWaktu.click();
});

@stop
