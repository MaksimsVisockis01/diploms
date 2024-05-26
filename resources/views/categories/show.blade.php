@extends('layouts.base')

@section('page.title', 'Category')

@section('content')
<x-form-75-container>
    <x-forms-header>
        <x-forms-heading>{{ $category->title }}</x-forms-heading>
        <x-search-container action="{{ route('category.show', $category->id) }}" method="GET">
            <input class="form-control mr-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </x-search-container>
    </x-forms-header>
    <p>{{ $category->description }}</p>

    <x-filter-container>
        <form action="{{ route('category.show', $category->id) }}" method="GET" class="mb-4">
            @csrf
            <x-filters-container>
                <x-filter-parametr-container>
                    <select class="form-control" name="type">
                        <option value="">All</option>
                        <option value="question" {{ request('type') == 'question' ? 'selected' : '' }}>Question</option>
                        <option value="file" {{ request('type') == 'file' ? 'selected' : '' }}>File</option>
                    </select>
                </x-filter-parametr-container>
                <x-filter-parametr-container>
                    <select class="form-control" name="sort">
                        <option value="date-desc" {{ request('sort') == 'date-desc' ? 'selected' : '' }}>Date Descending</option>
                        <option value="date-asc" {{ request('sort') == 'date-asc' ? 'selected' : '' }}>Date Ascending</option>
                        <option value="title-asc" {{ request('sort') == 'title-asc' ? 'selected' : '' }}>Title A-Z</option>
                        <option value="title-desc" {{ request('sort') == 'title-desc' ? 'selected' : '' }}>Title Z-A</option>
                    </select>
                </x-filter-parametr-container>
                <x-filter-parametr-container>
                    <button class="btn btn-outline-primary" type="submit">Filter</button>
                </x-filter-parametr-container>
            </x-filters-container>
        </form>
    </x-filter-container>

    <div class="row">
        @foreach($paginatedContent as $item)
            <div class="col-md-4 mb-4 w-25">
                <div class="card">
                    <div class="card-body">
                        @if($item['type'] === 'question')
                            <li class="list-group-item">
                                <h5 class="text-truncate" style="max-width: 200px;">{{ $item['data']->title }}</h5>
                                <p>{{ $item['data']->content }}</p>
                                <p><strong>Author:</strong> {{ $item['data']->user->name }}</p>
                                <a href="{{ route('question.show', $item['data']->id) }}" class="btn btn-primary">View Question</a>
                            </li>
                        @elseif($item['type'] === 'file')
                            <li class="list-group-item">
                                <h5 class="text-truncate" style="max-width: 200px;">{{ $item['data']->title }}</h5>
                                <p>{{ $item['data']->description }}</p>
                                <p><strong>Author:</strong> {{ $item['data']->user->name }}</p>
                                <a href="{{ asset('storage/files/' . $item['data']->file_path) }}" class="btn btn-outline-primary text-truncate" style="max-width: 200px;" target="_blank" title="{{ $item['data']->file_path }}">
                                    {{ $item['data']->file_path }}
                                </a>
                            </li>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if ($paginatedContent->lastPage() > 1)
        <div class="d-flex justify-content-between align-items-center mt-4">
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item {{ $paginatedContent->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link page-button" href="{{ $paginatedContent->previousPageUrl() }}" aria-label="Previous" data-target="{{ $paginatedContent->currentPage() - 1 }}">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $paginatedContent->lastPage(); $i++)
                        <li class="page-item {{ $paginatedContent->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link page-button" href="{{ $paginatedContent->url($i) }}" data-target="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $paginatedContent->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link page-button" href="{{ $paginatedContent->nextPageUrl() }}" aria-label="Next" data-target="{{ $paginatedContent->currentPage() + 1 }}">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <form action="{{ route('category.show', $category->id) }}" method="GET" class="d-inline-flex ml-3 gap-1">
                <input type="number" class="form-control mr-2" style="width: 100px;" name="page" min="1" max="{{ $paginatedContent->lastPage() }}" placeholder="Page" aria-label="Page">
                <button class="btn btn-outline-primary" type="submit">Go</button>
            </form>
        </div>
    @endif
</x-form-75-container>
@endsection
