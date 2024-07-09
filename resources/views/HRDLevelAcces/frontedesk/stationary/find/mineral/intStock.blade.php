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
        'c3' => 'active'
    ])
@stop

@push('style')
    <style>
        p#label span {
            font-size: 16px;
            font-style: italic;
        }
        p#label i {
            font-size: 12px;
        }
        p#label:hover {
            
        }
    </style>
@endpush
@section('body')
<!-- isi blade -->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mineral Water <br> <small>Purchase & Add Stock</small></h1> 
    </div>
</div>
@include('asset_feedbackErrors')
<div class="row">
    <div class="col-lg-10">
        <div>            
            <form action="{{route('stationery/mineral/find/post', [$stocks->id, $month])}}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name_item">Item:</label>
                            <input type="hidden" name="code_item" value="{{ $stocks->kode_barang }}">
                            <input type="text" name="name_item" value="{{$stocks->name_item}}" readonly="true" required="true" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="brank">Brand:</label>
                            <input type="text" name="brank" value="{{$stocks->merk}}" readonly="true" required="true" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date_stock">Date:</label>
                            <input type="date" name="date_stock" required="true" class="form-control" value="{{ old('date_stock') }}">
                        </div>
                    </div>
                </div>
              
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <p id="label"><span>Quantity</span> <i class="fa fa-arrow-down"></i></p>
                        </div>
                    </div>
                </div>
                <div class="row" id="Quantity">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="box">Box:</label>
                            <input type="number" name="box" id="box" class="form-control" min="1" required placeholder="0" value="{{ old('box') }}">
                        </div>
                    </div>
                    <div class="col-lg-4">                        
                        <div class="form-group">
                            <label for="pcs">Pcs:</label>
                            <input type="number" name="pcs" id="pcs" class="form-control" required min="1" placeholder="0" value="{{ old('pcs') }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="qty">Total (pcs):</label>
                            <input type="number" name="qty" min="1" required="true" class="form-control" id="qty" placeholder="0" value="{{ old('qty') }}">                   
                        </div> 
                    </div>
                </div>
           
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">                           
                            <p id="label"><span>Price</span> <i class="fa fa-arrow-down"></i></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="priceBox">Box:</label>
                            <input type="number" name="priceBox" id="priceBox" class="form-control" required placeholder="0" min="1" value="{{ old('priceBox') }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="pricePcs">Pcs:</label>
                            <input type="number" name="pricePcs" id="pricePcs" class="form-control" required placeholder="0" min="1" value="{{ old('pricePcs') }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="priceTotal">Total (Pcs)</label>
                            <input type="number" name="priceTotal" id="priceTotal" class="form-control" required placeholder="0" min="1" value="{{ old('priceTotal') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="purchasing">Purchasing ID:</label>
                            <div class="row">
                                    <div class="col-lg-1">
                                        <input type="number" name="pr-1" id="purchasing" class="form-control" min="1" required placeholder="123" value="{{ old('pr-1') }}">
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="text" name="pr-2" id="purchasing" class="form-control" value="PR" readonly>
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="text" name="pr-3" id="purchasing" class="form-control" readonly value="HR-KSM">
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="text" name="pr-4" id="purchasing" class="form-control text-uppercase" required placeholder="XII" maxlength="3" value="{{ old('pr-4') }}">
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="number" name="pr-5" id="purchasing" class="form-control" required placeholder="{{ date('Y') }}" maxlength="4" value="-"{{ old('pr-5') }}>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="remark">Remark</label>
                            <textarea name="remark" id="remark" cols="30" rows="5" class="form-control">{{ old('remark') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="from-group">
                                <button type="submit" class="btn btn-primary btn-sm">Add</button>
                                <a href="{{route('stationery/mineral/find/index', $month)}}" class="btn btn-default btn-sm">Back</a>
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
    @include('assets_script_2')
    @include('assets_script_7')
@stop

@section('script')
    
@endsection