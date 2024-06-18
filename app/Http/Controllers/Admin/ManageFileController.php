<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\User;

class ManageFileController extends Controller
{
    public function filecontrol(Request $request)
    {
        $query = File::with('user');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('author', 'like', "%{$search}%")
                      ->orWhereHas('user', function ($query) use ($search) {
                          $query->where('name', 'like', "%{$search}%");
                      });
            });
        }

        if ($request->filled('sort')) {
            switch ($request->input('sort')) {
                case 'title-asc':
                    $query->orderBy('title', 'asc');
                    break;
                case 'title-desc':
                    $query->orderBy('title', 'desc');
                    break;
                case 'author-asc':
                    $query->orderBy('author', 'asc');
                    break;
                case 'author-desc':
                    $query->orderBy('author', 'desc');
                    break;
            }
        }

        $files = $query->paginate(10);

        return view('admin.filecontrol', compact('files'));
    }
}
