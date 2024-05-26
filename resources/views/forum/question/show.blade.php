@extends('layouts.base')

@section('page.title', 'Question Details')

@section('content')
<x-form-container>
    <x-forms-header>
        <x-forms-heading>Question Details</x-forms-heading>
    </x-forms-header>
    <x-form-wrapper>
        <x-form-wrapper>
            <span class="text-uppercase fs-5">{{ $question->user->uid }}</span><br>
        </x-form-wrapper>
        <span class="text-capitalize font-weight-bold">{{ $question->title }}</span>
        <p class="content">{{ $question->content }}</p>

        <strong class="published-date-label">Published at:</strong>
        <span class="published-date">
            @if ($question->published_at)
                {{ \Carbon\Carbon::parse($question->published_at)->format('Y-m-d') }}
            @else
                null
            @endif
        </span>
    </x-form-wrapper>

    <a href="{{ route('forum') }}" class="btn btn-primary btn-sm">Back to Forum</a>

    @if(auth()->check() || session('admin_id'))
        @include('forum.comment.form')
    @endif

    @include('forum.comment.list', ['comments' => $comments])
</x-form-container>
@endsection
