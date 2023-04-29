@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Products</h2>
  <div class="row">
      <div class="col-md-2">
        <form action="{{route('product.list',[$slug])}}" method="get"> @csrf
          <!-- foreach subcategories  -->
          @foreach ($subcategories as $subcategory)
          <p><input type="checkbox" name="subcategory[]" value="{{ $subcategory->id }}" id=""
          @if (isset($filterSubcategories))
            {{ in_array($subcategory->id,$filterSubcategories)? 'checked="checked" ':'' }}
          @endif
          >{{ $subcategory->name }}</p>
          @endforeach
          <!-- end of foreach subcategories  -->
          <input type="submit" value="Filter" class="btn btn-secondary">
        </form>
        <hr>
        <!-- start of filter by price form  -->
        <h3>FIlter by price</h3>
        <form action="{{route('product.list',[$slug])}}" method="get"> @csrf
          <input type="text" name="min" class="form-control" placeholder="minimum price" required>
          <input type="text" name="max" class="form-control" placeholder="maximum price" required>
          <input type="hidden" name="categoryId" value="{{$categoryId}}">
          <br>
          <br>
          <input type="submit" value="filter" class="btn btn-secondary">
        </form>
        <hr>
        <a class="btn btn-success" href="{{route('product.list',[$slug])}}">Back</a>
      </div>
      <!-- end of filter by price form  -->
    <!-- start of card  -->
    <div class="col-md-10">


      <div class="row">
        <!-- foreach  -->
        @foreach ($products as $product)
          
        
        <div class="col-md-4">
          <div class="card mb-4 box-shadow">
            <img class="card-img-top" style="width:100%" height="200" src="{{Storage::url($product->image)}}" alt="{{$product->name}}">
            <div class="card-body">
              <p><b>{{ $product->name }}</b></p>
              <p class="card-text">{!! Str::limit($product->description,100) !!}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{route('product.show.frontend',[$product->id])}}"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                  
                  <a href="{{route('add.cart',[$product->id])}}"><button type="button" class="btn btn-sm btn-outline-success">Add to cart</button></a>
                </div>
                <small class="text-muted">${{ $product->price }}</small>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        <!-- end of foreach  -->
      </div>
    <!-- end of card  -->
    </div>
  </div>
</div>
@endsection
