<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Category::create([
            'name' => "Category 1",
            'enable' => 1, 
        ]);
        
        \App\Category::create([
            'name' => "Category 2",
            'enable' => 1, 
        ]);

        \App\Category::create([
            'name' => "Category 3",
            'enable' => 1, 
        ]);
        
        \App\Category::create([
            'name' => "Category 4",
            'enable' => 1, 
        ]);
        
        \App\Category::create([
            'name' => "Category 5",
            'enable' => 1, 
        ]);
        
        \App\Category::create([
            'name' => "Category 6",
            'enable' => 1, 
        ]);
    }
}
