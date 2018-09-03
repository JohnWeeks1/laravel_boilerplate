@extends('layouts.app')

@section('title', 'Home')

@section('content')
{{-- <div id="carousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="{{asset("images/site_images/background.jpg")}}" alt="" class="img-fluid" style="min-width:1200px;">
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div> --}}
    <div class="container">
        <div class="row justify-content-start"> 
            <div class="card-columns">
                @foreach($products as $product)
                    @component("components.card")
                        @slot('path')
                            {{asset("images/products/$product->path")}}
                        @endslot
                        @slot('name')
                            {{$product->name}}
                        @endslot
                        @slot('description')
                            €{{$product->cost}}
                        @endslot
                        @slot('link')
                            {{url("product/$product->id")}}
                        @endslot
                    @endcomponent
                @endforeach
            </div>
        </div>
        <div class="center_paginate">
            {{ $products->links() }}
        </div>
    </div>
@endsection
