<?php

namespace Medianova\LaravelSms\Test;
use Medianova\LaravelSms\Facades\Sms;

class SmsTest extends TestCase
{

    /**
     * Send SMS
     * @return void
     */
    public function testSendSms()
    {
        $response = Sms::to('0905551234567')->send('Hello World');
        $this->assertSame('2:Kullanici bulunamadi', $response);
    }
}
