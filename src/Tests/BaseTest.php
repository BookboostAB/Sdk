<?php

namespace Bookboost\Tests;

use Bookboost\Sdk;

class BaseTest extends TestCase
{
    public function testBase()
    {
        $facade = new Sdk($this->apiKey);

        $this->assertObjectHasProperty('signature', $facade);
    }
}
