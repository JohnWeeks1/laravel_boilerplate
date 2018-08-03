@extends('adminlte::page')

@section('title', 'Profile')

@include('admin.includes.scripts')

@section('content_header')
    <div class="container">
        <h3>Profile</h3>
    </div>
@stop

@section('content')
    <div class="container-fluid bg-light py-3 jumbotron">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
            <form method="POST" action="profile/{{ $user->id }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PATCH') }}
            <div class="col-md-offset-2 col-md-8">
                <div class="form-group">
                    <label for="title">Name</label>
                <input type="text" class="form-control" name="name" value="{{$user->name ? $user->name : ''}}">
                </div>
            </div>
            <div class="col-md-offset-2 col-md-8">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="{{$user->email ? $user->email : ''}}">
                </div> 
            </div>
            <div class="col-md-offset-2 col-md-8">
                <div class="form-group">
                    <label for="">Current Image</label> <br>
                    @if(!empty($user->path))
                        <img src="{{ asset("images/profile_pics/$user->path")}}" alt="">
                    @else
                        <p>You haven't uploaded an image yet.</p>
                    @endif
                </div>
            </div>
            <div class="col-md-offset-2 col-md-8">
                <div class="form-group">
                    <label for="">New Image</label>
                    <div class="image-editor">
                        <input type="file" class="cropit-image-input">
                        <div class="cropit-preview"></div>
                        <div class="image-size-label">
                        Resize image
                        </div>
                        <input type="range" class="cropit-image-zoom-input">
                        <input type="hidden" name="image-data" class="hidden-image-data" />
                    </div>
                </div>
            </div>
            <div class="col-md-offset-2 col-md-8">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@stop