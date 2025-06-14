<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('auth.usersControl.control', compact('users'));
    }

    public function toggleBan(User $user)
    {
        if ($user->banned_at) {
            $user->banned_at = null; 
        } else {
            $user->banned_at = now(); 
        }

        $user->save();

        return redirect()->route('admin.users.control')
                         ->with('status', 'Lietotāja statuss atjaunināts.');
    }
}
