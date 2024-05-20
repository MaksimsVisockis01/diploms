@extends('layouts.base')

@section('page.title', 'Category')

@section('content')
<div class="container">
    <h1 class="my-4">{{ $category->title }}</h1>
    <p>{{ $category->description }}</p>

    <h3>Questions</h3>
    <ul>
        @foreach($category->questions as $question)
            <li>{{ $question->title }}</li>
        @endforeach
    </ul>

    <h3>Files</h3>
    <ul>
        @foreach($category->files as $file)
            <li>{{ $file->title }}</li>
        @endforeach
    </ul>
</div>
@endsection
