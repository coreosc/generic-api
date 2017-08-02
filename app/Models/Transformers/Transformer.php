<?php

namespace App\Models\Transformers;

abstract class Transformer
{
	protected $map = [];

	/**
	 * @param array $items
	 * @return array
	 */
	public function transformCollection(array $items)
	{
		return array_map([$this, 'transformItem'], $items);
	}

	/**
	 * @param $item
	 * @return array
	 */
	public function transformItem($item)
	{
		return $this->transform($item->toArray());
	}

	/**
	 * @param array $toTransform
	 * @param array $map
	 * @return array
	 */
	public function doTransform(array $toTransform, array $map): array
	{
		return collect($toTransform)
			->filter(function($value, $key) use($map) { return isset($map[$key]); })
			->mapWithKeys(function($value, $key) use ($map) {
				return [$map[$key] => $value];
			})->toArray();
	}

	public function transformReverse(array $toTransform): array
	{
		return $this->doTransform($toTransform, array_flip($this->map));
	}

	public function transform(array $toTransform): array
	{
		return $this->doTransform($toTransform, $this->map);
	}

}