<?php

namespace PhpMicroframework\Application\Rest;

final class HttpResponse
{
    public const HTTP_INTERNAL_SERVER_ERROR = 500;
    public const HTTP_BAD_REQUEST = 400;
    public const HTTP_METHOD_NOT_ALLOWED = 405;
    public const HTTP_GONE = 410;

    public const MESSAGES = [
        // 500s
        self::HTTP_INTERNAL_SERVER_ERROR => 'Internal Server Error',
        // 400s
        self::HTTP_BAD_REQUEST => 'Bad Request',
        self::HTTP_METHOD_NOT_ALLOWED => 'Method Not Allowed',
        self::HTTP_GONE => 'Gone',
    ];
}
