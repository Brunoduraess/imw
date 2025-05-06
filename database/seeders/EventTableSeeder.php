<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert(
            [
                'id' => (string) Str::uuid(),
                'nome' => '6 horas de adoração',
                'descricao' => 'Evento 6 horas de adoração',
                'tipo' => '6 horas de adoração',
                'data' => '2025-05-17',
                'horario' => '15:00',
                'local_id' => 'fe40d6a7-48c4-42ec-8a2b-150a07f55f92',
                'imagem_agenda' => 'teste',
                'imagem_detalhe' => 'teste',
                'status' => 'Ativo',
                'criado_por' => '0000915b-434e-48e1-a837-048694f87d56',
                'criado_em' => Carbon::now()
            ]
        );
    }
}
