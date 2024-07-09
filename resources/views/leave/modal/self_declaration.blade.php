

@extends('layout')

@section('title')
Self Declaration
@stop

@section('top')
@include('assets_css_1')
@include('assets_css_2')
@stop

@push('style')
<style>
    .text-grey {
        color: grey;
        font-style: italic;
    }
    .text-grey:hover {
        color: black;
    }
    .text-underline {
        text-decoration: underline;        
    }
    .bold-text {
        font-weight: bold;
    }
    .margin-top {
        margin-top: 20px;
    }
    .marka {
        color:  rgb(184, 177, 177);
    }   
    ol li p {
        text-align: justify;
    } 
    .panel:hover {
        box-shadow: 2px 2px 4px 2px rgba(0, 0, 0, 0.2);
    }    

    @media only screen and (max-width: 480px) {
        .wise {
            margin-left: 0px;
        }       
    }
    @media only screen and (min-width: 480px) {
        .wise {
            margin-left: 30px;
        }
        table#tableForm tbody tr th {
            width: 15%;
        }
        .scrolling-div {
            overflow-y: scroll;
            height: 600px;
        }
    }
</style>
@endpush

@section('navbar')
@include('navbar_top')
@include('navbar_left', [
'c2' => 'active',
'c16' => 'active'
])
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">e-Form Self Declaration</h1>
    </div>    
</div>

<div class="row">
    <div class="col-lg-6" id="leave">
        <div class="panel panel-info">
            <div class="panel-header">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="text-center bold-text">Leave Appliaction Form <span>(Annual)</span></h4>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="panel-body">                
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table class="table table-condensed table-borderless" id="tableForm">                           
                            <tbody>
                                <tr>
                                    <td>Request By</td>
                                    <td>: <span class="bold-text">{{ $data['request_by'] }}</span></td>
                                    <th></th>
                                    <td>NIK</td>
                                    <td>: <span class="bold-text">{{ $data['request_nik'] }}</span></td>
                                </tr>
                                <tr>
                                    <td>Period</td>
                                    <td>: <span class="bold-text">{{ $data['period'] }}</span></td>
                                    <th></th>
                                    <td>Position</td>
                                    <td>: <span class="bold-text">{{ $data['request_position'] }}</span></td>
                                </tr>
                                <tr>
                                    <td>Join Date</td>
                                    <td>: <span class="bold-text">{{ date('F, m Y' , strtotime($data['request_join_date'])) }}</span></td>
                                    <th></th>
                                    <td>Department</td>
                                    <td>: <span class="bold-text">{{ $data['request_dept_category_name'] }}</span></td>
                                </tr>
                                <tr>
                                    <td>Contact Address</td>
                                    <td colspan="3">: <span class="bold-text">{{ auth()->user()->address. ', ' .auth()->user()->area .', ' .auth()->user()->city}}</span></td>
                                </tr>
                                <tr>
                                    <td>Leave Category</td>
                                    <td>: <span class="bold-text">{{ $leaveCategory }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-lg-12">
                        <h5 class="bold-text text-center">Personal Verification</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table class="table-condensed table table-borderless">
                            <thead>
                                <tr>
                                    <th>Period</th>
                                    <th>Entitlement</th>
                                    <th>Taken</th>
                                    <th>Pending</th>
                                    <th>Requested</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $data['period'] }}</td>
                                    <td>{{ $data['entitlement'] }}</td>
                                    <td>{{ $data['taken'] }}</td>
                                    <td>{{ $data['pending'] }}</td>
                                    <td>{{ $data['total_day'] }}</td>
                                    <td>{{ $data['remain'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table class="table table-condensed table-borderless" id="tableForm">
                            <tbody>
                                <tr>
                                    <td>Approved Leave Form</td>
                                    <td>: <span class="bold-text">{{ $data['leave_date'] }}</span></td>
                                    <th></th>
                                    <td>Until</td>
                                    <td>: <span class="bold-text">{{ $data['end_leave_date'] }}</span></td>
                                </tr>
                                <tr>
                                    <td>Back to Work On</td>
                                    <td>: <span class="bold-text">{{ $data['back_work'] }}</span></td>
                                </tr>
                                <tr>
                                    <td>Contact phone during leave</td>
                                    <td>: <span class="bold-text">{{ auth()->user()->phone }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row margin-top">
                    <div class="col-lg-12">
                        <h5 class="bold-text">Reason :</h5>                        
                        <p>{{ $data['reason_leave']}}</p>
                    </div>
                </div>               
            </div>
        </div>
    </div>   
    {{-- / --}}
    <div class="col-lg-6" id="declaration">
        <div class="panel panel-primary">
            <div class="panel-header">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="text-center bold-text">Surat Pernyataan Cuti Dalam Masa Pandemi Covid-19</h4>
                        <hr>
                        <h5 class="text-center text-grey" style="margin-top: -30px;">Leave Declaration Form During Covid-19 Pandemic</h5>
                    </div>
                </div>
            </div>
            <form action="{{ route('leave/forwarder/annual/post') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }} 
                <div class="panel-body scrolling-div">
                    <div class="container-fluid">
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="text-center">
                                    <span>---</span><span class="bold-text"> Keterangan </span><span class="marka">|</span><span class="text-grey"> Information </span><span>---</span>
                                </p>
                            </div>
                        </div>
                        <div class="row margin-top">                              
                            <div class="col-lg-6">
                                <table class="table table-borderless condensed">
                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <th>: {{ $data['request_by'] }}</th>
                                        </tr>
                                        <tr>
                                            <th>Department</th>
                                            <th>: {{ $data['request_dept_category_name'] }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <table class="table table-borderless table-condensed">
                                    <tbody>
                                        <tr>
                                            <th>NIK</th>
                                            <th>: {{ $data['request_nik'] }}</th>
                                        </tr>
                                        <tr>
                                            <th>Position</th>
                                            <th>: {{ $data['request_position'] }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>                              
                        </div>
                        <div class="row margin-top">
                            <div class="col-lg-12">
                                <p class="text-center">
                                    <span>---</span><span class="bold-text"> Deklarasi Mandiri </span><span class="marka">|</span><span class="text-grey"> Self Declaration </span><span>---</span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <p>
                                    <span class="bold-text">Rencana Cuti </span> <span class="marka">/</span> <span class="text-grey"> Leave Declaration</span>
                                </p>
                            </div>
                        </div>
                        <div class="row">                   
                            <div class="col-lg-2">
                                <label class="radio-inline">
                                    <input type="radio" name="rencana" value="1" required="true"><span class="bold-text">Di Kota Batam </span><br><span class="text-grey">In Batam City</span>
                                </label>
                            </div>                 
                            <div class="col-lg-2">
                                <label class="radio-inline">
                                    <input type="radio" name="rencana" value="2" required="true"><span class="bold-text">Keluar Batam </span><br><span class="text-grey">Out of Batam City</span>
                                </label>    
                            </div>                 
                            <div class="col-lg-8">
                                <label class="radio-inline">
                                    <input type="radio" name="rencana" value="3" required="true"><span class="bold-text">Keluar kota Batam yang sifatnya Mendesak/Emergency. <br>
                                        Merujuk pada Internal Memorandum Tanggal 5 Agustus 2020 </span><br><span class="text-grey"> Out of Batam Island which is Urgent/Emergency. <br> Referring to Internal Memoranddum Date 5 August 2020</span>
                                </label>
                            </div>                 
                        </div>
                        <div class="row margin-top">
                            <div class="col-lg-12">
                                <p>
                                    <span class="bold-text">Kebijakan Karantina DIri Sendiri</span><span class="marka"> | </span><span class="text-grey">Self Quarantine Policy</span>
                                </p>
                            </div>
                        </div>
                        <div class="row wise">
                            <div class="col-lg-11">
                                <ol>
                                    <li>
                                        <p>
                                            Bagi karyawan yang melakukan cuti didalam kota dan jika perusahaan mendapatkan informasi bahwa karyawan tersebut terbukti berpergian keluar kota Batam, maka akan dianggap cuti yang tidak dibayarkan dan wajib menjalankan karantina selama 14 hari sesampainya di Batam, yang mana karantina yang dijalankan akan memotong cuti karyawan tersebut dan dapat dikenakan disipliner.
                                        </p>
                                        <p class="text-grey">
                                            For employeess who have taken leave with prior intention of staying in Batam and if the company came to know that the employee traveled out of Batam, it will be considered as unpaid leave and there will be a mandatory 14 days quarantine upon returning to Batan where the quarantine period will deduct employee's annual leave and potentially disciplinary.
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Bagi karyawan yang melakukan perjalanan cuti yang sifatnya mendesak atau perjalanan bisnis perusahan, setelah masa cuti/tugas nya sudah berakhir wajib melakukan Rapid-test sesampainya di Batam dan biayar Rapid-test sepenuhnya akan menjadi tanggung jawab perusahaan.
                                            Wajib menjalankan karantina 14 hari.
                                        </p>
                                        <p class="text-grey">
                                            For employees who take urgent/emergancy leave or business trips, after the leave/duty peroid has ended, they are required to do a Rapid-test upon arrival in Batam. The cost of Rapid-test will be fully paid by the campany.
                                            Mandatory quarantine for 14 days upon arrival will apply.
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Bagi karyawan yang melakukan perjalanan cuti yang sifatnya tidak mendesak, maka setelah masa cutinya sudah berakhir wajib melakukan Rapid-test sesampainya di Batam dan wajib menjalankan karantina selama 14 hari dan selama masa karantina 14 hari karyawan tersebut menunjukan gejala maka wajib melakukan Swab-test.
                                            Biaya yang timbul atas tes-tes tersebut sepenuhnya akan menjadi tanggung jawab karyawan itu sendiri.
                                        </p>
                                        <p class="text-grey">
                                            For employees who take non-urgent/emergency leave, after thea leave period has ended, they are required to do a Rapid-test upon the arrival in Batam and must serve quarantine for 14 days. During these 14 days quarantine peroid, if the employee shows symptoms, he/she is obliged to take a Swab-test.
                                            Cost incurred for these tests will be borne by the employee.
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Pada masa karantina bagi karyawan yang melakukan perjalanan cuti yang sifatnya tidak mendesak dan tidak dapat melakukan pekerjaannya dirumah (WFH) selama masa karantina dikarenakan keterbatasan hardware, satu dan lain hal maka akan dipotong cuti. Jika sudah habis maka akan dianggap unpaid leave.
                                        </p>
                                        <p class="text-grey">
                                            For employees who are takin non-urgent/emergency leave, during the quarantine period employees are unable to perform their duty at home (WFH) due to hardware limitations or due to any reasons, the employee will be considered taking annual leave. if the employee does not have sufficient annual leave, then it will be considered as unpaid leave.
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Sebelum masuk bekerja karyawan wajib menunjukan hasil test disertai <b>Surat Keterangan Sehat</b> ke HRD.
                                        </p>
                                        <p class="text-grey">
                                            Before entering the workplace, employees are required to show the test results <b>accompanied by a healt certificate</b> to the HRD
                                        </p>                                                               
                                    </li>
                                </ol>   
                            </div>                       
                        </div> 
                        <div class="row text-justify">
                            <div class="col-lg-12">                        
                                <label for="" class="checkbox-inline">
                                    <input type="checkbox" name="accept" value="1" required="true">
                                    <p>
                                        Saya dengan ini menyatakan bahwa informasi diatas yang terkandung dalam formulir ini adalah benar dan lengkap. Saya mengerti bahwa jika ditemukan bahwa saya telah membuat pernyataan palsu dalam bentuk ini, tindakan yang diperlukan akan diambil terhadap saya.                                
                                    </p>
                                    <p class="text-grey">
                                        I hereby declared that the information in this form is true and complete. I understand that if it is known that i have made a false declaration in this form, the necessary action shall be taken against me.
                                    </p>
                                </label>
                            </div>
                        </div>                      
                    </div>
                </div>
                <div class="panel-footer">                    
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-sm btn-success">Apply</button>
                            <a onclick="backPage()" class="btn btn-sm btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>        
</div>
@stop

@section('bottom')
  @include('assets_script_1')
@stop

@push('js')
<script>  
    function setCookie(nama, nilai, durasiMenit) {
        var d = new Date();
        d.setTime(d.getTime() + durasiMenit * 60 * 1000);
        var expires = "expires=" + d.toUTCString();
        document.cookie = nama + "=" + nilai + ";" + expires + ";path=/";
    }

    function backPage()
    {
        setCookie('data', '', 1);
        setCookie('url', '', 1);
        window.location.href = "{{ $url }}";
    }

    setTimeout(function() { 
        setCookie("data", "", 1);      
        setCookie("url", "", 1);      
        window.location.href = "{{ $url }}";
    }, 600000);
</script>
@endpush