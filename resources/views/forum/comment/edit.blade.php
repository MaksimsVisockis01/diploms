@extends('layouts.base')

@section('page.title')
    Edit Comment
@endsection

@section('content')
    <div class="comment-edit-container">
        <h2>Edit Comment</h2>

        <form action="{{ route('comment.update', ['question_id' => $comment->question_id, 'comment_id' => $comment->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="text">Comment Text:</label>
                <textarea name="text" id="text" rows="4" required>{{ $comment->text }}</textarea>
            </div>

            <button type="submit">Update Comment</button>
        </form>
    </div>
@endsection