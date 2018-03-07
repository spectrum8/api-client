<?php

require_once __DIR__ . '/../vendor/autoload.php';

$availabilityService = new \Spectrum8\ApiClient\Service\ValidateService();
$availabilityService->initConnector(
    [
        'email'     => 'YOUR_MAIL_ADDRESS',
        'apiKey'    => 'YOUR_API_KEY'
    ]
);
try {
    var_dump($availabilityService->validatePhone('0213546879','mobile'));
} catch (\Spectrum8\ApiClient\Exception\SpectrumException $exception) {
    echo $exception->getMessage();
    exit;
}