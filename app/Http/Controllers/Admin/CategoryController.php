<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        // Sorting functionality
        if ($request->filled('sort')) {
            switch ($request->input('sort')) {
                case 'title-asc':
                    $query->orderBy('title', 'asc');
                    break;
                case 'title-desc':
                    $query->orderBy('title', 'desc');
                    break;
                case 'description-asc':
                    $query->orderBy('description', 'asc');
                    break;
                case 'description-desc':
                    $query->orderBy('description', 'desc');
                    break;
                case 'date-asc':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'date-desc':
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        }

        // Pagination
        $categories = $query->paginate(10);

        return view('admin.categories.categories', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.category');
    }

    public function store(Request $request)
    {
        if(auth()->check()){
            $validated = $request->validate([
                'title' => ['required', 'string', 'max:50'],
                'description' => ['required', 'string'],
            ]);
    
            $category = Category::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'published_at' => now(),
            ]);
            return redirect()->route('admin.categories.index')->with('status', 'Category created successfully!');
        } else {
            return redirect()->route('admin.categories.index')->with('status', 'Failed');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
        ]);

        $category->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('admin.categories.index')->with('status', 'Category updated successfully!');
    }

    public function destroy(string $id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->files()->detach();
            $category->questions()->detach();

            $category->delete();
            return redirect()->route('admin.categories.index')->with('status', 'Category deleted successfully.');
        } else {
            return redirect()->route('admin.categories.index')->with('error', 'Category not found.');
        }
    }
}
