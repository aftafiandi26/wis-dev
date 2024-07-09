<html>
<head>
  <title>WIS - Item Software - IT</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <?php $ListSoftware = $getData; ?>
<div class="row">
  <div class="col-g-12 text-bold">
    <center>
      <h2>{{$getData->product}}</h2>
      <h3>{{$getData->name_software}}</h3>
    </center>
  </div>
  <div class="col-lg-12" style="margin-top: 25px;">
    <center>
    <table class="table table-border table-condensed" style="width: 400px;">
      <tr>
              <th>ID Software</th>
              <td>: </td>
              <td>{{$getData->id}}</td>
            </tr>
            <tr>
              <th>Software Name</th>
              <td>: </td>
              <td>{{$getData->name_software}}</td>
            </tr>
            <tr>
              <th>Version</th>
              <td>: </td>
              <td>{{$getData->version}}</td>
            </tr>
            <tr>
              <th>Purchase Date</th>
              <td>: </td>
               <td>{{$getData->purchase_date}}</td>
            </tr>
            <tr>
              <th>Expiring Date</th>
              <td>: </td>
              <td>{{$getData->expiring_date}}</td>
            </tr>
            <tr>
              <th>Type Software</th>
              <td>: </td>
              <td>{{$getData->type_software}}</td>
            </tr>
            <tr>
              <th>Qty</th>
              <td>: </td>
              <td>{{$getData->qty}}</td>
            </tr>
            <tr>
              <th>Unit Price</th>
              <td>: </td>
              <td>{{$getData->price}}</td>
            </tr>
            <tr>
              <th>Total Price</th>
              <td>: </td>
              <td>{{$getData->total_price}}</td>
            </tr>
            <tr>
              <th>Vendor</th>
              <td>: </td>
              <td>{{$getData->vendor}}</td>
            </tr>
            <tr>
              <th>PO</th>
              <td>: </td>
              <td>{{$getData->po_number1}}/{{$getData->po_number2}}-{{$getData->po_number3}}/{{$getData->po_number4}}/{{$getData->po_number5}}</td>
            </tr>
            <tr>
              <th>Invoice</th>
              <td>: </td>
              <td>{{$getData->invoice}}</td>
            </tr>
            <tr>
              <th>Status</th>
              <td>: </td>
              <td>{{$getData->status_software}}</td>
            </tr>
            <tr>
              <th>Time Limit</th>
              <td>: </td>
              <td>{{$time_limit}}</td>
            </tr>
            <tr>
              <th>Conditon</th>
              <td>: </td>
              <td>{{$conditon}}</td>
            </tr>
    </table>
    </center>
  </div>
</div> 
<script type="text/javascript">
 window.print();
</script>  
</body>
</html>