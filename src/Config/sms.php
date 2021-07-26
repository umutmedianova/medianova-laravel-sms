<?php

return [
    'default_provider'=>env('SMS_PROVIDER', 'oztek'),
    'fallback_provider'=>env('SMS_PROVIDER_FALLBACK', ''), //alternative
    'oztek'=>[
        'url' => env('OZTEK_URL','http://www.ozteksms.com/panel/smsgonder1Npost.php'),
        'number'=>env('OZTEK_NUMBER', 'XXXXXXXXX.XXXXXXXXX.XXXXXXXXX'),
        'username'=>env('OZTEK_USERNAME', 'XXXXXXX'),
        'password'=>env('OZTEK_PASSWORD', 'XXXXXXX'),
        'orginator'=>env('OZTEK_ORGINATOR', 'XXXXXXX'),
        'type' => env('OZTEK_TYPE','Normal'), // Normal ya da Turkce
    ],
    'smspaneli'=>[
        'url' => env('SMS_PANELI_URL','https://xmlapi.smspaneli.com/xmlsms.php'),
        'number'=>env('SMS_PANELI_NUMBER', 'XXXXXXXXX.XXXXXXXXX.XXXXXXXXX'),
        'username'=>env('SMS_PANELI_USERNAME', 'XXXXXXX'),
        'password'=>env('SMS_PANELI_PASSWORD', 'XXXXXXX'),
        'orginator'=>env('SMS_PANELI_ORGINATOR', 'XXXXXXX'),
        'type' => env('SMS_PANELI_TYPE','1'), // 1 = NORMAL, 2 = FLASH, 3 = TÜRKÇE, 4 = NUMERIC, 5 = TÜRÇKE NUMERIC
    ],
];
