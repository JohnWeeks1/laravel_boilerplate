@extends('layouts.app')

@section('title', 'L Boilerplate')

@section('content')
    <div class="container">
        <div class="row"> 
            <div class="col-sm-4 col-md-3 p-3">
                <div class="card">
                    <img class="card-img-top image-fluid" src="http://via.placeholder.com/350x225" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">Name</h4>
                            <p class="card-text">Description</p>
                            <a href="#">View</a>
                        </div>
                </div>  
            </div>
        </div>
    </div>
@endsection
