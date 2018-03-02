<?php

require_once __DIR__ . '/../vendor/autoload.php';

$orderService = new \Spectrum8\Service\OrderService();
$orderService->initConnector(
    [
        'email'     => 'YOUR_MAIL_ADDRESS',
        'apiKey'    => 'YOUR_API_KEY'
    ]
);
try {
    var_dump($orderService->cancelOrder(null, 213546879, 'Test Auftrag'));
} catch (\Spectrum8\Exception\SpectrumException $exception) {
    echo $exception->getMessage();
    exit;
}

