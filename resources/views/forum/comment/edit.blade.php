@extends('layouts.base')

@section('page.title')
    Edit Comment
@endsection

@section('content')
    <div class="comment-edit-container">
        <h2 class="comment-edit-heading">Edit Comment</h2>

        <form action="{{ route('comment.update', ['question_id' => $comment->question_id, 'comment_id' => $comment->id]) }}" method="POST" class="comment-edit-form">
            @csrf
            @method('PUT')

            <div class="form-group comment-edit-group">
                <label for="text" class="comment-edit-label">Comment Text:</label>
                <textarea name="text" id="text" rows="4" class="comment-edit-textarea" required>{{ $comment->text }}</textarea>
            </div>

            <button type="submit" class="comment-edit-submit">Update Comment</button>
        </form>
    </div>
@endsection
