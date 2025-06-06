<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

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
                'cpf' => 'required',
                'senha' => 'required'
            ],
            [
                'cpf.required' => 'O cpf é obrigatório',
                'senha.required' => 'A senha é obrigatória'
            ]
        );

        $arrayEspeciais = ['.', '-', '/'];
        $cpf = str_replace($arrayEspeciais, '', $request->input('cpf'));
        $senha = $request->input('senha');

        $user = User::where('cpf', $cpf)->where('desativado_em', NULL)->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('loginError', 'CPF ou senha incorretos');
        }

        if (!password_verify($senha, $user->senha)) {
            return redirect()->back()->withInput()->with('loginError', 'CPF ou senha incorretos');
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
        return view('forgot_password');
    }


    public function logout()
    {
        session()->flush();
        return redirect()->to('/login');
    }
}
