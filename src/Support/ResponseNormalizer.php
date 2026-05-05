<?php
declare(strict_types=1);

namespace ShamimStack\ServerTheme\Support;

use ShamimStack\ServerTheme\DTOs\Common\AccountInfo;
use ShamimStack\ServerTheme\DTOs\Common\OrderResult;
use ShamimStack\ServerTheme\DTOs\Common\Service;
use ShamimStack\ServerTheme\Exceptions\ResponseMappingException;

final class ResponseNormalizer
{
    public static function toCommonAccountInfo(array $source): AccountInfo
    {
        if (isset($source['SUCCESS'][0])) {
            $data = $source['SUCCESS'][0];
            return new AccountInfo(
                balance: (float) ($data['balance'] ?? 0),
                currency: $data['currency'] ?? 'USD',
                name: $data['name'] ?? 'Unknown',
                email: $data['email'] ?? '',
                apiVersion: 'standard',
                raw: $source,
            );
        } elseif (isset($source['data'])) {
            $data = $source['data'];
            return new AccountInfo(
                balance: (float) ($data['balance'] ?? 0),
                currency: $data['currency'] ?? 'USD',
                name: $data['name'] ?? 'Unknown',
                email: $data['email'] ?? '',
                apiVersion: 'pro',
                raw: $source,
            );
        }

        throw ResponseMappingException::unknownSource();
    }

    public static function toCommonServiceList(array $data): array
    {
        if (isset($data['products'])) {
            return self::mapProProductsToServices($data);
        } elseif (isset($data['SUCCESS'][0]['services'])) {
            return self::mapStandardServices($data);
        }

        return [];
    }

    private static function mapProProductsToServices(array $data): array
    {
        $services = [];
        $categories = $data['categories'] ?? [];

        foreach ($data['products'] as $uuid => $product) {
            $categoryNames = array_map(
                fn(string $cid) => $categories[$cid]['name'] ?? $cid,
                $product['cids'] ?? []
            );

            $services[] = new Service(
                id: $uuid,
                name: $product['name'] ?? 'Unknown',
                type: $product['type'] ?? 'digital',
                price: (float) ($product['price'] ?? 0),
                currency: $data['currency'] ?? 'USD',
                categories: $categoryNames,
                fields: $product['fields'] ?? [],
                raw: $product,
            );
        }

        return $services;
    }

    private static function mapStandardServices(array $data): array
    {
        $services = [];
        $serviceList = $data['SUCCESS'][0]['services'] ?? [];

        foreach ($serviceList as $service) {
            $services[] = new Service(
                id: (string) ($service['service_id'] ?? ''),
                name: $service['name'] ?? 'Unknown',
                type: 'imei',
                price: (float) ($service['price'] ?? 0),
                currency: $data['SUCCESS'][0]['currency'] ?? 'USD',
                categories: [$service['category'] ?? 'General'],
                raw: $service,
            );
        }

        return $services;
    }

    public static function toCommonOrderResult(array $data): OrderResult
    {
        if (isset($data['SUCCESS'][0])) {
            $orderData = $data['SUCCESS'][0];
            return OrderResult::success([
                'order_id' => $orderData['order_id'] ?? '',
                'status' => $orderData['status'] ?? 'pending',
                'reference_id' => $orderData['reference_id'] ?? null,
                'amount' => $orderData['amount'] ?? null,
                'currency_code' => $orderData['currency'] ?? null,
                'message' => $orderData['message'] ?? null,
            ]);
        } elseif (isset($data['data'])) {
            $orderData = $data['data'];
            return OrderResult::success([
                'order_uuid' => $orderData['order_uuid'] ?? '',
                'status' => $orderData['status'] ?? 'pending',
                'reference_id' => $orderData['reference_id'] ?? null,
                'amount' => $orderData['amount'] ?? null,
                'currency_code' => $orderData['currency'] ?? null,
                'message' => $orderData['message'] ?? null,
            ]);
        }

        return OrderResult::failed('Unknown order response format', $data);
    }

    public static function toCommonBulkOrderResults(array $data): array
    {
        $results = [];
        
        if (isset($data['SUCCESS'])) {
            foreach ($data['SUCCESS'] as $item) {
                $results[] = self::toCommonOrderResult(['SUCCESS' => [$item]]);
            }
        } elseif (isset($data['data']['orders'])) {
            foreach ($data['data']['orders'] as $order) {
                $results[] = self::toCommonOrderResult(['data' => $order]);
            }
        }

        return $results;
    }
}
