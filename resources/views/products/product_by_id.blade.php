@extends('layouts.app')

@section('title', 'Product')

@section('content')
    <div class="container">
        <div class="jumbotron">
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
            <div class="row"> 
                <div class="col-md-6 text-center">
                    <img class="img-fluid" src="{{url("images/products/$product->path")}}">
                </div>
                <div class="col-md-6">
                    <div class="col-md-12 text-center">
                        <h1>{{$product->name}}</h1>
                        <p>{{$product->description}}</p>
                        <p>{{$product->cost}}</p>
                    </div>
                    <div class="col-md-12">
                    <span class="float-left"><b>Seller:</b> <a href="{{url('profile/'.$product->user->id)}}">{{$product->user->name}}</a> </span>
                        <br><br>
                        @if(Auth::check())
                            <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#email">Email</a> 
                            <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#whatsapp">Whatsapp</a> 
                        @endif
                        {{-- Email --}}
                        @component('components.model_basic')
                            @slot('name')
                                email
                            @endslot
                            @slot('header')
                                Email
                            @endslot
                            @slot('body')
                            {!! Form::open(['method' => 'POST', 'route' => ['send_email']]) !!}
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="email_message">Email message</label>
                                    <textarea class="form-control" rows="5" name="email_message">{{ old('email_message') }}</textarea>
                                    <input type="hidden" value="{{$product->user->email}}" name="email">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                {!! Form::close() !!}
                            @endslot
                        @endcomponent
                        {{-- Email END--}}
                        {{-- Whatsapp --}}
                        @component('components.model_basic')
                            @slot('name')
                                whatsapp
                            @endslot
                            @slot('header')
                                Whatsapp
                            @endslot
                            @slot('body')
                            <div class='form-group'>
                                <label for='phone'>Phone Number</label>
                                <input type='phone' class='form-control' id='mobile' value="{{substr($product->user->mobile,1,50)}}" readonly>
                              </div>
                            <div class='form-group'>
                                <label for='message'>Message</label>
                                <textarea class='form-control' rows='5' id='message'></textarea>
                              </div>
                              <a type='button' href='https://api.whatsapp.com/send' target='_blank' class='btn btn-success pull-right send_whatsapp_message'>Send</a>
                            @endslot
                        @endcomponent
                        {{-- Whatsapp END--}}
                    </div>                
                </div>
            </div>
        </div>
    </div>
@endsection