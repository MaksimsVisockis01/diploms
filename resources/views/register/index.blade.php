@extends('layouts.base')

@section('page.title', 'Register')

@section('content')
<section class="my-5 border p-4 mx-auto w-50">
    <div>
        <h1>Sign up</h1>
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                @if ($errors->has('email'))
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        @if (session('status'))
            <div class="success">{{ session('status') }}</div>
        @endif
    </div>
</section>
@endsection
