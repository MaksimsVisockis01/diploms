@extends('layouts.base')

@section('page.title', 'Register')

@section('content')
<section class="my-5 border p-4 mx-auto w-50">
    <div>
        <x-forms-heading>
            Sign up
        </x-forms-heading>
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                @if ($errors->has('email'))
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
        @if (session('status'))
            <div class="success">{{ session('status') }}</div>
        @endif
    </div>
</section>
@endsection
