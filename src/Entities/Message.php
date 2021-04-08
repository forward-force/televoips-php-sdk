<?php

namespace ForwardForce\TeleVoIPs\Entities;

use ForwardForce\TeleVoIPs\Contracts\ApiAwareContract;
use ForwardForce\TeleVoIPs\HttpClient;
use GuzzleHttp\Exception\GuzzleException;

/** @psalm-suppress PropertyNotSetInConstructor */
class Message extends HttpClient implements ApiAwareContract
{
    /**
     * From phone number
     * @example 13214567890
     *
     * @var string
     */
    protected string $from;

    /**
     * To phone number
     * @example 19876543210
     *
     * @var string
     */
    protected string $to;

    /**
     * Content of message
     * @example Test
     *
     * @var string
     */
    protected string $message;

    /**
     * @return array
     */
    public function send(): array
    {
        $this->addBodyParameter('to', $this->getTo());
        $this->addBodyParameter('from', $this->getFrom());
        $this->addBodyParameter('content', $this->getMessage());

        return $this->post($this->buildQuery('/messages'));
    }
    /**
     * Get all jobs (paginated)
     *
     * @return array
     * @throws GuzzleException
     */
    public function getAll(): array
    {
        return $this->get($this->buildQuery('/messages'));
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @param string $from
     * @return Message
     */
    public function setFrom(string $from): Message
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param string $to
     * @return Message
     */
    public function setTo(string $to): Message
    {
        $this->to = filter_var($to, FILTER_SANITIZE_NUMBER_INT);
        $this->to = str_replace('-', '', $this->to);
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function setMessage(string $message): Message
    {
        $this->message = $message;
        return $this;
    }
}
