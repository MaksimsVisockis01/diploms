<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchPages(Request $request)
    {
        $viewsPath = resource_path('views');
        $files = File::allFiles($viewsPath);
        $pages = [];

        foreach ($files as $file) {
            $path = $file->getRelativePathname();
            $pageName = pathinfo($path, PATHINFO_FILENAME); 
            $pages[] = ['path' => $path, 'title' => $pageName];
        }

        return response()->json($pages);
        
    }
    // public function searchPages(Request $request)
    // {
    //     $viewsPath = resource_path('views');
    //     $files = File::allFiles($viewsPath);
    //     $pages = [];
    
    //     foreach ($files as $file) {
    //         $path = $file->getRelativePathname();
    //         $pageName = pathinfo($path, PATHINFO_FILENAME);
    //         $pages[] = ['path' => $path, 'title' => $pageName, 'folder' => dirname($path)];
    //     }
    
    //     return response()->json($pages);
    // }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
