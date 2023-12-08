{{ View::make('header') }}
@extends('layouts.app')

@section('content')
    <div class="container">
        @if($orders->isNotEmpty())
            <h2>My Orders</h2>
                <div class="row">
                    @foreach($orders as $product)
                        <div class="col-md-4">
                            <div class="card mt-3">
                                <img src="{{ $product->gallery }}" height="400" width="400" alt="">
                                <h3 class="card-text">Name :{{ $product->name }}</h3>
                                <h4 class="card-text">Delivery Status: {{ $product->status }}</h4>
                                <h4 class="card-text text-success">Payment Status: {{ $product->payment_status }}</h4>
                                <h4 class="card-text text-info">Payment Method: {{ $product->payment_method }}</h4>
                            </div>
                        </div>
                    @endforeach
                </div>
        @else
        <div class="row mt-8">
            <div class="col-md-6 mx-auto">
                <div class="card mt-3 shadow-lg p-3 mb-5 bg-body rounded bg-success">
                    <h4 class="card-text">You have not made any orders yet</h4>
                         <div class="card-footer">     
                            <a class="btn btn-primary  me-md-2 mt-2 mb-2 text-center" type="button" href="/home">Order Now</a> 
                         </div>
                </div>          
            </div>

        </div>
        @endif
    </div>
@endsection
