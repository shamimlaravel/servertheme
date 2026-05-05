<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Services;

use ShamimStack\ServerTheme\Core\Client;
use ShamimStack\ServerTheme\DTOs\Common\Service;

class ProductService
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Service[]
     */
    public function getAll(?string $categoryId = null): array
    {
        return $this->client->getServices($categoryId);
    }

    public function findById(string $id): ?Service
    {
        $services = $this->getAll();
        foreach ($services as $service) {
            if ($service->id === $id) {
                return $service;
            }
        }
        return null;
    }

    public function filterByCategory(string $category): array
    {
        return array_filter($this->getAll(), fn(Service $s) => in_array($category, $s->categories));
    }
}
