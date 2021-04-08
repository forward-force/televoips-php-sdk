<?php

namespace ForwardForce\TeleVoIPs\Contracts;

interface ApiAwareContract
{
    /**
     * Get all of entity
     *
     * @return array
     */
    public function getAll(): array;
}
