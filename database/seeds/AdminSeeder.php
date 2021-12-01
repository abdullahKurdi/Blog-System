<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        \App\Models\User::create([
            'name'=>'Abdullah',
            'email'=>'kurdi@gmail.com',
            'password'=>bcrypt('123456789'),
            'profile_img'=>'p1.jpg',
            'is_admin'=>true
        ]);
    }
}
