<?php

namespace Bookboost\PhpSdk\Tests;

use Bookboost\PhpSdk\Bookboost;

class BaseTest extends TestCase
{
    public function testBase()
    {
        $facade = new Bookboost($this->apiKey);

        $this->assertObjectHasProperty('signature', $facade);
    }
}
