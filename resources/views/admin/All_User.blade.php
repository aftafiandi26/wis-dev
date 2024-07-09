@extends('layout')

@section('title')
    (Adm) All Employee
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active'
    ])
@stop
@section('body')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
 <div class="row">
        <div class="col-lg-12">
             <h1>Employee Kinema</h1><hr>
        </div>
    </div>
 <div class="row">
 <div class = "col-lg-12">
   <table class="table table-striped table-hover" width="100%" id="tables">
    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        
        <th>Nik</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Department</th>
        <th>Position</th>
        <th>Level HRD</th>
        <th>Employee Status</th>

        <th>Nationality</th>
        <th>Join Date</th>
        <th>End Date</th>
        <th>Date Of Birthday</th>
        <th>Place Of Birthday</th>
        <th>Province</th>
        <th>Maiden Name</th>
        <th>Gender</th>
        <th>ID Card</th>
        <th>Email</th>

        <th>Phone</th>
        <th>Address</th>
        <th>Area</th>
        <th>City</th>
        <th>Education</th>
        <th>Marital Status</th>
        <th>NPWP</th>
        <th>KK</th>
        <th>Religion</th>
        <th>Dependent</th>

        <th>BPJS Ketenagakerjaan</th>
        <th>BPJS Kesehatan</th>
        <th>Rusun</th>
        <th>Rusun Status</th>
        <th>Race</th>
        <th>Source Company</th>
        <th>Global ID</th>
        <th>Initial Date</th>
        <th>Tax Cut In</th>
        <th>Tax Cut Off</th>

        <th>Reason Off Leavng</th>
        <th>Reason To Company</th>
        <th>Reason To Otherco</th>
        <th>Remark</th>
        <th>JPK</th>
        <th>COB</th>
        <th>Project Category 1</th>
        <th>Project Category 2</th>
        <th>Project Category 3</th>
        <th>Initial Annual</th>

        <th>Active</th>
        <th>Admin</th>
        <th>HR</th>
        <th>Coordinator</th>
        <th>PM</th>
        <th>SPV</th>
        <th>Producer</th>
        <th>HOD</th>
        <th>HRD</th>
        <th>GM</th>
       
        <th>User</th>
        <th>SP</th>
        <th>SP HRD</th>
        <th>Ticket</th>
        <th>Block Status</th>
        <th>Profile Picture</th>
        <th>Request IP</th>
        <th>Online</th> 
      </tr>
     </thead>
    </table>
   </div>
 </div>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
@section('script')
    $('[data-toggle="tooltip"]').tooltip();

    $('#tables').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [] }
        ],
        "order": [
            [ 0, "asc" ]
        ],
        "scrollX": true,       
        "dom": 'Blfrtip',
         buttons: [
            {
                extend: 'excelHtml5',
                title: 'Data All Employee <?php echo date('Y-m-d') ?>'
            }
        ],
        responsive: true,        
        ajax: '{!! URL::route("mgmt-data/getAll_User") !!}'
    });

    $(document).on('click','#tables tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });
@stop

