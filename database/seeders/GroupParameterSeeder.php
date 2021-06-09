<?php

namespace Database\Seeders;

use App\Models\GroupParameter;
use Illuminate\Database\Seeder;

class GroupParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now()->toDateString();
        GroupParameter::insert([
        ['name' =>  'Grupos Sanguíneos', 'created_at' => $now, 'updated_at' => $now],
        ['name' =>  'Genero', 'created_at' => $now, 'updated_at' => $now],
        ['name' =>  'Vacunas', 'created_at' => $now, 'updated_at' => $now],
        ['name' =>  'Operaciones', 'created_at' => $now, 'updated_at' => $now],
        ['name' =>  'Alergias', 'created_at' => $now, 'updated_at' => $now],
        ['name' =>  'Fuerza', 'created_at' => $now, 'updated_at' => $now],
        ['name' =>  'Regionales', 'created_at' => $now, 'updated_at' => $now],
        ['name' =>  'Tipo de Asegurado', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
