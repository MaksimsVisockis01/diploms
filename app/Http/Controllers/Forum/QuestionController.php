<?php

namespace App\Http\Controllers\Forum;

use App\Models\Question;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class QuestionController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('forum.question', compact('categories'));
    }
    public function store(Request $request)
    {

        if(auth()->check()){
            $validated = $request->validate([
                'title' =>['required', 'string','max:50'],
                'content' => ['required', 'string'],
                'category_id' => ['nullable', 'array'],
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
                if(isset($validated['category_id'])) {
                    $question->categories()->attach($validated['category_id']);
                }
                return redirect()->route('forum')->with('status', 'Question created successfully!');
            }
        }else{
            return redirect()->route('forum')->with('status', 'Failed');
        }
    }

    public function show($id)
    {
        $question = Question::findOrFail($id);
        $comments = $question->comments()->paginate(5);

        return view('forum.question.show', compact('question', 'comments'));
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $categories = Category::all();

        $selectedCategories = $question->categories->pluck('id')->toArray();

        return view('forum.question.edit', compact('question', 'categories', 'selectedCategories'));
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required','string','max:50'],
            'content' => ['required','string'],
            'category_id' => ['nullable', 'array'],
        ]);
        
        $question->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        $question->categories()->sync($validated['category_id'] ?? []);

        return redirect()->route('forum')->with('status', 'Question updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        
        $question->categories()->detach();

        $question->delete();

        return redirect()->route('forum')->with('status', 'Question deleted successfully!');
    }
}
