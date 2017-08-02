<?php

namespace App\Models\Transformers;

use Illuminate\Database\Eloquent\Model;

class DefaultTransformer extends Transformer
{

	public function setMap(Model $resource)
	{
		$this->map = array_merge([$resource->getKeyName() => $resource->getKeyName()], array_combine($resource->getFillable(), $resource->getFillable()));

		return $this;
	}

}