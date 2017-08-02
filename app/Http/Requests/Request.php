<?php

namespace App\Http\Requests;

use App\Http\ResponseWithStatusCodes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

abstract class Request extends FormRequest
{

	use ResponseWithStatusCodes;

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(): bool
	{
		return true;
	}

	public abstract function rules(): array;

	/**
	 * @param array $errors
	 * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function response(array $errors)
	{
		if ($this->is(config('coreoshop.api_prefix') . '/*')) {
			return $this->respondValidationError(collect($errors)->flatten(1)->implode(", "), $errors);
		}

		return parent::response($errors);
	}

}
