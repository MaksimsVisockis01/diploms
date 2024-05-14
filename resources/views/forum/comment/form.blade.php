<x-comment-container>
    <x-mini-forms-header>
        Add Comment
    </x-mini-forms-header>

    <form action="{{ route('question.comment.store', ['question_id' => $question->id]) }}" method="POST">
        @csrf
        <x-form-wrapper>
            <input type="hidden" name="question_id" value="{{ $question->id }}">
            <textarea class="form-control" name="text" required></textarea>
            <button type="submit" class="btn btn-primary mt-3">Submit Comment</button>
        </x-form-wrapper>
    </form>
</x-form-container>