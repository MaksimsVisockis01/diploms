<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>@yield('page.title', 'diplom')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<body>

<nav>
    <ul class="menu">
        <li class="logo"><a href="/">Logo</a></li>
        <li class="item"><a href="#">About</a></li>
        <li class="item"><a href="#">Forum</a></li>
        <li class="item"><a href="#">Services</a></li>

        @if(session('user_id'))
            <li class="item button secondary"><a href="{{ route('logout') }}">Logout</a></li>
        @elseif(session('admin_id'))
            {{-- <li class="item"><a href="{{ route('users') }}">User Ctrl</a></li>
            <li class="item"><a href="{{ route('gameAdd') }}">Add Game</a></li>
            <li class="item"><a href="{{ route('gameList') }}">Game List</a></li> --}}
            <li class="item button secondary"><a href="{{ route('logout') }}">Logout</a></li>
        @else
            <li class="item button"><a href="{{ route('login') }}">Log In</a></li>
            <li class="item button secondary"><a href="{{ route('register') }}">Sign Up</a></li>
        @endif


        <li class="toggle"><span class="bars"></span></li>
    </ul>
</nav>
<script src="{{ asset('js/navbar.js') }}"></script>

     @yield('content')



</body>
</html>