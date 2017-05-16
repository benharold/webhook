<?php namespace benharold\webhook\sms;

use Twilio\Rest\Client;

class Message implements MessageInterface
{
    protected $to = '';

    protected $from = '';

    protected $body = '';

    private $client;

    public function __construct(
        Client $client,
        string $to,
        string $from,
        string $body
    ) {
        $this->client = $client;
        $this->to     = $to;
        $this->from   = $from;
        $this->body   = $body;
    }

    public function setTo(string $to) : void
    {
        $this->to = $to;
    }

    public function setFrom(string $from) : void
    {
        $this->from = $from;
    }

    public function setBody(string $body) : void
    {
        $this->body = $body;
    }

    public function send() : void
    {
        $this->client->messages->create(
            $this->to,
            [
                'from' => $this->from,
                'body' => $this->body,
            ]
        );
    }
}
