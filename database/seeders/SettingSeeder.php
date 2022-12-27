<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Settings;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = [
            'shop_id' => 4708,
            'auth_code' => '878fcad78962ae416b08cea651e68b3d',
            'process' => 'search',
            'access_token' => null,
            'response_format' => 'xml',
            'total_product' => 10072
        ];
        Settings::create($setting);
    }
}
