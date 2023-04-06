@extends('admin.layouts.main')
@section('content')

            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">DataTables with Hover</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Additional Info</th>
                        <th>Category</th>
                        <th>-</th>
                        <th>-</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if ($products)
                      @foreach ($products as $key=>$product)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$product->name}}</td>
                        <td>{!!$product->description!!}</td>
                        <td><img src="{{Storage::url($product->image)}}" width="100" alt=""></td>
                        <td>${{$product->price}}</td>
                        <td>{{$product->additional_info}}</td>
                        <td>{{$product->category->name}}</td>
                        <td><a href="{{route('product.edit',[$product->id])}}"><button class="btn btn-sm btn-primary">Edit</button></a></td>
                        <td><form action="{{ route('product.destroy',[$product->id]) }}" method="post" onsubmit="return confirmDelete()">@csrf 
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-sm bg-danger btn-danger">Delete</button></form></td>
                      </tr>
                      @endforeach
                      @else
                      <p>No product to display</p>
                      @endif
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          


@endsection