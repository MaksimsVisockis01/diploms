<?php

namespace App\Http\Controllers\Forum;

use App\Models\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        return view('forum.question');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        if(auth()->check()){
            $validated = $request->validate([
                'title' =>['required', 'string','max:50'],
                'content' => ['required', 'string'],
            ]);
    
            $user = auth()->user();

            if ($user) {
                $userId = $user->id;

                $question = Question::create([
                    'user_id' => $userId,
                    'title' => $validated['title'],
                    'content' => $validated['content'],
                    'published_at' => now(),
                ]);
            
                return redirect()->route('forum')->with('status', 'Question created successfully!');
            }
        }   else{
            return redirect()->route('forum')->with('status', 'Failed');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $question = Question::with('user')->findOrFail($id); 

        return view('forum.question.show', compact('question'));
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
