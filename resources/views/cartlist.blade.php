{{ View::make('header') }}
@extends('layouts.app')

@section('content')
    <div class="container">
        @if($products->isNotEmpty())
            <h2>Items in Cart</h2>
            @foreach($products->chunk(3) as $productChunk)
                <div class="row">
                    @foreach($productChunk as $product)
                        <div class="col-md-4">
                            <div class="card mt-3">
                                <h3 class="card-text">{{ $product->id }}</h3>
                                <img src="{{ $product->gallery }}" height="400" width="400" alt="">
                                <h4 class="card-text">Price: {{ $product->price }}</h4>
                                <h4 class="card-text text-success">Category: {{ $product->category }}</h4>
                                <h4 class="card-text text-info">Description: {{ $product->description }}</h4>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary  me-md-2 mt-2 mb-2" type="button" href="/order">Order Now</a>
                                <a class="btn btn-warning  me-md-2 mt-2 mb-2" type="button" href="/remove-cart/{{$product->cart_id}}">Remove from cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
@endsection
