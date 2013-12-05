<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('users')->truncate();

		$users = array(
		    array( // make a new admin account with password Jess&Administration
			'id' => '1',
			'username' => 'admin',
			'email' => 'webmaster@localhost.local',
			'fullname' => 'Administrator',
			'password' => '$2y$08$c1dqQZAWRp2AZbyvBaQz0.8kI4OZMxg9O03EmgEUO4qVBq56QO7jK',
			'notes' => 'Default account',
			'admin_level' => '0'
		    )
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
