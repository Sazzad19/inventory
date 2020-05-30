<option value="" selected>--Select Sale--</option>
@foreach($sale as $m)
    <option value="{{$m->id}}">Sale Id.: {{$m->id}} Product: {{$m->name}} Quantity:{{$m->quantity}} Price:{{$m->price}} &nbsp; </option>
@endforeach
