@extends('layout')

@section('title')
    {{ $headline }}
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'cd3' => 'active'
    ])
@stop

@push('style')
@include('asset_select2')
    <style>
        .myinput {
            margin-bottom: 20px;
            margin-top: -40px;
        }
        .ahover {
            color: black;
        }
        
        table tbody tr td:hover {
            background-color: lightgray;
        }    

        .stock:hover {
            background-color: lightcoral;
            color: white;
        }
        .pdf:hover {
            background-color: darkgoldenrod;
            color: whitesmoke;
        }
        .excel:hover {
            background-color: lightseagreen;
            color: white;
        }
        .textHeadling {
            margin-top: 20px;
        }
        #showModalSearchMonth .modal-header header {
            font-size: 18px;
            font-style: oblique;
        }
        #showModalSearchMonth .modal-body {           
            text-align: center;
        }
        td #itemName {
            color: black;
        }
        td #itemName:hover {
            color: red;
        }    
        div.finding {
            text-align: right;
        }  
    </style>
@endpush
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mineral Water Stock ss</h1> 
    </div>
</div>
<div class="row ">       
    <div class="col-lg-6">
        <a href="{{ route('stationery/mineral/find/index', date('Y-m', strtotime('previous month', strtotime($month))))}}" class="btn btn-sm btn-default previous"><i class="fa fa-arrow-left"></i> {{ $previous }}</a>
        <a href="{{ route('stationery/mineral/find/index', date('Y-m', strtotime('next month', strtotime($month))))}}" class="btn btn-sm btn-default previous">{{ $next }} <i class="fa fa-arrow-right"></i></a>
    </div>
    <div class="col-lg-6 finding">
        <a href="{{route('stationery/mineral/pdf', [$month])}}" class="btn btn-sm btn-default pdf" target="_blank">PDF</a> 
        <a href="{{route('stationery/mineral/excel', [$month])}}" class="btn btn-sm btn-default excel">Excel</a>     
        <a href="{{route('stationery/mineral/find/add', [$month])}}" class="btn btn-sm btn-default stock">Add Stock</a>
    </div> 
</div>

<div class="row textHeadling">
    <div class="col-lg-12">        
        <label>Periode: {{date('F Y')}}</label><br>
        <label>Stock Started: {{date('F Y', strtotime('-1 month', strtotime($month)))}}</label><br> 
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="myinput pull-right">
            <input type="text" id="myInput" onkeyup="searchItem()" placeholder="search item.." title="Type in a name item" class="form-control">
        </div>         
    </div>
</div>
<div class="row">
    <div class="col-lg-12 table-responsive"> 
        <table id="myTable" class="table table-hover table-bordered table-condensed table-striped">
            <thead>
                <tr>
                    <th rowspan="2" style="text-align: center;">No</th>               
                    <th rowspan="2" style="text-align: center;">Code Item</th>                
                    <th rowspan="2" style="text-align: center;">Item</th>
                    <th rowspan="2" style="text-align: center;">UOM</th>
                    <th rowspan="2" style="text-align: center;">Brand</th>
                    <th rowspan="2" style="text-align: center;">Stock</th>
                    <th colspan="{{ $lastDay }}" style="text-align: center;">Date Items Out <i>{{date('F Y', strtotime($month))}}</i></th>
                    <th rowspan="2" style="text-align: center;">Total Items Out</th>
                    <th rowspan="2" style="text-align: center;">IN (Purchase)</th>
                    <th rowspan="2" style="text-align: center;">Balance Stock</th>
                    <th rowspan="2" style="text-align: center;">Date Stocked</th>
                    <th colspan="3" style="text-align: center;">Action</th>
                </tr>
                <tr>              
                    <?php for ($i=1; $i <= $lastDay ; $i++) { 
                        echo "<th>$i</th>";
                    } ?>
                    <th style="text-align: center;">In</th>
                    <th style="text-align: center;">Out</th>
                    <th style="text-align: center;">Edit</th>                  
                </tr>
            </thead>
            <tbody>
                <?php foreach ($waters as $key => $value): ?>
                <tr>
                    <td style="text-align: center;">{{$key + 1}}</td>
                    <td style="text-align: center;">{{$value->kode_barang}}</td>
                    <td style="text-align: left;">
                        <a href="{{ route('statinery/mineral/tracking/index', $value->id) }}" title="view tracking this item" id="itemName">{{ $value->name_item }}</a>
                    </td>
                    <td style="text-align: center;">{{$value->satuan}}</td>
                    <td style="text-align: center;">{{$value->merk}}</td>
                    <td style="text-align: center;">
                        @foreach ($array_waters as $water)
                            @if ($water['id'] === $value->id)
                                {{ $water['stocked'] }}
                            @endif
                        @endforeach
                    </td>               
                    @for ($i = 1; $i <= $lastDay; $i++)
                    <td style="text-align: center;" id="das">
                        <a data-toggle="modal" data-target="#showModal" title="view" data-role="{{ route('stationery/mineral/modal', [$value->kode_barang, $month.'-'.$i]) }} " class="ahover">
                            @foreach ($array_out_waters as $water)
                                @if ($water['id'] === $value->id && $water['day'] === $i)
                                    {{ $water['value'] }}
                                @endif
                            @endforeach
                        </a>                                              
                    </td>
                    @endfor              
                    @foreach ($array_waters as $water)
                        @if ($water['id'] === $value->id)
                            <td style="text-align: center;">{{ $water['out_count'] }}</td>
                            <td style="text-align: center;">{{ $water['in_count'] }}</td>
                            <td style="text-align: center;">{{ $water['balance'] }}</td>
                        @endif
                    @endforeach
                    <td style="text-align: center;">{{date('M, d-Y', strtotime($value->date_stock))}}</td>                  
                    <td><a href="{{route('stationery/mineral/find/in', [$value->id, $month])}}" class="btn btn-xs btn-default" id="in">In</a></td>
                    <td><a href="{{route('stationery/mineral/find/out', [$value->id, $month])}}" class="btn btn-xs btn-default" id="out">Out</a></td>
                    <td><a href="{{route('stationery/mineral/edit', [$value->id])}}" class="btn btn-xs btn-default" id="edit">Edit</a></td>                
                </tr>
                <?php endforeach ?>                
            </tbody>
            <tfoot>                
                <tr>
                    <th colspan="5" style="text-align: right;">Total</th>
                    <th style="text-align: center;">{{ $total_tfoot['totalStocked'] }}</th>
                    @for ($i = 1; $i <= $lastDay; $i++)
                        <th style="text-align: center;">
                            @foreach ($array_tfoot_out as $water)
                                @if ($water['day'] === $i)
                                    {{ $water['value'] }}
                                @endif
                            @endforeach
                        </th>
                    @endfor
                    <th style="text-align: center;">{{ $total_tfoot['total_tfoot_out'] }}</th>
                    <th style="text-align: center;">{{ $total_tfoot['total_tfoot_in'] }}</th>
                    <th style="text-align: center;">{{ $total_tfoot['total_tfoot_balance'] }}</th>
                    <th colspan="6"></th>
                </tr>
                </tfoot>
        </table>
    </div>
</div>

<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content">
           
        </div>
    </div>
</div>

@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop

@section('script')
$(document).on('click','#myTable tr td a[title="view"]',function(e) {
    var id = $(this).attr('data-role');
    $.ajax({
        url: id, 
        success: function(e) {
            $("#modal-content").html(e);
        }
    });
}); 
$('select#searchMonth').select2({
    placeholder: "choose a month",
    allowClear: true,
    dropdownParent: $("#showModalSearchMonth")
});
$('select#searchYear').select2({
    placeholder: "choose a year",
    allowClear: true,
    dropdownParent: $("#showModalSearchMonth")
});
@endsection

@push('js')
    <script>
        function searchItem() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
            }
        }
    </script>
@endpush