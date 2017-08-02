<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\BaseStoreRequest;
use App\Http\Requests\BaseUpdateRequest;
use App\Http\ResponseWithStatusCodes;
use App\Models\Transformers\DefaultTransformer;
use App\Models\Transformers\Transformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\Model;

abstract class ApiController extends BaseController
{
	use ResponseWithStatusCodes;
	/**
	 * @var \App\Models\Transformers\Transformer
	 */
	protected $transformer;

	/**
	 * @var Model
	 */
	protected $resource;

	public function __construct(Model $resource, Transformer $transformer = null)
	{
		$this->resource = $resource;
		$this->transformer = $transformer;

		if ($this->transformer == null) {
			$this->transformer = new DefaultTransformer();
			$this->transformer->setMap($this->resource);
		}
	}

	/**
	 * @return JsonResponse
	 */
	protected function index(): JsonResponse
	{
		$items = $this->resource->paginate(20);

		return $this->respondWithPagination($items, [
			'data' => $this->transformer->transformCollection($items->all())
		]);
	}

	/**
	 * @param $id
	 * @return JsonResponse
	 */
	public function show($id): JsonResponse
	{
		$item = $this->resource->find($id);

		return $item ? $this->respond([
			'data' => $this->transformer->transformItem($item)
		]) : $this->respondNotFound();
	}

	/**
	 * @param BaseStoreRequest $request
	 * @return JsonResponse
	 */
	public function store(BaseStoreRequest $request): JsonResponse
	{
		return $this->respondCreated([
			'data' => $this->transformer->transformItem(
				$this->resource->create($this->transformer->transformReverse($request->all()))
			)
		]);
	}

	/**
	 * @param $id
	 * @param BaseUpdateRequest $request
	 * @param array $exceptions
	 * @return JsonResponse
	 */
	public function update($id, BaseUpdateRequest $request, array $exceptions = []): JsonResponse
	{
		$item = $this->resource->find($id);

		if (!$item) {
			return$this->respondNotFound();

		}

		$item->update($this->transformer->transformReverse($request->except($exceptions)));

		return $this->respond(['data' => $this->transformer->transformItem($item)]);
	}

	/**
	 * @param $id
	 * @return JsonResponse
	 */
	public function destroy($id): JsonResponse
	{
		return $this->respondWithMethodNotFound();
	}

}