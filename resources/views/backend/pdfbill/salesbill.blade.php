<!doctype html>
<html><head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style type="text/css">
body{
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}
    #invoice {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#invoice td, #invoice th {
  border: 1px solid #ddd;
  padding: 8px;
}





#invoice th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;

  color: black;
}


</style>
<body>
<p align="center"><?php if(session()->get('comp')=='al_safa'){ ?><strong>Al Safa</strong><?php } else if(session()->get('comp')=='safa') {?><strong>Al Safa</strong><?php } else {?><strong>Pioneer</strong><?php } ?> </p>
<p align="center">Board Bazar</p>
<p align="center">Main Road,Gazipur</p>
<p align="center">Phone No: 01977660059</p>
<hr>

<p>Invoice No: <?php
echo time();?> </p>
<p>Date:<?php echo Carbon\Carbon::now()->format('d-m-Y'); ?></p>
<hr>
<table id="invoice">
    <thead>
    <tr>
        <th>S.N.</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1 ?>
    @foreach($report as $all)
    <tr>
        <td>{{$i++}}</td>
        <td>{{$all->name}}</td>
        <td>{{$all->quantity}}</td>
        <td>{{$all->price}}</td>
    </tr>
    @endforeach
    <tr>
        <td colspan="3"> Grand Total </td>
        <td>
            <?php $total=0 ?>
            @if($report)
                @foreach($report as $s)
                    @php
                        $price = $s->price;
                        $total += $price;
                    @endphp
                @endforeach
                Tk. {{$total}}
            @endif
        </td>
    </tr>
    </tbody>
</table>
<br>
<p>prepared by:<?php echo Auth::user()->name; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p>
<p align="center">Powerd By: www.ideatechsolution.com</p>
</body></html>


