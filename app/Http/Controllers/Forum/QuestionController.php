<?php

namespace App\Http\Controllers\Forum;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Question;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $search = $request->input('search');

        // Включаем логирование запросов
        DB::enableQueryLog();

        $query = Question::query();

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('content', 'like', '%' . $search . '%')
                      ->orWhereHas('categories', function ($query) use ($search) {
                          $query->where('title', 'like', '%' . $search . '%');
                      });
            });
        }

        // Получаем результаты с категориями и пользователем
        $questions = $query->with('categories', 'user')->get();

        // Логирование SQL-запросов
        $queries = DB::getQueryLog();
        Log::info('SQL Queries: ', ['queries' => $queries]);

        // Логирование результатов поиска
        Log::info('Search Query: ', ['search' => $search, 'questions' => $questions->toArray()]);

        return view('forum.index', compact('questions', 'categories', 'search'));
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

        $question->delete();

        return redirect()->route('forum')->with('status', 'Question deleted successfully!');
    }
}
