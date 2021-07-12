<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\MedicalBoard;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalBoardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MedicalBoard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween($startDate = '2021-01-01 02:00:49', $endDate = 'now', $timezone = 'America/La_Paz'),
            'status' => Arr::random(['Confirmado', 'Cancelado','Reprogramar']),
            'patient_id' => \App\Models\Patient::factory(),
            'doctor_id' => \App\Models\Doctor::factory(),
            'open_zoom' => 0,
        ];
    }
}
