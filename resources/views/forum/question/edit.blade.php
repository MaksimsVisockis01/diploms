@extends('layouts.base')

@section('page.title')
    Edit Question
@endsection

@section('content')
    <x-form-container>
        <x-forms-header>
            <x-actions-forms-heading>
                Edit Question
            </x-actions-forms-heading>
        </x-forms-header>
            <x-form-wrapper>
                <form action="{{ route('question.update', $question->id) }}" method="POST">
                    @csrf
                    @method('PUT')
        
                    <x-form-wrapper>
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" name="title" id="title" value="{{ $question->title }}" class="form-control" required>
                    </x-form-wrapper>
        
                    <x-form-wrapper>
                        <label for="content" class="form-label">Content:</label>
                        <textarea name="content" id="content" rows="4" class="form-control" required>{{ $question->content }}</textarea>
                    </x-form-wrapper>
        
                    <x-form-wrapper>
                        <select name="category_id[]" id="categories" class="form-select" aria-label="multiple select example" multiple>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $question->categories->contains($category->id) ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </x-form-wrapper>
        
                    <button type="submit" class="btn btn-primary">Update Question</button>
                </form>
            </x-form-wrapper>
        
            <a href="{{ route('forum') }}" class="back-to-forum-link">Back to Forum</a>
        
    </x-form-container>
@endsection