<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert(
            [

                [
                    'id' => uuid_create(),
                    'nome' => 'Bruno Durães de Souza Gonçalves',
                    'email' => 'brunoduraes03@gmail.com',
                    'senha' => bcrypt('teste'),
                    'acesso' => 'Administrador',
                    'status' => 'Ativo',
                    'ultimo_acesso' => null,
                    'criado_em' => date('Y-m-d H:i:s'),
                ],
            ]

        );
    }
}
