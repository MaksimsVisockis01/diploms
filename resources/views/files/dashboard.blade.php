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
        <div class="pagination-buttons d-flex justify-content-center gap-1">
            @if ($files->count() > 0)
                <button class="btn btn-primary page-button" data-target="1">1</button>
                @if ($files->count() > 5)
                    <span class="dots">...</span>
                    @for ($i = 2; $i <= ceil($files->count() / 5); $i++)
                        <button class="btn btn-primary page-button" data-target="{{ $i }}">{{ $i }}</button>
                    @endfor
                    <!-- <form action="{{ route('dashboard') }}" method="GET">
                        <button class="btn btn-primary page-button" type="submit" data-target="{{ $i }}" data-search="{{ $p_search }}"> ehfeq</button>
                    </form> -->

                    <!-- <x-search-container action="{{ route('dashboard') }}" method="GET">
                        <input class="form-control mr-2" type="search" name="p_search" placeholder="Search" aria-label="Search page " value="{{ $p_search }}">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </x-search-container> -->

                @endif
            @endif
        </div>
        @if ($files->count() > 0)
            @foreach ($files->chunk(5) as $index => $fileChunk)
                <div class="card-group" data-group="{{ $index + 1 }}" style="display: {{ $index === 0 ? 'block' : 'none' }};">
                    @foreach ($fileChunk as $file)
                        <x-card>
                            <x-settings-button>
                                @if(auth()->check() && $file->user_id == auth()->user()->id)
                                    <li><a href="{{ route('/', $file->id) }}" class="dropdown-item">Edit</a></li>
                                    <div class="dropdown-divider"></div>
                                @endif
                                @if(auth()->check() && (auth()->user()->isAdmin() || $file->user_id == auth()->id()))
                                <li>
                                    <form action="{{ route('/', $file->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this question?');">
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
                </div>
            @endforeach
        @else
            <p class="text-muted">No files found.</p>
        @endif
    </x-cards>
</x-form-75-container>
@endsection

