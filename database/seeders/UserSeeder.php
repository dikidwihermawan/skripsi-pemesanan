<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            [
                'username' => 'newbieorg',
                'name' => 'Newbie Organic',
                'email' => 'newbieorganic@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'manager',
            ],
            [
                'username' => 'ozora256',
                'name' => 'Haruka Ozora',
                'email' => 'harukaozora@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
            [
                'username' => 'dikidh',
                'name' => 'Diki Dwi Hermawan',
                'email' => 'dikidwihermawan@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'client',
            ],
        ];

        foreach ($arr as $k => $v) {
            User::create($v);
        }
    }
}
