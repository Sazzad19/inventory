<option value="" selected>--Select Customer--</option>
@foreach($customer as $m)
    <option value="{{$m->id}}"> Customer Name:{{$m->name}} Code:{{$m->code_number}} Phone:{{$m->phone_number}} Due Amount:{{$m->due_amount}} &nbsp; </option>
@endforeach
