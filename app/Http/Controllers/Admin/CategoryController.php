<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
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
                'title' =>['required', 'string','max:50'],
                'description' => ['required', 'string'],
            ]);
    
            $category = Category::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'published_at' => now(),
            ]);
            return redirect()->route('admin.categories.index')->with('status', 'Category created successfully!');
        }   else{
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
            'title' =>['required', 'string','max:50'],
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
            $category->delete();
            return redirect()->route('admin.categories.index')->with('status', 'Category deleted successfully.');
        } else {
            return redirect()->route('admin.categories.index')->with('error', 'Category not found.');
        } 
    }
}
