<?php namespace benharold\webhook\sms;

use Twilio\Rest\Client;

interface MessageFactoryInterface
{
    public static function create(
        Client $client,
        string $to,
        string $from,
        string $body
    ) : Message;
}
