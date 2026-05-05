<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Traits;

trait TransformsResponse
{
    protected function normalizeResponse(array $response): array
    {
        // Check if it's a Standard API response (has SUCCESS key)
        if (isset($response['SUCCESS'])) {
            return $this->normalizeStandardResponse($response);
        }

        // Check if it's a Pro API response (has data key)
        if (isset($response['data'])) {
            return $this->normalizeProResponse($response);
        }

        return $response;
    }

    private function normalizeStandardResponse(array $response): array
    {
        $success = $response['SUCCESS'][0] ?? [];
        return [
            'success' => true,
            'data' => $success,
            'raw' => $response,
        ];
    }

    private function normalizeProResponse(array $response): array
    {
        return [
            'success' => true,
            'data' => $response['data'],
            'raw' => $response,
        ];
    }
}
