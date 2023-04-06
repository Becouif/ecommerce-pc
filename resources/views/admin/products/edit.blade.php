@extends('admin.layouts.main')
@section('content')


    <!-- start of breadcrumbs  -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('category.index')}}">Product</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
      </ol>
    </nav>
    <!-- end of breadcrumbs -->

              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Update Product</h6>
                </div>
                <div class="card-body">
                  <form action="{{route('product.update',[$product->id])}}" enctype="multipart/form-data" method="post">@csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{$product->name}}" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter product name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      
                    </div>
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea name="description" class="form-control @error('description') is-invalid @enderror" name="description" id="summernote" cols="30" rows="10">{!! $product->description !!}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group">
                      <label for="additional_info">Additional Info</label>
                      <textarea name="additional_info" class="form-control @error('additional_info') is-invalid @enderror" name="description" id="" cols="30" rows="10">{{$product->additional_info}}</textarea>
                                @error('additional_info')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group">
                      <div class="custom-file">
                        <img src="{{Storage::url($product->image)}}" width="100" alt="">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        <input name="image" type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFile">
                        
                          @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="price">enter price</label>
                      <input name="price" type="number" class="form-control @error('price') is-invalid @enderror" value="{{$product->price}}" id="price" placeholder="Enter price">
                        @error('price')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      
                    </div>
                    <div class="form-group">
                      <select class="form-control" name="category" id="category">
                        <option value="">select category</option>
                      @foreach (App\Models\Category::all() as $category)
                        <option for="category" value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </select>

                    </div>
                    <div class="form-group">
                      <select class="form-control" name="subcategory" id="subcategory">
                        <option value="">Select subcategory</option>
                                @error('subcategory')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </select>

                    </div>

                    
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    
                  </form>
                </div>
              </div>




     <!-- script for jquery from cdnjs  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<!-- script for ajax dropdown -->

<script type="text/javascript">
    $("document").ready(function(){
      $('select[name="category"]').on('change',function(){
        var catId = $(this).val();
        if(catId)
        {
          $.ajax({
            url:'/subcategories/'+catId,
            type:"GET",
            dataType:"json",
            success:function(data){
              $('select[name="subcategory"]').empty();
              $.each(data,function(key,value){
                $('select[name="subcategory"]').append('<option value=" '+key+' "> '+value+' </option> ')
              })
            }
          })
        } else {
          $('select[name="subcategory"]').empty();
        }
      })
    })
</script>




@endsection