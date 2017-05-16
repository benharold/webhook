<?php namespace benharold\webhook;

use benharold\webhook\sms\MessageFactory;

class NewRelicMessageController extends MessageController
{
    protected $data = [];

    public function __construct(array $data)
    {
        parent::__construct();
        $this->data = $data;
    }

    public function run()
    {
        $to   = getenv('TO_NUMBER');
        $from = getenv('FROM_NUMBER');

        if ($alert = $this->data['alert']) {
            $alert   = json_decode($alert);
            $message = sprintf('%s: %s', $alert->long_description, $alert->alert_url);
            $message = MessageFactory::create($this->client, $to, $from, $message);
            $message->send();
        }
    }
}
