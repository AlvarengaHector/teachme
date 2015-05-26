<?php 

use TeachMe\Entities\Ticket;
use Faker\Generator;
use Faker\Factory as Faker;

class TicketTableSeeder extends BaseSeeder
{
	public function getModel()
	{
		return new Ticket();
	}

	public function getDummyData(Generator $faker, array $customValues = array())
	{
		return [
			'title' => $faker->sentence(),
			'status' => $faker->randomElement(['open', 'open', 'closed']),
			'user_id' => 1

		];
	}

	public function run()
	{
		$this->createMultiple(50);
	}
}