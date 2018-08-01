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
                    <label for="">Current Image</label> <br>
                    @if(!empty($user->image))
                        <img src="{{$user->image}}" alt="">
                    @else
                        <p>You haven't uploaded an image yet.</p>
                    @endif
                </div>
            </div>
            <div class="col-md-offset-2 col-md-8">
                    <div class="form-group">
                        <label for="">New Image</label>
                        <div id="image-cropper">
                            <div class="cropit-preview"></div>
                            
                            <input type="range" class="cropit-image-zoom-input" />
                            
                            <!-- The actual file input will be hidden -->
                            <input type="file" class="cropit-image-input" />
                            <!-- And clicking on this button will open up select file dialog -->
                            <div class="select-image-btn">Select new image</div>
                        </div>
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