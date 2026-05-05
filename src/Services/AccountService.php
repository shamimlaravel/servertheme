<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Services;

use ShamimStack\ServerTheme\Core\Client;
use ShamimStack\ServerTheme\DTOs\Common\AccountInfo;

class AccountService
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getInfo(): AccountInfo
    {
        return $this->client->getAccountInfo();
    }

    public function getBalance(): float
    {
        return $this->client->getAccountInfo()->balance;
    }

    public function getFormattedBalance(): string
    {
        return $this->client->getAccountInfo()->formattedBalance();
    }
}
