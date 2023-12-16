@extends('layouts.base')

@section('page.title')
    forum
@endsection

@section('content')
    {{-- @if (auth()->check())
        <p>Hello, {{ auth()->user()->name }}</p>
    @endif --}}
    <p>
         make question
    </p>

    {{-- form --}}
    <section class="question-form">
        <h1>Create question</h1>
        <form action="{{ route('question.store') }}" method="POST">
            @csrf
    
            <div class="txt_field">
                <input name="title" required>
                <span></span>
                <label>Title</label>
            </div>
            @if ($errors->has('title'))
                <div class="error">{{ $errors->first('title') }}</div>
            @endif
    
            <div class="txt_field">
                <textarea name="content" required></textarea>
                <span></span>
                <label>Content</label>
            </div>
            @if ($errors->has('content'))
                <div class="error">{{ $errors->first('content') }}</div>
            @endif
    
    
            <button type="submit">Create Question</button>
        </form>
    
        @if (session('status'))
            <div class="success">{{ session('status') }}</div>
        @endif
    </section>
    {{-- endform --}}

@endsection