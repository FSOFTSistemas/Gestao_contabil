<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EmpresaSeeder::class,
            FornecedorSeeder::class,
            PlanoDeContasSeeder::class,
            ProdutoSeeder::class,
            ServicoSeeder::class,
            MovimentoSeeder::class,
            ClienteSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'empresa_id' => 1,
        ]);
    }
}
