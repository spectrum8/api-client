<?php

require_once __DIR__ . '/../vendor/autoload.php';

$reportingService = new \Spectrum8\ApiClient\Service\ReportingService();
$reportingService->initConnector(
    [
        'email'     => 'YOUR_MAIL_ADDRESS',
        'apiKey'    => 'YOUR_API_KEY'
    ]
);
try {
    var_dump($reportingService->getReportingList('2016-08-01', '2016-12-30', false, false, 1234));
} catch (\Spectrum8\ApiClient\Exception\SpectrumException $exception) {
    echo $exception->getMessage();
    exit;
}
