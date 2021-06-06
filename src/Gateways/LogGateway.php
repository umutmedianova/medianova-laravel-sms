<?php
namespace Medianova\LaravelSms\Gateways;

use Illuminate\Support\Facades\Log;
use Medianova\LaravelSms\Interfaces\SmsInterface;

class LogGateway implements SmsInterface
{
    public function sendSms($to, $msg)
    {
        $log = array(
            'msg' => $msg,
            'to' => [$to],
        );

        Log::info($log);
    }
}
