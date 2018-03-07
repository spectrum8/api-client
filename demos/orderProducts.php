<?php

require_once __DIR__ . '/../vendor/autoload.php';

$orderService = new \Spectrum8\ApiClient\Service\OrderService();
$orderService->initConnector(
    [
        'email'     => 'YOUR_MAIL_ADDRESS',
        'apiKey'    => 'YOUR_API_KEY'
    ]
);
try {
    var_dump($orderService->getProductsToOrder(123456));
} catch (\Spectrum8\ApiClient\Exception\SpectrumException $exception) {
    echo $exception->getMessage();
    exit;
}
