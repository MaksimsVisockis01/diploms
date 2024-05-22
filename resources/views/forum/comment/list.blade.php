@if ($question->comments->count() > 0)
    <section class="comment-list-container my-3 border p-4 w-100">
        <h3>Comments</h3>
        <ul class="list-group">
            @foreach ($question->comments as $comment)
                <li class="list-group-item">
                    <div class="comment-header">
                        <strong class="user-id">User:</strong> {{ $comment->user->uid }}
                    </div>
                    <div class="comment-content">
                        <p>{{ $comment->text }}</p>
                    </div>
                    <div class="comment-footer">
                        <strong class="published-date-label">Published at:</strong>
                        <span class="published-date">
                            @if ($comment->published_at)
                                {{ \Carbon\Carbon::parse($comment->published_at)->format('Y-m-d') }}
                            @else
                                null
                            @endif
                        </span>
                    </div>

                    @if (auth()->check() && (auth()->user()->isAdmin() || auth()->user()->id == $comment->user_id || auth()->user()->id == $question->user_id))  
                    <div class="d-flex gap-1 mt-2">
                        @if (auth()->user()->id == $comment->user_id)
                            <a href="{{ route('comment.edit', ['question_id' => $comment->question_id, 'comment_id' => $comment->id]) }}" class="btn btn-warning">Edit</a>
                        @endif
                        @if (auth()->check() && (auth()->user()->isAdmin() || auth()->user()->id == $comment->user_id))
                            <form action="{{ route('comment.destroy', ['question_id' => $comment->question_id, 'comment_id' => $comment->id]) }}" method="POST" class="delete-comment-form" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-comment-button">Delete</button>
                            </form>
                        @endif 
                    </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </section>
@endif
