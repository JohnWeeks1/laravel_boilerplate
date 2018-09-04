@extends('layouts.app')

@section('title', 'Profile')

<link rel="stylesheet" href="{{ asset('css/map.css') }}">

@section('content')

<div class="container">
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-3 col-sm-4 text-center">
                <img class="rounded img-fluid" src="{{asset("images/profile_pics/$user->path")}}" alt="">
            </div>
            <div class="col-md-9 col-sm-8">
                <br>
                <h3>{{$user->name}}</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magnam et nesciunt, iste recusandae vero dolores temporibus assumenda est molestiae optio qui quaerat totam sit doloremque deserunt magni at similique quasi.</p>
                <ul>
                    <li> <a href="" data-toggle="modal" data-target="#email">Email</a>  </li>
                    <li> <a href="" data-toggle="modal" data-target="#whatsapp">Whatsapp</a> </li>
                </ul>

                    {{-- Email --}}
                    @component('components.model_basic')
                        @slot('name')
                            email
                        @endslot
                        @slot('header')
                            Email {{$user->name}}
                        @endslot
                        @slot('body')
                        {!! Form::open(['method' => 'POST', 'route' => ['send_email']]) !!}
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email_message">Email message</label>
                                <textarea class="form-control" rows="5" name="email_message">{{ old('email_message') }}</textarea>
                                <input type="hidden" value="{{$user->email}}" name="email">
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
                                Whatsapp {{$user->name}}
                            @endslot
                            @slot('body')
                            <div class='form-group'>
                                <label for='phone'>Phone Number</label>
                                <input type='phone' class='form-control' id='mobile' value="{{substr($user->mobile,1,50)}}" readonly>
                              </div>
                            <div class='form-group'>
                                <label for='message'>Message</label>
                                <textarea class='form-control' rows='5' id='message'></textarea>
                              </div>
                              <a type='button' href='https://api.whatsapp.com/send' target='_blank' class='btn btn-success pull-right send_whatsapp_message'>Send</a>
                            @endslot
                        @endcomponent
                        {{-- END Whatsapp --}}


                <button class="btn btn-info float-right">Edit</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4>Events</h4>
        </div>
            <div class="card-columns">
                <?php $a=0; ?>
                @foreach($user->events as $event)
                    @component("components.card")
                        @slot('path')
                            {{asset("images/events/$event->path")}}
                        @endslot
                        @slot('name')
                            {{$event->name}}
                        @endslot
                        @slot('description')
                            <b>Location:</b> {{$event->location->address}}
                        @endslot
                        @slot('link')
                            {{url("event/$event->id")}}
                        @endslot
                    @endcomponent
                    <?php $a++; if($a==3){ break;} ?>
                @endforeach
            </div>
    </div>
    <br>
    <br>
    <div class="row"> 
        <div class="col-md-12">
            <h4>Products</h4>
        </div>
            <div class="card-columns">
                <?php $b=0; ?>
                @foreach($user->products as $product)
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
                    <?php $b++; if($b==3){ break;} ?>
                @endforeach
            </div>
    </div>
</div>
@endsection