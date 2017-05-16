<?php namespace benharold\webhook;

use benharold\webhook\client\ClientFactory;

abstract class MessageController extends Controller implements MessageControllerInterface
{
    protected $client;

    public function __construct()
    {
        $sid          = getenv('TWILIO_SID');
        $token        = getenv('TWILIO_TOKEN');
        $this->client = ClientFactory::create($sid, $token);
    }
}
