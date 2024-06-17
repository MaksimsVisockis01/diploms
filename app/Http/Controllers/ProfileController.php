<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Question;
use App\Models\Question_Comment;
use App\Models\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function myProfile()
    {
        $user = Auth::user();
        $questions = $user->questions()->paginate(10);
        $comments = $user->comments()->paginate(10);
        $files = $user->files()->paginate(10);

        return view('profile.show', compact('user', 'questions', 'comments', 'files'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $questions = $user->questions()->paginate(10);
        $comments = $user->comments()->paginate(10);
        $files = $user->files()->paginate(10);

        return view('profile.show', compact('user', 'questions', 'comments', 'files'));
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
            'uid' => 'required|string|max:255|unique:users,uid,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:8192',
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

        $user->uid = $request->input('uid');
        $user->save();

        return redirect()->route('profile.show', $user->id)->with('status', 'Profile updated successfully!');
    }
}
