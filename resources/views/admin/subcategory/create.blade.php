@extends('admin.layouts.main')
@section('content')

 <!-- start of breadcrumbs  -->
 <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Subcategory</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
      </ol>
    </nav>
    <!-- end of breadcrumbs -->

              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Create Subcategory</h6>
                </div>
                <div class="card-body">
                  <form action="{{route('subcategory.store')}}" enctype="multipart/form-data" method="post">@csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter subcategory name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      
                    </div>
                    
                    <div class="form-group">
                      <div class="custom-file">
                        <select name="category" id="" class="form-control @error('name') is-invalid @enderror">
                        <option value="">Select Category</option>
                          @foreach (App\Models\Category::all() as $category)
                          <option value="{{$category->id}}">{{$category->name}}</option>
                          @endforeach
                        </select>
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </div>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    
                  </form>
                </div>
              </div>


              


@endsection