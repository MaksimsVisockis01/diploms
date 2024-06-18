@extends('layouts.base')

@section('content')

@section('page.title')
    Files
@endsection
<x-files-table-container>
    <x-forms-header>
        <x-forms-heading>Files</x-forms-heading>
        <x-search-container action="{{ route('admin.filecontrol') }}" method="GET" class="mb-4">
            <input class="form-control mr-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </x-search-container>
    </x-forms-header>
    
    <x-filter-container>
        <form action="{{ route('admin.filecontrol') }}" method="GET" class="mb-4">
            @csrf
            <x-filters-container>
                <x-filter-parametr-container>
                    <select class="form-control" name="sort">
                        <option value="">Sort by</option>
                        <option value="title-asc" {{ request('sort') == 'title-asc' ? 'selected' : '' }}>Title A-Z</option>
                        <option value="title-desc" {{ request('sort') == 'title-desc' ? 'selected' : '' }}>Title Z-A</option>
                        <option value="author-asc" {{ request('sort') == 'author-asc' ? 'selected' : '' }}>Author A-Z</option>
                        <option value="author-desc" {{ request('sort') == 'author-desc' ? 'selected' : '' }}>Author Z-A</option>
                    </select>
                </x-filter-parametr-container>
                <x-filter-parametr-container>
                    <button class="btn btn-outline-primary" type="submit">Filter</button>
                </x-filter-parametr-container>
            </x-filters-container>
        </form>
    </x-filter-container>
    
    <x-alert\>
        
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Description</th>
                <th>Published At</th>
                <th>Uploaded By</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $file)
                <tr>
                    <td>{{ $file->title }}</td>
                    <td>{{ $file->author }}</td>
                    <td>{{ $file->description }}</td>
                    <td>{{ $file->published_at }}</td>
                    <td>{{ $file->user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($files->lastPage() > 1)
        <div class="d-flex justify-content-between align-items-center mt-4">
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item {{ $files->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link page-button" href="{{ $files->previousPageUrl() }}" aria-label="Previous" data-target="{{ $files->currentPage() - 1 }}">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $files->lastPage(); $i++)
                        <li class="page-item {{ $files->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link page-button" href="{{ $files->url($i) }}" data-target="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $files->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link page-button" href="{{ $files->nextPageUrl() }}" aria-label="Next" data-target="{{ $files->currentPage() + 1 }}">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <form action="{{ route('admin.filecontrol') }}" method="GET" class="d-inline-flex ml-3 gap-1">
                <input type="number" class="form-control mr-2" style="width: 100px;" name="page" min="1" max="{{ $files->lastPage() }}" placeholder="Page" aria-label="Page">
                <button class="btn btn-outline-primary" type="submit">Go</button>
            </form>
        </div>
    @endif
</x-files-table-container>
@endsection
