<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;

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

    public function forgot_password_submit(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
            ],
            [
                'email.required' => 'O email é obrigatório',
                'email.email' => 'O email deve ser válido',
            ]
        );

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

    public function update_password_submit(Request $request, $token)
    {
        $request->validate(
            [
                'email' => ['required', 'email'],
                'senha' => ['required', 'same:confirmaSenha', Rules\Password::min(8)->mixedCase()->numbers()->symbols()],
                'confirmaSenha' => ['required'],
            ],
            [
                'email.required' => 'O email é obrigatório',
                'email.email' => 'O email deve ser válido',
                'senha.required' => 'A senha é obrigatória',
                'senha.same' => 'As senhas não coincidem',
                'confirmaSenha.required' => 'A confirmação da senha é obrigatória',
            ]
        );

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
