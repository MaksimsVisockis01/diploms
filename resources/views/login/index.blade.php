@extends('layouts.base')

@section('page.title')
    Login page
@endsection

@section('content')

<x-form-container>
    <x-forms-heading>
        Login
    </x-forms-heading>
    <form action="{{ route('login.store') }}" method="POST">
        {{ csrf_field() }}
        <x-form-wrapper>
            <label for="uid" class="form-label">Username</label>
            <input type="text" class="form-control" id="uid" name="uid" required>
            @if ($errors->has('uid'))
                <div class="invalid-feedback">{{ $errors->first('uid') }}</div>
            @endif
        </x-form-wrapper>
        <x-form-wrapper>
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @if ($errors->has('password'))
                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
            @endif
        </x-form-wrapper>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</x-form-container>




@endsection
