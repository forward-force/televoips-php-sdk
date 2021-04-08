<?php

namespace ForwardForce\TeleVoIPs;

use ForwardForce\TeleVoIPs\Entities\Message;

class TeleVoIPs
{
    /**
     * TeleVoIPs API key
     *
     * @var string
     */
    protected string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Get jobs from API
     *
     * @return Message
     */
    public function message(): Message
    {
        return new Message($this->apiKey);
    }
}
