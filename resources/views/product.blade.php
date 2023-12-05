{{View::make('header')}}
@extends('layouts.app')
@section('content')
   <div class="container custom-product">
   <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">
        <div class="carousel-inner">
             @foreach($products as $item)
             <div class="carousel-item {{ $item['id'] == 1 ? 'active' : '' }} text-center">
                <img class="slider-img "height=400  width=400  src="{{ $item['gallery'] }}" alt="...">
                <h3>{{$item['name']}}</h3>
                <p>{{$item['description']}}</p>
            </div>
             @endforeach
          </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
   </div>

@endsection
