@extends('layouts.base')

@section('page.title')
    Edit Comment
@endsection

@section('content')
    <x-form-container>
        <x-forms-header>
            edit Comment
        </x-forms-header>
            <form action="{{ route('comment.update', ['question_id' => $comment->question_id, 'comment_id' => $comment->id]) }}" method="POST" class="comment-edit-form">
                @csrf
                @method('PUT')

                <x-form-wrapper>
                    <label for="text" class="form-label">Comment Text</label>
                    <textarea name="text" id="text" rows="4" class="form-control" required>{{ $comment->text }}</textarea>
                </x-form-wrapper>

                <button type="submit" class="btn btn-primary">Update Comment</button>
            </form>
    </x-form-container>
@endsection
