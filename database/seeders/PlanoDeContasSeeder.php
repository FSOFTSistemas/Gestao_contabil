<?php

namespace Database\Seeders;

use App\Models\PlanoDeContas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanoDeContasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PlanoDeContas::factory()->count(10)->create();
    }
}
