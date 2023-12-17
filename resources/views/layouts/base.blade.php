<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>@yield('page.title', 'diplom')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/forumindex.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comment.css') }}">
    <link rel="stylesheet" href="{{ asset('css/question_show.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comment_form.css') }}">
</head>
<body>

<nav>
    <ul class="menu">
        <li class="logo"><a class="nav" href="/">Logo</a></li>
        <li class="item"><a class="nav" href="{{ route('files') }}">Files</a></li>
        <li class="item"><a class="nav" href="{{ route('forum') }}">Forum</a></li>
        <li class="item"><a class="nav" href="#">Services</a></li>

        @if(session('user_id'))
            <li class="item button secondary"><a class="nav" href="{{ route('logout') }}">Logout</a></li>
        @elseif(session('admin_id'))
            {{-- <li class="item"><a class="nav" href="{{ route('users') }}">User Ctrl</a></li>
            <li class="item"><a class="nav" href="{{ route('gameAdd') }}">Add Game</a></li>
            <li class="item"><a class="nav" href="{{ route('gameList') }}">Game List</a></li> --}}
            <li class="item button secondary"><a class="nav" href="{{ route('logout') }}">Logout</a></li>
        @else
            <li class="item button"><a class="nav" href="{{ route('login') }}">Log In</a></li>
            <li class="item button secondary"><a class="nav" href="{{ route('register') }}">Sign Up</a></li>
        @endif


        <li class="toggle"><span class="bars"></span></li>
    </ul>
</nav>
<script src="{{ asset('js/navbar.js') }}"></script>

     @yield('content')



</body>
</html>