<?php namespace TeachMe\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Static class for retrieve full class namespace
 *
 * Entends from Model of Eloquent ORM
 */
class Entity extends Model
{
	public static function getClass()
	{
		return get_class(new static);
	}
}