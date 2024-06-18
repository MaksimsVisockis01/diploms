@extends('layouts.base')

@section('page.title', 'Edit Profile')

@section('content')
<x-form-container>
    <x-forms-header>
        <x-actions-forms-heading>
            Edit Profile
        </x-actions-forms-heading>
    </x-forms-header>
        <x-form-wrapper>
            <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <x-form-wrapper>
                    <label for="uid" class="form-label">Username</label>
                    <input type="text" name="uid" id="uid" class="form-control @error('uid') is-invalid @enderror" value="{{ old('uid', $user->uid) }}" required>
                    @error('uid')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </x-form-wrapper>
                <x-form-wrapper>
                    <label for="avatar" class="form-label">Avatar</label>
                    <input type="file" name="avatar" id="avatar" class="form-control @error('avatar') is-invalid @enderror">
                    <small class="form-text text-muted">Only JPEG, JPG and PNG files are allowed. Maximum size: 8MB.</small>
                    @error('avatar')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </x-form-wrapper>

                <x-form-wrapper>
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </x-form-wrapper>

                <x-form-wrapper>
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </x-form-wrapper>

                <x-form-wrapper>
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror">
                    @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </x-form-wrapper>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </x-form-wrapper>          
</x-form-container>
@endsection
