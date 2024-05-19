@extends('layouts.base')

@section('page.title')
    Edit Category
@endsection

@section('content')
<x-form-container>
    <x-forms-header>
        <x-forms-heading>
            Edit Category
        </x-forms-heading>
    </x-forms-header>
    <div class="edit-category-container">
        <h2>Edit Category</h2>

        <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="{{ $category->title }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" rows="4" required>{{ $category->description }}</textarea>
            </div>

            <button type="submit">Update Category</button>
        </form>

        <a href="{{ route('admin.categories.index') }}" class="back-to-categories-link">Back to Categories</a>
    </div>
</x-form-container>
@endsection