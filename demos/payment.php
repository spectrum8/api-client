<?php

require_once __DIR__ . '/../vendor/autoload.php';

$paymentService = new \Spectrum8\Service\PaymentService();
$paymentService->initConnector(
    [
        'email'     => 'YOUR_MAIL_ADDRESS',
        'apiKey'    => 'YOUR_API_KEY'
    ]
);
try {
    var_dump($paymentService->getBicByIban('DE213546879213'));
} catch (\Spectrum8\Exception\SpectrumException $exception) {
    echo $exception->getMessage();
    exit;
}
