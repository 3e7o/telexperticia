<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now()->toDateString();
        Specialty::insert([
          ['name' => 'MEDICINA GENERAL', 'created_at' => $now, 'updated_at' => $now],
          ['name' => 'MEDICINA INTERNA', 'created_at' => $now, 'updated_at' => $now],
          ['name' => 'MEDICINA LABORAL', 'created_at' => $now, 'updated_at' => $now],
          ['name' => 'MEDICINA FAMILIAR', 'created_at' => $now, 'updated_at' => $now],
          ['name' => 'GERIATRÍA', 'created_at' => $now, 'updated_at' => $now],
          ['name' => 'PEDIATRÍA', 'created_at' => $now, 'updated_at' => $now],
          ['name' => 'PSIQUIATRÍA', 'created_at' => $now, 'updated_at' => $now],
          ['name' => 'DIABETOLOGÍA', 'created_at' => $now, 'updated_at' => $now],
          ['name' => 'ENDOCRINOLOGÍA', 'created_at' => $now, 'updated_at' => $now],
          ['name' => 'HEMATOLOGÍA', 'created_at' => $now, 'updated_at' => $now],
          ['name' => 'INFECTOLOGÍA', 'created_at' => $now, 'updated_at' => $now],
          ['name' => 'NEFROLOGÍA', 'created_at' => $now, 'updated_at' => $now],
          ['name' => 'REUMATOLOGÍA', 'created_at' => $now, 'updated_at' => $now],
          ['name' => 'GINECO-OBSTETRICIA', 'created_at' => $now, 'updated_at' => $now],
          ['name' => 'CARDIOLOGÍA', 'created_at' => $now, 'updated_at' => $now],
          ['name' => 'NEUMOLOGÍA', 'created_at' => $now, 'updated_at' => $now],
          ['name' => 'NEUROLOGÍA', 'created_at' => $now, 'updated_at' => $now],
          ['name' => 'OFTALMOLOGÍA', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
