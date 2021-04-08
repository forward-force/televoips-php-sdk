<?php

namespace ForwardForce\TeleVoIPs\Tests;

use ForwardForce\TeleVoIPs\HttpClient;
use PHPUnit\Framework\TestCase;

class HttpClientTest extends TestCase
{
    public function testBaseURL()
    {
        $params = ['Authorization' => '123456'];
        $fixture = new HttpClient($params['Authorization']);

        try {
            $reflector = new \ReflectionProperty($fixture, 'client');
            $reflector->setAccessible(true);
            $token = $reflector->getValue($fixture)->getConfig()['headers']['Authorization'];
            $this->assertSame($params['Authorization'], $token);
        } catch (\ReflectionException $e) {
            $this->assertTrue(false);
        }
    }

    public function testBuildQuery()
    {
        try {
            $fixture = new HttpClient('123456');

            $reflector = new \ReflectionMethod($fixture, 'buildQuery');
            $reflector->setAccessible(true);

            $query = $reflector->invoke($fixture, '/test');
            $this->assertSame('/test', $query);

            $fixture = new HttpClient('123456');
            $fixture->addQueryParameter('foo', 'bar');
            $query = $reflector->invoke($fixture, '/test');
            $this->assertSame('/test/?foo=bar', $query);
        } catch (\ReflectionException $e) {
            $this->assertTrue(false);
        }
    }

}
