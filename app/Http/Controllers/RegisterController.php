<?php

namespace App\Http\Controllers;

use App\Models\PendingUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pending_users', 'unique:users'],
        ]);

        PendingUser::create([
            'email' => $validated['email'],
        ]);

        return redirect()->route('register')->with('status', 'Registration request sent.');
    }

    public function approve($id)
    {
        $pendingUser = PendingUser::findOrFail($id);

        $token = Str::random(60);
        $url = route('register.complete', ['token' => $token]);

        $pendingUser->update(['token' => $token]);

        Mail::send('emails.registration_link', ['url' => $url], function ($message) use ($pendingUser) {
            $message->to($pendingUser->email);
            $message->subject('Complete your registration');
        });

        return redirect()->route('admin.users.index')->with('status', 'Registration email sent.');
    }

    public function complete($token)
    {
        $pendingUser = PendingUser::where('token', $token)->firstOrFail();

        return view('register.complete', ['email' => $pendingUser->email]);
    }

    public function finalize(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'exists:pending_users'],
            'uid' => ['required', 'string', 'max:30', 'unique:users'],
            'password' => ['required', 'string', 'min:7', 'max:30', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'uid' => $validated['uid'],
            'password' => Hash::make($validated['password']),
        ]);

        PendingUser::where('email', $validated['email'])->delete();

        return redirect()->route('login')->with('status', 'Registration complete. Please log in.');
    }
}
