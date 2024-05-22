<?php

namespace App\Http\Controllers\Files;

use App\Models\File;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $files = File::paginate(5);
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

        $files = $query->paginate(5);

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

    public function edit($id)
    {
        $file = File::findOrFail($id);
        $categories = Category::all();
        return view('files.edit', compact('file', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
            'category_id' => ['nullable', 'array'],
            'category_id.*' => 'exists:categories,id',
        ]);

        $file = File::findOrFail($id);

        if ($request->hasFile('file')) {
            // Delete the old file
            Storage::delete('files/' . $file->file_path);

            // Store the new file
            $newFile = $request->file('file');
            $fileName = time() . '_' . $newFile->getClientOriginalName();
            $newFile->storeAs('files', $fileName, 'public');

            $file->file_path = $fileName;
        }

        $file->update([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'description' => $validated['description'],
        ]);

        if (isset($validated['category_id'])) {
            $file->categories()->sync($validated['category_id']);
        }

        return redirect()->route('dashboard')->with('status', 'File updated successfully!');
    }

    public function destroy($id)
    {
        $file = File::findOrFail($id);

        $file->categories()->detach();

        $filePath = 'files/' . $file->file_path;

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        // Delete the file record from the database
        $file->delete();

        return redirect()->route('dashboard')->with('success', 'File deleted successfully');
    }
}