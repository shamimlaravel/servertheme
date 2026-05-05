<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Core\Enums;

enum ProEndpoint: string
{
    case ACCOUNT = '/account';
    case PRODUCTS = '/products';
    case ORDER = '/order';
}
