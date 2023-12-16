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
                </li>
            @endforeach
        </ul>
    </div>
@endif