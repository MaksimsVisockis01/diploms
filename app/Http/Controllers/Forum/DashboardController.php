<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $questions = Question::leftJoin('category_question', 'questions.id', '=', 'category_question.question_id')
        ->leftJoin('categories', 'category_question.category_id', '=', 'categories.id')
        ->select('questions.*', 'categories.title as category_title')
        ->get();

        return view('forum.index', compact('questions'));

    }
}
