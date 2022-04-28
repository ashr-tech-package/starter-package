<?php

namespace Ashr\Starter\Services\Response;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait HandleResponse
{
    /**
     * Handle response created data
     *
     * @param string $module
     * @param $data
     * @return JsonResponse
     */
    protected function responseCreated(string $module, $data = null): JsonResponse
    {
        return $this->jsonResponse(
            $data,
            trans('ashr-starter::message.success.store.header'),
            trans('ashr-starter::message.success.store.body', compact('module')),
            Response::HTTP_CREATED
        );
    }

    /**
     * Handle response create data failed
     *
     * @param string $module
     * @return JsonResponse
     */
    protected function responseCreateFailed(string $module): JsonResponse
    {
        return $this->jsonResponse(
            [],
            trans('ashr-starter::message.error.store.header'),
            trans('ashr-starter::message.error.store.body', compact('module')),
            Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * Handle response data not found
     *
     * @param string $module
     * @return JsonResponse
     */
    protected function responseNotFound(string $module): JsonResponse
    {
        return $this->jsonResponse(
            [],
            trans('ashr-starter::message.error.not-found.header'),
            trans('ashr-starter::message.error.not-found.body', compact('module')),
            Response::HTTP_NOT_FOUND
        );
    }

    /**
     * Handle response updated data
     *
     * @param string $module
     * @param $data
     * @return JsonResponse
     */
    protected function responseUpdated(string $module, $data = null): JsonResponse
    {
        return $this->jsonResponse(
            $data,
            trans('ashr-starter::message.success.update.header'),
            trans('ashr-starter::message.success.update.body', compact('module')),
            Response::HTTP_OK
        );
    }

    /**
     * Handle response update data failed
     *
     * @param string $module
     * @return JsonResponse
     */
    protected function responseUpdatedFailed(string $module): JsonResponse
    {
        return $this->jsonResponse(
            [],
            trans('ashr-starter::message.error.update.header'),
            trans('ashr-starter::message.error.update.body', compact('module')),
            Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * Handle response deleted data
     *
     * @param string $module
     * @param mixed $data
     * @return JsonResponse
     */
    protected function responseDeleted(string $module, mixed $data = []): JsonResponse
    {
        return $this->jsonResponse(
            $data,
            trans('ashr-starter::message.success.delete.header'),
            trans('ashr-starter::message.success.delete.body', compact('module')),
            Response::HTTP_OK
        );
    }

    /**
     * Handle response delete data failed
     *
     * @param string $module
     * @return JsonResponse
     */
    protected function responseDeleteFailed(string $module): JsonResponse
    {
        return $this->jsonResponse(
            [],
            trans('ashr-starter::message.error.delete.header'),
            trans('ashr-starter::message.error.delete.body', compact('module')),
            Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * Handle response if user unauthorized
     *
     * @param $data
     * @param $header
     * @param $body
     * @param int $status
     * @return JsonResponse
     */
    protected function responseUnauthorized($data = null, $header = null, $body = null, int $status = Response::HTTP_UNAUTHORIZED): JsonResponse
    {
        return $this->jsonResponse(
            $data,
            $header,
            $body,
            $status
        );
    }

    /**
     * Handle response if user unauthenticated
     *
     * @param $data
     * @param $header
     * @param $body
     * @param int $status
     * @return JsonResponse
     */
    protected function responseUnauthenticated($data = null, $header = null, $body = null, int $status = Response::HTTP_FORBIDDEN): JsonResponse
    {
        return $this->jsonResponse(
            $data,
            $header,
            $body,
            $status
        );
    }

    /**
     * Handle common success response
     *
     * @param $data
     * @param $header
     * @param $body
     * @param int $status
     * @return JsonResponse
     */
    protected function responseSuccess($data, $header, $body, int $status = Response::HTTP_OK): JsonResponse
    {
        return $this->jsonResponse(
            $data,
            $header,
            $body,
            $status
        );
    }

    /**
     * Handle common error response
     *
     * @param $data
     * @param $header
     * @param $body
     * @param int $status
     * @return JsonResponse
     */
    protected function responseError($data, $header, $body, int $status = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return $this->jsonResponse(
            $data,
            $header,
            $body,
            $status
        );
    }

    /**
     * Handle microservice JsonResponse
     *
     * @param $data
     * @param $header
     * @param $body
     * @param int $status
     * @return JsonResponse
     */
    protected function jsonResponse($data, $header, $body, int $status): JsonResponse
    {
        $errorCode = [400, 401, 403, 422, 500];

        $response = [
            'data' => $data,
            'message' => [
                'header' => $header,
                'body' => $body
            ]
        ];

        // change key data with errors
        if (in_array($status, $errorCode, true)) {
            unset($response['data']);
            $response['errors'] = $data;
        }

        return response()->json($response, $status);
    }
}