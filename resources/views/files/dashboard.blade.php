@extends('layouts.base')

@section('page.title', 'File')

@section('content')
<x-form-75-container>
    <x-forms-header>
        <x-forms-heading>Files</x-forms-heading>
        <x-search-container action="{{ route('dashboard') }}" method="GET">
            <input class="form-control mr-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </x-search-container>
    </x-forms-header>

    <x-filter-container>
        <form action="{{ route('dashboard') }}" method="GET">
            @csrf
            <x-filters-container>
                <x-filter-parametr-container>
                    <select class="form-control" name="category">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </x-filter-parametr-container>
                <x-filter-parametr-container>
                    <input type="date" class="form-control" name="date" value="{{ request('date') }}">
                </x-filter-parametr-container>
                <x-filter-parametr-container>
                    <select class="form-control" id="sort" name="sort">
                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Descending</option>
                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    </select>
                </x-filter-parametr-container>
                <x-filter-parametr-container>
                    <button class="btn btn-outline-primary" type="submit">Filter</button>
                </x-filter-parametr-container>
            </x-filters-container>
        </form>
    </x-filter-container>

    <x-form-wrapper>
        <a href="{{ route('addfile') }}" class="btn btn-primary">Add File</a>
    </x-form-wrapper>
    @if(request('search'))
        <p>Search results for: "{{ request('search') }}"</p>
    @endif
    
    <x-cards id="cards">
        @if ($files->count() > 0)
            @foreach ($files as $file)
                <x-card>
                    <x-settings-button>
                        @if(auth()->check() && $file->user_id == auth()->user()->id)
                            <li><a href="{{ route('files.edit', $file->id) }}" class="dropdown-item">Edit</a></li>
                            <div class="dropdown-divider"></div>
                        @endif
                        @if(auth()->check() && (auth()->user()->isAdmin() || $file->user_id == auth()->id()))
                        <li>
                            <form action="{{ route('files.destroy', $file->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this file?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item mw-100">Delete</button>
                            </form>
                        </li>
                        @endif
                    </x-settings-button>
                    <x-cards-header>
                    </x-cards-header>
                    <x-cards-content>
                        <span class="text-uppercase fs-5">{{ $file->title }}</span><br>
                        <span class="text-capitalize font-weight-bold">{{ $file->author }}</span>
                        <p>{{ $file->description }}</p>
                        <a href="{{ asset('storage/files/' . $file->file_path) }}" class="btn btn-primary btn-sm" target="_blank">
                            Download File: {{ $file->file_path }}.{{ pathinfo($file->file_path, PATHINFO_EXTENSION) }}
                        </a>
                    </x-cards-content>
                    <x-cards-footer>
                        <x-categories-container>
                            @if ($file->categories->isNotEmpty())
                                @foreach ($file->categories as $category)
                                    <x-category-container :route="route('category.show', $category->id)">
                                        {{ $category->title }}
                                    </x-category-container>
                                @endforeach
                            @else
                                <x-none-category-container>
                                    uncategorised
                                </x-none-category-container>
                            @endif
                        </x-categories-container>
                            <x-publishing-date :uid="$file->user->uid" :published_at="$file->published_at"/>
                    </x-cards-footer>
                </x-card>
            @endforeach
        @else
            <p class="text-muted">No files found.</p>
        @endif
    </x-cards>

    @if ($files->lastPage() > 1)
        <div class="d-flex justify-content-between align-items-center mt-4">
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item {{ $files->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $files->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $files->lastPage(); $i++)
                        <li class="page-item {{ $files->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $files->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $files->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $files->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <form action="{{ route('dashboard') }}" method="GET" class="d-inline-flex ml-3">
                <input type="number" class="form-control mr-2" style="width: 100px;" name="page" min="1" max="{{ $files->lastPage() }}" placeholder="Page" aria-label="Page">
                <button class="btn btn-outline-primary" type="submit">Go</button>
            </form>
        </div>
    @endif
</x-form-75-container>
@endsection
