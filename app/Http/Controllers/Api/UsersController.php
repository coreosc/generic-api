<?php

namespace App\Http\Controllers\Api;

use App\Models\Core\DeliveryAddress;
use App\Models\Core\User;
use App\Models\Transformers\DefaultTransformer;
use App\Models\Transformers\User as UserTransformer;
use Illuminate\Http\JsonResponse;

class UsersController extends InjectableApiController
{
	public function __construct(User $user, UserTransformer $userTransformer)
	{
		parent::__construct($user, $userTransformer);
	}

	public function show($id): JsonResponse
	{

		$user = User::find($id);

		return $user ? $this->respond([
			'data' => array_merge(
				$this->transformer->transformItem($user),
				[
					'delivery_addresses' => (new DefaultTransformer())
						->setMap(new DeliveryAddress())
						->transformCollection($user->deliveryAddresses()->get()->all())
				]
			)
		]) : $this->respondNotFound();
	}

}
