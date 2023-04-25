@extends('admin.layouts.main')
@section('content')


    <!-- start of breadcrumbs  -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('category.index')}}">Category</a></li>
        <li class="breadcrumb-item active" aria-current="page">edit</li>
      </ol>
    </nav>
    <!-- end of breadcrumbs -->

              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Update Category</h6>
                </div>
                <div class="card-body">
                  <form action="{{route('category.update',[$category->id])}}" enctype="multipart/form-data" method="post">@csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{$category->name}}"
                        placeholder="Enter category name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      
                    </div>
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea name="description" class="form-control @error('name') is-invalid @enderror" name="description" id="" cols="30" rows="10">{{$category->description}}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group">
                      <img src="{{Storage::url($category->image)}}" width="100" alt="">
                      <div class="custom-file">
                        <input name="image" type="file" class=" @error('image') is-invalid @enderror" id="customFile">
                        <!-- <label class="custom-file-label" for="customFile">Choose file</label> -->
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </div>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    
                  </form>
                </div>
              </div>


              


@endsection