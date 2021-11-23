<?php

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
        $faker = \Faker\Factory::create();
        \App\Models\User::create([
            'name'=>'Abdullah',
            'email'=>'kurdi313@gmail.com',
            'password'=>bcrypt('123456789'),
            'profile_img'=>'p1.jpg',
        ]);

        for ($i=1 ; $i <= 5; $i++){
            \App\Models\User::create([
                'name'=>$faker->name,
                'email'=>$faker->email,
                'password'=>bcrypt('12345687867'),
                'profile_img'=>'p1.jpg',
            ]);
        }

    }
}
