<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserService
{
    public function getDashboardData(): array
    {
        $users = User::orderBy('nome')->get();

        foreach ($users as $user) {
            $user->data_criacao = date('d/m/Y H:i', strtotime($user->criado_em));
            $user->ultimo_acesso_formatado = $user->ultimo_acesso
                ? $user->ultimo_acesso->format('d/m/Y H:i')
                : '-';
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
            $nameParts = explode(' ', $access->nome);
            $access->nome = $nameParts[0].' '.end($nameParts);
            $access->data_acesso = date('d/m/Y H:i', strtotime($access->ultimo_acesso));
        }

        return compact('users', 'userPerStatus', 'userPerProfile', 'lastAccess');
    }

    public function create(array $data): User
    {
        $user = new User;
        $user->id = (string) Str::uuid();
        $user->nome = $data['nome'];
        $user->email = $data['email'];
        $user->acesso = $data['acesso'];
        $user->status = 'Ativo';
        $user->criado_em = now();
        $user->senha = Hash::make(Str::random(64));
        $user->save();

        Password::sendResetLink(['email' => $user->email]);

        return $user;
    }

    public function find(string $id): ?User
    {
        return User::find($id);
    }

    public function update(array $data): void
    {
        User::where('id', $data['id'])->update([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'acesso' => $data['acesso'],
        ]);
    }

    public function disable(string $id, string $disabledBy): void
    {
        $user = User::find($id);
        $user->status = 'Inativo';
        $user->desativado_em = now();
        $user->desativado_por = $disabledBy;
        $user->save();
    }

    public function enable(string $id): void
    {
        $user = User::find($id);
        $user->status = 'Ativo';
        $user->desativado_em = null;
        $user->desativado_por = null;
        $user->save();
    }
}
