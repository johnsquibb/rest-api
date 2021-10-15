<?php

declare(strict_types=1);

namespace PhpMicroframework\Application\Controller;

use PhpMicroframework\Application\Rest\ApiEndpointHandler;
use PhpMicroframework\Application\Rest\Endpoint\DemoApiEndpoint;
use PhpMicroframework\Framework\Controller\ControllerInterface;
use PhpMicroframework\Framework\Controller\Response\JsonResponse;
use PhpMicroframework\Framework\Controller\Response\ResponseInterface;

class ApiController implements ControllerInterface
{
    private ApiEndpointHandler $handler;

    public function __construct()
    {
        $this->handler = new ApiEndpointHandler();
    }

    public function index(): ResponseInterface
    {
        return new JsonResponse(['resources' => [
            'demo' => '/api/demo',
        ]]);
    }

    public function demo(?string $resourceId = null): ResponseInterface
    {
        $endpoint = new DemoApiEndpoint();

        return $this->handler->handle($endpoint, $resourceId);
    }
}
