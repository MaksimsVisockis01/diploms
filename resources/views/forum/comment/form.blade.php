<section class="my-3 border p-4 w-100">
    <h3>Add Comment</h3>

    <form action="{{ route('question.comment.store', ['question_id' => $question->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="question_id" value="{{ $question->id }}">
        <textarea class="form-control" name="text" required></textarea>
        <button type="submit" class="btn btn-primary mt-3">Submit Comment</button>
    </form>
</section>