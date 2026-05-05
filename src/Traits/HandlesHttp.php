<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Traits;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use ShamimStack\ServerTheme\Exceptions\ServerThemeException;

trait HandlesHttp
{
    protected function executeRequest(
        string $method,
        string $url,
        array $data = [],
        array $query = [],
        ?string $token = null
    ): array {
        $request = Http::timeout($this->config['timeout'] ?? 30)
            ->retry($this->config['retries'] ?? 3, 100)
            ->withHeaders([
                'Accept' => 'application/json',
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
            ]);

        if ($token) {
            $request = $request->withToken($token);
        }

        $response = match (strtolower($method)) {
            'get' => $request->get($url, $query),
            'post' => $request->post($url, $data),
            default => throw new ServerThemeException("Unsupported HTTP method: {$method}"),
        };

        return $this->parseResponse($response);
    }

    private function parseResponse(Response $response): array
    {
        if ($response->successful()) {
            return $response->json() ?: [];
        }

        throw new ServerThemeException(
            message: $response->json('message') ?? $response->body(),
            code: $response->status(),
            apiResponse: $response->json()
        );
    }
}
