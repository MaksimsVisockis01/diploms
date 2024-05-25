<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PendingUser;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortOrder = $request->input('sort', 'desc');

        $query = PendingUser::query();

        if ($search) {
            $query->where('email', 'like', '%' . $search . '%');
        }

        if ($sortOrder) {
            switch ($sortOrder) {
                case 'asc':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'desc':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'a-z':
                    $query->orderBy('email', 'asc');
                    break;
                case 'z-a':
                    $query->orderBy('email', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        }

        $pendingUsers = $query->paginate(10);

        return view('admin.users.index', compact('pendingUsers', 'search', 'sortOrder'));
    }

    public function destroy($id)
    {
        PendingUser::findOrFail($id)->delete();
        return redirect()->route('admin.users.index')->with('status', 'User deleted successfully.');
    }
}
