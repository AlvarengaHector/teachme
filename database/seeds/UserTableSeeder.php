<?php

use Illuminate\Database\Seeder;
use TeachMe\Entities\User;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->createAdmin();
		$this->createUsers(50);

	}

	private function createAdmin()
	{
		User::create([
			'name' => 'Hector Alvarenga', 
			'email' => 'i@hector.me', 
			'password' => bcrypt('admin')
		]);
	}

	private function createUsers($total)
	{
		$faker = Faker::create();

		for ($i=0; $i <= $total; $i++) {
			User::create([
				'name' => $faker->name, 
				'email' => $faker->email, 
				'password' => bcrypt('secret')
			]);
		}
	}

}
