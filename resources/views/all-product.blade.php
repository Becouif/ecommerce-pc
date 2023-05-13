@extends('layouts.app')
@section('content')


<div class="container">
  <form action="{{route('more.product')}}" method="GET"> @csrf
    <div class="form-row align-items-center justify-content-center">
      <div class="col-md-8">
        <input type="text" name="search" class="form-control" placeholder="search...">
      </div>
      <div class=" ">
        <button type="submit" class="btn btn-secondary">Search</button>
      </div>
    </div>
  </form>
<br>



  <div class="row">
    @foreach ($products as $product)
    <div class="col-md-4">
      <div class="card mb-4 box-shadow">
        <div >
          <img class="card-img-top img-fluid" style="object-fit: cover; width: 100%; height: 150px;" src="{{ Storage::url($product->image) }}" alt="{{$product->price}}">
        </div>
        <div class="card-body">
          <p><b>{{$product->name}}</b></p>
          <p class="card-text">{!!Str::limit($product->description,120)!!}</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <a href="{{route('product.show.frontend',[$product->id])}}"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
              <a href="{{route('add.cart',[$product->id])}}"><button type="button" class="btn btn-sm btn-outline-success">Add to cart</button></a>
            </div>
            <small class="text-muted">${{$product->price}}</small>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>


@endsection