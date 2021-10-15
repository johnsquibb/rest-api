<?php

namespace PhpMicroframework\Application\Rest\Error;

use Exception;
use PhpMicroframework\Application\Rest\HttpResponse;

class ApiErrorException extends Exception
{
    public function __construct(int $code)
    {
        if (!array_key_exists($code, HttpResponse::MESSAGES)) {
            $code = HttpResponse::HTTP_INTERNAL_SERVER_ERROR;
        }

        $message = sprintf('HTTP/1.0 %s %s', $code, HttpResponse::MESSAGES[$code]);

        parent::__construct($message, $code);
    }
}