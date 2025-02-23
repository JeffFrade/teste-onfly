<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::factory([
            'name' => 'Solicitado'
        ])->create();

        Status::factory([
            'name' => 'Aprovado'
        ])->create();

        Status::factory([
            'name' => 'Cancelado'
        ])->create();
    }
}
