<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('pages.profile');
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'current_password' => ['required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'min:6', 'confirmed'],
        ]);

        User::where('id', Auth::id())->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($request->filled('new_password')) {
            User::where('id', Auth::id())->update([
                'password' => Hash::make($validated['new_password'])
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
