@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="container">
        <div class="row"> 
            <div class="card-columns">
                @foreach($products as $product)
                    @component("components.card")
                        @slot('path')
                            {{asset("images/events/$product->path")}}
                        @endslot
                        @slot('name')
                            {{$product->name}}
                        @endslot
                        @slot('description')
                        <b>Location:</b> {{$product->location->address}}
                        @endslot
                        @slot('link')
                            {{url("event/$product->id")}}
                        @endslot
                    @endcomponent
                @endforeach
            </div>
        </div>
        <div class="center_paginate">
            {{ $product->links() }}
        </div>
    </div>
@endsection
