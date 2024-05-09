<?php

namespace Database\Seeders;

use App\Models\Backend\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'site_name' => 'Ecommerce Site',
            'layout' => 'RTL',
            'contact_email' => 'contact@neinaa@com',
            'currency_name' => 'USD',
            'currency_icon' => '&#36;',
            'time_zone' => 'UTC'
        ];

        Setting::create($settings);
    }
}
