<?php
namespace Medianova\LaravelSms\Interfaces;

interface SmsInterface
{
    public function sendSms($to, $msg);
}
