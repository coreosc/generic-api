<?php

namespace App\Models\Core;

class Currency extends ModelUuid
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'iso_code',
		'sign',
	];

}
