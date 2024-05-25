@extends('layouts.base')

@section('page.title', 'Edit File')

@section('content')
<x-form-75-container>
    <form action="{{ route('files.update', $file->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-forms-header>
            <x-forms-heading>Edit File</x-forms-heading>
        </x-forms-header>
        <x-form-wrapper>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $file->title }}" required>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" value="{{ $file->author }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required>{{ $file->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="file">File</label>
                <input type="file" name="file" class="form-control">
                <small class="form-text text-muted">Leave blank to keep the current file</small>
            </div>
            <div class="form-group">
                <label for="category_id">Categories</label>
                <select name="category_id[]" class="form-control" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ in_array($category->id, $file->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </x-form-wrapper>
    </form>
</x-form-75-container>
@endsection