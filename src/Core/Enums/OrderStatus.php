<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Core\Enums;

enum OrderStatus: string
{
    case SUCCESS = 'success';
    case REJECTED = 'rejected';
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case ERROR = 'error';
}
