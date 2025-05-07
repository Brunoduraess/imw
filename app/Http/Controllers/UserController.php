<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function users()
    {
        $users = User::orderBy('nome', 'asc')->get();

        foreach ($users as $user) {
            $user->cpf = $this->formataCPF($user->cpf);
            $user->data_criacao = date('d/m/Y H:i', strtotime($user->criado_em));

            if ($user->ultimo_acesso) {
                $user->ultimo_acesso = date('d/m/Y H:i', timestamp: strtotime($user->ultimo_acesso));
            } else {
                $user->ultimo_acesso = '-';
            }
        }

        $userPerStatus = User::selectRaw('count(id) as total, status')
            ->groupBy('status')
            ->get();

        $userPerProfile = User::selectRaw('count(id) as total, acesso')
            ->groupBy('acesso')
            ->get();

        $lastAccess = User::where('ultimo_acesso', '!=', '')
            ->orderBy('ultimo_acesso', 'desc')
            ->limit(3)
            ->get();

        foreach ($lastAccess as $access) {
            $quebraNome = explode(' ', $access->nome);
            $access->nome = $quebraNome[0] . " " . end($quebraNome);
            $access->data_acesso = date('d/m/Y H:i', strtotime($access->ultimo_acesso));
        }

        return view('admin/users', ['users' => $users, 'userPerStatus' => $userPerStatus, 'userPerProfile' => $userPerProfile, 'lastAccess' => $lastAccess]);
    }

    private function formataCPF($cpf)
    {
        $cpfFormatado = preg_replace(
            '/(\d{3})(\d{3})(\d{3})(\d{2})/',
            '$1.$2.$3-$4',
            $cpf
        );
        return $cpfFormatado;
    }

    public function newUser()
    {
        return view('admin/newUser');
    }

    public function createUser(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required',
                'email' => 'required',
                'cpf' => 'required|min:14',
                'acesso' => 'required',
            ],
            [
                'nome.required' => 'O campo nome é obrigatório.',
                'email.required' => 'O campo email é obrigatório.',
                'cpf.required' => 'O campo CPF é obrigatório.',
                'cpf.min' => 'O CPF deve ter 11 números.',
                'acesso.required' => 'O campo nível de acesso é obrigatório.',
            ]
        );

        $nome = $request->input('nome');
        $email = $request->input('email');
        $cpf = str_replace(['.', '-'], '', $request->input('cpf'));
        $acesso = $request->input('acesso');
        $status = 'Ativo';
        $data = date('Y-m-d H:i:s');
        $senha = bcrypt('1234');

        $user = new User();
        $user->id = (string) Str::uuid();
        $user->nome = $nome;
        $user->email = $email;
        $user->cpf = $cpf;
        $user->acesso = $acesso;
        $user->status = $status;
        $user->criado_em = $data;
        $user->senha = $senha;
        $user->save();

        return redirect()->route('users');
    }

    public function editUser($id)
    {
        $user = User::find($id);

        return view('admin/editUser', ['user' => $user]);
    }

    public function saveUserEdit(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required',
                'email' => 'required',
                'cpf' => 'required|min:14',
                'acesso' => 'required',
            ],
            [
                'nome.required' => 'O campo nome é obrigatório.',
                'email.required' => 'O campo email é obrigatório.',
                'cpf.required' => 'O campo CPF é obrigatório.',
                'cpf.min' => 'O CPF deve ter 11 números.',
                'acesso.required' => 'O campo nível de acesso é obrigatório.',
            ]
        );

        User::where('id', '=', $request->input('id'))
            ->update([
                'nome' => $request->input('nome'),
                'email' => $request->input('email'),
                'cpf' => str_replace(['-', '.'], '', $request->input('cpf')),
                'acesso' => $request->input('acesso')
            ]);

        return redirect()->route('users');

    }

    public function disableUser($id)
    {
        $user = User::find($id);

        $user->status = "Inativo";
        $user->desativado_em = date('Y-m-d H:i:s');
        $user->desativado_por = session('user.nome');
        $user->save();

        return redirect()->route('users');
    }

    public function enableUser($id)
    {
        $user = User::find($id);

        $user->status = "Ativo";
        $user->desativado_em = null;
        $user->desativado_por = null;
        $user->save();

        return redirect()->route('users');
    }
}
