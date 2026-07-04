<?php

namespace App\Services;

use App\Exceptions\Records\UserRecordException;
use App\Http\Resources\Admin\LastAccessResource;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Throwable;

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
        try {
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
        } catch (Throwable $exception) {
            throw UserRecordException::createFailed($exception);
        }
    }

    public function find(string $id): ?User
    {
        return User::find($id);
    }

    public function update(array $data): void
    {
        try {
            User::where('id', $data['id'])->update([
                'nome' => $data['nome'],
                'email' => $data['email'],
                'acesso' => $data['acesso'],
            ]);
        } catch (Throwable $exception) {
            throw UserRecordException::updateFailed($exception);
        }
    }

    public function disable(string $id, string $disabledBy): void
    {
        try {
            User::whereKey($id)->update([
                'status' => 'Inativo',
                'desativado_em' => now(),
                'desativado_por' => $disabledBy,
            ]);
        } catch (Throwable $exception) {
            throw UserRecordException::disableFailed($exception);
        }
    }

    public function enable(string $id): void
    {
        try {
            User::whereKey($id)->update([
                'status' => 'Ativo',
                'desativado_em' => null,
                'desativado_por' => null,
            ]);
        } catch (Throwable $exception) {
            throw UserRecordException::enableFailed($exception);
        }
    }
}
