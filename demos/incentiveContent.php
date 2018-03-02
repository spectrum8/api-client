<?php

require_once __DIR__ . '/../vendor/autoload.php';

$contentService = new \Spectrum8\Service\ContentService();
$contentService->initConnector(
    [
        'email'     => 'YOUR_MAIL_ADDRESS',
        'apiKey'    => 'YOUR_API_KEY'
    ]
);
try {
    var_dump($contentService->getGroupContent([1,2,3], 111));
} catch (\Spectrum8\Exception\SpectrumException $exception) {
    echo $exception->getMessage();
    exit;
}
