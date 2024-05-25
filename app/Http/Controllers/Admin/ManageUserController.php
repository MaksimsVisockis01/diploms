<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ManageUserController extends Controller
{
    public function usercontrol()
    {
        $users = User::where('admin', false)->get();
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
