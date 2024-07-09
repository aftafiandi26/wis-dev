@extends('layout')

@section('title')
    (hr) Stocked
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c3' => 'active'
    ])
@stop
@section('body')
<!-- isi blade -->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Detail Stationery Stock</h1> 
    </div>
</div>
<div class="col-sm-12">
    <a href="{{route('Statoonery/addStockStatoonary')}}" class="btn btn-sm btn-default pull-right">Add Stock</a>
     <table width="100%" id="tables" class="table table-hover">
        <thead>
            <tr>
                <th style="width: 60px; text-align: center;" rowspan="2">Kode Barang</th>
                <th style="width: 150px; text-align: center;" rowspan="2">Item</th>
                <th style="width: 80px; text-align: center;" rowspan="2">Merk</th>
                <th style="width: 1px; text-align: center;" colspan="31">OUT (Pemakaian Barang)</th>
                <th style="width: 1px; text-align: center;" rowspan="2">TOTAL Pemakaian Barang</th>
                <th style="width: 1px; text-align: center;" rowspan="2">Balance Stock</th> 
            </tr>
            <tr>
                <th style="text-align: center;">1</th>
                <th style="text-align: center;">2</th>
                <th style="text-align: center;">3</th>
                <th style="text-align: center;">4</th>
                <th style="text-align: center;">5</th>
                <th style="text-align: center;">6</th>
                <th style="text-align: center;">7</th>
                <th style="text-align: center;">8</th>
                <th style="text-align: center;">9</th>
                <th style="text-align: center;">10</th>
                <th style="text-align: center;">11</th>
                <th style="text-align: center;">12</th>
                <th style="text-align: center;">13</th>
                <th style="text-align: center;">14</th>
                <th style="text-align: center;">15</th>
                <th style="text-align: center;">16</th>
                <th style="text-align: center;">17</th>
                <th style="text-align: center;">18</th>
                <th style="text-align: center;">19</th>
                <th style="text-align: center;">20</th>
                <th style="text-align: center;">21</th>
                <th style="text-align: center;">22</th>
                <th style="text-align: center;">23</th>
                <th style="text-align: center;">24</th>
                <th style="text-align: center;">25</th>
                <th style="text-align: center;">26</th>
                <th style="text-align: center;">27</th>
                <th style="text-align: center;">28</th>
                <th style="text-align: center;">29</th>
                <th style="text-align: center;">30</th>
                <th style="text-align: center;">31</th>
            </tr>

              <tr>               
                <td style="width: 60px; text-align: center;" ></td>
                <td style="width: 150px; text-align: center;" ></td>
                <td style="width: 1px; text-align: center;" ></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                 <td></td>
                <td style="width: 1px; text-align: center;" ></td>
                <td style="width: 1px; text-align: center;" ></td>
                <td style="width: 1px; text-align: center;" ></td>                    
                <td style="width: 1px; text-align: center;" ></td>
             </tr> 
            </thead>
    </table>
</div>  
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop