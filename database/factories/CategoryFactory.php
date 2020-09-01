<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(\App\Category::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'url_image'=>$faker->imageUrl(400,400),
        'description'=>$faker->text
    ];
});
