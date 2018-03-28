<?php

namespace AllDigitalRewards\FIS;

use AllDigitalRewards\FIS\Entity\ZeroPurseRequest;
use PHPUnit\Framework\TestCase;

class ZeroPurseRequestTest extends TestCase
{

    public function test_request_is_valid()
    {
        $zeroPurseRequest = new ZeroPurseRequest();
        // Proxy key should be 13 chars.
        $zeroPurseRequest->setProxyKey('01234567890123');

        $this->assertTrue($zeroPurseRequest->isValid());
    }

    public function test_request_is_not_valid()
    {
        $zeroPurseRequest = new ZeroPurseRequest();
        // Proxy key should be 13 chars.
        $zeroPurseRequest->setProxyKey('0');

        $this->assertFalse($zeroPurseRequest->isValid());
    }
}

