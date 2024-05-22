@extends('layouts.base')

@section('page.title', 'Forum')

@section('content')
<x-form-75-container>
    <x-forms-header>
        <x-forms-heading>Forum</x-forms-heading>
        <x-search-container action="{{ route('forum') }}" method="GET">
            <input class="form-control mr-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </x-search-container>
    </x-forms-header>

    <x-filter-container>
        <form action="{{ route('forum') }}" method="GET">
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
        <a href="{{ route('question') }}" class="btn btn-primary">Create Question</a>
    </x-form-wrapper>
    @if(request('search'))
        <p>Search results for: "{{ request('search') }}"</p>
    @endif
    <x-cards id="forum-container">
        @foreach($questions as $question)
            <x-card class="card-group" data-group="{{ $loop->index + 1 }}">
                @if(auth()->check() && $question->user_id == auth()->user()->id || $question->user_id == auth()->id())
                    <x-settings-button>
                        @if(auth()->check() && $question->user_id == auth()->user()->id)
                        <li><a href="{{ route('question.edit', $question->id) }}" class="dropdown-item">Edit</a></li>
                        <div class="dropdown-divider"></div>
                        @endif
                        @if(auth()->check() && (auth()->user()->isAdmin() || $question->user_id == auth()->id()))
                        <li>
                                <form action="{{ route('question.destroy', $question->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this question?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item mw-100">Delete</button>
                                </form>
                        </li>
                        @endif
                    </x-settings-button>
                @endif
                <x-cards-header>
                </x-cards-header>
                <x-cards-content>
                    <a href="{{ route('question.show', $question->id) }}"><span class="text-capitalize font-weight-bold">{{ $question->title }}</span></a> 
                    <p class="content-text">
                        {{ strlen($question->content) > 100 ? substr($question->content, 0, 100) . '...' : $question->content }}
                    </p>
                </x-cards-content>
                <x-cards-footer>
                    <x-categories-container>
                        @if ($question->categories->isNotEmpty())
                            @foreach ($question->categories as $category)
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
                    
                    <x-publishing-date :uid="$question->user->uid" :userId="$question->user->id" :published_at="$question->published_at"/>
                    <p class="mb-0">Comments: {{ $question->comments_count }}</p>
                </x-cards-footer>
            </x-card>
        @endforeach
    </x-cards>

    @if ($questions->lastPage() > 1)
        <div class="d-flex justify-content-between align-items-center mt-4">
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item {{ $questions->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link page-button" href="{{ $questions->previousPageUrl() }}" aria-label="Previous" data-target="{{ $questions->currentPage() - 1 }}">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $questions->lastPage(); $i++)
                        <li class="page-item {{ $questions->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link page-button" href="{{ $questions->url($i) }}" data-target="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $questions->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link page-button" href="{{ $questions->nextPageUrl() }}" aria-label="Next" data-target="{{ $questions->currentPage() + 1 }}">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <form action="{{ route('forum') }}" method="GET" class="d-inline-flex ml-3 gap-1">
                <input type="number" class="form-control mr-2" style="width: 100px;" name="page" min="1" max="{{ $questions->lastPage() }}" placeholder="Page" aria-label="Page">
                <button class="btn btn-outline-primary" type="submit">Go</button>
            </form>
        </div>
    @endif
</x-form-75-container>
@endsection
