@extends('layouts.base')

@section('page.title', $user->name . ' Profile')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $user->name }}'s Profile</h3>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/default-avatar.png') }}" alt="Avatar" class="img-fluid rounded-circle" width="150">
                    </div>
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Username:</strong> {{ $user->uid }}</p>
                    <p><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}</p>
                    <p><strong>Questions asked:</strong> {{ $questionsCount }}</p>
                    <p><strong>Files uploaded:</strong> {{ $filesCount }}</p>
                    <p><strong>Comments made:</strong> {{ $commentsCount }}</p>
                </div>
                @if(Auth::id() == $user->id)
                <div class="card-footer text-center">
                    <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary">Edit Profile</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
