@extends('layouts.base')

@section('page.title')
    forum
@endsection

@section('content')
    <p>
         make question
    </p>

{{-- create question form --}}
<section class="my-5 border p-4 mx-auto w-50">
    <div class="question-form">
        <h1>Create question</h1>
        <form action="{{ route('question.store') }}" method="POST">
            @csrf
    
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
                @if ($errors->has('title'))
                    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                @endif
            </div>
    
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                @if ($errors->has('content'))
                    <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                @endif
            </div>

            <select name="category_id[]" id="category_id" multiple>
                @if ($categories->isEmpty())
                    <option value="" disabled>No categories found</option>
                @else
                    <option value="">-- Select Categories --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                @endif
            </select>
    
            <button type="submit" class="btn btn-primary">Create Question</button>
        </form>
    
        @if (session('status'))
            <div class="success">{{ session('status') }}</div>
        @endif
    </div>
</section>

{{-- endform --}}

@endsection