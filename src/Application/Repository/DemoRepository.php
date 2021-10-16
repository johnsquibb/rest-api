<?php

namespace PhpMicroframework\Application\Repository;

class DemoRepository implements RepositoryInterface
{
    public function getCollection(array $filters): array
    {
        return [
            'items' => [
                [
                    'resourceId' => 'abc123',
                    'foo_sanitized' => $filters['foo4'] ?? 'supply ?foo=[string123], get "stri"',
                    'bar_sanitized' => $filters['barSplit'] ?? 'supply ?bar[string-string-string], get [STR, STR, STR]',
                ],
                [
                    'resourceId' => 'def456',
                ]
            ]
        ];
    }

    public function getItemById(string $id): array
    {
        return match ($id) {
            'abc' => [
                'id' => $id,
            ],
            default => [],
        };
    }

    public function createItem(array $data): array
    {
        return [
            'id' => 'ghi789',
        ];
    }

    public function updateItem(string $id, array $data): array
    {
        return [
            'id' => $id,
            'updated' => true,
        ];
    }

    public function deleteItemById(string $id): void
    {
        // Delete logic here.
    }
}
