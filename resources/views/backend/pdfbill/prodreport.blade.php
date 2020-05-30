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
    #report {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#report td, #report th {
  border: 1px solid #ddd;
  padding: 8px;
}


#report th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;

  color: black;
}


</style>

<body>
<h2 align="center">Sales Report For {{$product->name}}</h2>
<table id="report">
    <thead>
    <tr>
        <th>S.N.</th>
        <th>Customer Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>sales By</th>
        <th>sales Date</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1 ?>
    @foreach($report as $all)
    <tr>
        <td>{{$i++}}</td>
        <td>{{$all->cust_name}}</td>
        <td>{{$all->quantity}}</td>
        <td>{{$all->price}}</td>
        <td>{{$all->saller_name}}</td>
        <td>{{$all->created_at}}</td>
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
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>
</body></html>


