<?php

namespace Database\Seeders;

use App\Models\Parameter;
use Illuminate\Database\Seeder;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now()->toDateString();
        Parameter::insert([
            ['group_id' => '1 ','name'=> 'A positivo (A +)', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '1 ','name'=> 'A negativo (A-)', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '1 ','name'=> 'B positivo (B +)', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '1 ','name'=> 'B negativo (B-)', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '1 ','name'=> 'AB positivo (AB+)', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '1 ','name'=> 'AB negativo (AB-)', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '1 ','name'=> 'O positivo (O+)', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '1 ','name'=> 'O negativo (O-)', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '2 ','name'=> 'Femenino', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '2 ','name'=> 'Masculino', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '2 ','name'=> 'Indeterminado', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '3 ','name'=> 'Pentavalente', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '3 ','name'=> 'Antipolio', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '3 ','name'=> 'SRP', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '3 ','name'=> 'Antineumocócica', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '4 ','name'=> 'Cirugía Menor', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '4 ','name'=> 'Cirugía Mayor', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '5 ','name'=> 'Pensilina', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '6 ','name'=> 'Armada', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '6 ','name'=> 'Ejercito', 'created_at' => $now, 'updated_at' => $now],
            ['group_id' => '6 ','name'=> 'Aerea', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
