<?php

require_once __DIR__ . '/../vendor/autoload.php';

$apiService = new \Spectrum8\ApiClient\Service\ApiService();
$apiService->initConnector(
    [
        'email'     => 'YOUR_MAIL_ADDRESS',
        'apiKey'    => 'YOUR_API_KEY'
    ]
);
var_dump($apiService->getServerService()->getTime());
