<?php

use Illuminate\Database\Seeder;
use Pingpong\Admin\Entities\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'email' => 'admin@slingshot.com',
            'password' => 'secret',
	        'name' => 'Admin',
        ]);

        $user->addRole(1);


	    User::create([
		    'email' => 'user1@slingshot.com',
		    'password' => 'secret',
		    'name' => 'Eugene',
	    ]);

	    User::create([
		    'email' => 'user2@slingshot.com',
		    'password' => 'secret',
		    'name' => 'Ian Gillan',
	    ]);

	    User::create([
		    'email' => 'user3@slingshot.com',
		    'password' => 'secret',
		    'name' => 'John Snow',
	    ]);

	    User::create([
		    'email' => 'user4@slingshot.com',
		    'password' => 'secret',
		    'name' => 'Peter Gabriel',
	    ]);

	    User::create([
		    'email' => 'user5@slingshot.com',
		    'password' => 'secret',
		    'name' => 'Ian Anderson',
	    ]);
    }
}
