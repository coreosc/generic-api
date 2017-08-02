<?php

namespace App\Models\Transformers;

class User extends Transformer
{

	protected $map = [
		'id'             => 'id',
		'first_name'     => 'first_name',
		'last_name'      => 'last_name',
		'email'          => 'email',
		'has_newsletter' => 'has_newsletter',
		'password'       => 'password'
	];

	/**
	 * @param $item
	 * @return array
	 */
	public function transformItem($item)
	{
		return collect(parent::transformItem($item))
			->merge([
				'has_newsletter' => (bool)$item['has_newsletter'],
				'full_name'      => $item['first_name'] . " " . $item['last_name'],
			])->toArray();
	}
}