@extends('layouts.app')

@section('content')

<div class="container">
  @if ($errors->any())
    @foreach($errors->all() as $error)
      <div class="alert alert-danger">{{$error}}</div>
    @endforeach
  @endif
	<table id="cart" class="table table-hover ">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Product</th>
      <th scope="col">Price</th>
      <th scope="col">Qty</th>
      <th>Remove</th>
    </tr>
  </thead>
  <tbody>
@if ($cart)
      
   
    @php
      $i = 1
    @endphp
    @foreach ($cart->items as $product)
      
   
    <tr>
      <th scope="row">{{$i++}}</th>
      <td><img src="{{ Storage::url($product['image']) }}" width="100"></td>
      <td>{{ $product['name'] }}</td>
      <td>${{ $product['price'] }}</td>
      <td>
        <form action="{{route('cart.update',$product['id'])}}" method="post"> @csrf
          <input type="text" name="qty" value="{{$product['qty']}}">
          <button class="btn btn-secondary btn-sm"><i class="fas fa-sync"></i>update</button>
        </form>
      </td>
      <td>
        <form action="{{route('cart.remove',$product['id'])}}" method="post"> @csrf
          <button class="btn btn-danger">Remove</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>	
<hr>
<div class="card-footer">
	<button class="btn btn-warning">Continue Shopping</button>
	<span style="margin-left:300px;">Total Price: ${{$cart->totalPrice}}</span>
	<a href="{{route('cart.checkout',[$cart->totalPrice])}}"><button class="btn btn-info float-right">Checkout</button></a>
</div>
@else
<td><p>No item in cart</p></td>	
@endif
</div>
@endsection