<?php namespace benharold\webhook\client;

use Twilio\Rest\Client;

interface ClientFactoryInterface
{
    public static function create(string $sid, string $token) : Client;
}
