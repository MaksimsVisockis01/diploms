<?php

namespace App\Http\Controllers\Files;

use App\Models\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('files.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->check()) {
            // Validate the request
            $validated = $request->validate([
                'title' => ['required', 'string'],
                'author' => ['required', 'string'],
                'description' => ['required', 'string'],
                'file' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
            ]);
        
            // Process the file
            if ($request->hasFile('file')) {
                $file = $request->file('file');
            
                // Check if the file is valid
                if ($file->isValid()) {
                    // Generate a unique filename
                    $fileName = time() . '_' . $file->getClientOriginalName();
                
                    // Store the file in the public disk
                    $file->storeAs('files', $fileName, 'public');
                
                    // Create a new File record in the database
                    File::create([
                        'user_id' => auth()->id(),
                        'title' => $validated['title'],
                        'author' => $validated['author'],
                        'description' => $validated['description'],
                        'file_path' => $fileName, // Store the filename, not the full path
                        'published_at' => now(),
                    ]);
                
                    return redirect()->route('dashboard')->with('status', 'File uploaded successfully!');
                } else {
                    return redirect()->route('dashboard')->with('status', 'Invalid file.');
                }
            }
        }
    
        return redirect()->route('dashboard')->with('status', 'Failed to upload file.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
