@extends('layouts.base')

@section('page.title')
    Question Details
@endsection

@section('content')
    <div class="question-details-container">
        <h2>Question Details</h2>

        <div class="question-details">
            <strong class="user-id">User:</strong> {{ $question->user->uid }}
            <strong class="title">Title:</strong> {{ $question->title }}
            
            <p class="content">{{ $question->content }}</p>

            <strong class="published-date-label">Published at:</strong>
            <span class="published-date">
                @if ($question->published_at)
                    {{ \Carbon\Carbon::parse($question->published_at)->format('Y-m-d H:i:s') }}
                @else
                    null
                @endif
            </span>
        </div>

        <a href="{{ route('forum') }}" class="back-to-forum-link">Back to Forum</a>

        @if(session('user_id') || session('admin_id'))
            @include('forum.comment.form')
        @endif

        @include('forum.comment.list')

    </div>
@endsection