<?php

require_once __DIR__ . '/../vendor/autoload.php';

$connector = new Spectrum8\Connector\CurlConnector();
$connector->setAuth(
    [
        'email'     => 'YOUR_MAIL_ADDRESS',
        'apiKey'    => 'YOUR_API_KEY'
    ]
);
$serverService = new \Spectrum8\Service\ServerService;
$serverService->initConnector($connector);
var_dump($serverService->getTime());
