@extends('layouts.app')

@section('title', 'Profile Search')

@section('content')

<div class="container">
        <h2>All Users</h2> 
        <form action="{{ route('profile_search_selected') }}" method="GET">
            @if(!empty($users))
            @csrf
                <select class="search-select" name="user_id" onchange="this.form.submit()">
                    <option value="">Search here for a user profile.......</option>
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            @endif
            <a href="{{ url('profile_search') }}" class="btn btn-sm btn-warning">Get All</a>
        </form>
        
        @if(session()->has('success'))
        <br>
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        
        <br>
        <div class="table-responsive-md">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($users))
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <img width="50" src="{{asset("images/profile_pics/$user->path")}}" alt="">
                                </td>
                                <td>{{$user->name}}</td>
                                <td>
                                    <a href="profile/{{$user->id}}" class="btn btn-primary btn-sm">View Profile</a>
                                </td>
                            </tr>
                        @endforeach
                    @else 
                        <tr>
                            <td>
                                <img width="50" src="{{asset("images/profile_pics/$user_by_id->path")}}" alt="">
                            </td>
                            <td>{{$user_by_id->name}}</td>
                            <td>
                                <a href="profile/{{$user->id}}" class="btn btn-primary btn-sm">View Profile</a>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        @if(!empty($users))
            <div class="center_paginate">
                {{ $users->links() }}
            </div>
        @endif
      </div>
@endsection