<?php
namespace App\Http\Requests\Currency;

use App\Http\Requests\BaseStoreRequest;

class CurrencyStoreRequest extends BaseStoreRequest
{
	public function rules(): array
	{
		return [
			'name'     => 'required|max:32',
			'iso_code' => 'required|size:3',
			'sign'     => 'required|max:8',
		];
	}
}