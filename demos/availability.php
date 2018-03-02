<?php

require_once __DIR__ . '/../vendor/autoload.php';

$availabilityService = new \Spectrum8\Service\AvailabilityService();
$availabilityService->initConnector(
    [
        'email'     => 'YOUR_MAIL_ADDRESS',
        'apiKey'    => 'YOUR_API_KEY'
    ]
);
try {
    var_dump($availabilityService->getAvailability(
        'telekom',
        'festnetz',
        [
            'address' => [
                'street'            => 'Oberes Feld',
                'housenumber'       => '6',
                'housenumber_affix' => '',
                'city'              => 'Paderborn',
                'zipcode'           => '33106'
            ]
        ]
        )
    );
} catch (\Spectrum8\Exception\SpectrumException $exception) {
    echo $exception->getMessage();
    exit;
}