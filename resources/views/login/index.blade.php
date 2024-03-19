@extends('layouts.base')

@section('page.title')
    Login page
@endsection

@section('content')

<section class="my-5 border p-4 mx-auto w-50">
    <div>
        <h1>Login</h1>
        <form action="{{ route('login.store') }}" method="POST">
            {{ csrf_field() }}
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
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</section>



@endsection
