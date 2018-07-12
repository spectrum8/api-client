<?php

require_once __DIR__ . '/../vendor/autoload.php';

$statusService = new \Spectrum8\ApiClient\Service\StatusService();
$statusService->initConnector(
    [
        'email'     => 'YOUR_MAIL_ADDRESS',
        'apiKey'    => 'YOUR_API_KEY'
    ]
);
try {
    var_dump(
        $statusService->setMpsStatus(
            123456789,
            'IDENTIFIED', // IDENTIFIED OR SHIPPED
            123456789,
            [
                'shipping_number' => 123456789
            ]
        )
    );
} catch (\Spectrum8\ApiClient\Exception\SpectrumException $exception) {
    echo $exception->getMessage();
    exit;
}