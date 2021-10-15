<?php

namespace PhpMicroframework\Application\Repository;

interface RepositoryInterface
{
    public function getCollection(array $filters): array;

    public function getItemById(string $id): array;

    public function createItem(array $data): array;

    public function updateItem(string $id, array $data): array;

    public function deleteItemById(string $id): void;
}