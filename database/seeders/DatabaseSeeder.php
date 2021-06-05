<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'ci' => 9202401,
                'name' => 'Luis',
                'first_surname' => 'Pilco',
                'last_surname' => 'Vargas',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);
        $this->call(SpecialtySeeder::class);
        //$this->call(DoctorSeeder::class);
        //$this->call(UserSeeder::class);
        //$this->call(PatientSeeder::class);
        $this->call(GeneralSettingsTableSeeder::class);
        $this->call(GroupParameterSeeder::class);
        $this->call(ParameterSeeder::class);
        //$this->call(MedicalBoardSeeder::class);
       //$this->call(ReportSeeder::class);
    }
}
