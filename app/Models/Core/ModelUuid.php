<?php
namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

abstract class ModelUuid extends Model
{

	public $incrementing = false;

	public static function boot()
	{
		parent::boot();

		static::creating(function (Model $model) {
			$model->{$model->getKeyName()} = Uuid::uuid1()->toString();
		});

	}

}