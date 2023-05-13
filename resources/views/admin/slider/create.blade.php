@extends('admin.layouts.main')
@section('content')


    <!-- start of breadcrumbs  -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('category.index')}}">Slider</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
      </ol>
    </nav>
    <!-- end of breadcrumbs -->

              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Create Slider</h6>
                </div>
                <div class="card-body">
                  <form action="{{route('slider.store')}}" enctype="multipart/form-data" method="post">@csrf
                    
                    
                    <div class="form-group">
                      <div class="">
                        
                        <!-- <label for="customFile">Choose file</label> -->
                        <input name="image" type="file" class=" @error('image') is-invalid @enderror" id="customFile">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </div>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary bg-primary">Submit</button>
                    </div>
                    
                  </form>
                </div>
              </div>


              


@endsection