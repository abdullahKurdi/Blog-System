<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();


        for ($i = 1; $i <= 100; $i++) {
            $title = $faker->sentence(mt_rand(3, 6), true);
            \App\Models\Comment::create([
                'body' => $faker->paragraph(),
                'user_id' => \App\Models\User::inRandomOrder()->first()->id,
                'post_id' => \App\Models\Post::inRandomOrder()->first()->id,

            ]);
        }
    }
}
