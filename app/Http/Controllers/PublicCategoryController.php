<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PublicCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
        }

        if ($request->has('sort')) {
            $sort = $request->get('sort');
            if ($sort == 'title-asc') {
                $query->orderBy('title', 'asc');
            } elseif ($sort == 'title-desc') {
                $query->orderBy('title', 'desc');
            } elseif ($sort == 'usage-asc') {
                $query->withCount(['questions', 'files'])
                      ->orderBy('questions_count', 'asc')
                      ->orderBy('files_count', 'asc');
            } elseif ($sort == 'usage-desc') {
                $query->withCount(['questions', 'files'])
                      ->orderBy('questions_count', 'desc')
                      ->orderBy('files_count', 'desc');
            }
        } else {
            $query->withCount(['questions', 'files']);
        }

        $categories = $query->paginate(12);

        return view('categories.index', compact('categories'));
    }
    public function show(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $search = $request->input('search');
        $type = $request->input('type');
        $sort = $request->input('sort', 'date-desc');

        $questionsQuery = $category->questions()->with('user');
        $filesQuery = $category->files()->with('user');

        if ($search) {
            $questionsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('content', 'like', '%' . $search . '%');
            });

            $filesQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($type === 'question') {
            $files = collect();
            $questions = $questionsQuery->get();
        } elseif ($type === 'file') {
            $questions = collect();
            $files = $filesQuery->get();
        } else {
            $questions = $questionsQuery->get();
            $files = $filesQuery->get();
        }

        $content = $questions->map(function ($question) {
            return ['type' => 'question', 'data' => $question];
        })->merge($files->map(function ($file) {
            return ['type' => 'file', 'data' => $file];
        }));

        if ($sort === 'date-asc') {
            $content = $content->sortBy('data.created_at');
        } elseif ($sort === 'date-desc') {
            $content = $content->sortByDesc('data.created_at');
        } elseif ($sort === 'title-asc') {
            $content = $content->sortBy('data.title');
        } elseif ($sort === 'title-desc') {
            $content = $content->sortByDesc('data.title');
        }

        $perPage = 12;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $content->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedContent = new LengthAwarePaginator($currentItems, $content->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        return view('categories.show', compact('category', 'paginatedContent'));
    }

    public function downloadFile($id)
    {
        $file = File::findOrFail($id);
        $path = 'files/' . $file->file_path;

    if (file_exists(storage_path('app/public/' . $path))) {
        return response()->download(storage_path('app/public/' . $path), $file->file_name);
    } else {
        return redirect()->back()->with('error', 'File not found.');
    }
    }
}
