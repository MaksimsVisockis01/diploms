@extends('layouts.base')

@section('content')

@section('page.title')
    Users
@endsection
<x-users-table-container>
    <x-forms-header>
        <x-forms-heading>Users</x-forms-heading>
        <x-search-container action="{{ route('admin.users.usercontrol') }}" method="GET" class="mb-4">
            <input class="form-control mr-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </x-search-container>
    </x-forms-header>
    
    <x-filter-container>
        <form action="{{ route('admin.users.usercontrol') }}" method="GET" class="mb-4">
            @csrf
            <x-filters-container>
                <x-filter-parametr-container>
                    <select class="form-control" name="sort">
                        <option value="">Sort by</option>
                        <option value="name-asc" {{ request('sort') == 'name-asc' ? 'selected' : '' }}>Name A-Z</option>
                        <option value="name-desc" {{ request('sort') == 'name-desc' ? 'selected' : '' }}>Name Z-A</option>
                        <option value="email-asc" {{ request('sort') == 'email-asc' ? 'selected' : '' }}>Email A-Z</option>
                        <option value="email-desc" {{ request('sort') == 'email-desc' ? 'selected' : '' }}>Email Z-A</option>
                    </select>
                </x-filter-parametr-container>
                <x-filter-parametr-container>
                    <select class="form-control" name="active">
                        <option value="">Active Status</option>
                        <option value="1" {{ request('active') == '1' ? 'selected' : '' }}>Is Active</option>
                        <option value="0" {{ request('active') == '0' ? 'selected' : '' }}>Not Active</option>
                    </select>
                </x-filter-parametr-container>
                <x-filter-parametr-container>
                    <select class="form-control" name="teacher">
                        <option value="">Teacher Status</option>
                        <option value="1" {{ request('teacher') == '1' ? 'selected' : '' }}>Is Teacher</option>
                        <option value="0" {{ request('teacher') == '0' ? 'selected' : '' }}>Not Teacher</option>
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
                <th>Name</th>
                <th>Email</th>
                <th>Active</th>
                <th style="width: 1%; white-space: nowrap;">Teacher</th>
                <th style="width: 1%; white-space: nowrap;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->active ? 'Yes' : 'No' }}</td>
                    <td style="white-space: nowrap;">
                        <form action="{{ route('users.toggle-teacher', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-{{ $user->teacher ? 'danger' : 'success' }} w-100">
                                {{ $user->teacher ? 'Remove Teacher' : 'Make Teacher' }}
                            </button>
                        </form>
                    </td>
                    <td style="white-space: nowrap;">
                        <form action="{{ route('users.toggle-active', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-{{ $user->active ? 'danger' : 'success' }} w-100">
                                {{ $user->active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    @if ($users->lastPage() > 1)
        <div class="d-flex justify-content-between align-items-center mt-4">
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link page-button" href="{{ $users->previousPageUrl() }}" aria-label="Previous" data-target="{{ $users->currentPage() - 1 }}">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $users->lastPage(); $i++)
                        <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link page-button" href="{{ $users->url($i) }}" data-target="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link page-button" href="{{ $users->nextPageUrl() }}" aria-label="Next" data-target="{{ $users->currentPage() + 1 }}">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <form action="{{ route('admin.users.usercontrol') }}" method="GET" class="d-inline-flex ml-3 gap-1">
                <input type="number" class="form-control mr-2" style="width: 100px;" name="page" min="1" max="{{ $users->lastPage() }}" placeholder="Page" aria-label="Page">
                <button class="btn btn-outline-primary" type="submit">Go</button>
            </form>
        </div>
    @endif
</x-users-table-container>
@endsection
