<?php
namespace App\Http\Requests\Currency;

use App\Http\Requests\BaseUpdateRequest;

class CurrencyUpdateRequest extends BaseUpdateRequest
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