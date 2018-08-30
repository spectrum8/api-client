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
    // All mobile tariffs
    var_dump($infoService->getMobileTariffs());
    // For example: specific Telekom mobile tariffs
    var_dump($infoService->getMobileTariffs('Telekom Mobile'));
} catch (\Spectrum8\ApiClient\Exception\SpectrumException $exception) {
    echo $exception->getMessage();
    exit;
}
