<?php

require_once __DIR__ . '/../vendor/autoload.php';

$infoService = new \Spectrum8\Service\InfoService();
$infoService->initConnector(
    [
        'email'     => 'YOUR_MAIL_ADDRESS',
        'apiKey'    => 'YOUR_API_KEY'
    ]
);
try {
    var_dump($infoService->getBookableProducts('telekom', 'festnetz'));
} catch (\Spectrum8\Exception\SpectrumException $exception) {
    echo $exception->getMessage();
    exit;
}
