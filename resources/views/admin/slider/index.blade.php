                 
@extends('admin.layouts.main')

@section('content')


        
    <!-- start of breadcrumbs  -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Slider</li>
      </ol>
    </nav>
    <!-- end of breadcrumbs -->  

          <div class="row">
          
            <div class="col-lg-12 mb-4">
            @if (Session::has('message'))
                    <div class="alert alert-success">
                      {{ Session::get('message') }}
                    </div>
            @endif
              <!-- Simple Tables -->
              <div class="card">
                
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">View Category</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Order ID</th>
                        <th>Image</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if (count($sliders)>0)
                      @foreach ($sliders as $key=>$slider)
                      <tr>
                        <td><a href="#">{{ $key+1 }}</a></td>
                        <td><img src="{{Storage::url($slider->image)}}" width="100" alt="{{$slider->name}}"></td>
                        <!-- <td>
                          <form action="{{route('category.destroy',[$category->id])}}" method="POST" onsubmit="return confirmDelete()">@csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-sm bg-danger btn-danger">Delete</button>
                          </form>
                        </td> -->
                      </tr>
                      @endforeach
                      @else
                      <td>No slider created yet</td>
                      @endif
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  
                </div>
              </div>
            </div>
          </div>

@endsection