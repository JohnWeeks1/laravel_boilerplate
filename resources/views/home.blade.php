@extends('layouts.app')

@section('title', 'L Boilerplate')

@section('content')
    <div class="container">
        <div class="row"> 
            @foreach($events as $event)
                <div class="col-sm-4 col-md-3 p-3">
                    <div class="card">
                        <img class="card-img-top image-fluid" src="{{asset("images/events/$event->path")}}" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">{{$event->name}}</h4>
                            <p class="card-text">{{$event->description}}</p>
                            <a href="">View</a>
                        </div>
                    </div> 
                </div>
            @endforeach
        </div>
    </div>
@endsection
