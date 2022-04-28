<?php

namespace Ashr\Starter\Support\Facades;

use Ashr\Starter\Services\MicroserviceServiceLayer as Service;
use Illuminate\Support\Facades\Facade;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method static userCanAccess($permission)
 * @method static responseCreated(string $module, $data = null)
 * @method static responseCreateFailed(string $module)
 * @method static responseNotFound(string $module)
 * @method static responseUpdated(string $module, $data = null)
 * @method static responseUpdateFailed(string $module)
 * @method static responseDeleted(string $module, mixed $data)
 * @method static responseDeleteFailed(string $module)
 * @method static responseUnauthorized($data = null, $header = null, $body = null, int $status = Response::HTTP_UNAUTHORIZED)
 * @method static responseUnauthenticated($data = null, $header = null, $body = null, int $status = Response::HTTP_UNAUTHORIZED)
 * @method static responseSuccess($data, $header, $body, int $status = Response::HTTP_OK)
 * @method static responseError($data, $header, $body, int $status = Response::HTTP_BAD_REQUEST)
 * @method static jsonResponse($data, $header, $body, int $status)
 */
class MicroserviceServiceLayer extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return Service::class;
    }
}