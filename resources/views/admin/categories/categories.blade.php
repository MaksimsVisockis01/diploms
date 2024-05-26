@extends('layouts.base')

@section('page.title')
    Categories Control
@endsection

@section('content')
<x-table-container>
        <x-forms-header>
            <x-forms-heading>Category Management</x-forms-heading>
            <x-search-container action="{{ route('admin.categories.index') }}" method="GET" class="mb-4">
                <input class="form-control mr-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </x-search-container>
        </x-forms-header>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <p><a href="{{ route('admin.category.create') }}" class="btn btn-primary">Create category</a></p>

        <x-filter-container>
            <form action="{{ route('admin.categories.index') }}" method="GET" class="mb-4">
                @csrf
                <x-filters-container>
                    <x-filter-parametr-container>
                        <select class="form-control" name="sort">
                            <option value="">Sort by</option>
                            <option value="title-asc" {{ request('sort') == 'title-asc' ? 'selected' : '' }}>Title A-Z</option>
                            <option value="title-desc" {{ request('sort') == 'title-desc' ? 'selected' : '' }}>Title Z-A</option>
                            <option value="description-asc" {{ request('sort') == 'description-asc' ? 'selected' : '' }}>Description A-Z</option>
                            <option value="description-desc" {{ request('sort') == 'description-desc' ? 'selected' : '' }}>Description Z-A</option>
                            <option value="date-asc" {{ request('sort') == 'date-asc' ? 'selected' : '' }}>Date Ascending</option>
                            <option value="date-desc" {{ request('sort') == 'date-desc' ? 'selected' : '' }}>Date Descending</option>
                        </select>
                    </x-filter-parametr-container>
                    <x-filter-parametr-container>
                        <button class="btn btn-outline-primary" type="submit">Filter</button>
                    </x-filter-parametr-container>
                </x-filters-container>
            </form>
        </x-filter-container>

        @if ($categories->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th style="width: 1%; white-space: nowrap;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->description }}</td>
                            <td class="d-flex gap-2" style="white-space: nowrap;">
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                                <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-primary">Edit Category</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif


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

                <form action="{{ route('admin.categories.index') }}" method="GET" class="d-inline-flex ml-3 gap-1">
                    <input type="number" class="form-control mr-2" style="width: 100px;" name="page" min="1" max="{{ $categories->lastPage() }}" placeholder="Page" aria-label="Page">
                    <button class="btn btn-outline-primary" type="submit">Go</button>
                </form>
            </div>
        @endif
</x-table-container>
@endsection
