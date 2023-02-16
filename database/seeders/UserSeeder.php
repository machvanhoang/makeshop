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
        $users = [
            [
                'name' => 'Mạch Văn Hoàng',
                'email' => 'hoangmach.website@gmail.com',
                'password' => Hash::make('admin#123')
            ],
            [
                'name' => 'Nekonote',
                'email' => 'nekonote@gmail.com',
                'password' => Hash::make('JZ~2+fmk')
            ]
        ];
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
