<?php

namespace App\Http\Controllers\Files;

use App\Models\File;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $files = File::paginate(5); // Пагинация с 5 элементами на странице
        return view('files.addfile', compact('files', 'categories'));
    }

    public function dashboard(Request $request)
    {
        $categories = Category::all();
        $search = $request->input('search');
        $p_search = $request->input('p_search');
        $categoryFilter = $request->input('category');
        $dateFilter = $request->input('date');
        $sortOrder = $request->input('sort', 'desc');

        $query = File::query();

        if ($search || $p_search) {
            $query->where(function ($query) use ($search, $p_search) {
                $query->where('title', 'like', '%' . ($search ?: $p_search) . '%')
                      ->orWhere('author', 'like', '%' . ($search ?: $p_search) . '%')
                      ->orWhere('description', 'like', '%' . ($search ?: $p_search) . '%')
                      ->orWhere('file_path', 'like', '%' . ($search ?: $p_search) . '%')
                      ->orWhereHas('categories', function ($query) use ($search, $p_search) {
                          $query->where('title', 'like', '%' . ($search ?: $p_search) . '%');
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

        $files = $query->paginate(5); // Пагинация с 5 элементами на странице

        return view('files.dashboard', compact('files', 'categories', 'search', 'p_search'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'file' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
            'category_id' => ['nullable', 'array'],
            'category_id.*' => 'exists:categories,id',
        ]);

        $file = $request->file('file');

        if ($file->isValid()) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('files', $fileName, 'public');

            $newFile = File::create([
                'user_id' => auth()->id(),
                'title' => $validated['title'],
                'author' => $validated['author'],
                'description' => $validated['description'],
                'file_path' => $fileName,
                'published_at' => now(),
            ]);

            if (isset($validated['category_id'])) {
                $newFile->categories()->attach($validated['category_id']);
            }

            return redirect()->route('dashboard')->with('status', 'File uploaded successfully!');
        } else {
            return redirect()->route('dashboard')->with('status', 'Failed to upload file.');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
