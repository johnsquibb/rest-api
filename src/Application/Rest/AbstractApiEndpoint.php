<?php

namespace PhpMicroframework\Application\Rest;

abstract class AbstractApiEndpoint implements ApiEndpointInterface
{
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PUT = 'PUT';
    public const METHOD_DELETE = 'DELETE';

    public function supports(string $method): bool
    {
        return match ($method) {
            self::METHOD_GET => $this->supportsGetCollection() || $this->supportsGetItem(),
            self::METHOD_POST => $this->supportsPostCollection(),
            self::METHOD_PUT => $this->supportsPutItem(),
            self::METHOD_DELETE => $this->supportsDeleteItem(),
            default => false,
        };
    }

    protected function supportsGetCollection(): bool
    {
        return false;
    }

    protected function supportsPostCollection(): bool
    {
        return false;
    }

    protected function supportsGetItem(): bool
    {
        return false;
    }

    protected function supportsPutItem(): bool
    {
        return false;
    }

    protected function supportsDeleteItem(): bool
    {
        return false;
    }
}