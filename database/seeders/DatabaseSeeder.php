<?php

namespace Database\Seeders;


use App\Models\Pessoa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach (['João', 'Maria', 'Paulo', 'Ana'] as $nome) {
            Pessoa::create(['nome' => $nome]);
        }

        User::create([
            'name' => 'Administrador',
            'email' => 'admin@exemplo.com',
            'password' => 'senha1234',
            'nivel_acesso' => 2,
        ]);

        User::create([
            'name' => 'Usuário Comum',
            'email' => 'comum@exemplo.com',
            'password' => 'senha1234',
            'nivel_acesso' => 1,
        ]);
    }
}
