<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin/login');
    }

    public function loginSubmit(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = $request->user();
        $user->ultimo_acesso = now();
        $user->save();

        return redirect()->intended(route('menu'));
    }

    public function forgot_password()
    {
        return view('admin/forgot_password');
    }

    public function forgot_password_submit(ForgotPasswordRequest $request)
    {
        Password::sendResetLink($request->only('email'));

        return redirect()->route('send_confirm');
    }

    public function send_confirm()
    {
        return view('admin/send_confirm');
    }

    public function update_password(Request $request, string $token)
    {
        return view('admin/update_password', [
            'email' => $request->query('email'),
            'token' => $token,
        ]);
    }

    public function update_password_submit(ResetPasswordRequest $request, $token)
    {
        $status = Password::reset(
            [
                'email' => $request->input('email'),
                'password' => $request->input('senha'),
                'password_confirmation' => $request->input('confirmaSenha'),
                'token' => $token,
            ],
            function ($user, string $password) {
                $user->senha = Hash::make($password);
                $user->save();
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            return back()->withInput($request->only('email'))->withErrors([
                'email' => __($status),
            ]);
        }

        return redirect()->route('login')->with('success', 'Senha atualizada com sucesso');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
