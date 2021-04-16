<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GeneralSetting;


class GeneralSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $general_settings = [
            ['id' => 1],
         ];

        foreach ($general_settings as $general_settings) {
            GeneralSetting::create($general_settings);
        }
    }
}
