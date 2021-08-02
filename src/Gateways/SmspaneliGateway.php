<?php

namespace Medianova\LaravelSms\Gateways;

use Medianova\LaravelSms\Interfaces\SmsInterface;
use Medianova\LaravelSms\Exceptions\LaravelSmsGatewayException;

class SmsPaneliGateway implements SmsInterface
{
    public function sendSms($to, $msg)
    {

        $url = config('sms.smspaneli.url');
        $type = config('sms.smspaneli.type');
        $number = config('sms.smspaneli.number');
        $username = config('sms.smspaneli.username');
        $password = config('sms.smspaneli.password');
        $orginator = config('sms.smspaneli.orginator');

        $xmlString = '<?xml version=\"1.0\" ?><PACKET>
               <USERNAME>'.$username.'</USERNAME>
               <PASSWORD>'.$password.'</PASSWORD>
               <ORIGINATOR>'.$orginator.'</ORIGINATOR>
               <PHONENUMBER>'.$to.'</PHONENUMBER>
               <MESSAGE><![CDATA['.$msg.']]></MESSAGE>
               <MESSAGETYPE>'.$type.'</MESSAGETYPE>
              </PACKET>';

        try {

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlString);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;

        } catch (Exception $e) {
            throw new LaravelSmsGatewayException($e->getMessage(), 1);
        }
    }
}
