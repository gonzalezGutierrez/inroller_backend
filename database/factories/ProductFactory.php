<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    $categories = \App\Category::all();
    return [
        'name'=>$faker->name,
        'price'=>$faker->randomNumber(3),
        'cost'=>$faker->randomNumber(2),
        'url_image'=>$faker->imageUrl(400,400),
        'width'=>$faker->randomNumber(3),
        'category_id'=>$categories->random(),
        'description'=>$faker->text
    ];
});
