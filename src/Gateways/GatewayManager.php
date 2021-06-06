<?php
namespace Medianova\LaravelSms\Gateways;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Medianova\LaravelSms\Interfaces\SmsInterface;
use Medianova\LaravelSms\Exceptions\LaravelSmsException;
use Medianova\LaravelSms\Exceptions\LaravelSmsGatewayException;

class GatewayManager
{
    protected $provider;
    protected $to;

    public function __construct()
    {
        $this->provider(config('sms.default_provider'));
    }
    public function __autoload($class_name)
    {
        include_once($class_name.".php");
    }

    /**
     * Load SMS Gateway Provider
     *
     * @param String $provider
     * @return void
     */
    public function provider($provider)
    {
        if ($provider == null) {
            return false;
        }

        $class_name = ucfirst($provider).'Gateway';

        $file = dirname(__FILE__).'/'.$class_name.".php";
        if (!file_exists($file)) {
            throw new LaravelSmsException("We could not found Gateway Provider  : {$file}");
        }
        $provider = resolve("Medianova\\LaravelSms\\Gateways\\".$class_name);
        $this->provider = $provider;

        if (!$this->provider instanceof SmsInterface) {
            throw new LaravelSmsException("Provider must implement on LaravelSmsInterface");
        }
        return $this;
    }

    public function to($to)
    {
        $this->to = $to;
        return $this;
    }

    public function send($msg)
    {
        try {
            $this->provider->sendSms($this->to, $msg);
        } catch (LaravelSmsGatewayException $e) {
            $current_provider = $this->provider;
            $fallbak_provider = $this->provider(config('sms.fallback_provider'));
            if ($current_provider == $fallbak_provider) {
                Log::critical("sms sending error every attempt faild : " . $e->getMessage(), [
                    'to' => $this->to,
                    'msg' => $msg,
                    'provider' => $this->provider,
                ]);
                return false;
            }
            if (!$this->_isEnableFallback()) {
                Log::critical("sms sending error : ".$e->getMessage(), [
                    'to'=>$this->to,
                    'msg'=>$msg,
                    'provider'=>$this->provider,
                ]);
                throw new LaravelSmsException($e->getMessage(), 1);
            }
            $this->provider(config('sms.fallback_provider'))->send($msg);
        }
    }
    protected function _isEnableFallback()
    {
        return (config('sms.fallback_provider') == null?false:true);
    }
}
