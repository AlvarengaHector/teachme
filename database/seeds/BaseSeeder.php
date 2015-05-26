<?php 

use Illuminate\Database\Seeder;
use Faker\Generator;
use Faker\Factory as Faker;

abstract class BaseSeeder extends Seeder
{
	protected function createMultiple($total, array $customaValues = array())
	{
		for ($i=0; $i <= $total; $i++) {
			$this->create($customaValues);
		}
	}

	abstract public function getModel();
	abstract public function getDummyData(Generator $faker, array $customValues = array());

	protected function create(array $customaValues = array())
	{
		$values = $this->getDummyData(Faker::create(), $customaValues);
		$values = array_merge($values, $customaValues);

		$this->getModel()->create($values);
	}

}