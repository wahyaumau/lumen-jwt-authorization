<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['id' => 1, 'username' => 'admin', 'password' => app('hash')->make('admin')],
            ['id' => 2, 'username' => 'user', 'password' => app('hash')->make('user')],
            ['id' => 3, 'username' => 'super administrator', 'password' => app('hash')->make('super administrator')],
        ];
        foreach($users as $user){
    		User::create($user);
		}
    }
}
