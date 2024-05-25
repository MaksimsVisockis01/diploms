@extends('layouts.base')

@section('page.title', 'Pending Users')

@section('content')
<x-table-container>
    <x-forms-header>
        <x-forms-heading>Pending Users</x-forms-heading>
        <x-search-container action="{{ route('admin.users.index') }}" method="GET">
            <input class="form-control mr-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </x-search-container>
    </x-forms-header>
    <x-filter-container>
        <form action="{{ route('admin.users.index') }}" method="GET" class="my-4">
            @csrf
            <x-filters-container>
                <x-filter-parametr-container>
                    <select class="form-control" name="sort">
                        <option value="">Sort by</option>
                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Descending</option>
                        <option value="a-z" {{ request('sort') == 'a-z' ? 'selected' : '' }}>A-Z</option>
                        <option value="z-a" {{ request('sort') == 'z-a' ? 'selected' : '' }}>Z-A</option>
                    </select>
                </x-filter-parametr-container>
                <x-filter-parametr-container>
                    <button class="btn btn-outline-primary" type="submit">Filter</button>
                </x-filter-parametr-container>
            </x-filters-container>
        </form>
    </x-filter-container>
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Email</th>
                <th style="width: 1%; white-space: nowrap;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendingUsers as $user)
                <tr>
                    <td>{{ $user->email }}</td>
                    <td style="white-space: nowrap;">
                        <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($pendingUsers->lastPage() > 1)
        <div class="d-flex justify-content-between align-items-center mt-4">
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item {{ $pendingUsers->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link page-button" href="{{ $pendingUsers->previousPageUrl() }}" aria-label="Previous" data-target="{{ $pendingUsers->currentPage() - 1 }}">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $pendingUsers->lastPage(); $i++)
                        <li class="page-item {{ $pendingUsers->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link page-button" href="{{ $pendingUsers->url($i) }}" data-target="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $pendingUsers->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link page-button" href="{{ $pendingUsers->nextPageUrl() }}" aria-label="Next" data-target="{{ $pendingUsers->currentPage() + 1 }}">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <form action="{{ route('admin.users.index') }}" method="GET" class="d-inline-flex ml-3 gap-1">
                <input type="number" class="form-control mr-2" style="width: 100px;" name="page" min="1" max="{{ $pendingUsers->lastPage() }}" placeholder="Page" aria-label="Page">
                <button class="btn btn-outline-primary" type="submit">Go</button>
            </form>
        </div>
    @endif
</x-table-container>
@endsection
