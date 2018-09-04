<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-dark bg-dark" style="padding:20px;">
            <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">Laravel Boilerplate</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                
                    <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link @if(Request::url() === url('/')) active @endif" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Request::url() === url('/events')) active @endif" href="{{ url('/events') }}">Events</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Products
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                <a class="dropdown-item" href="{{ url('product_by_category/0') }}">Water Sports</a>
                                <a class="dropdown-item" href="{{ url('product_by_category/1') }}">Skate</a>
                                <a class="dropdown-item" href="{{ url('product_by_category/2') }}">Other</a>
                            </div>
                        </li>
                        </ul>
                        <div class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::check() ? Auth::user()->name : "Sign In" }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdown04">
                                    @if(!Auth::check())
                                        <a class="dropdown-item" href="{{ route('login') }}">login</a>
                                        <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                                    @else
                                        <a class="dropdown-item" href="{{ url('profile') }}">Profile</a>
                                        <a class="dropdown-item" href="{{ url('admin/dashboard') }}">Dashboard</a>
                                        <hr>
                                        <a class="dropdown-item" href="{{ route('logout') }}">logout</a>
                                    @endif
                                </div>
                            </li>
                        </div>
                    </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
        <footer class="footer">
            <div class="container">
              <span class="text-muted">Place sticky footer content here.</span>
            </div>
          </footer>
    </div>
<script>
$(function() {
    $('.send_whatsapp_message').click(function () {
        var link = $(this).attr("href");
        if($("#mobile").val() != null && $("#message").val() != null) {
          var phone = $("#mobile").val();
          var message = $('#message').val();
          var totalPhone = '?phone=' + phone;
          var totalmessage = '&text=' + message;
          var info = totalPhone + totalmessage;
          var result = link + info;
          $('.send_whatsapp_message').attr("href", result);
        }
    });
});
</script>
</body>
</html>
