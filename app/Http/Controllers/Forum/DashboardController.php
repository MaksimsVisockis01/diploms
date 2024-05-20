<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $search = $request->input('search');
        $categoryFilter = $request->input('category');
        $dateFilter = $request->input('date');
        $sortOrder = $request->input('sort', 'desc');

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

        if ($categoryFilter) {
            $query->whereHas('categories', function ($query) use ($categoryFilter) {
                $query->where('categories.id', $categoryFilter);
            });
        }

        if ($dateFilter) {
            $query->whereDate('published_at', $dateFilter);
        }
        
        $query->orderBy('published_at', $sortOrder);

        $questions = $query->with('categories', 'user')->get();

        foreach ($questions as $question) {
            $question->comments_count = $question->comments()->count();
        }

        return view('forum.index', compact('questions', 'categories', 'search', 'categoryFilter', 'dateFilter'));
    }
}