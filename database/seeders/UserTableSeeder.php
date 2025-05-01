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
                    'id' => 'd9a8a4ec-b28b-4a90-9226-1a482ff96e5b',
                    'nome' => 'Lucas Henrique Almeida Souza',
                    'cpf' => '12345678901',
                    'email' => 'lucas.souza@example.com',
                    'senha' => bcrypt('teste'),
                    'acesso' => 'Administrador',
                    'status' => 'Ativo',
                    'ultimo_acesso' => NULL,
                    'criado_em' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 'ab1f94cd-d7d9-49c0-8b39-6cb7d3c78f12',
                    'nome' => 'Mariana Costa Oliveira',
                    'cpf' => '23456789012',
                    'email' => 'mariana.oliveira@example.com',
                    'senha' => bcrypt('teste'),
                    'acesso' => 'Usuário',
                    'status' => 'Ativo',
                    'ultimo_acesso' => NULL,
                    'criado_em' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '2e6a0129-b8b2-41a6-8be2-c18f3f7e22c0',
                    'nome' => 'Rafael Mendes Lima',
                    'cpf' => '34567890123',
                    'email' => 'rafael.lima@example.com',
                    'senha' => bcrypt('teste'),
                    'acesso' => 'Moderador',
                    'status' => 'Inativo',
                    'ultimo_acesso' => NULL,
                    'criado_em' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '75f50c03-f011-4d15-97cc-9c621d13d4d2',
                    'nome' => 'Aline Ferreira Rocha',
                    'cpf' => '45678901234',
                    'email' => 'aline.rocha@example.com',
                    'senha' => bcrypt('teste'),
                    'acesso' => 'Usuário',
                    'status' => 'Ativo',
                    'ultimo_acesso' => NULL,
                    'criado_em' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 'd3c5d764-89b1-4a3f-a64d-9939b2f3b8ab',
                    'nome' => 'Gustavo Ribeiro Martins',
                    'cpf' => '56789012345',
                    'email' => 'gustavo.martins@example.com',
                    'senha' => bcrypt('teste'),
                    'acesso' => 'Administrador',
                    'status' => 'Ativo',
                    'ultimo_acesso' => NULL,
                    'criado_em' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 'ea39a55c-fd17-40f0-b1c6-7bc8f4cf2b6d',
                    'nome' => 'Juliana Carvalho Dias',
                    'cpf' => '67890123456',
                    'email' => 'juliana.dias@example.com',
                    'senha' => bcrypt('teste'),
                    'acesso' => 'Moderador',
                    'status' => 'Inativo',
                    'ultimo_acesso' => NULL,
                    'criado_em' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '2e84d453-0b3a-46f5-a9d6-cba43ad3e168',
                    'nome' => 'Bruno Teixeira Cardoso',
                    'cpf' => '78901234567',
                    'email' => 'bruno.cardoso@example.com',
                    'senha' => bcrypt('teste'),
                    'acesso' => 'Usuário',
                    'status' => 'Ativo',
                    'ultimo_acesso' => NULL,
                    'criado_em' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 'f0b6f1f6-fd7d-472e-873a-3f10e15f39e0',
                    'nome' => 'Renata Lima Andrade',
                    'cpf' => '89012345678',
                    'email' => 'renata.andrade@example.com',
                    'senha' => bcrypt('teste'),
                    'acesso' => 'Usuário',
                    'status' => 'Ativo',
                    'ultimo_acesso' => NULL,
                    'criado_em' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 'e04b2b77-5a1b-4df6-bf8d-1f6a3c6e9b25',
                    'nome' => 'Diego Farias Monteiro',
                    'cpf' => '90123456789',
                    'email' => 'diego.monteiro@example.com',
                    'senha' => bcrypt('teste'),
                    'acesso' => 'Moderador',
                    'status' => 'Inativo',
                    'ultimo_acesso' => NULL,
                    'criado_em' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 'b1a61f46-b9b2-47d2-8af9-85e1c4cc8902',
                    'nome' => 'Patrícia Nogueira Souza',
                    'cpf' => '01234567890',
                    'email' => 'patricia.souza@example.com',
                    'senha' => bcrypt('teste'),
                    'acesso' => 'Administrador',
                    'status' => 'Ativo',
                    'ultimo_acesso' => NULL,
                    'criado_em' => date('Y-m-d H:i:s'),
                ],
            ]

        );
    }
}