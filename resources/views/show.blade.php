@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
      <div class="row">
        <aside class="col-sm-5 border-right">
          <section class="gallery-wrap">
            <div class="img-big-wrap">
              <a href="#">
                <img src="{{Storage::url($product->image)}}" width="450" alt="">
              </a>
            </div>
          </section>
        </aside>

        <aside class="col-sm-7">
          <section class="card-body p-5">
            <h3 class="title mb-3">
              {{ $product->name }}
            </h3>
            <p class="price-detail-wrap">
              <span class="price h3 text-danger">
                <span class="currency">US $ {{ $product->price }}</span>
              </span>
            </p>
            <h3>Description</h3>
            <p>{!! $product->description !!}</p>
            <h3>Additional Information</h3>
            <p>{!! $product->additional_info !!}</p>
            <!-- <hr> -->
            <div class="row">
              <div class="form-inline">
                <!-- <div class="input-group">
                  <h3 class="mr-6">Quantity:</h3>
                  <input type="number" name="qty" class="form-control">
                  <input type="submit" class="btn btn-primary ml-2">
                </div> -->
               
              </div>
              <hr>
              <a href="{{route('add.cart',[$product->id])}}" class="btn btn-lg btn-outline-primary text-uppercase">Add to Cart</a>
            </div>
          </section>
        </aside>
      </div>
    </div>

    <!-- down the lane  -->

    @if (count($productFromSameCategories)>0)

    <div class="jumbotron">
      <h3>You may like </h3>
    <div class="row">
      @foreach ($productFromSameCategories as $product)
      <div class="col-md-4">
        <div class="card mb-4 box-shadow">
          <img class="card-img-top" style="width:100%" height="200" src="{{Storage::url($product->image)}}" alt="{{$product->price}}">
          <div class="card-body">
            <p><b>{{$product->name}}</b></p>
            <p class="card-text">{!!Str::limit($product->description,120)!!}</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a href="{{route('product.show.frontend',[$product->id])}}"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                
                <!-- <a href="{{url('add.cart',[$product->id])}}"></a><button type="button" class="btn btn-sm btn-outline-success">Add to cart</button> -->
              </div>
              <small class="text-muted">${{$product->price}}</small>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    </div>
  @endif
</div>
@endsection
