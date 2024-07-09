@extends('layout')

@section('title')
   (hr) Data Employee
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c3003' => 'active'
    ])
@stop
@section('body')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <h2>Add List National Day</h2>
    <hr class="my-5">
</div>
<form method="post" action="{{route('storeAddViewOffYears')}}" autocomplete="true">
    {{ csrf_field() }}
    <div class="row">
    <div class="col-lg-12">
         <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th width="100px">Date</th>
                                <th width="200px">National Day</th>
                                <th width="80px"></th>
                            </tr>
                        </thead>
                        <!--elemet sebagai target append-->
                        <tbody id="itemlist">
                            <tr>
                                <td><input name="jenis_input[0]" class="form-control" type="date" required="true"/></td>
                                <td><input name="jumlah_input[0]" class="form-control" required="true"/></td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><button class="btn btn-sm btn-success" type="submit">save</button></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-sm btn-default" onclick="additem(); return false"><i class="glyphicon glyphicon-plus"></i></button>                                   
                                </td>
                            </tr>
                        </tfoot>
                    </table>

    </div>
 
</div>
</form>
<script type="text/javascript">
///////////////////////////////////////////////////////////////////////
 var i = 1;
            function additem() {
                var itemlist = document.getElementById('itemlist');
                
//                membuat element
                var row = document.createElement('tr');
                var jenis = document.createElement('td');
                var jumlah = document.createElement('td');
                var aksi = document.createElement('td');

//                meng append element
                itemlist.appendChild(row);
                row.appendChild(jenis);
                row.appendChild(jumlah);
                row.appendChild(aksi);

//                membuat element input
                var jenis_input = document.createElement('input');
                jenis_input.setAttribute('name', 'jenis_input['+ i +']');
                jenis_input.setAttribute('class', 'form-control');
                jenis_input.setAttribute('type', 'date');
                jenis_input.setAttribute('required', 'true');

                var jumlah_input = document.createElement('input');
                jumlah_input.setAttribute('name', 'jumlah_input['+ i +']');
                jumlah_input.setAttribute('class', 'form-control');
                jumlah_input.setAttribute('required', 'true');

                var hapus = document.createElement('span');

                jenis.appendChild(jenis_input);
                jumlah.appendChild(jumlah_input);
                aksi.appendChild(hapus);

                hapus.innerHTML = '<button class="btn btn-small btn-default"><i class="glyphicon glyphicon-trash"></i></button>';
//                Aksi Delete
                hapus.onclick = function () {
                    row.parentNode.removeChild(row);
                };

                i++;
            }
    
</script>
@stop
@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
