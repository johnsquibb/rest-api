<?php

namespace PhpMicroframework\Application\Rest;

use JsonException;
use PhpMicroframework\Application\Rest\Error\ApiErrorException;
use PhpMicroframework\Framework\Controller\Response\JsonResponse;
use PhpMicroframework\Framework\Controller\Response\ResponseInterface;

class ApiEndpointHandler
{
    public function handle(ApiEndpointInterface $endpoint, ?string $resourceId): ResponseInterface
    {
        $method = $_SERVER['REQUEST_METHOD'];
        try {
            if (!$endpoint->supports($method)) {
                throw new ApiErrorException(HttpResponse::HTTP_METHOD_NOT_ALLOWED);
            }

            return match ($method) {
                AbstractApiEndpoint::METHOD_GET => $this->handleGet($endpoint, $resourceId),
                AbstractApiEndpoint::METHOD_POST => $this->handlePost($endpoint),
                AbstractApiEndpoint::METHOD_PUT => $this->handlePut($endpoint, $resourceId),
                AbstractApiEndpoint::METHOD_DELETE => $this->handleDelete($endpoint, $resourceId),
                default => new JsonResponse([]),
            };
        } catch (ApiErrorException $e) {
            header($e->getMessage(), true, $e->getCode());
            return new JsonResponse(['error' => $e->getMessage()]);
        }
    }

    private function handlePost(ApiEndpointInterface $endpoint): ResponseInterface
    {
        $body = $this->getBodyUnserialized();
        return $endpoint->postCollection($body);
    }

    private function handleDelete(
        ApiEndpointInterface $endpoint,
        ?string $resourceId
    ): ResponseInterface {
        if ($resourceId === null) {
            throw new ApiErrorException(HttpResponse::HTTP_BAD_REQUEST);
        }

        try {
            $endpoint->deleteItem($resourceId);
        } catch (ApiErrorException $e) {
            if ($e->getCode() !== HttpResponse::HTTP_GONE) {
                throw $e;
            }

            header($e->getMessage(), true, $e->getCode());
        }

        return new JsonResponse([]);
    }

    private function handlePut(
        ApiEndpointInterface $endpoint,
        ?string $resourceId
    ): ResponseInterface {
        if ($resourceId === null) {
            throw new ApiErrorException(HttpResponse::HTTP_BAD_REQUEST);
        }
        $body = $this->getBodyUnserialized();
        return $endpoint->putItem($resourceId, $body);
    }

    private function handleGet(
        ApiEndpointInterface $endpoint,
        ?string $resourceId
    ): ResponseInterface {
        if (isset($resourceId)) {
            return $endpoint->getItem($resourceId);
        }

        $filters = $this->getFilters($endpoint);

        return $endpoint->getCollection($filters);
    }

    private function getFilters(ApiEndpointInterface $endpoint): array
    {
        return $endpoint->sanitizeFilters($_GET);
    }

    private function getBodyUnserialized(): array
    {
        $content = file_get_contents('php://input');
        if (empty($content)) {
            return [];
        }

        try {
            return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            throw new ApiErrorException(HttpResponse::HTTP_BAD_REQUEST);
        }
    }
}
