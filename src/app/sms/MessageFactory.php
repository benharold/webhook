<?php namespace benharold\webhook\sms;

use Twilio\Rest\Client;

class MessageFactory implements MessageFactoryInterface
{
    public static function create(
        Client $client,
        string $to,
        string $from,
        string $body
    ) : Message {
        return new Message($client, $to, $from, $body);
    }
}
