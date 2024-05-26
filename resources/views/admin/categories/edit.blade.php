@extends('layouts.base')

@section('page.title', 'Edit Category')

@section('content')
<x-form-75-container>
        <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
            <x-forms-header>
                <x-forms-heading>Edit Category</x-forms-heading>
            </x-forms-header>
            <x-form-wrapper>
                <x-form-wrapper>
                    <label for="title">Title:</label>
                    <input  class="form-control" type="text" name="title" id="title" value="{{ $category->title }}" required>
                </x-form-wrapper>

                <x-form-wrapper>
                    <label for="description">Description:</label>
                    <textarea  class="form-control" name="description" id="description" rows="4" required>{{ $category->description }}</textarea>
                </x-form-wrapper>
                <x-form-wrapper>
                <button type="submit" class="btn btn-primary">Update Category</button>
                </x-form-wrapper>
            </x-form-wrapper>
        </form>

        <a href="{{ route('admin.categories.index') }}" class="back-to-categories-link">Back to Categories</a>
</x-form-75-container>
@endsection