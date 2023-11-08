<?php

namespace Bookboost\Abstractions;

abstract class Service
{
    protected $apiKey = null;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }
}
