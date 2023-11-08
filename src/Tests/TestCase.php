<?php
namespace Bookboost\Tests;
abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected $apiKey = null;
    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->apiKey = 'test-api-key';
    }
}
