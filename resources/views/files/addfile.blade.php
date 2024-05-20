@extends('layouts.base')

@section('page.title', 'Add File')

@section('content')
<x-form-container>
    <x-mini-forms-header>
        Add File
    </x-mini-forms-header>
    <form action="{{ route('addfile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-form-wrapper>
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </x-form-wrapper>
        <x-form-wrapper>
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </x-form-wrapper>
        <x-form-wrapper>
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </x-form-wrapper>
        <x-form-wrapper>
            <label for="file" class="form-label">File</label>
            <input type="file" class="form-control" id="file" name="file" required accept=".pdf,.doc,.docx">
        </x-form-wrapper>
        <x-form-wrapper>
            <label for="category_id" class="form-label">Categories</label>
            <select name="category_id[]" id="category_id" class="form-select" multiple>
                @if ($categories->isEmpty())
                    <option value="">No categories found</option>
                @else
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                @endif
            </select>
        </x-form-wrapper>
        <x-forms-footer>
            <button type="submit" class="btn btn-primary">Upload File</button>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to files</a>
        </x-forms-footer>
    </form>
</x-form-container>
@endsection
