<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ManageUserController extends Controller
{
    public function usercontrol(Request $request)
    {
        $query = User::where('admin', false);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by active status
        if ($request->filled('active')) {
            $active = $request->input('active');
            $query->where('active', $active);
        }

        // Filter by teacher status
        if ($request->filled('teacher')) {
            $teacher = $request->input('teacher');
            $query->where('teacher', $teacher);
        }

        // Sorting functionality
        if ($request->filled('sort')) {
            switch ($request->input('sort')) {
                case 'name-asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name-desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'email-asc':
                    $query->orderBy('email', 'asc');
                    break;
                case 'email-desc':
                    $query->orderBy('email', 'desc');
                    break;
            }
        }

        // Pagination
        $users = $query->paginate(10);

        return view('admin.users.usercontrol', compact('users'));
    }

    public function toggleTeacher(User $user)
    {
        $user->teacher = !$user->teacher;
        $user->save();

        return redirect()->route('admin.users.usercontrol')->with('status', 'User teacher role toggled successfully.');
    }

    public function toggleActive(User $user)
    {
        $user->active = !$user->active;
        $user->save();

        return redirect()->route('admin.users.usercontrol')->with('status', 'User activity toggled successfully.');
    }
}
