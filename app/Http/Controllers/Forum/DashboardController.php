<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    // public function index()
    // {

    //     $questions = Question::leftJoin('category_question', 'questions.id', '=', 'category_question.question_id')
    //     ->leftJoin('categories', 'category_question.category_id', '=', 'categories.id')
    //     ->select('questions.*', 'categories.title as category_title')
    //     ->get();

    //     return view('forum.index', compact('questions'));

    // }
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
}
