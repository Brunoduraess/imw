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
        $user = User::create([
            'id' => (string) Str::uuid(),
            'nome' => $data['nome'],
            'email' => $data['email'],
            'acesso' => $data['acesso'],
            'status' => 'Ativo',
            'criado_em' => now(),
            'senha' => Hash::make(Str::random(64)),
        ]);

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
        User::whereKey($id)->update([
            'status' => 'Inativo',
            'desativado_em' => now(),
            'desativado_por' => $disabledBy,
        ]);
    }

    public function enable(string $id): void
    {
        User::whereKey($id)->update([
            'status' => 'Ativo',
            'desativado_em' => null,
            'desativado_por' => null,
        ]);
    }
}
