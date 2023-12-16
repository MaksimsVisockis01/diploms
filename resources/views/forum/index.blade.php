@extends('layouts.base')

@section('page.title')
    Forum
@endsection

@section('content')
    <div class="forum-container">
        <h2>Forum</h2>
        <p><a href="{{ route('question') }}">Create Question</a></p>

        <ul class="question-list">
            @foreach($questions as $question)
                <li class="question-item">
                    <div class="question-header">
                        <strong class="user-id">User ID:</strong> {{ $question->user->uid }}
                        <strong class="title">Title:</strong> {{ $question->title }}
                    </div>
                    <div class="question-content">
                        <strong class="content-label">Content:</strong>
                        <p class="content">
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
                        <a href="{{ route('question.show', $question->id) }}" class="view-question-link">View Full Question</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
