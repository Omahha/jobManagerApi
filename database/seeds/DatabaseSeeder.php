<?php

use App\Action;
use App\Company;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('statuses')->truncate();
        DB::table('roles')->truncate();
        DB::table('users')->truncate();
        DB::table('companies')->truncate();
        DB::table('photos')->truncate();

        $this->call(DefaultDataSeeder::class);

        factory(Company::class, 15)->create();

        factory(User::class, 10)->create()->each(function($user){
            $user->actions()->createMany(
                factory(Action::class, 10)->make()->toArray()
            );
        });

        User::find(1)->actions()->createMany(
            factory(Action::class, 10)->make()->toArray()
        );
    }
}
