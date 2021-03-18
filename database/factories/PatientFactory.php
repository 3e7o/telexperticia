<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

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
            'address' => $this->faker->address,
            'force' => Arr::random(['Ejercito', 'Armada', 'Aerea']),
            'gender' => Arr::random(['Hombre', 'Mujer']),
            'birthday' => $this->faker->date,
        ];
    }
}
