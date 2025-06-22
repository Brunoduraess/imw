<?php

namespace App\Http\Controllers;

use App\Mail\forgotPassMail;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin/login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'senha' => 'required'
            ],
            [
                'email.required' => 'O email é obrigatório',
                'senha.required' => 'A senha é obrigatória'
            ]
        );

        $email = $request->input('email');
        $senha = $request->input('senha');

        $user = User::where('email', $email)->where('desativado_em', NULL)->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('loginError', 'Email ou senha incorretos');
        }

        if (!password_verify($senha, $user->senha)) {
            return redirect()->back()->withInput()->with('loginError', 'Email ou senha incorretos');
        }

        date_default_timezone_set('America/Bahia');

        $user->ultimo_acesso = date('Y-m-d H:i:s');
        $user->save();

        session([
            'user' => [
                'id' => $user->id,
                'nome' => $user->nome,
                'acesso' => $user->acesso
            ]
        ]);

        return redirect()->to('/menu');
    }

    public function forgot_password()
    {
        return view('admin/forgot_password');
    }

    public function forgot_password_submit(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email'
            ],
            [
                'email.required' => 'O email é obrigatório',
                'email.email' => 'O email deve ser válido'
            ]
        );

        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Email não encontrado');
        }

        $token = uuid_create();

        $token = new Token([
            'id' => uuid_create(),
            'token' => $token,
            'email' => $email,
            'data_criacao' => date('Y-m-d'),
            'data_expiracao' => date('Y-m-d h:i:s', strtotime('+1 day'))
        ]);

        $token->save();

        $link = url('/update_password/' . $token->token);

        Mail::to($email)->send(new forgotPassMail($link));

        return redirect()->route('send_confirm');
    }

    public function send_confirm()
    {
        return view('admin/send_confirm');
    }

    public function update_password($token)
    {
        $tokenRecord = Token::where('token', $token)->first();

        if (!$tokenRecord || strtotime($tokenRecord->data_expiracao) < time()) {
            return redirect()->route('login');
        }

        return view('admin/update_password', ['token' => $token]);
    }

    public function update_password_submit(Request $request, $token)
    {
        $request->validate(
            [
                'senha' => 'required',
                'confirmaSenha' => 'required'
            ],
            [
                'senha.required' => 'A senha é obrigatória',
                'confirmaSenha.required' => 'A confirmação da senha é obrigatória'
            ]
        );

        $senha = $request->input('senha');
        $confirmaSenha = $request->input('confirmaSenha');

        if ($senha !== $confirmaSenha) {
            return redirect()->back()->withInput()->with('error', 'As senhas não coincidem');
        }

        if (!preg_match('/[A-Z]/', $senha)) {
            return redirect()->back()->withInput()->with('error', 'A senha deve conter pelo menos uma letra maiúscula');
        }

        if (!preg_match('/[0-9]/', $senha)) {
            return redirect()->back()->withInput()->with('error', 'A senha deve conter pelo menos um número');
        }

        if (!preg_match('/[\W_]/', $senha)) {
            return redirect()->back()->withInput()->with('error', 'A senha deve conter pelo menos um caractere especial');
        }

        $tokenRecord = Token::where('token', $token)->first();

        if (!$tokenRecord || strtotime($tokenRecord->data_expiracao) < time()) {
            return redirect()->route('login');
        }

        $user = User::where('email', $tokenRecord->email)->first();
        $user->senha = bcrypt($request->input('senha'));
        $user->save();

        $tokenRecord->delete();

        return redirect()->route('login')->with('success', 'Senha atualizada com sucesso');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->to('/login');
    }
}
