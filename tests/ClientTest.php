<?php
namespace AllDigitalRewards\FIS;

use AllDigitalRewards\FIS\Entity\Card;
use AllDigitalRewards\FIS\Entity\CardCreateRequest;
use AllDigitalRewards\FIS\Entity\CardLoadRequest;
use AllDigitalRewards\FIS\Entity\Person;
use AllDigitalRewards\FIS\Entity\PersonRequest;
use AllDigitalRewards\FIS\Exception\FisException;
use AllDigitalRewards\FIS\Interfaces\Validateable;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private function getFisClient()
    {
        $httpClient = new \GuzzleHttp\Client();
        $client = new Client(
            $httpClient,
            [
                'userId' => 'development',
                'password' => 'password',
                'sourceId' => '1234',
                'fisCertificate' => __DIR__ . '/../etc/fisCertificate',
                'fisCertificatePassword' => '1234321'
            ],
            true
        );

        return $client;
    }

    public function testClientIdConfiguration()
    {
        $client = $this->getFisClient();
        $client->setClientId(1);
        $this->assertSame(1, $client->getClientId());
    }

    public function testClientDevelopmentMode()
    {
        $client = $this->getFisClient();
        $client->setDevelopment(false);
        $this->assertFalse($client->isDevelopmentMode());
        $client->setDevelopment(true);
        $this->assertTrue($client->isDevelopmentMode());
    }

    public function testClientUrl()
    {
        $client = $this->getFisClient();
        $client->setClientId(1);
        $client->setDevelopment(false);
        $client->getUrl('test');
        $urlString = 'https://a2a.fisprepaid.com' . '/test?userid=development&pwd=password&sourceid=1234&clientid=1' ;
        $this->assertSame($urlString, $client->getUrl('test'));
        $client->setDevelopment(true);
        $urlString = 'https://a2a.uatfisprepaid.com' . '/test?userid=development&pwd=password&sourceid=1234&clientid=1' ;
        $this->assertSame($urlString, $client->getUrl('test'));
    }
}