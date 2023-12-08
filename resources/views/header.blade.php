<?php
use App\Http\Controllers\ProductController;
$total=ProductController::cartItem();
?>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    <a class="navbar-brand h5" href="/home">EComm </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active h5" aria-current="page" href="/home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link h5" href="#">Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link h5" href="#">Add cart</a>
        </li>

      </ul>
      <form class="d-flex" action="{{ route('search') }}" method="POST">
          @csrf
          <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Submit</button>
      </form>
      <div class="collapse navbar-collapse" id="navbarScroll">
          <ul class=" nav navbar-nav navbar-right" style="--bs-scroll-height: 100px;">
          <li class="nav-item"><a class="nav-link" href="/cartlist">Cart {{ $total }}</a>
            </li>
          </ul>
      </div>

      <ul class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>

        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
</ul>
    </div>
  </div>
</nav>