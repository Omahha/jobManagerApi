<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Action;
use App\Company;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'status_id' => 1,
        'role_id' => $faker->numberBetween(1,2),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Company::class, function(Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->address
    ];
});

$factory->define(Action::class, function(Faker $faker) {

    $company_id = $faker->numberBetween(1, 15);
    $company_address = Company::find($company_id)->address;

    $from = Carbon::today()->addDays( $faker->numberBetween(3, 14) )->addHours( $faker->numberBetween(10, 17) );
    $to = Carbon::createFromFormat('Y-m-d H:i:s', $from)->addHours( $faker->numberBetween(1,3) );

    return [
        'title' => $faker->word,
        'company_id' => $company_id,
        'status' => $faker->realText(150),
        'color' => $faker->hexColor,
        'scheduleFrom' => $from,
        'scheduleTo' => $to,
        'place' => $company_address
    ];
});
