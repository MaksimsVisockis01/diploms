@extends('layouts.base')

@section('page.title')
    forum
@endsection

@section('content')
    <p>
         make question
    </p>

{{-- create question form --}}
<x-form-container>
    <x-forms-header>
        Create question
    </x-forms-header>
        <form action="{{ route('question.store') }}" method="POST">
            @csrf
    
            <x-form-wrapper>
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
                @if ($errors->has('title'))
                    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                @endif
            </x-form-wrapper>
    
            <x-form-wrapper>
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                @if ($errors->has('content'))
                    <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                @endif
            </x-form-wrapper>

            <x-form-wrapper>
                <select name="category_id[]" id="category_id" class="form-select" aria-label="multiple select example" multiple>
                    @if ($categories->isEmpty())
                        <option value="">No categories found</option>
                    @else
                        <option value="">-- Select Categories --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                    @endif
                </select>
            </x-form-wrapper>
            <button type="submit" class="btn btn-primary">Create Question</button>
        </form>
    
        @if (session('status'))
            <div class="success">{{ session('status') }}</div>
        @endif
</x-form-container>
{{-- endform --}}

@endsection