<?php

namespace PhpMicroframework\Application\Rest;

use PhpMicroframework\Framework\Controller\Response\ResponseInterface;

interface ApiEndpointInterface
{
    public function supports(string $method): bool;

    public function getCollection(array $filters): ResponseInterface;

    public function getItem(string $resourceId): ResponseInterface;

    public function postCollection(array $context): ResponseInterface;

    public function putItem(string $resourceId, array $context): ResponseInterface;

    public function deleteItem(string $resourceId): void;

    public function sanitizeFilters(array $filters): array;
}
