<?php

namespace App\Models\Core;

class Country extends ModelUuid
{
	protected $fillable = [
		'iso_code',
		'call_prefix',
		'postcode_format'
	];

    public function languages(){
		return $this->hasMany(Language::class);
	}
}
