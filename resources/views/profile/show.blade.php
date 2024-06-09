@extends('layouts.base')

@section('page.title', $user->uid . ' Profile')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header text-center">
                    <h3>{{ $user->uid }}'s Profile</h3>
                </div>
                <div class="card-body text-center">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/default-avatar.png') }}" alt="Avatar" class="img-fluid rounded-circle mb-3" width="150">
                    <p><strong>Username:</strong> {{ $user->uid }}</p>
                    <p><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}</p>
                    <p><strong>Questions asked:</strong> {{ $questions->total() }}</p>
                    <p><strong>Files uploaded:</strong> {{ $files->total() }}</p>
                    <p><strong>Comments made:</strong> {{ $comments->total() }}</p>
                </div>
                @if(Auth::id() == $user->id)
                <div class="card-footer text-center">
                    <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary">Edit Profile</a>
                </div>
                @endif
            </div>

            <div class="mt-5">
                <h4>Questions</h4>
                <ul class="list-group mb-3">
                    @foreach($questions as $question)
                    <li class="list-group-item">
                        <a href="{{ route('questions.show', $question->id) }}">{{ $question->title }}</a>
                        <span class="float-end">{{ $question->created_at->format('d M Y') }}</span>
                    </li>
                    @endforeach
                </ul>
                {{ $questions->links() }}

                <h4>Comments</h4>
                <ul class="list-group mb-3">
                    @foreach($comments as $comment)
                    <li class="list-group-item">
                        {{ $comment->body }}
                        <span class="float-end">{{ $comment->created_at->format('d M Y') }}</span>
                    </li>
                    @endforeach
                </ul>
                {{ $comments->links() }}

                <h4>Files</h4>
                <ul class="list-group">
                    @foreach($files as $file)
                    <li class="list-group-item">
                        <a href="{{ asset('storage/' . $file->path) }}" download>{{ $file->name }}</a>
                        <span class="float-end">{{ $file->created_at->format('d M Y') }}</span>
                    </li>
                    @endforeach
                </ul>
                {{ $files->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
