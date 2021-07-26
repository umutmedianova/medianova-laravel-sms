# Medianova Laravel Sms

### Support Gateways

- oztek // (ozteksms.com)
- smspaneli // (smspaneli.com)

### Installation

You can install the package via composer:

```bash
composer require medianova/laravel-sms
```

configuration in `config/sms.php`

```php
return [
    'default_provider'=>env('SMS_PROVIDER', 'oztek'),
    'fallback_provider'=>env('SMS_PROVIDER_FALLBACK', ''), //alternative sms provider for an emergency
    'oztek'=>[
        'url'=>env('OZTEK_URL', 'http://www.ozteksms.com/panel/smsgonder1Npost.php'),
        'type'=>env('OZTEK_TYPE', 'Normal'),
        'number'=>env('OZTEK_NUMBER', 'XXXXXXXXX.XXXXXXXXX.XXXXXXXXX'),
        'username'=>env('OZTEK_USERNAME', 'XXXXXXX'),
        'password'=>env('OZTEK_PASSWORD', 'XXXXXXX'),
        'orginator'=>env('OZTEK_ORGINATOR', 'XXXXXXX'),
    ],
];
```

## Usage

```php
<?php

use Medianova\LaravelSms\Facades\Sms;

Sms::to('0905551234567')
    ->send('Hello World');
```

## Or use by choosing a provider

```php
Sms::provider('oztek')
    ->to('0905551234567')
    ->send('Hello World');
```