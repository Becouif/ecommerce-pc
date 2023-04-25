@extends('layouts.app')

@section('content')
<div class="container">
<main role="main">

<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">Album example</h1>
    <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
    <p>
      <a href="#" class="btn btn-primary my-2 mr-2">Main call to action</a>
      <a href="#" class="btn btn-secondary my-2">Secondary action</a>
    </p>
  </div>
</section>
<h2>Category</h2>
@foreach (App\Models\Category::get() as $cat)
  <a href="{{route('product.list',[$cat->slug])}}"><button class="btn btn-secondary mb-4 me-2">{{$cat->name}}</button></a>
  
@endforeach

<div class="album py-5 bg-light">
  <div class="container">
    <h2>Products</h2>

    <div class="row">
      @foreach ($products as $product)
      <div class="col-md-4">
        <div class="card mb-4 box-shadow">
          <img class="card-img-top" style="width:100%" height="200" src="{{Storage::url($product->image)}}" alt="{{$product->price}}">
          <div class="card-body">
            <p><b>{{$product->name}}</b></p>
            <p class="card-text">{!!Str::limit($product->description,120)!!}</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a href="product/{{$product->id}}"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                <button type="button" class="btn btn-sm btn-outline-success">Add to cart</button>
              </div>
              <small class="text-muted">${{$product->price}}</small>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
<!-- ADD A FUNCTIONAL CAROUSEL  -->

<!-- <br><br><br> -->
<!-- start of carousel  -->
<!-- <div class="jumbotron">
  <div id="carousel1" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="row">
        @foreach ($randomActiveProducts as $product)
          <div class="col-3">
          <div class="card mb-4 box-shadow">
          <img class="card-img-top" style="width:100%" height="200" src="{{Storage::url($product->image)}}" alt="{{$product->price}}">
          <div class="card-body">
            <p><b>{{$product->name}}</b></p>
            <p class="card-text">{!!Str::limit($product->description,120)!!}</p>
            <div class="d-flex justify-content-between align-items-center">
              <small class="text-muted">$ {{$product->price}}</small>
            </div>
          </div>
        </div> 
              
            @endforeach
            
           </div>
        </div>
      </div>  -->
      <!-- carousel two  -->
      <!-- <div class="carousel-item">
        <div class="row">
          <div class="col-4">
            <img src="{{asset('image/barimg.jpg')}}" height="100" width="100" class="d-block w-100" alt="...">
          </div>
          
        </div>
      </div>
    </div>
    
    <button class="carousel-control-prev" type="button" data-bs-target="#carousel1" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel1" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>  -->
 <!-- end of carousel  -->
</main>

<br>
<footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Back to top</a>
        </p>
        <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
        <p>New to Bootstrap? <a href="../../">Visit the homepage</a> or read our <a href="../../getting-started/">getting started guide</a>.</p>
      </div>
    </footer>

</div>
@endsection

