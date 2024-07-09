@extends('layout')

@section('title')
    {{ $headline }}
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_3')
    @include('asset_select2')

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
        <h1 class="page-header">Mineral Out Item</h1> 
    </div>
</div>
@include('asset_feedbackErrors')
<form action="{{route('stationery/mineral/out/store', [$stocks->id])}}" method="post">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                    <label for="code_item">Code Item:</label>
                    <input type="hidden" name="id" value="{{$stocks->id}}">
                    <input type="text" name="code_item" id="code_item" class="form-control" readonly value="{{ $stocks->kode_barang }}">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                    <label for="item">Item:</label>
                    <input type="text" name="item" id="item" class="form-control" value="{{ $stocks->name_item }}" readonly>
            </div>
        </div>
        <div class="col-lg-3">
                <div class="form-group">
                    <label for="brand">Brand:</label>
                    <input type="text" name="brand" id="brand" class="form-control" value="{{ $stocks->merk }}" readonly>
                </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="date_stock">Date Out Item:</label>
                <input type="date" name="date_stock" id="stock_date" class="form-control" required value="{{ date('Y-m-d') }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label for="qty">Qty:</label>
                <input type="text" name="qty" id="qty" class="form-control" required value="{{ old('qty') }}" maxlength="4">
            </div>
        </div>
       
        <div class="col-lg-3">
            <div class="form-group">
                <label for="user">user</label>
                    <div id="selectUser">
                        <select name="user" id="user" class="form-control" required>
                            <option value=""></option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->getFullName() }}</option>
                            @endforeach         
                        </select>
                    </div>
                    <div id="textUser">
                        <input type="hidden" name="user1" id="manual" class="form-control" readonly>
                    </div>
                <div style="margin-top: 5px;">
                        <a class="btn btn-default btn-xs" id="enable">Manual</a>
                        <a class="btn btn-default btn-xs hidden" id="disable">Search</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="price">Price (qty)</label>
                <input type="text" id="pcs" class="form-control" readonly>
                <input type="hidden" name="price" id="price" class="form-control" value="{{ $stocks->price }}" readonly>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="totalPrice">Total (price)</label>
                <input type="text" id="totalPrice" class="form-control" readonly>
                <input type="hidden" name="totalPrice" id="total" class="form-control" readonly>
            </div>
        </div>
    </div>   
    <div class="row">
        <div class="col-lg-6">
           <div class="form-group">
                <div class="form-gorup">
                    <label for="describe">Remark</label>
                    <textarea   textarea name="describe" id="describe" cols="30" rows="3" class="form-control">{{ old('describe') }}</textarea>
                </div>
           </div>
        </div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3"></div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Out Item</button>
                <a href="{{route('stationery/mineral/index')}}" class="btn btn-sm btn-default">Back</a>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-condensed table-striped table-bordered">
            <thead>
                <tr>
                    <th>Code Item</th>
                    <th>Item</th>
                    <th>UOM</th>
                    <th>Brand</th>
                    <th>Total Stock</th>
                    <th>Out Stock</th>
                    <th>Balance Stock</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $stocks->kode_barang }}</td>
                    <td>{{ $stocks->name_item }}</td>
                    <td>{{ $stocks->satuan }}</td>
                    <td>{{ $stocks->merk }}</td>
                    <td>{{ $stocks->stock_barang }}</td>
                    <td id="outStock">{{ $stocks->total_out_stock }}</td>
                    <th id="stock">{{ $stocks->balance_stock }}</th>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@stop

@section('bottom')
    @include('assets_script_1')
@stop

@section('script')
    $('select#user').select2();

    $('a#enable').on('click', function (e) {
        
        const manual = document.getElementById("manual");
        const select = document.getElementById("user");
        const div = document.getElementById("selectUser");
        const enable = document.getElementById("enable");
        const disable = document.getElementById("disable");

        manual.attributes["type"].value = "text";
        manual.removeAttribute('readonly');
        manual.setAttribute('required', 'true');

        div.classList.add('hidden');  
        
        enable.classList.add('hidden');        
        disable.classList.remove('hidden');        

        select.removeAttribute('required');        
        select.removeAttribute('value');  
    });

    $('a#disable').on('click', function () {
        const manual = document.getElementById("manual");

        const select = document.getElementById("user");
        const div = document.getElementById("selectUser");
        const enable = document.getElementById("enable");
        const disable = document.getElementById("disable");
        
        manual.setAttribute('readonly', 'true');
        manual.attributes["type"].value = "hidden";
        manual.removeAttribute('required'); 
        manual.removeAttribute('value');    

        div.classList.remove('hidden');

        disable.classList.add('hidden');        
        enable.classList.remove('hidden');

        select.setAttribute('required', 'true');
        
    });

    const formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
    });

    var price = document.getElementById("price").value;

    document.getElementById("pcs").value = formatter.format(price);

    var outstock = document.getElementById("outStock").innerText;
    var stock = document.getElementById("stock").innerText;

    $('input#qty').on('change', function (e) {
        e.preventDefault();
    
        var qty = $(this).val();

        if ($(this).val() === ""){
            var qty = 0;
        }

        let total = price * qty;

        document.getElementById("totalPrice").value = formatter.format(total);
        document.getElementById("total").value = total;

        let netOut = parseInt(outstock) + parseInt(qty);
        let netStock = stock - qty;

        document.getElementById("outStock").innerText = netOut;
        document.getElementById("stock").innerText = netStock;

    });

@stop