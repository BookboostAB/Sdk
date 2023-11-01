<?php

namespace Bookboost\PhpSdk\Services;

use Bookboost\PhpSdk\Exceptions\InvalidUrl;
use Throwable;
use Bookboost\PhpSdk\Abstractions\Service;

class Signature extends Service
{
    /**
     * @throws InvalidUrl
     */
    public function signUrl(string $data): string
    {
        if (!filter_var($data, FILTER_VALIDATE_URL)) {
            throw new InvalidUrl('Data provided is not a valid URL');
        }

        $parsedUrl = parse_url($data);
        parse_str($parsedUrl['query'] ?? null, $result);

        $keys = array_keys($result);

        array_multisort($keys, SORT_ASC, $result);

        $uri = urldecode(($parsedUrl['scheme'] ?? '') . '://' . ($parsedUrl['host'] ?? '') . ($parsedUrl['path'] ?? '') . '?' . http_build_query($result));

        return $this->encode($uri);
    }

    private function encode(string $data): string
    {
        return hash_hmac('sha256', $data, $this->apiKey);
    }
}
