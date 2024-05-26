<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question_Comment;
use App\Models\Question;

class CommentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $questionId)
    {
        if(auth()->check()){
            $validated = $request->validate([
                'text' => ['required', 'string', 'max:100'],
            ]);

            $comment = Question_Comment::create([
                'user_id' => auth()->id(),
                'question_id' => $questionId,
                'text' => $validated['text'],
                'published_at' => now(),
            ]);

            return redirect()->route('question.show', ['question_id' => $questionId])->with('status', 'Comment added successfully!');
        } else {
            return redirect()->route('question')->with('status', 'Failed');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($questionId, $commentId)
    {
        $comment = Question_Comment::findOrFail($commentId);

        return view('forum.comment.edit', compact('comment'));
    }

    public function update(Request $request, $questionId, $commentId)
    {
        $comment = Question_Comment::findOrFail($commentId);

        $validated = $request->validate([
            'text' => ['required', 'string', 'max:100'],
        ]);

        $comment->update([
            'text' => $validated['text'],
        ]);

        return redirect()->route('question.show', ['question_id' => $questionId])->with('status', 'Comment updated successfully!');
    }

    public function destroy($questionId, $commentId)
    {
        $comment = Question_Comment::findOrFail($commentId);
        $comment->delete();

        return redirect()->route('question.show', ['question_id' => $questionId])->with('status', 'Comment deleted successfully!');
    }
}
