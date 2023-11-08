<?php

namespace Bookboost;

use Bookboost\Services\Signature;

/**
 * Class Bookboost
 * @property string $apiKey
 * @method Signature signature($data)
 */
class Sdk
{
    public $signature = null;

    public function __construct(string $apiKey)
    {
        $this->signature = new Signature($apiKey);
    }
}
