@extends('layouts.base')

@section('page.title')
    Forum
@endsection

@section('content')
<section class="my-5 border p-4 mx-auto w-50">
    <div class="forum-container">
        <h2 class="mb-4">Forum</h2>
        <p><a href="{{ route('question') }}" class="btn btn-primary">Create Question</a></p>

        <ul class="question-list">
            @foreach($questions as $question)
                <li class="question-item">
                    <div class="question-header">
                        <span class="text-uppercase fs-5">{{ $question->user->uid }}</span><br>
                        <span class="text-capitalize font-weight-bold">{{ $question->title }}</span>
                    </div>
                    <div class="question-content">
                        <p class="content">
                            {{ strlen($question->content) > 100 ? substr($question->content, 0, 100) . '...' : $question->content }}
                        </p>
                    </div>
                    <div class="question-footer">
                        <strong class="published-date-label">Published at:</strong>
                        <span class="published-date">
                            @if ($question->published_at)
                                {{ \Carbon\Carbon::parse($question->published_at)->format('Y-m-d') }}
                            @else
                                null
                            @endif
                        </span>
                        <br>
                        <a href="{{ route('question.show', $question->id) }}" class="btn btn-primary btn-sm">View Full Question</a>
                    
                        @if(auth()->check() && $question->user_id == auth()->user()->id)
                            <a href="{{ route('question.edit', $question->id) }}" class="btn btn-warning btn-sm">Edit Question</a>
                        @endif

                        @if(auth()->check() && (auth()->user()->isAdmin() || $question->user_id == auth()->id()))
                            <form action="{{ route('question.destroy', $question->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this question?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete Question</button>
                            </form>
                        @endif
                        
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</section>
@endsection