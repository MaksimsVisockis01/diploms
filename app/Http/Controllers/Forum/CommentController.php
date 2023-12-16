<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question_Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $questionId)
    {
        if(auth()->check()){
            $validated = $request->validate([
                'text' =>['required', 'string','max:100'],
            ]);

            $comment = Question_Comment::create([
                'user_id' => auth()->id(),
                'question_id' => $questionId,
                'text' => $validated['text'],
                'published_at' => now(),
            ]);

            return redirect()->route('question.show', ['id' => $questionId])->with('status', 'Comment added successfully!');
        }   else{
            return redirect()->route('question')->with('status', 'Failed');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
