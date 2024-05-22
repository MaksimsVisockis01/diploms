<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function myProfile()
    {
        $user = Auth::user();
        $questionsCount = $user->questions()->count();
        $filesCount = $user->files()->count();
        $commentsCount = $user->comments()->count();

        return view('profile.show', compact('user', 'questionsCount', 'filesCount', 'commentsCount'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $questionsCount = $user->questions()->count();
        $filesCount = $user->files()->count();
        $commentsCount = $user->comments()->count();

        return view('profile.show', compact('user', 'questionsCount', 'filesCount', 'commentsCount'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() !== $user->id) {
            abort(403);
        }

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() !== $user->id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'uid' => 'required|string|max:255|unique:users,uid,' . $user->id,
            'avatar' => 'nullable|image|max:8192', // max 8MB
            'password' => 'nullable|string|min:8|confirmed',
            'current_password' => 'required_with:password',
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        if ($request->filled('password')) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = Hash::make($request->input('password'));
            } else {
                return back()->withErrors(['current_password' => 'The current password is incorrect']);
            }
        }

        $user->name = $request->input('name');
        $user->uid = $request->input('uid');
        $user->save();

        return redirect()->route('profile.show', $user->id)->with('status', 'Profile updated successfully!');
    }
}
