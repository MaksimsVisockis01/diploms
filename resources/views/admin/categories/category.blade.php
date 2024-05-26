@extends('layouts.base')

@section('page.title')
    forum
@endsection

@section('content')

<section class="my-5 border p-4 mx-auto w-50">
    <div class="category-form">
        <h1>Create category</h1>
        <form action="{{ route('admin.category.store') }}" method="POST">
            @csrf
    
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
                @if ($errors->has('title'))
                    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                @endif
            </div>
    
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                @if ($errors->has('description'))
                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                @endif
            </div>
    
            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
    
        @if (session('status'))
            <div class="success">{{ session('status') }}</div>
        @endif
    </div>
</section>

{{-- endform --}}

@endsection