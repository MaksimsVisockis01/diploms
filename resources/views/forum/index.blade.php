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
    @else
        <p>All Questions</p>
    @endif
    <x-cards>
        @foreach($questions as $question)
            <x-card href="{{ route('question.show', $question->id) }}">
                <x-settings-button>
                    @if(auth()->check() && $question->user_id == auth()->user()->id)
                    <li><a href="{{ route('question.edit', $question->id) }}" class="dropdown-item">Edit</a></li>
                    <div class="dropdown-divider"></div>
                    @endif
                    @if(auth()->check() && (auth()->user()->isAdmin() || $question->user_id == auth()->id()))
                    <li>
                            <form action="{{ route('question.destroy', $question->id) }}" method="POST" style="display: inline-block;"  onsubmit="return confirm('Are you sure you want to delete this question?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item mw-100">Delete</button>
                            </form>
                    </li>
                    @endif
                </x-settings-button>
                <div class="question-header">
                    <span class="text-uppercase fs-5">{{ $question->user->uid }}</span><br>
                    <span class="text-capitalize font-weight-bold">{{ $question->title }}</span>
                </div>
                <div class="question-content">
                    <p class="content-text">
                        {{ strlen($question->content) > 100 ? substr($question->content, 0, 100) . '...' : $question->content }}
                    </p>
                </div>
                <x-cards-footer>
                    <x-categories-container>
                        @if ($question->categories->isNotEmpty())
                            @foreach ($question->categories as $category)
                                <x-category-container>
                                    {{ $category->title }}
                                </x-category-container> 
                            @endforeach
                        @else
                            <x-none-category-container>
                                uncategorised
                            </x-none-category-container>
                        @endif
                    </x-categories-container>
                    <x-publishing-date>
                        <strong class="published-date-label">Published at:&nbsp;</strong>
                        <span class="published-date">
                            {{ $question->published_at ? \Carbon\Carbon::parse($question->published_at)->format('F j, Y') : 'null' }}
                        </span>
                    </x-publishing-date>
                </x-cards-footer>
            </x-card>
        @endforeach
    </x-cards>
</x-form-75-container>
@endsection
