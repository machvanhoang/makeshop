<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'Mạch Văn Hoang',
            'email' => 'hoangmach.website@gmail.com',
            'password' => Hash::make('admin#123'),
        ];
        User::create($user);
    }
}
