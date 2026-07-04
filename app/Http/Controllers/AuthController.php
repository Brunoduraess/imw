<?php

namespace App\Http\Controllers;

use App\Exceptions\Records\UserRecordException;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Throwable;

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

        try {
            $user->ultimo_acesso = now();
            $user->save();
        } catch (Throwable $exception) {
            throw UserRecordException::updateLastAccessFailed($exception);
        }

        return redirect()->intended(route('menu'));
    }

    public function forgotPassword()
    {
        return view('admin/forgot_password');
    }

    public function forgotPasswordSubmit(ForgotPasswordRequest $request)
    {
        Password::sendResetLink($request->only('email'));

        return redirect()->route('send_confirm');
    }

    public function sendConfirm()
    {
        return view('admin/send_confirm');
    }

    public function updatePassword(Request $request, string $token)
    {
        return view('admin/update_password', [
            'email' => $request->query('email'),
            'token' => $token,
        ]);
    }

    public function updatePasswordSubmit(ResetPasswordRequest $request, $token)
    {
        $status = Password::reset(
            [
                'email' => $request->input('email'),
                'password' => $request->input('senha'),
                'password_confirmation' => $request->input('confirmaSenha'),
                'token' => $token,
            ],
            function ($user, string $password) {
                try {
                    $user->senha = Hash::make($password);
                    $user->save();
                } catch (Throwable $exception) {
                    throw UserRecordException::updatePasswordFailed($exception);
                }
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
