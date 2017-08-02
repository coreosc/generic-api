<?php

namespace App\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

trait ResponseWithStatusCodes
{
	/**
	 * @var int
	 */
	protected $statusCode = Response::HTTP_OK;

	/**
	 * @return int
	 */
	public final function getStatusCode(): int
	{
		return $this->statusCode;
	}

	/**
	 * @param int $statusCode
	 * @return $this
	 */
	public final function setStatusCode(int $statusCode)
	{
		$this->statusCode = $statusCode;

		return $this;
	}

	/**
	 * @param string $message
	 * @return JsonResponse
	 */
	public final function respondNotFound($message = 'Item not found!'): JsonResponse
	{
		return $this->setStatusCode(Response::HTTP_NOT_FOUND)->respondWithError($message);
	}

	/**
	 * @param string $message
	 * @return JsonResponse
	 */
	public final function respondInternalError($message = 'Internal error!'): JsonResponse
	{
		return $this->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
	}

	/**
	 * @param string $message
	 * @return JsonResponse
	 */
	public final function respondValidationError($message = 'Validation error!', array $errors = []): JsonResponse
	{
		return $this->setStatusCode(Response::HTTP_BAD_REQUEST)->respond([
			'error' => [
				'message'     => trans($message),
				'errors'      => $errors,
				'status_code' => $this->getStatusCode()
			]
		]);
	}

	/**
	 * @param $data
	 * @return JsonResponse
	 */
	public final function respondCreated($data): JsonResponse
	{
		return $this->setStatusCode(Response::HTTP_CREATED)->respond($data);
	}

	/**
	 * @param $data
	 * @param array $headers
	 * @return JsonResponse
	 */
	public final function respond($data, $headers = []): JsonResponse
	{
		return response()->json($data, $this->getStatusCode(), $headers);
	}

	/**
	 * @param LengthAwarePaginator $items
	 * @param $data
	 * @return JsonResponse
	 */
	protected final function respondWithPagination(LengthAwarePaginator $items, $data): JsonResponse
	{
		$data = array_merge($data, [
			'paginator' => [
				'total_count'  => $items->total(),
				'total_pages'  => ceil($items->total() / $items->perPage()),
				'current_page' => $items->currentPage(),
				'limit'        => $items->perPage()
			]
		]);

		return $this->respond($data);
	}

	/**
	 * @param $message
	 * @return JsonResponse
	 */
	public final function respondWithError($message): JsonResponse
	{
		return $this->respond([
			'error' => [
				'message'     => trans($message),
				'status_code' => $this->getStatusCode()
			]
		]);
	}

	public final function respondWithMethodNotFound($message = 'Method not found!'): JsonResponse
	{
		return $this->setStatusCode(Response::HTTP_METHOD_NOT_ALLOWED)->respondWithError($message);
	}
}