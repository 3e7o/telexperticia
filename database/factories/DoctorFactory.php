<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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
            //'username' => $this->faker->firstName.$this->faker->lastName,
            'first_surname' => $this->faker->lastName,
            'last_surname' => $this->faker->lastName,
            'email' => $this->faker->email,
            'regional' => Arr::random(['La Paz', 'Sucre', 'Santa Cruz', 'Cochabamba']),
            'signature' => Arr::random(['images/feYIzLMsQ9Rv3JozFPO2Ti7Uoxuu5PtjmFxJ8F0Q.png', 'images/JpLNzIC9B51l2K2GEdQd1RGiTIIq7rOcroZQeA2B.png', 'images/pYtXz2FEBj9LqBuYzkQHnpmGPNSvf96Bdfe1gLGa.png', 'images/sBJMd1tRAbueqHvmbvkiFMaCvU4hHhyh3fUMr2kz.png','images/XaYLLqt924F2lJPO5UGaiPeBXalSZtFK5RCgWn6l.png','images/ZwvDsIcXsEbtZZFBUYzOqkeI6b513aawoehfStSN.png']),
            'specialty_id' => \App\Models\Specialty::inRandomOrder()->first()->id,
        ];
    }
}
