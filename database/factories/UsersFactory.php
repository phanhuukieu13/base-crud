<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'full_name' => $faker->full_name,
        'address' => $faker->address,
        'phone_number' => $faker->phone_number,
        'old' => $faker->old,
        'status' => $faker->status,
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
