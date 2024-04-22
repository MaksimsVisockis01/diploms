@extends('layouts.base')

@section('page.title')
    Edit Question
@endsection

@section('content')
    <div class="edit-question-container">
        <h2>Edit Question</h2>

        <form action="{{ route('question.update', $question->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="{{ $question->title }}" required>
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" id="content" rows="4" required>{{ $question->content }}</textarea>
            </div>

            <div class="form-group">
                <label for="categories">Categories:</label>
                <select name="category_id[]" id="categories" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $question->categories->contains($category->id) ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit">Update Question</button>
        </form>

        <a href="{{ route('forum') }}" class="back-to-forum-link">Back to Forum</a>
    </div>
@endsection