<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

$random = Str::random(40);

class AuthController extends Controller
{
    public function login()
    {
        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');

            } else if (Auth::user()->user_type == 2) {
                return redirect('teacher/dashboard');

            } else if (Auth::user()->user_type == 3) {
                return redirect('student/dashboard');

            } else if (Auth::user()->user_type == 4) {
                return redirect('parent/dashboard');
            }
        } else {
            return view('auth.login');
        }
    }
    public function AuthLogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {

            if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');

            } else if (Auth::user()->user_type == 2) {
                return redirect('teacher/dashboard');

            } else if (Auth::user()->user_type == 3) {
                return redirect('student/dashboard');

            } else if (Auth::user()->user_type == 4) {
                return redirect('parent/dashboard');

            }

        } else {
            return redirect()->back()->with('error', 'Incorrect Username Or Password');
        }


    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');

    }

    public function forgetpassword()
    {
        return view('auth.forget');
    }
    public function PostForgetPassword(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if (!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success', 'Reset-Pass-Email has been Sent');

        } else {
            return redirect()->back()->with('error', 'Email Not Found');
        }

    }
    public function reset($token)
    {
        $user = User::getTokenSingle($token);
        if (!empty($user)) {
            $data['user'] = $user;
            return view('auth.reset', $data);
        } else {
            abort(404);
        }
    }

    public function PostReset($token, Request $request)
    {
        if ($request->newPassword == $request->confirmPassword) {
            $user = User::getTokenSingle($token);

            $user->password = Hash::make($request->newPassword);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect('login')->with('success', 'Password Successfully Reset');

        } else {
            return redirect()->back()->with('error', 'Passwords do not macth');
        }

    }


    
}
