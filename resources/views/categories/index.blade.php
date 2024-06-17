@extends('layouts.base')

@section('page.title', 'Categories')

@section('content')
<x-categories-section>
    <x-forms-header>
        <x-forms-heading>Categories</x-forms-heading>
        <x-search-container action="{{ route('categories.index') }}" method="GET" class="mb-4">
            <input class="form-control mr-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </x-search-container>
    </x-forms-header>
    
    <x-filter-container>
        <form action="{{ route('categories.index') }}" method="GET" class="mb-4">
            @csrf
            <x-filters-container>
                <x-filter-parametr-container>
                    <select class="form-control" name="sort">
                        <option value="">Sort by</option>
                        <option value="title-asc" {{ request('sort') == 'title-asc' ? 'selected' : '' }}>Title A-Z</option>
                        <option value="title-desc" {{ request('sort') == 'title-desc' ? 'selected' : '' }}>Title Z-A</option>
                        <option value="usage-asc" {{ request('sort') == 'usage-asc' ? 'selected' : '' }}>Total Usage Ascending</option>
                        <option value="usage-desc" {{ request('sort') == 'usage-desc' ? 'selected' : '' }}>Total Usage Descending</option>
                    </select>
                </x-filter-parametr-container>
                <x-filter-parametr-container>
                    <button class="btn btn-outline-primary" type="submit">Filter</button>
                </x-filter-parametr-container>
            </x-filters-container>
        </form>
    </x-filter-container>
    
    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-4 mb-4 w-25">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->title }}</h5>
                        <p class="card-text">{{ $category->description }}</p>
                        <p class="card-text"><small class="text-muted">Files: {{ $category->files_count }}</small></p>
                        <p class="card-text"><small class="text-muted">Questions: {{ $category->questions_count }}</small></p>
                        <a href="{{ route('category.show', $category->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    @if ($categories->lastPage() > 1)
        <div class="d-flex justify-content-between align-items-center mt-4">
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item {{ $categories->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link page-button" href="{{ $categories->previousPageUrl() }}" aria-label="Previous" data-target="{{ $categories->currentPage() - 1 }}">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $categories->lastPage(); $i++)
                        <li class="page-item {{ $categories->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link page-button" href="{{ $categories->url($i) }}" data-target="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $categories->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link page-button" href="{{ $categories->nextPageUrl() }}" aria-label="Next" data-target="{{ $categories->currentPage() + 1 }}">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <form action="{{ route('categories.index') }}" method="GET" class="d-inline-flex ml-3 gap-1">
                <input type="number" class="form-control mr-2" style="width: 100px;" name="page" min="1" max="{{ $categories->lastPage() }}" placeholder="Page" aria-label="Page">
                <button class="btn btn-outline-primary" type="submit">Go</button>
            </form>
        </div>
    @endif
</x-categories-section>
@endsection
