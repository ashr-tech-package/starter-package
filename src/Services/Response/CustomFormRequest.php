<?php

namespace Ashr\Starter\Services\Response;

use Ashr\Starter\Support\Facades\MicroserviceServiceLayer;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CustomFormRequest extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     * @throws ValidationException
     */
    public function failedValidation(Validator $validator)
    {
        $response = MicroserviceServiceLayer::jsonResponse(
            $validator->errors(),
            $this->messageHeader(),
            $this->messageBody(),
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl())
            ->status(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function messageHeader(): string
    {
        return trans('ashr-starter::message.error.validation.header');
    }

    public function messageBody(): string
    {
        return trans('ashr-starter::message.error.validation.body');
    }
}