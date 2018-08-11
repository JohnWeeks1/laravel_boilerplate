@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row"> 
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
