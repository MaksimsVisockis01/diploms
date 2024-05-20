<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class PublicCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount(['questions', 'files'])->get();

        foreach ($categories as $category) {
            $category->total_usage = $category->questions_count + $category->files_count;
        }

        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::with('questions', 'files')->findOrFail($id);
        return view('categories.show', compact('category'));
    }
}
