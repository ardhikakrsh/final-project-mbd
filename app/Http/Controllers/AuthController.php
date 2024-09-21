<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\RolesType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    public function signIn()
    {
        return view('GO.auth.login');
    }

    public function signInStore()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if (Auth::attempt($attributes)) {
            session()->regenerate();
            $userRole = Auth::user()->role;

            if ($userRole  == RolesType::ADMIN) {
                return redirect()->intended(route('admin.dashboard'))->with(['success' => 'You are logged in.']);;
            } elseif ($userRole  == RolesType::OWNER) {
                return redirect()->intended(route('owner.dashboard'))->with(['success' => 'You are logged in.']);;
            } else {
                return redirect()->intended('/')->with(['success' => 'You are logged in.']);;
            }
        } else {
            return back()->withErrors(['email' => 'Email or password invalid.']);
        }
    }

    public function logout()
    {

        Auth::logout();

        return redirect('/login')->with(['success' => 'You\'ve been logged out.']);
    }
    public function signUp()
    {
        return view('GO.auth.register');
    }

    public function signUpStore()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'agreement' => ['accepted']
        ]);
        $attributes['password'] = bcrypt($attributes['password']);

        if(User::create($attributes)){
            return redirect('/login')->with(['success' => 'You are registered.']);
        }else{
            return back()->withErrors(['msg' => 'Something went wrong.']);
        }
    }

    public function forgot()
    {
        return view('GO.auth.forgotPassword');
    }

    public function sendEmail(Request $request)
    {

        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
        
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPass($token)
    {
        return view('GO.auth.resetPassword', ['token' => $token]);
    }

    public function changePassword(Request $request)
    {

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect('/login')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
