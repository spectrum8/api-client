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
    $result = $reportingService->getReportingOrderData('YOUR_ORDER_ID', 'YOUR_PARTNER_ID');
    if($reportingService->getConnector()->hasErrors()){
        echo json_encode($reportingService->getConnector()->getErrors());
    }
    else{
        echo json_encode(($result));
    }
} catch (\Spectrum8\ApiClient\Exception\SpectrumException $exception) {
    echo $exception->getMessage();
    exit;
}