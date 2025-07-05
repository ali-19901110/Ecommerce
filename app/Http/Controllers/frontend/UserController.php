<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.profile.page-account');
    }

    public function update(Request $request)
    {
        // dd(get_class(Auth::user()));
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
            'current_password' => ['nullable', 'current_password'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        // Update name/email
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password if filled
        if ($request->filled('password')) {
            /** @var string $hashedPassword */
            $hashedPassword = Hash::make($request->password);

            $user->password = $hashedPassword;
        }

        $user->save();

        return back()->with('success', 'Account updated successfully.');
    }
}
