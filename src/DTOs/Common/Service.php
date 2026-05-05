<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\DTOs\Common;

final readonly class Service
{
    public function __construct(
        public string $id,
        public string $name,
        public string $type,
        public float $price,
        public string $currency,
        public array $categories = [],
        public array $fields = [],
        public array $raw = [],
    ) {}
}
