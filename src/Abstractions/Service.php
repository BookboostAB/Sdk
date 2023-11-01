<?php

namespace Bookboost\PhpSdk\Abstractions;

use Bookboost\PhpSdk\Services\Signature;

abstract class Service
{
    protected $apiKey = null;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }
}
