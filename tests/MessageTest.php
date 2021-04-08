<?php

namespace ForwardForce\TeleVoIPs\Tests;

use ForwardForce\TeleVoIPs\Entities\Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testSanitizeToNumber()
    {
        $message = new Message('123456');
        $message->setTo('123ABC');
        $this->assertSame('123', $message->getTo());

        $message->setTo('+9411234567');
        $this->assertSame('+9411234567', $message->getTo());

        $message->setTo('+9411234567ABC!!');
        $this->assertSame('+9411234567', $message->getTo());
    }
}
