{{View::make('header')}}
@extends('layouts.app')
@section('content')
    <div class="container custom-product">
        <div class="row">
            <div class="col-md-5 mx-auto mt-5">
                <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">
                    <div class="carousel-inner">
                        @foreach($products as $item)
                        <div class="carousel-item {{ $item['id'] == 1 ? 'active' : '' }} text-center">
                            <a href="detail/{{$item['id']}}">
                                <img class="slider-img "height=400  width=400  src="{{ $item['gallery'] }}" alt="...">
                                <h3 >{{$item['name']}}</h3>
                                <p>{{$item['description']}}</p>
                            </a>
                        </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev btn " type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon  btn btn-secondary " aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
                        <span class="carousel-control-next-icon  btn btn-secondary " aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
            </div>
</div>
        </div> 

        <div class="row trending-items bg-light">
        <h2 class="lead text-center">Trending Items</h3>
            @foreach($products as $item)
            <div class="col-md-4">
                    <div class="card-group">
                     <a href="detail/{{$item['id']}}">
                        <div class="card text-center mb-2">
                        <div class="card-body">
                                <h5 class="card-header">{{$item['name']}}</h5>
                        </div>
                           <img class="slider-img rounded float-end"height=200  width=200  src="{{ $item['gallery'] }}" alt="...">
                             <div class="card-footer">{{$item['id']}}</div>
                        </div>
                      </a>
                    </div>
            </div>
            @endforeach
        </div>
   </div>
   {{View::make('footer')}}
@endsection



