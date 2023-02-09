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
            'auth_code' => '819daf05630eed8a7554f2a13a5452e6',
            'process' => 'search',
            'access_token' => null,
            'response_format' => 'xml',
            'total_product' => 10282
        ];
        Settings::create($setting);
    }
}
