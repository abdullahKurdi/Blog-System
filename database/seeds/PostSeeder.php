<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();


        for ($i=1 ; $i <= 27; $i++){
            $title = $faker->sentence(mt_rand(3, 6), true);
            \App\Models\Post::create([
                'title'=>$title,
                'slug'=>Str::slug($title),
                'body'=>$faker->paragraph(),
                'image'=>'p1.jpg',
                'user_id'=>\App\Models\User::inRandomOrder()->first()->id,
                'category_id'=>\App\Models\Category::inRandomOrder()->first()->id,

            ]);
        }
    }
}
