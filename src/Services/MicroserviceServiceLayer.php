<?php

namespace Ashr\Starter\Services;

use Ashr\Starter\Services\Auth\HandleAuthentication;
use Ashr\Starter\Services\Auth\HandleAuthorization;
use Ashr\Starter\Services\Response\HandleResponse;
use BadMethodCallException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Traits\Macroable;


class MicroserviceServiceLayer
{
    use Macroable {
        __call as macroCall;
    }
    use HandleAuthorization;
    use HandleAuthentication;
    use HandleResponse;

    public static $escapedMethods = [
        'createRequestInstance'
    ];

    /**
     * Instance of \Illuminate\Http\Client\PendingRequest to make the request.
     *
     * @var \Illuminate\Http\Client\PendingRequest
     */
    protected PendingRequest $request;

    /**
     * Create a new instance class.
     *
     * @param array $config
     * @return void
     */
    public function __construct(protected array $config)
    {
        $this->createRequestInstance();
    }

    /**
     * Create Laravel HTTP client request instance.
     *
     * @return void
     */
    public function createRequestInstance()
    {
        $this->request = Http::baseUrl($this->config['auth_base_url'])
            ->withToken(request()->bearerToken() ?? '');
    }

    /**
     * @param $method
     * @param $parameters
     * @return mixed
     *
     * @throws BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        if (in_array($method, static::$escapedMethods, true)) {
            throw new BadMethodCallException(sprintf(
                'Method %s::%s is in the escaped method list.', static::class, $method
            ));
        }

        return $this->{$method}(...$parameters);
    }
}