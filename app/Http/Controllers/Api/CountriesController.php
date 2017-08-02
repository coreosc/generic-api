<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\BaseStoreRequest;
use App\Http\Requests\BaseUpdateRequest;
use App\Models\Core\Country;
use Illuminate\Http\JsonResponse;

class CountriesController extends InjectableApiController
{

	public function __construct(Country $country)
	{
		parent::__construct($country);
	}

	public function update($id, BaseUpdateRequest $request, array $exceptions = []): JsonResponse
	{
		return $this->respondWithMethodNotFound();
	}

	public function store(BaseStoreRequest $request): JsonResponse
	{
		return $this->respondWithMethodNotFound();
	}
}
