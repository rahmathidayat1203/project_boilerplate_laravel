<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'app_name', 'value' => 'Laravel Pro-Boilerplate', 'type' => 'string'],
            ['key' => 'app_email', 'value' => 'admin@example.com', 'type' => 'string'],
            ['key' => 'items_per_page', 'value' => '10', 'type' => 'integer'],
        ];
        
        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
