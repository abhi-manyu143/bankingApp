<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
               'name'=>'UserOne',
               'email'=>'userone@gmail.com',
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'UserTwo',
               'email'=>'usertwo@gmail,com.com',
               'password'=> bcrypt('123456'),
            ],
            [
                'name'=>'UserThree',
                'email'=>'userthree@gmail,com.com',
                'password'=> bcrypt('123456'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
