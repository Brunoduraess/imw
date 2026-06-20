<?php

namespace Tests\Feature\Services;

use App\Services\EventService;
use App\Services\EventTypeService;
use App\Services\LocationService;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EloquentPersistenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_services_persist_models_with_eloquent_methods(): void
    {
        Notification::fake();
        Storage::fake('public');

        $user = app(UserService::class)->create([
            'nome' => 'Usuário Service',
            'email' => 'service@example.com',
            'acesso' => 'Administrador',
        ]);

        $eventType = app(EventTypeService::class)->create([
            'nome' => 'Conferência',
            'descricao' => 'Evento de teste',
            'duracao' => 1,
        ]);

        $location = app(LocationService::class)->create([
            'nome' => 'Templo',
            'rua' => 'Rua Teste',
            'numero' => 10,
            'bairro' => 'Centro',
            'cidade' => 'Santo André',
            'cep' => '09000-000',
            'responsavel' => 'Responsável',
            'tel_responsavel' => '(11) 99999-9999',
        ]);

        $event = app(EventService::class)->create([
            'nome' => 'Evento de Teste',
            'tipo' => $eventType->id.' / '.$eventType->nome,
            'descricao' => 'Descrição completa do evento de teste',
            'data' => now()->addDay()->toDateString(),
            'horario' => '19:00',
            'local' => $location->id,
            'imagem_agenda' => UploadedFile::fake()->image('agenda.jpg'),
            'imagem_detalhe' => UploadedFile::fake()->image('detalhe.jpg'),
            'valor' => '10,00',
        ], $user->id);

        $this->assertDatabaseHas('users', ['id' => $user->id]);
        $this->assertDatabaseHas('event_types', ['id' => $eventType->id]);
        $this->assertDatabaseHas('locations', ['id' => $location->id]);
        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'status' => 'Ativo',
        ]);
        Storage::disk('public')->assertExists($event->imagem_agenda);
        Storage::disk('public')->assertExists($event->imagem_detalhe);
    }
}
