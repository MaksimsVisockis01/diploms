<div class="comment-form-container">
     <h3>Add Comment</h3>
 
     <form action="{{ route('question.comment.store', ['question_id' => $question->id]) }}" method="POST">
         @csrf
         <input type="hidden" name="question_id" value="{{ $question->id }}">
         <textarea name="text" required></textarea>
         <button type="submit">Submit Comment</button>
     </form>
</div>