<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Product::class,30)->create()->each(function($product){
            $moreThanOneCategories = random_int(0,1); //boolean

            $categoriesIds = \App\Category::all()->pluck('id')->toArray();

            shuffle($categoriesIds); //shuffle the category of id

            if($moreThanOneCategories){
                $howMany = random_int(1, sizeof($categoriesIds)-1);
                $categories = array_slice($categoriesIds, 0, $howMany); 

                $product->categories()->attach($categories);
            }else{
                $product->categories()->attach(array_rand($categoriesIds, 1)+1);
            }

            $moreThanOneImages = random_int(0,1); //boolean

            $imagesIds = \App\Image::all()->pluck('id')->toArray();

            shuffle($imagesIds); //shuffle the image of id

            if($moreThanOneImages){
                $howMany = random_int(1, sizeof($imagesIds)-1);
                $images = array_slice($imagesIds, 0, $howMany);

                $product->images()->attach($images);
            }else{
                $product->images()->attach(array_rand($imagesIds, 1)+1);
            }
        });
    }
}
