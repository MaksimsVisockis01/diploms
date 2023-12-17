@extends('layouts.base')

@section('page.title')
    Login page
@endsection

@section('content')

<section class="custom-login-section">
    <h1>Login</h1>
    <form action="{{ route('login.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="custom-form-field">
            <input type="text" name="uid" required>
            <span></span>
            <label>Username</label>
        </div>
        @if ($errors->has('uid'))
            <div class="custom-error">{{ $errors->first('uid') }}</div>
        @endif
        <div class="custom-form-field">
            <input type="password" name="password" required>
            <span></span>
            <label>Password</label>
        </div>
        @if ($errors->has('password'))
            <div class="custom-error">{{ $errors->first('password') }}</div>
        @endif
        <button type="submit">Login</button>
    </form>
</section>
@endsection
