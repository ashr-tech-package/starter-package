<?php

namespace Ashr\Starter\Services\Auth;

use Illuminate\Http\Client\Response;

/**
 * @property \Illuminate\Http\Client\PendingRequest $request
 */
trait HandleAuthorization
{
    /**
     * Handle check access to auth service
     *
     * @param string $permission
     * @return \Illuminate\Http\Client\Response
     */
    protected function userCanAccess(string $permission): Response
    {
        $path = sprintf('%s%s', $this->config['access_user_path'], $permission);

        return $this->request->get($path);
    }
}