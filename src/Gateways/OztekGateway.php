<?php

namespace Medianova\LaravelSms\Gateways;

use Medianova\LaravelSms\Interfaces\SmsInterface;
use Medianova\LaravelSms\Exceptions\LaravelSmsGatewayException;

class OztekGateway implements SmsInterface
{
    public function sendSms($to, $msg)
    {

        $url = config('sms.oztek.url') || 'http://www.ozteksms.com/panel/smsgonder1Npost.php';
        $type = config('sms.oztek.type') || 'Normal';
        $number = config('sms.oztek.number');
        $username = config('sms.oztek.username');
        $password = config('sms.oztek.password');
        $orginator = config('sms.oztek.orginator');

        $xmlString = 'data=<sms>
            <kno>' . $number . '</kno> 
            <kulad>' . $username . '</kulad> 
            <sifre>' . $password . '</sifre>    
            <gonderen>' . $orginator . '</gonderen> 
            <mesaj>' . $msg . '</mesaj> 
            <numaralar>' . $to . '</numaralar>
            <tur>' . $type . '</tur> 
            </sms>';

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
