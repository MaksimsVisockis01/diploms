<nav class="navbar bg-dark navbar-expand-lg border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
        @if(session('user_id'))
            <a class="navbar-brand text-light" href="/">Hello!</a>
        @else
        <a class="navbar-brand text-light" href="{{ route('register') }}">Hello!</a>
        @endif
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('broadcast.index') }}">Broadcasting</a>
                </li>
                {{-- <li class="nav-item dropdown">
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
                </li> --}}
            </ul>
            <ul class="navbar-nav ms-auto">
                @if(session('user_id'))
                    <li class="nav-item dropstart">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('profile.show', Auth::user()->id) }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                            <li><a class="nav-link text-light" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @elseif(session('admin_id'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Controls
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">Pending users Ctrl</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.users.usercontrol') }}">Manage users</a></li>
                                <li><hr class="dropdown-divider"></li>
                                
                            <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}">Categories Ctrl</a></li>
                                <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('admin.statistics') }}">Statistics</a></li>
                            {{-- <li><a class="dropdown-item" href="{{ route('admin.statistics.files') }}">File Statistics</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.statistics.questions') }}">Question Statistics</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.statistics.comments') }}">Comment Statistics</a></li> --}}
                        </ul>
                    </li>
                    <li class="nav-item dropstart">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('profile.show', Auth::user()->id) }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                            <li><a class="nav-link text-light" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
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