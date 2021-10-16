<?php

namespace PhpMicroframework\Application;

use PhpMicroframework\Application\Rest\Error\ApiErrorException;
use PhpMicroframework\Application\Rest\HttpResponse;

class Core extends \PhpMicroframework\Framework\Core
{
    /**
     *  Show custom 404 Page Not Found error.
     */
    public static function error404(): void
    {
        $e = new ApiErrorException(HttpResponse::HTTP_NOT_FOUND);
        header($e->getHeaderString(), true, $e->getCode());
        exit;
    }
}
