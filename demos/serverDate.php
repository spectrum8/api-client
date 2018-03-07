<?php

require_once __DIR__ . '/../vendor/autoload.php';

$serverService = new \Spectrum8\ApiClient\Service\ServerService;
$serverService->initConnector(
    [
        'email'     => 'YOUR_MAIL_ADDRESS',
        'apiKey'    => 'YOUR_API_KEY'
    ]
);
var_dump($serverService->getDate());
