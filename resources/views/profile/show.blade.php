@extends('layouts.base')

@section('page.title', $user->uid . ' Profile')

@section('content')
<x-profile-container>
    <x-profile-header>
        <div class="text-left">
            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('storage/avatars/default-avatar.png') }}" alt="Avatar" class="img-fluid border rounded-circle mb-3" width="150">
            <h3>{{ $user->uid }}</h3>
            <p><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}</p>
        </div>
        <div class="w-50">
            <div class="row">
                <div class="col-4">
                    <h4>{{ $questions->total() }}</h4>
                    <p>Questions</p>
                </div>
                <div class="col-4">
                    <h4>{{ $comments->total() }}</h4>
                    <p>Comments</p>
                </div>
                @if(Auth::user()->isAdmin() || Auth::user()->isTeacher())
                    <div class="col-4">
                        <h4>{{ $files->total() }}</h4>
                        <p>Files</p>
                    </div>
                @endif
            </div>
        </div>
    </x-profile-header>

    @if(Auth::id() == $user->id)
    <div class="text-left mt-3">
        <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary">Edit Profile</a>
    </div>
    @endif
    <div class="mt-5">
        <h4>Recent Questions</h4>
        <ul class="list-group mb-3">
            @foreach($questions->take(3) as $question)
            <li class="list-group-item">
                <a href="{{ route('question.show', $question->id) }}">{{ $question->title }}</a>
                <span class="float-end">{{ $question->created_at->format('d M Y') }}</span>
            </li>
            @endforeach
        </ul>
        {{ $questions->links() }}
    </div>
</x-profile-container>

@endsection
