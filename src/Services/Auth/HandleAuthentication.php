<?php

namespace Ashr\Starter\Services\Auth;

use Illuminate\Http\Client\Response;

/**
 * @property \Illuminate\Http\Client\PendingRequest $request
 */
trait HandleAuthentication
{
    /**
     * Handle refresh bearer token user
     *
     * @return \Illuminate\Http\Client\Response
     */
    protected function refreshToken(): Response
    {
        return $this->request->get($this->config['refresh_token_path']);
    }
}