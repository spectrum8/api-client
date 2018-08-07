<?php

require_once __DIR__ . '/../vendor/autoload.php';

$infoService = new \Spectrum8\ApiClient\Service\InfoService();
$infoService->initConnector(
    [
        'email'     => 'YOUR_MAIL_ADDRESS',
        'apiKey'    => 'YOUR_API_KEY'
    ]
);

try {
    var_dump($infoService->getMobileDevices());
} catch (\Spectrum8\ApiClient\Exception\SpectrumException $exception) {
    echo $exception->getMessage();
    exit;
}