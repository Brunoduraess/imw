<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_admin_area(): void
    {
        $this->get(route('menu'))
            ->assertRedirect(route('login'));
    }

    public function test_active_user_can_log_in(): void
    {
        $user = $this->createUser();

        $response = $this->post(route('loginSubmit'), [
            'email' => $user->email,
            'senha' => 'Senha@123',
        ]);

        $response->assertRedirect(route('menu'));
        $this->assertAuthenticatedAs($user);
        $this->assertNotNull($user->fresh()->ultimo_acesso);
    }

    public function test_disabled_user_cannot_log_in(): void
    {
        $user = $this->createUser([
            'status' => 'Inativo',
        ]);

        $this->post(route('loginSubmit'), [
            'email' => $user->email,
            'senha' => 'Senha@123',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_authenticated_user_can_log_out(): void
    {
        $user = $this->createUser();

        $this->actingAs($user)
            ->post(route('logout'))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }

    public function test_user_can_request_a_password_reset_link(): void
    {
        Notification::fake();
        $user = $this->createUser();

        $this->post(route('forgot_password_submit'), [
            'email' => $user->email,
        ])->assertRedirect(route('send_confirm'));

        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_user_can_reset_the_password_with_a_valid_token(): void
    {
        $user = $this->createUser();
        $token = Password::broker()->createToken($user);

        $this->post(route('update_password_submit', $token), [
            'email' => $user->email,
            'senha' => 'NovaSenha@123',
            'confirmaSenha' => 'NovaSenha@123',
        ])->assertRedirect(route('login'));

        $this->assertTrue(Hash::check('NovaSenha@123', $user->fresh()->senha));
        $this->assertDatabaseMissing('password_reset_tokens', [
            'email' => $user->email,
        ]);
    }

    private function createUser(array $attributes = []): User
    {
        $user = new User;
        $user->id = (string) Str::uuid();
        $user->nome = 'Usuário de Teste';
        $user->email = $attributes['email'] ?? 'teste@example.com';
        $user->senha = Hash::make('Senha@123');
        $user->acesso = 'Administrador';
        $user->status = $attributes['status'] ?? 'Ativo';
        $user->criado_em = now();
        $user->desativado_em = $attributes['desativado_em'] ?? null;
        $user->save();

        return $user;
    }
}
