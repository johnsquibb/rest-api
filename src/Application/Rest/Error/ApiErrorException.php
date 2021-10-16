<?php

namespace PhpMicroframework\Application\Rest\Error;

use Exception;
use PhpMicroframework\Application\Rest\HttpResponse;

class ApiErrorException extends Exception
{
    protected string $headerString;

    public function __construct(int $code, string $message = '')
    {
        if (!array_key_exists($code, HttpResponse::MESSAGES)) {
            $code = HttpResponse::HTTP_INTERNAL_SERVER_ERROR;
        }

        $this->headerString = sprintf('HTTP/1.0 %s %s', $code, HttpResponse::MESSAGES[$code]);

        parent::__construct($message, $code);
    }

    public function getHeaderString(): string
    {
        return $this->headerString;
    }
}
