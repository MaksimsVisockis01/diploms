@extends('layouts.base')

@section('page.title')
    Register
@endsection

@section('content')
<section class="signup-container">
    <h1>Sign up</h1>
    <form action="{{ route('register.store') }}" method="POST">
        {{ csrf_field() }}

        <div class="form-field">
            <input name="name" required>
            <span></span>
            <label>Name</label>
        </div>

        @if ($errors->has('name'))
            <div class="error">{{ $errors->first('name') }}</div>
        @endif

        <div class="form-field">
            <input type="email" name="email" required>
            <span></span>
            <label>Email</label>
        </div>

        @if ($errors->has('email'))
            <div class="error">{{ $errors->first('email') }}</div>
        @endif

        <div class="form-field">
            <input name="uid" required>
            <span></span>
            <label>Username</label>
        </div>

        @if ($errors->has('uid'))
            <div class="error">{{ $errors->first('uid') }}</div>
        @endif

        <div class="form-field">
            <input type="password" name="password" required>
            <span></span>
            <label>Password</label>
        </div>

        @if ($errors->has('password'))
            <div class="error">{{ $errors->first('password') }}</div>
        @endif

        <div class="form-field">
            <input type="password" name="password_confirmation" required>
            <span></span>
            <label>Repeat Password</label>
        </div>

        @if ($errors->has('password_confirmation'))
            <div class="error">{{ $errors->first('password_confirmation') }}</div>
        @endif

        <button type="submit">Register</button>
    </form>

    @if (session('status'))
        <div class="success">{{ session('status') }}</div>
    @endif
</section>
@endsection