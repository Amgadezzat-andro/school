<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function change_password()
    {
        return view('profile.change_password');
    }
    public function update_change_password(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', 'Password Updated');
        } else {
            return redirect()->back()->with('error', 'Icorrect Password');
        }

    }
}