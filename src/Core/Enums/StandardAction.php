<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Core\Enums;

enum StandardAction: string
{
    case ACCOUNT_INFO = 'accountinfo';
    case IMEI_SERVICE_LIST = 'imeiservicelist';
    case PLACE_IMEI_ORDER = 'placeimeiorder';
    case PLACE_IMEI_ORDER_BULK = 'placeimeiorderbulk';
    case GET_IMEI_ORDER = 'getimeiorder';
    case GET_IMEI_ORDER_BULK = 'getimeiorderbulk';
}
