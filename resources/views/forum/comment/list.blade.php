<x-alert></x-alert>
@if ($comments->count() > 0)
<x-comment-section>
        <x-cards>
            @foreach ($comments as $comment)
                <x-card>
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
                    

                    @if(auth()->check() && ($comment->user_id == auth()->user()->id || auth()->user()->isAdmin()))
                        <x-settings-button>
                            @if(auth()->check() && $comment->user_id == auth()->user()->id)
                            <li><a href="{{ route('comment.edit', ['question_id' => $comment->question_id, 'comment_id' => $comment->id]) }}" class="dropdown-item">Edit</a></li>
                            <div class=""></div>
                            @endif
                            @if(auth()->check() && (auth()->user()->isAdmin() || $comment->user_id == auth()->id()))
                            <li>
                                    <form action="{{ route('comment.destroy', ['question_id' => $comment->question_id, 'comment_id' => $comment->id]) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item mw-100">Delete</button>
                                    </form>
                            </li>
                            @endif
                        </x-settings-button>
                    @endif

                </x-card>
            @endforeach
        </x-cards>

        @if ($comments->lastPage() > 1)
            <div class="d-flex justify-content-between align-items-center mt-4">
                <nav>
                    <ul class="pagination mb-0">
                        <li class="page-item {{ $comments->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link page-button" href="{{ $comments->previousPageUrl() }}" aria-label="Previous" data-target="{{ $comments->currentPage() - 1 }}">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $comments->lastPage(); $i++)
                            <li class="page-item {{ $comments->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link page-button" href="{{ $comments->url($i) }}" data-target="{{ $i }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item {{ $comments->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link page-button" href="{{ $comments->nextPageUrl() }}" aria-label="Next" data-target="{{ $comments->currentPage() + 1 }}">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <form action="{{ route('question.show', $question->id) }}" method="GET" class="d-inline-flex ml-3 gap-1">
                    <input type="number" class="form-control mr-2" style="width: 100px;" name="page" min="1" max="{{ $comments->lastPage() }}" placeholder="Page" aria-label="Page">
                    <button class="btn btn-outline-primary" type="submit">Go</button>
                </form>
            </div>
        @endif
</x-comment-section>
@endif
