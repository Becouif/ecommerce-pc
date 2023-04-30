@extends('layouts.app')

@section('content')

<div class="container">
<div class="col-md-8">
    <div class="card">
      <div class="card-header">Checkout</div>
      <div class="card-body">
        <!-- the id for the form is very important for submitting  -->
        <form action="#" method="post" id="payment-form">@csrf
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" required="">
                      </div>
                      
                      <div class="form-group">

                        <label>Address</label>
                        <input type="text" name="address" id="address" class="form-control" required="">
                      </div>
                      <div class="form-group">

                        <label>City</label>
                        <input type="text" name="city" id="city" class="form-control" required="">
                      </div>
                      <div class="form-group">

                        <label>State</label>
                        <input type="text" name="state" id="state" class="form-control" required="">
                      </div>
                      <div class="form-group">

                        <label>Postal code</label>
                        <input type="text" name="postalcode" id="postalcode" class="form-control" required="">
                      </div>
                      <div class="">
            <input type="hidden" name="amount" value="{{$amount}}">
                     

                      <button class="btn btn-primary mt-3">Submit Payment</button>
      </form>
 </div>
</div>
</div>
</div>


@endsection