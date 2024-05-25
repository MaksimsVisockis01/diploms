@extends('layouts.base')

@section('page.title', 'Complete Registration')

@section('content')
<section class="my-5 border p-4 mx-auto w-50">
    <div>
        <h1>Complete your registration</h1>
        <form action="{{ route('register.finalize') }}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
                @if ($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="uid" class="form-label">Username</label>
                <input type="text" class="form-control" id="uid" name="uid" required>
                @if ($errors->has('uid'))
                    <div class="invalid-feedback">{{ $errors->first('uid') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                @if ($errors->has('password'))
                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                @if ($errors->has('password_confirmation'))
                    <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Complete Registration</button>
        </form>
    </div>
</section>
@endsection
