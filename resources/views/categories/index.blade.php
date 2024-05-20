@extends('layouts.base')

@section('page.title', 'Categories')

@section('content')
<div class="container">
    <h1 class="my-4">Categories</h1>
    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->title }}</h5>
                        <p class="card-text">{{ $category->description }}</p>
                        <p class="card-text"><small class="text-muted">Total usage: {{ $category->total_usage }}</small></p>
                        <a href="{{ route('category.show', $category->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
