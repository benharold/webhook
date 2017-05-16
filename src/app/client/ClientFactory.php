<?php namespace benharold\webhook\client;

use Twilio\Rest\Client;

class ClientFactory implements ClientFactoryInterface
{
    public static function create(string $sid, string $token) : Client
    {
        return new Client($sid, $token);
    }
}
