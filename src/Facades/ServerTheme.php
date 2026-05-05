<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Facades;

use Illuminate\Support\Facades\Facade;

class ServerTheme extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'servertheme';
    }
}
