<?php

use Illuminate\Database\Seeder;
use App\User;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin user
        $user =  User::findOrFail(1);
        $roles_id = [1, 2];
        $user->roles()->attach($roles_id);

        // User user
        $user =  User::findOrFail(2);
        $roles_id = [2];
        $user->roles()->attach($roles_id);

        // Super Admin user
        $user =  User::findOrFail(3);
        $roles_id = [3];
        $user->roles()->attach($roles_id);
    }
}
