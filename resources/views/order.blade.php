{{ View::make('header') }}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-8 mx-auto">
            <table class="table table-hover table-bordered">
                <tr>
                    <td class="h5">Amount</td>
                    <td>{{$total}}</td>
                </tr>
                <tr>
                    <td class="h5">Tax</td>
                    <td>$0</td>
                </tr>
                <tr>
                    <td class="h4 text-success">Total amount</td>
                    <td>${{$total}}+$10</td>
                </tr>
            </table>
            </div>
        </div>
            <div class="row">
              <div class="col-md-8 mx-auto">
                <form action="/action.php">
                <div class="form-group mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter your email"aria-describedby="emailHelp">
                </div>
                <div class="form-group mb-3">
                  <label for="phone" class="form-label">Phone</label>
                  <input type="tel" class="form-control" id="phone" placeholder="Enter your Phone Number"aria-describedby="emailHelp">
                </div>
                <div class ="form-group mb-3">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">Paypal Payment</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">Mpesa payment</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option2">
                    <label class="form-check-label" for="inlineRadio3">Payment on Delivery</label>
                  </div>
                </div>
  
                <button type="submit" class="btn btn-primary">Order Now</button>
                </form>
              </div>
            </div>
    </div>
@endsection
