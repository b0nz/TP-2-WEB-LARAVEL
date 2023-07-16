<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUsers()
    {
        if (Auth::check()) {
            $users = User::all();
            return view('dashboard.users', compact('users'));
        } else {
            return redirect()->route('showLoginForm');
        }
    }

    public function showUserResetPasswordForm(User $user)
    {
        if (Auth::check()) {
            // get user by id
            $user = User::get()->where('id', $user->id)->first();
            return view('dashboard.user_reset_password', compact('user'));
        } else {
            return redirect()->route('showLoginForm');
        }
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'string', 'confirmed', 'min:10', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('dashboard.users')->with('success', 'Reset password success.');
    }
}
