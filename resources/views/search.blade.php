{{View::make('header')}}
@extends('layouts.app')
@section('content')
 <div class="container">
    <div class="row">
    <h1>Search Results</h1>

@if($products->isEmpty())
    <p>No results found.</p>
@else
    <div class="col-md-8 mx-auto">
     <div class="card ">
        @foreach($products as $product)
           <img src="{{$product['gallery']}}" height=400 width=400  alt="">
            <div class="card-body text-center ">
                <h3 class="card-text">{{ $product->name }}
                <h3 class="card-text">Price:{{$product['price']}}</h4>
                <h4 class="card-text text-success">Category:{{$product['category']}}</h4>
                <h4 class="card-text text-info">Description:{{$product['description']}}</h4>
            </div>
        @endforeach
    
     </div>
    </div>
@endif
    </div>
 </div>
@endsection