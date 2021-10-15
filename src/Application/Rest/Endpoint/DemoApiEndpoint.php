<?php

namespace PhpMicroframework\Application\Rest\Endpoint;

use PhpMicroframework\Application\Repository\DemoRepository;
use PhpMicroframework\Application\Rest\AbstractApiEndpoint;
use PhpMicroframework\Application\Rest\Error\ApiErrorException;
use PhpMicroframework\Application\Rest\HttpResponse;
use PhpMicroframework\Application\Rest\Supports\SupportsDeleteItemTrait;
use PhpMicroframework\Application\Rest\Supports\SupportsGetCollectionTrait;
use PhpMicroframework\Application\Rest\Supports\SupportsPostCollectionTrait;
use PhpMicroframework\Application\Rest\Supports\SupportsPutItemTrait;
use PhpMicroframework\Framework\Controller\Response\JsonResponse;
use PhpMicroframework\Framework\Controller\Response\ResponseInterface;

class DemoApiEndpoint extends AbstractApiEndpoint
{
    use SupportsGetCollectionTrait;
    use SupportsPostCollectionTrait;
    use SupportsPutItemTrait;
    use SupportsDeleteItemTrait;

    private DemoRepository $demoRepository;

    public function __construct()
    {
        $this->demoRepository = new DemoRepository();
    }

    public function getCollection(array $filters): ResponseInterface
    {
        return new JsonResponse($this->demoRepository->getCollection($filters));
    }

    public function getItem(string $resourceId): ResponseInterface
    {
        return new JsonResponse($this->demoRepository->getItemById($resourceId));
    }

    public function postCollection(array $context): ResponseInterface
    {
        return new JsonResponse($this->demoRepository->createItem($context));
    }

    public function putItem(string $resourceId, array $context): ResponseInterface
    {
        return new JsonResponse($this->demoRepository->updateItem($resourceId, $context));
    }

    public function deleteItem(string $resourceId): void
    {
        $this->demoRepository->deleteItemById($resourceId);
        throw new ApiErrorException(HttpResponse::HTTP_GONE);
    }

    public function sanitizeFilters(array $filters): array
    {
        $sanitized = [];

        foreach ($filters as $key => $value) {
            switch ($key) {
                case 'foo':
                    $sanitized['foo4'] = substr((string)$value, 0, 4);
                    break;
                case 'bar':
                    $parts = explode('-', (string)$value);

                    foreach ($parts as &$part) {
                        $part = strtoupper(substr($part, 0, 3));
                    }
                    unset($part);

                    $sanitized['barSplit'] = $parts;
                    break;
            }
        }

        return $sanitized;
    }
}