@extends('admin.layouts.main')
@section('content')




          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div>
                  @if (Session::has('message'))
                    <div class="alert alert-success">
                      {{ Session::get('message') }}
                    </div>
                  @endif
                </div>
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">View Category</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Order ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($categories as $key=>$category)
                      <tr>
                        <td><a href="#">{{ $key+1 }}</a></td>
                        <td>{{$category->name}}</td>
                        <td>{!! $category->description !!}</td>
                        <td><img src="Storage::url($category->image)" alt="{{$category->name}}"></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Edit</a></td>
                        <td><a href="#" class="btn btn-sm btn-secondary">Delete</a></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  
                </div>
              </div>
            </div>
          </div>

@endsection