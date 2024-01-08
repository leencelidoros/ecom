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
                    <td>${{$total}}+$0</td>
                </tr>
            </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="card-header text-center h5">Enter Your Details Here!!</div>
                <form action="/orderplace" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="location" name="address" class="form-label h6">Email address</label>
                        <input type="text" name="address" class="form-control" id="location" placeholder="Enter your location" aria-describedby="emailHelp" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone" class="form-label h6">Phone</label>
                        <input type="tel" name="phone" class="form-control" id="phone" placeholder="Enter your Phone Number" aria-describedby="emailHelp" required>
                    </div>

                    <div class="form-group mb-3">
                        <div class="form-check form-check-inline">
                            <input name="payment_method" value="Paypal" class="form-check-input" type="radio" id="inlineRadio1" required>
                            <label class="form-check-label h6" for="inlineRadio1">Paypal Payment</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input name="payment_method" value="Mpesa" class="form-check-input" type="radio" id="inlineRadio2" required>
                            <label class="form-check-label h6" for="inlineRadio2">Mpesa payment</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input name="payment_method" value="Cash" class="form-check-input" type="radio" id="inlineRadio3" required>
                            <label class="form-check-label h6" for="inlineRadio3">Payment on Delivery</label>
                        </div>
                    </div>

                   <div class="mr-5"> <button type="submit" class="btn btn-primary">Order Now</button></div>
                </form>
                </div>
            </div>
              </div>
            </div>
    </div>
@endsection
