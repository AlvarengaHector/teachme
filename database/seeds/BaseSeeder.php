<?php 

use Illuminate\Database\Seeder;
use Faker\Generator;
use Faker\Factory as Faker;

use Illuminate\Database\Eloquent\Collection;

abstract class BaseSeeder extends Seeder
{
	protected $total = 50;
	protected static $pool = array();

	public function run()
	{
		$this->createMultiple($this->total);
	}

	/**
	 * Used for load multiples models
	 * Protected: Allow acces from child table.
	 * @param  integer $total        	Total of faker rows to load
	 * @param  array   $customValues 	[description]
	 * @return Response
	 */
	protected function createMultiple($total, array $customValues = array())
	{
		for ($i=0; $i <= $total; $i++) {
			$this->create($customValues);
		}
	}

	abstract public function getModel();

	/**
	 * Parent class
	 * @param  Generator 	$faker        
	 * @param  array     	$customValues If we want to create custom data
	 * @return Response
	 */
	abstract public function getDummyData(Generator $faker, array $customValues = array());

	protected function create(array $customValues = array())
	{
		$values = $this->getDummyData(Faker::create(), $customValues);
		$values = array_merge($values, $customValues);

		return $this->addToPool($this->getModel()->create($values));
	}

	protected function createFrom($seeder, array $customValues = array())
	{
		$seeder = new $seeder;
		return $seeder->create($customValues);
	}

	protected function getRandom($model)
	{
		if ( ! $this->collectionExist($model)) {
			throw new Exception("The $model collection does not exist");
		}

		return static::$pool[$model]->random();
	}

	private function addToPool($entity)
	{
		$reflection = new ReflectionClass($entity);
		$class = $reflection->getShortName();

		if ( ! $this->collectionExist($class)) {
			static::$pool[$class] = new Collection();
		}

		static::$pool[$class]->add($entity);

		return $entity;
	}

	private function collectionExist($class)
	{
		return isset(static::$pool[$class]);
	}

}