<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Currency\CurrencyStoreRequest;
use App\Http\Requests\Currency\CurrencyUpdateRequest;
use App\Models\Core\Currency;

class CurrenciesController extends InjectableApiController
{
	protected $storeRequestClass = CurrencyStoreRequest::class;
	protected $updateRequestClass = CurrencyUpdateRequest::class;

	public function __construct(Currency $currency)
	{
		parent::__construct($currency);
	}
}
