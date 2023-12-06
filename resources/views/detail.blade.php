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
                    <div class="card-body">
                        <h3 class="card-text text-success">Category:{{$product['category']}}</h4>
                        <h4 class="card-text">Price:{{$product['price']}}</h4>
                        <h4 class="card-text text-info">Description:{{$product['description']}}</h4>
                    </div>
                     <div class="text-center mb-3"><button class="btn btn-primary " type="button" >Add to cart</button>
                    <button class="btn btn-success " type="button" >Buy Now</button> </div>
                    <div class="card-footer text-center"><a href="/home">Go back</a></div>
                </div>
                
            </div>
        <div>
    </div>
</div>
@endsection