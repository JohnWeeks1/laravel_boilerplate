@extends('adminlte::page')

@section('title', 'Create Product')

@include('admin.includes.scripts')

@section('content_header')
    <div class="container">
        <div class="row">
            <h3>Create Product</h3>
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
        {!! Form::open(['method' => 'POST', 'files' => true, 'route' => ['products.store']]) !!}
            @csrf
                <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="product_category">Select Category</label>
                                <select class="form-control" name="product_category" id="product_category">
                                    <option value="0">Water Sports</option>
                                </select>
                            </div>
                        </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" name="name" class="form-control" placeholder="Please the name of you product">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_message">Description</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Pleae enter the description for you product" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_message">Cost</label>
                            <input type="number" step="00.01" id="cost" name="cost" class="form-control" placeholder="12.99">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image">
                        </div>
                    </div>
                    <div class="col-md-12">
                        {!! Form::submit('Create Product', ['class' => 'btn btn-primary btn']) !!}
                    </div>
                </div>
        {!! Form::close() !!}
    </div>
@stop