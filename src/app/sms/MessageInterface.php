<?php namespace benharold\webhook\sms;

interface MessageInterface
{
    public function setTo(string $to) : void;

    public function setFrom(string $from) : void;

    public function setBody(string $body) : void;

    public function send() : void;
}
