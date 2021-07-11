<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\MedicalBoard;
use App\Models\Report;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class MedicalBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medicalBoards = MedicalBoard::factory()
            ->count(45)
            ->create();

        $doctors = Doctor::query()->get()->pluck('id')->toArray();

        $medicalBoards->each( function ($mb) use ($doctors) {
            $cant = rand(2,5);
            $mb->doctorsSupervisors()->sync(Arr::random($doctors, $cant));
            Report::factory()
                ->create([
                    'medical_board_id' => $mb->id
                ]);
        });
    }
}
