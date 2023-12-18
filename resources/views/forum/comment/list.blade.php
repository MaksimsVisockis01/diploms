@if ($question->comments->count() > 0)
    <div class="comment-list-container">
        <h3>Comments</h3>
        <ul class="comment-list">
            @foreach ($question->comments as $comment)
                <li class="comment-item">
                    <div class="comment-header">
                        <strong class="user-id">User:</strong> {{ $comment->user->uid }}
                    </div>
                    <div class="comment-content">
                        <p class="text">{{ $comment->text }}</p>
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

                    @if(auth()->check())
                    @if(auth()->check() && (auth()->user()->isAdmin()) || $question->user_id == auth()->user()->id)
                        @if(auth()->check() && $question->user_id == auth()->user()->id)
                            <span class="comment-actions">
                                <a href="{{ route('comment.edit', ['question_id' => $comment->question_id, 'comment_id' => $comment->id]) }}" class="edit-comment-link">Edit</a>
                        @endif     
                            
                        @if(auth()->check() && (auth()->user()->isAdmin()) || $question->user_id == auth()->user()->id)
                                <form action="{{ route('comment.destroy', ['question_id' => $comment->question_id, 'comment_id' => $comment->id]) }}" method="POST" class="delete-comment-form" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-comment-button">Delete</button>
                                </form>
                            </span>
                        @endif
                    @endif
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endif
