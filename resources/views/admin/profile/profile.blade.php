@extends('adminlte::page')

@section('title', 'Profile')

@include('admin.includes.scripts')

@section('content_header')
    <div class="container">
        <h3>Profile</h3>
    </div>
@stop

@section('content')

<div class="container">
    <form method="post" enctype="multipart/form-data" action="#">
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
                <label for="">Profile Image</label> <br>
                <input type="file" name="image">
            </div>
        </div>
        <div class="col-md-offset-2 col-md-8">
            <div class="form-group">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <button type="submit" class="btn btn-primary upload-result">Submit</button>
            </div>
        </div>
        
    </form>
</div>
@stop