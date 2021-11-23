<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::create([
           'name'=>'HTML5',
            'slug'=>'HTML5'
        ]);
        \App\Models\Category::create([
            'name'=>'CSS',
            'slug'=>'CSS'
        ]);
        \App\Models\Category::create([
            'name'=>'JS',
            'slug'=>'JS'
        ]);
        \App\Models\Category::create([
            'name'=>'Vue Js',
            'slug'=>'Vue-Js'
        ]);
        \App\Models\Category::create([
            'name'=>'PHP',
            'slug'=>'PHP'
        ]);
        \App\Models\Category::create([
            'name'=>'LARAVEL',
            'slug'=>'LARAVEL'
        ]);
    }
}
