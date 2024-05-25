<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PendingUser;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $users = User::where('admin', false)->get(); // Fetch non-admin users
    //     return view('admin.users.users', compact('users'));
    // }
    public function index()
    {
        $pendingUsers = PendingUser::all();
        return view('admin.users.index', compact('pendingUsers'));
    }

    // public function destroy($id)
    // {
    //     $user = User::find($id);
    //     if ($user) {
    //         $user->delete();
    //         return redirect()->route('admin.users.index')->with('status', 'User deleted successfully.');
    //     } else {
    //         return redirect()->route('admin.users.index')->with('error', 'User not found.');
    //     }
    // }
    public function destroy($id)
    {
        PendingUser::findOrFail($id)->delete();
        return redirect()->route('admin.users.index')->with('status', 'User deleted successfully.');
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
}
