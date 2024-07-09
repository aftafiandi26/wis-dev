@extends('layout')

@section('title')
    (hr) Add Employee Medic
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c181' => 'active'
    ])
@stop
@section('body')
<style type="text/css">
  .sup {
    color: red;
  } 
  .sup:hover {
    color: tomato;
  }
  .marginBottom {
    margin-bottom: 30px;
  }
</style>
  <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Employee Medic <sup><small class="sup">(ID Leave : {{$leave->id}})</small></sup></h1>
            <small><a href="https://www.alodokter.com/penyakit-a-z" target="_blank" class="pull-right">www.alodokter.com</a></small>
        </div>
</div>

<div class="row">
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade in">
        <a class="close" data-dismiss="alert" aria-label="close">&times;</a>        
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

   <div class="col-lg-12">
       <form action="{{ route('sicked/update') }}" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}
           <div class="col-lg-12 marginBottom">
               <h4>Biodata : </h4>
               <div class="form-group">
                  <div class="col-lg-2">
                       <label for="nik">NIK</label>
                       <input type="text" name="nik" id="nik" value="{{ $user->nik }}" class="form-control" readonly>
                  </div>
                  <div class="col-lg-2">
                       <label for="employee">Employee</label>
                       <input type="text" name="employee" id="employee" value="{{ $user->first_name.' '.$user->last_name }}" class="form-control" readonly>
                  </div> 
                  <div class="col-lg-2">
                       <label for="dept">Department</label>
                       <input type="text" name="dept" id="dept" value="{{ $dept->dept_category_name }}" class="form-control" readonly>
                  </div>
                  <div class="col-lg-2">
                       <label for="position">Position</label>
                       <input type="text" name="position" id="position" value="{{ $user->position }}" class="form-control" readonly>
                  </div> 
                  <div class="col-lg-2">
                       <label for="join">Join Date</label>
                       <input type="text" name="join" id="join" value="{{ $user->join_date }}" class="form-control" readonly>
                  </div>              
               </div>
           </div>
           
           <div class="col-lg-12 marginBottom">
               <h4>Leave Form :</h4>
               <div class="form-group">                    
                    <div class="col-lg-2">
                       <label for="category">Category</label>
                       <input type="text" name="category" id="category" value="Sick" class="form-control" readonly> 
                    </div>
                    <div class="col-lg-2">
                       <label for="period">Period</label>
                       <input type="text" name="period" id="period" value="{{ $leave->period }}" class="form-control" readonly> 
                    </div>
                    <div class="col-lg-2">
                       <label for="startLeave">Start Leave Date</label>
                       <input type="text" name="startLeave" id="startLeave" value="{{ $leave->leave_date }}" class="form-control" readonly> 
                    </div> 
                    <div class="col-lg-2">
                       <label for="endLeave">End Leave Date</label>
                       <input type="text" name="endLeave" id="endLeave" value="{{ $leave->end_leave_date }}" class="form-control" readonly> 
                    </div> 
                    <div class="col-lg-2">
                       <label for="backWork">Back to Work</label>
                       <input type="text" name="backWork" id="backWork" value="{{ $leave->back_work }}" class="form-control" readonly> 
                    </div>   
               </div>
           </div>

           <div class="col-lg-12">
                <h4>Data Medic :</h4> 
                <div class="form-group">
                    <div class="col-lg-2 hidden">
                       <label for="idLeave">ID Leave</label>
                       <input type="text" name="idLeave" id="idLeave" value="{{ $leave->id }}" class="form-control"> 
                    </div>
                    <div class="col-lg-2 hidden">
                       <label for="idUser">ID User</label>
                       <input type="text" name="idUser" id="idUser" value="{{ $user->id }}" class="form-control"> 
                    </div>
                    <div class="col-lg-2">
                       <label for="nameHospital text-red">Hospital Name</label>
                       <input type="text" name="nameHospital" id="nameHospital" class="form-control" value="{{ old('nameHospital') }}"> 
                    </div>
                    <div class="col-lg-2">
                       <label for="name">Name</label>
                       <input type="text" name="name" id="name" value="{{ $user->first_name.' '.$user->last_name }}" class="form-control" readonly> 
                    </div>
                    <div class="col-lg-2">
                       <label for="age">Age <sup><small class="sup">(th)</small></sup></label>
                       <input type="text" name="age" id="age" class="form-control" > 
                    </div>                    
                    <div class="col-lg-2">
                       <label for="dateSicked">Date Sicked</label>
                       <input type="date" name="dateSicked" id="dateSicked" class="form-control" > 
                    </div>
                    <div class="col-lg-2">
                       <label for="totDay">Total Day <sup><small class="sup">(day)</small></sup></label>
                       <input type="text" name="totDay" id="totDay" class="form-control" > 
                    </div>    
                    <div class="col-lg-2">
                       <label for="address">Address</label>
                       <input type="text" name="address" id="address" placeholder="input address" class="form-control" > 
                    </div>              
                </div>
           </div>

           <div class="col-lg-12">              
                <div class="form-group">                 
                    <div class="col-lg-4">
                        <table class="table table-sm table-responsive">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Disease</th>
                                    <th>Period</th>
                                </tr>
                            </thead>
                            <tbody id="itemlist">
                                <tr>
                                   <!--  <td><input name="categoryDisease[0]" class="form-control" type="text" required="true"/></td> -->
                                    <td>
                                        <select class="form-control" name="categoryDisease[0]" required id="selected">
                                            <?php foreach ($jenis_penyakit as $jenis): ?>
                                                <option value="{{ $jenis }}">{{ $jenis }}</option>
                                            <?php endforeach ?>
                                        </select>
                                    </td>
                                    <td><input name="diseaseName[0]" class="form-control"  type="text" required="true"/></td>
                                     <td><input name="period[0]" class="form-control"  type="text" required="true"/></td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                    <td>
                                        <button class="btn btn-sm btn-default" onclick="additem(); return false"><i class="glyphicon glyphicon-plus"></i></button>                                   
                                    </td>
                                </tr>
                        </tfoot>
                        </table>
                    </div>
                    <div class="col-lg-2">
                           <label for="scan">Scan MC <sup><small class="sup">(max: 1MB)</small></sup></label>
                           <img class="img-preview img-fluid" width="250px" height="250px" alt=""> 
                           <input type="file" name="scan" id="scan" placeholder="input scan" class="form-control"  onchange="previewImage()"> 
                           <br>
                           <button type="submit" class="btn btn-sm btn-success">add</button>
                           <a href="{{ route('index/sicked') }}" class="btn btn-default btn-sm">back</a>
                    </div>                    

                </div>
           </div>

       </form>
   </div>
</div>
<script type="text/javascript">
function previewImage() {
  const image = document.querySelector('#scan');
  const imgPreview = document.querySelector('.img-preview');

  const oFReader = new FileReader();
  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function(oFREvent) {
    imgPreview.src = oFREvent.target.result;
  }
  
}

 var i = 1;

            function additem() {
                i++;
                var itemlist = document.getElementById('itemlist');
//                membuat element
                var row = document.createElement('tr');
                var jenis = document.createElement('td');
                var jumlah = document.createElement('td');
                var total = document.createElement('td');
                var aksi = document.createElement('td');

//                meng append element
                itemlist.appendChild(row);
                row.appendChild(jenis);
                row.appendChild(jumlah);
                row.appendChild(total);
                row.appendChild(aksi);

            
//                membuat element input
                var categoryDisease = document.createElement('select');
                categoryDisease.setAttribute('name', 'categoryDisease['+ i +']');
                categoryDisease.setAttribute('class', 'form-control');              
                categoryDisease.setAttribute('required', 'true');
                categoryDisease.setAttribute('id', 'selected');
                
                var option = document.createElement('option');
                option.setAttribute('value', 'Accident');
                var a = document.createTextNode("Accident");
                option.appendChild(a);

                var option1 = document.createElement('option');
                option1.setAttribute('value', 'Brain');
                var a1 = document.createTextNode("Brain");
                option1.appendChild(a1);

                var option2 = document.createElement('option');
                option2.setAttribute('value', 'Cancer');
                var a2 = document.createTextNode("Cancer");
                option2.appendChild(a2);

                var option3 = document.createElement('option');
                option3.setAttribute('value', 'Deficiency');
                var a3 = document.createTextNode("Deficiency");
                option3.appendChild(a3);

                var option4 = document.createElement('option');
                option4.setAttribute('value', 'Digestion');
                var a4 = document.createTextNode("Digestion");
                option4.appendChild(a4);

                var option5 = document.createElement('option');
                option5.setAttribute('value', 'Eye');
                var a5 = document.createTextNode("Eye");
                option5.appendChild(a5);

                var option6 = document.createElement('option');
                option6.setAttribute('value', 'Heart');
                var a6 = document.createTextNode("Heart");
                option6.appendChild(a6);

                var option7 = document.createElement('option');
                option7.setAttribute('value', 'Infection');
                var a7 = document.createTextNode("Infection");
                option7.appendChild(a7);

                var option8 = document.createElement('option');
                option8.setAttribute('value', 'Psychology');
                var a8 = document.createTextNode("Psychology");
                option8.appendChild(a8);

                var option9 = document.createElement('option');
                option9.setAttribute('value', 'Virus');
                var a9 = document.createTextNode("Virus");
                option9.appendChild(a9);

                var diseaseName = document.createElement('input');
                diseaseName.setAttribute('name', 'diseaseName['+ i +']');
                diseaseName.setAttribute('class', 'form-control');
                diseaseName.setAttribute('required', 'true');

                var period = document.createElement('input');
                period.setAttribute('name', 'period['+ i +']');
                period.setAttribute('class', 'form-control');
                period.setAttribute('required', 'true');

                var hapus = document.createElement('span');

                // document.getElementById('selected').appendChild(option);
                categoryDisease.appendChild(option);
                categoryDisease.appendChild(option1);
                categoryDisease.appendChild(option2);
                categoryDisease.appendChild(option3);
                categoryDisease.appendChild(option4);
                categoryDisease.appendChild(option5);
                categoryDisease.appendChild(option6);
                categoryDisease.appendChild(option7);
                categoryDisease.appendChild(option8);
                categoryDisease.appendChild(option9);

                jenis.appendChild(categoryDisease);
                jumlah.appendChild(diseaseName);
                total.appendChild(period);
                aksi.appendChild(hapus);

                hapus.innerHTML = '<button class="btn btn-small btn-default"><i class="glyphicon glyphicon-trash"></i></button>';
//                Aksi Delete
                hapus.onclick = function () {
                    row.parentNode.removeChild(row);
                };  

            }
    

</script>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
