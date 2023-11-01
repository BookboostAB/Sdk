<?php

namespace Bookboost\PhpSdk\Tests\Unit\Signature;

use Bookboost\PhpSdk\Bookboost;
use Bookboost\PhpSdk\Exceptions\InvalidUrl;
use Bookboost\PhpSdk\Services\Signature;
use Bookboost\PhpSdk\Tests\TestCase;

class SignatureTest extends TestCase
{
    private $service = null;
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->service = (new Bookboost($this->apiKey))->signature;
    }

    public function testItWillNotSignInvalidUrl()
    {
        $invalidUrl = '/staging-ang.bookboost.io/#reservations?t=2&page=1&limit=12&ijij=null&somethingelse=gdsgds&a=1';

        $this->expectException(InvalidUrl::class);
        $this->service->signUrl($invalidUrl);
    }

    public function testItWillSignValidUrl()
    {
        $invalidUrl = 'https://staging-ang.bookboost.io/reservations?t=2&page=1&limit=12&ijij=null&somethingelse=gdsgds&a=1';

        $signature = $this->service->signUrl($invalidUrl);

        $this->assertNotEmpty($signature);
    }

    public function testItWillSortQueryParams()
    {
        $firstUrl = 'https://staging-ang.bookboost.io/reservations?t=2&page=1&limit=12&ijij=null&somethingelse=gdsgds&a=1';
        $secondUrl = 'https://staging-ang.bookboost.io/reservations?somethingelse=gdsgds&a=1&limit=12&t=2&page=1&ijij=null';

        $firstSig = $this->service->signUrl($firstUrl);
        $secondSig = $this->service->signUrl($secondUrl);

        $this->assertEquals($firstSig, $secondSig);
    }

    public function testItWillSignValidUriWithoutQueryParams()
    {
        $url = 'https://staging-ang.bookboost.io/reservations';

        $this->assertNotNull($this->service->signUrl($url));
    }

    public function testItWillStrictlyCompareEmptyParams()
    {
        $firstUrl = 'https://staging-ang.bookboost.io/reservations?p2=&p1=null';
        $secondUrl = 'https://staging-ang.bookboost.io/reservations?p2=null&p1=';

        $firstSig = $this->service->signUrl($firstUrl);
        $secondSig = $this->service->signUrl($secondUrl);

        $this->assertNotEquals($firstSig, $secondSig);

        $firstUrl = 'https://staging-ang.bookboost.io/reservations?p2=&p1=null';
        $secondUrl = 'https://staging-ang.bookboost.io/reservations?p1=null&p2=';

        $firstSig = $this->service->signUrl($firstUrl);
        $secondSig = $this->service->signUrl($secondUrl);

        $this->assertEquals($firstSig, $secondSig);
    }
}
