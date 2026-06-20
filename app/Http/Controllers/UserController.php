<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function users()
    {
        $users = User::orderBy('nome', 'asc')->get();

        foreach ($users as $user) {
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
            $access->nome = $quebraNome[0].' '.end($quebraNome);
            $access->data_acesso = date('d/m/Y H:i', strtotime($access->ultimo_acesso));
        }

        return view('admin/users', ['users' => $users, 'userPerStatus' => $userPerStatus, 'userPerProfile' => $userPerProfile, 'lastAccess' => $lastAccess]);
    }

    public function newUser()
    {
        return view('admin/newUser');
    }

    public function createUser(StoreUserRequest $request)
    {
        $nome = $request->input('nome');
        $email = $request->input('email');
        $acesso = $request->input('acesso');
        $status = 'Ativo';
        $user = new User;
        $user->id = (string) Str::uuid();
        $user->nome = $nome;
        $user->email = $email;
        $user->acesso = $acesso;
        $user->status = $status;
        $user->criado_em = now();
        $user->senha = Hash::make(Str::random(64));
        $user->save();

        Password::sendResetLink(['email' => $email]);

        return redirect()->route('users');
    }

    public function editUser($id)
    {
        $user = User::find($id);

        return view('admin/editUser', ['user' => $user]);
    }

    public function saveUserEdit(UpdateUserRequest $request)
    {
        User::where('id', '=', $request->input('id'))
            ->update([
                'nome' => $request->input('nome'),
                'email' => $request->input('email'),
                'acesso' => $request->input('acesso'),
            ]);

        return redirect()->route('users');

    }

    public function disableUser($id)
    {
        $user = User::find($id);

        $user->status = 'Inativo';
        $user->desativado_em = date('Y-m-d H:i:s');
        $user->desativado_por = auth()->user()->nome;
        $user->save();

        return redirect()->route('users');
    }

    public function enableUser($id)
    {
        $user = User::find($id);

        $user->status = 'Ativo';
        $user->desativado_em = null;
        $user->desativado_por = null;
        $user->save();

        return redirect()->route('users');
    }
}
