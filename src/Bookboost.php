<?php

namespace Bookboost\PhpSdk;

use Bookboost\PhpSdk\Services\Signature;

/**
 * Class Bookboost
 * @property string $apiKey
 * @method Signature signature($data)
 */
class Bookboost
{
    public $signature = null;

    public function __construct(string $apiKey)
    {
        $this->signature = new Signature($apiKey);
    }
}
