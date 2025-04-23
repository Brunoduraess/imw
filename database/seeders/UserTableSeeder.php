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
                'id' => '0000915b-434e-48e1-a837-048694f87d56',
                'nome' => 'Bruno Durães de Souza Gonçalves',
                'cpf' => '17511527744',
                'email' => 'brunoduraes03@gmail.com',
                'senha' => bcrypt('teste'),
                'acesso' => 'Administrador',
                'status' => 'Ativo',
                'ultimo_acesso' => NULL,
                'criado_em' => date('Y-m-d H:i:s'),
            ]
        );
    }
}