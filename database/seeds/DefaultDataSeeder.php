<?php

use App\Role;
use App\Status;
use App\User;
use Illuminate\Database\Seeder;

class DefaultDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $statuses = [
            [
                'name' => 'active'
            ],
            [
                'name' => 'inactive'
            ]
        ];

        foreach($statuses as $status){
            Status::create($status);
        }

        $roles = [
            [
                'name' => 'admin'
            ],
            [
                'name' => 'user'
            ]
        ];

        foreach($roles as $role){
            Role::create($role);
        }

        User::create([
            'name' => 'Omahha',
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
            'status_id' => 1,
            'role_id' => 1
        ]);
    }
}
