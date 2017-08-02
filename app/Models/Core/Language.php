<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
	public function country()
	{
		return $this->belongsTo(Country::class);
	}
}
