@extends('layouts.base')

@section('page.title')
    Question Details
@endsection

@section('content')
<section class="d-flex flex-column align-items-start my-5 border p-4 mx-auto w-50">
    <h2>Question Details</h2>

    <div>
        <span class="text-uppercase fs-5">{{ $question->user->uid }}</span><br>
        <span class="text-capitalize font-weight-bold">{{ $question->title }}</span>
        
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

    <a href="{{ route('forum') }}" class="btn btn-primary btn-sm">Back to Forum</a>

    @if(session('user_id') || session('admin_id'))
        @include('forum.comment.form')
    @endif

    @include('forum.comment.list')
</section>
@endsection