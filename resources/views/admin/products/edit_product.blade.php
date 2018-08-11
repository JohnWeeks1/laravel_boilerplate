@extends('adminlte::page')

@section('title', 'Edit Product')

@include('admin.includes.scripts')

@section('content_header')
    <div class="container">
        <div class="row">
            <h3>Edit Product</h3>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid py-3 jumbotron">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            {!! Form::open(['method' => 'POST', 'files' => true, 'action' => ['ProductController@update', $product->id]]) !!}
                @csrf
                {{ method_field('PATCH') }}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="product_category">Select Category</label>
                            <select class="form-control" name="product_category" id="product_category">

                                
                                @if($product->product_category == 0)
                                    <option value="0">Water Sports</option>
                                @elseif($product->product_category == 1)
                                    <option value="1">Skate</option>
                                @else
                                    <option value="2">Other</option>
                                @endif


                                <option value="0">Water Sports</option>
                                <option value="1">Skate</option>
                                <option value="2">Other</option>


                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" name="name" class="form-control" placeholder="Please the name of you event" value="{{$product->name}}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Pleae enter the description for you event" rows="4">{{$product->description}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Cost</label>
                        <input id="cost" name="cost" class="form-control" placeholder="12.99" value="{{$product->cost}}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="image">Current Image</label> <br>
                            <img src="{{ asset("images/products/$product->path") }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image">
                        </div>
                    </div>
                    <div class="col-md-12">
                        {!! Form::submit('Update Product', ['class' => 'btn btn-primary btn']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
    </div>
@stop