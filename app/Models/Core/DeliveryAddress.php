<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
