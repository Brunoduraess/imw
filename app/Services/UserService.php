<?php

namespace App\Services;

use App\Http\Resources\Admin\LastAccessResource;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserService
{
    public function getDashboardData(): array
    {
        $users = UserResource::collection(User::orderBy('nome')->get())->resolve();

        $userPerStatus = User::selectRaw('count(id) as total, status')
            ->groupBy('status')
            ->get();

        $userPerProfile = User::selectRaw('count(id) as total, acesso')
            ->groupBy('acesso')
            ->get();

        $lastAccess = LastAccessResource::collection(
            User::whereNotNull('ultimo_acesso')
                ->orderBy('ultimo_acesso', 'desc')
                ->limit(3)
                ->get()
        )->resolve();

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
