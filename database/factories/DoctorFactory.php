<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ci' => $this->faker->numberBetween(10000001, 99999999),
            'name' => $this->faker->firstName,
            'first_surname' => $this->faker->lastName,
            'last_surname' => $this->faker->lastName,
            'email' => $this->faker->email,
            'specialty_id' => \App\Models\Specialty::inRandomOrder()->first()->id,
        ];
    }
}
