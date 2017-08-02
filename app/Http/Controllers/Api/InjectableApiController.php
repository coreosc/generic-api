<?php
namespace App\Http\Controllers\Api;

use App\Http\Requests\BaseStoreRequest;
use App\Http\Requests\BaseUpdateRequest;
use App\Models\Transformers\Transformer;
use Illuminate\Database\Eloquent\Model;

abstract class InjectableApiController extends ApiController
{
	protected $storeRequestClass = BaseStoreRequest::class;
	protected $updateRequestClass = BaseUpdateRequest::class;

	public function __construct(Model $resource, Transformer $transformer = null)
	{
		app()->bind(BaseStoreRequest::class, $this->storeRequestClass);
		app()->bind(BaseUpdateRequest::class, $this->updateRequestClass);
		parent::__construct($resource, $transformer);
	}

}