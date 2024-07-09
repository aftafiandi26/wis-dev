<!DOCTYPE html>
<html lang="en">
<head>
  <title>Stock Stationary</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12" style="margin-left: 0px;">
            <label>PT. KINEMA SYTRANS MULTIMEDIA</label>
            <br>
            <label>STATIONARY INVENTORY STOCK</label>
            <br>
            <label>PERIODE {{strtoupper(date('F Y'))}}</label><p class="pull-right">Update On : {{date('M, d Y')}} </p>
            <br>
            <label>STOCK TRANSACTION : {{$getKategori->kategori_stock}}</label>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
          <table style="margin-left: -0px; margin-top: 10px;" id="tables" class="table table-hover" border="1" >
           <thead>
            <tr>
                <th rowspan="2" style="text-align: center;">No</th>
                <th rowspan="2" style="text-align: center;">Kode Barang</th>
                <th rowspan="2" style="text-align: center;">Item</th>
                <th rowspan="2" style="text-align: center;">Satuan</th>
                <th rowspan="2" style="text-align: center;">Merk</th>
                <th rowspan="2" style="text-align: center;">Stock Awal {{date('F Y', strtotime('-1 month'))}}</th>
                <th colspan="31" style="text-align: center;">Date Items Exited {{(date('F Y'))}}</th>
                <th rowspan="2" style="text-align: center;">Total Items Exited</th>
                <th rowspan="2" style="text-align: center;">IN (Purchase)</th>
                <th rowspan="2" style="text-align: center;">Balance Stock</th>
            </tr>
             <tr>
                <?php for ($i=1; $i <=31 ; $i++) {
                    echo "<th style='text-align: center;'>$i</th>";
                 } ?>
            </tr>
            </thead>
            <tbody>
          <?php
          use App\stationary_count;
          use App\Stationary_transaction;
          use App\stationary_stock;

          foreach ($data as $value): ?>
            <tr>
              <td style="text-align: center">{{$no++}}</td>
              <td style="text-align: center">{{$value->kode_barang}}</td>
              <td>{{$value->name_item}}</td>
              <td style="text-align: center">{{$value->satuan}}</td>
              <td style="text-align: center">{{$value->merk}}</td>
              <td style="text-align: center">{{$value->stock_barang}}</td>
               <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 1)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 2)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 3)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 4)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 5)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 6)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 7)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 8)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 9)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 10)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 11)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 12)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 13)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 14)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 15)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 16)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 17)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 18)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 19)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 20)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 21)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 22)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 23)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 24)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 25)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 26)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 27)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 28)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 29)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 30)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;"><?php
                                $out_stock = stationary_count::select('*')->whereMONTH('date_out_stock_historical', '=', date('m'))->whereYEAR('date_out_stock_historical', '=', date('Y'))->whereDAY('date_out_stock_historical', '=', 31)->where('kode_barang' ,'=', $value->kode_barang)->first();
                                if ($out_stock != null) {
                                    echo $out_stock->total_out_items;
                                }else{
                                    echo "0";
                                }?>
                            </td>
                            <td style="text-align: center;">{{$value->total_out_stock}}</td>
                            <td style="text-align: center;">{{$value->in_purchase}}</td>
                            <td style="text-align: center;">{{$value->balance_stock}}</td>
            </tr>
          <?php endforeach ?>
            <tr>
              <th colspan="5"style="text-align: right;">Total</th>
              <th style="text-align: center;" >{{$stock_awal}}</th>
              <th style="text-align: center;"><?php
                    $total_date = stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 1)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 2)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 3)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 4)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('out_stock')->where('status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 5)->pluck('out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 6)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 7)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 8)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 9)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 10)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 11)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 12)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 13)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 14)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 15)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 16)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 17)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 18)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 19)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 20)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 21)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 22)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 23)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 24)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 25)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 26)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 27)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 28)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 29)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 30)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                <th style="text-align: center;"><?php
                    $total_date =stationary_stock::JoinStationary_transaction()->select('stationary_transaction.out_stock')->where('stationary_transaction.status_transaction', 2)->where('stationery_stock.kode_kategory', $getKategori->unik_kategori)->whereYEAR('stationary_transaction.date_out_stock', date('Y'))->whereMONTH('stationary_transaction.date_out_stock', date('m'))->whereDAY('stationary_transaction.date_out_stock', 31)->pluck('stationary_transaction.out_stock');
                    echo $total_date->sum();
                 ?></th>
                 <th style="text-align: center;">{{$total_items_exited}}</th>
                 <th style="text-align: center;">{{$total_in_purchase}}</th>
                 <th style="text-align: center;">{{$total_balance_stock}}</th>
            </tr>
            </tbody>
            </table>
        </div>
    </div>

    <div class="row" style="margin-top: 100px;">
    <div class="col-lg-4">
       <label style="text-align: center; margin-left: -600px;">
        <p style="margin-bottom: 100px;">Prepared By</p>
        <p style="text-decoration: underline;">Madina Harinda Lubis</p>
        <p>Receptionist Cum Admin</p>
        </label>
    </div>
    <div class="col-lg-4">
        <label style="text-align: center; margin-top: -100px;">
        <p style="margin-bottom: 100px;">Acknowledged By</p>
        <p style="text-decoration: underline;">Wahyuni Hasan</p>
        <p>HR & GA Manager</p>
        </label>
    </div>
    <div class="col-lg-4">
        <label style="text-align: center; margin-top: -150px; margin-left: 1200px;">
        <p style="margin-bottom: 100px;">Approved By</p>
        <p style="text-decoration: underline;">Ghea Lisanova</p>
        <p>GM</p>
        </label>
    </div>
</div>
</div>
</body>
</head>
</html>
