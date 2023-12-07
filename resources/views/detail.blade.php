{{View::make('header')}}
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-8 mx-auto">
            <div class="card-group border bg-light">
                <div class="card "> 
                <h3 class="card-header text-center">{{$product['name']}}</h3>
                    <img src="{{$product['gallery']}}" height=400 width=400  alt="">
                </div>
                <div class="card shadow-lg p-3 bg-body rounded">
                  <div class="card-header text-center"><a href="/home">Go back</a></div>
                    <div class="card-body">
                        <h3 class="card-text">Price:{{$product['price']}}</h4>
                        <h4 class="card-text text-success">Category:{{$product['category']}}</h4>
                        <h4 class="card-text text-info">Description:{{$product['description']}}</h4>
                    </div>
                     <div class="text-center mb-3">
                        <form action="/add_to_cart"method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product['id']}}">
                           <button class="btn btn-primary " >Add to Cart</button>
                        </form>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                    <button class="btn btn-success " type="button" >Buy Now</button>
                    </div>
                </div>
                
            </div>
        <div>
    </div>
</div>
@endsection