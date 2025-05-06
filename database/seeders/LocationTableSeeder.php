<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert(
            [
                'id' => (string) Str::uuid(),
                'nome' => 'Igreja Metodista Wesleyana Vila Elmira',
                'responsavel' => 'Edna',
                'tel_responsavel' => '24998385939',
                'cep' => '27335310',
                'rua' => 'Rua Miguel da Fonseca Rego',
                'numero' => 75,
                'bairro' => 'Ponte Alta',
                'cidade' => 'Volta Redonda',
                'complemento' => 'Igreja'
            ]
        );
    }
}
