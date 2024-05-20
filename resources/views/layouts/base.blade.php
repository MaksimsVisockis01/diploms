<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>@yield('page.title', 'diplom')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var searchPagesUrl = "{{ route('search.pages') }}";
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css\base.css') }}" >
</head>
<body>
    <nav class="navbar bg-dark navbar-expand-lg border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="/">Logo</a>
            <button class="navbar-toggler btn bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('files') }}">Files</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('forum') }}">Forum</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @foreach($popularCategories as $category)
                                <li><a class="dropdown-item" href="{{ route('category.show', $category->id) }}">{{ $category->title }}</a></li>
                            @endforeach
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('categories.index') }}">All Categories</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <div class="dropdown">
                            <form class="d-flex">
                                <input id="search-input" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-light dropdown-toggle" type="button" id="searchDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Search
                                </button>
                            </form>
                            <ul id="search-results" class="dropdown-menu" aria-labelledby="searchDropdown">
                            </ul>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @if(session('user_id'))
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('logout') }}">Logout</a>
                        </li>
                    @elseif(session('admin_id'))
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('admin.users.index') }}">User Ctrl</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('admin.categories.index') }}">Categories Ctrl</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('logout') }}">Logout</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('login') }}">Log In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('register') }}">Sign Up</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
     @yield('content')
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
 $(document).ready(function() {
    $('#search-input').on('input', function() {
        var query = $(this).val();
        if (query.length >= 3) {
            $.ajax({
                url: searchPagesUrl,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    var html = '';
                    $.each(data, function(index, value) {
                        if (value.title && value.title.toLowerCase().indexOf(query.toLowerCase()) !== -1 && !value.path.includes("destroy") && !value.path.includes("update") && !value.path.includes("edit") && !value.path.includes("show")) {
                            html += '<li><a class="dropdown-item" href="' + value.path + '">' + value.title + '</a></li>';
                        }
                    });
                    $('#search-results').html(html);
                    $('#search-results').addClass('show');
                }
            });
        } else {
            $('#search-results').html('');
            $('#search-results').removeClass('show');
        }
    });

    $(document).on('click', '#search-results a', function(e) {
    e.preventDefault();
    var routeUrl = new URL($(this).attr('href'), window.location.origin).pathname; // Получаем только путь относительно корня
    routeUrl = routeUrl.replace('.blade.php', ''); // Удаляем расширение .blade.php
    window.location.href = routeUrl; // Переходим по URL маршруту относительно корня без расширения .blade.php
    $('#search-input').val('');
    $('#search-results').removeClass('show');
    });

    $(document).click(function(e) {
        if (!$(e.target).closest('#search-results').length) {
            $('#search-results').removeClass('show');
        }
    });
});

// $(document).ready(function(){
//         $('.dropdown').on('click', function(event){
//             $(this).find('.dropdown-menu').toggleClass('show');
//             event.stopPropagation();
//         });
//     });

//     $(document).click(function(event) {
//         if (!$(event.target).closest('.dropdown').length) {
//             $('.dropdown-menu').removeClass('show');
//         }
//     });
    </script>
</body>
</html>