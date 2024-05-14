@extends('layouts.base')

@section('page.title')
    Forum
@endsection

@section('content')
<x-form-75-container>
        <x-forms-header>
            Forum
        </x-forms-header>

        <x-form-wrapper>
            <a href="{{ route('question') }}" class="btn btn-primary">Create Question</a>
        </x-form-wrapper>

        <x-cards>
            @foreach($questions as $question)
                <x-card>
                        <div class="question-header">
                            <span class="text-uppercase fs-5">{{ $question->user->uid }}</span><br>
                            <span class="text-capitalize font-weight-bold">{{ $question->title }}</span>
                        </div>
                        <div class="question-content">
                            <p class="content-text">
                                {{ strlen($question->content) > 100 ? substr($question->content, 0, 100) . '...' : $question->content }}
                            </p>
                        </div>
                        <div class="question-footer">
                            <strong class="published-date-label">Published at:</strong>
                            <span class="published-date">
                                @if ($question->published_at)
                                    {{ \Carbon\Carbon::parse($question->published_at)->format('Y-m-d') }}
                                @else
                                    null
                                @endif
                            </span>
                            <br>
                            @if ($question->categories->isNotEmpty())
                                <strong>Categories:</strong>
                                <ul>
                                    @foreach ($question->categories as $category)
                                        <li>{{ $category->title }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <strong>Categories:</strong> uncategorised
                            @endif
                            <br>
                            <a href="{{ route('question.show', $question->id) }}" class="btn btn-primary btn-sm">View</a>
                            @if(auth()->check() && $question->user_id == auth()->user()->id)
                                <a href="{{ route('question.edit', $question->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endif
                            @if(auth()->check() && (auth()->user()->isAdmin() || $question->user_id == auth()->id()))
                                <form action="{{ route('question.destroy', $question->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this question?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endif
                        </div>
                </x-card>
            @endforeach
        </x-cards>
</x-form-75-container>
@endsection
