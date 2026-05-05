<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Core\Drivers;

use ShamimStack\ServerTheme\Core\Contracts\DhruFusionInterface;
use ShamimStack\ServerTheme\Traits\HandlesFeedback;
use ShamimStack\ServerTheme\Traits\ValidatesPayload;

abstract class AbstractDriver implements DhruFusionInterface
{
    use HandlesFeedback, ValidatesPayload;

    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }
}
