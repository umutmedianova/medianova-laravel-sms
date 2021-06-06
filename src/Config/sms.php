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
];
