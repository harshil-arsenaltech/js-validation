<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();
        $fields = [
            [
                'slug' => 'idel_trip_cancel_time',
                'name' => 'Idel Trip Cancel Time',
                'value' => '5',
            ],
            [
                'slug' => 'distance',
                'name' => 'Distance',
                'value' => '50',
            ],
        ];

        foreach ($fields as $field) {
            Setting::updateOrCreate($field);
        }
    }
}
