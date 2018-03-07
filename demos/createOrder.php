<?php

require_once __DIR__ . '/../vendor/autoload.php';

$order = array (
    'action' => 'post',
    'format' => 'json',
    'language' => 'de',
    'businesscase' => 'Neukunde',
    'linendc' => '+495251',
    'wishdate' => '2018-01-01',
    'customerData' =>
        array (
            'salutation' => 'Herr',
            'firstname' => 'Max',
            'name' => 'Mustermann',
            'birthday' => '26.04.1987',
            'lineadress' =>
                array (
                    'street' => 'Testweg',
                    'housenumber' => '1',
                    'city' => 'Testhausen',
                    'zipcode' => '11000',
                ),
            'adress' =>
                array (
                    'street' => 'Testweg',
                    'housenumber' => '18',
                    'housenumber_affix' => '',
                    'city' => 'Testhausen',
                    'zipcode' => '11000',
                ),
            'contact' =>
                array (
                    'ndc' => '0176',
                    'serial' => '234564641',
                    'email' => 'test@test.de',
                ),
            'payment' =>
                array (
                    'iban' => 'XXXXXXXXXXXXX',
                    'bic' => 'XXXXXXX',
                    'email' => 'test@outlook.de',
                    'owner' => 'Max Mustermann',
                ),
        ),
    'cart' =>
        array (
            'cartEntries' =>
                array (
                    0 =>
                        array (
                            'groupId' => 9319,
                        ),
                ),
        ),
    'channel' => 'eBiz',
    'externalId' => '213546879',
);


$orderService = new \Spectrum8\ApiClient\Service\OrderService();
$orderService->initConnector(
    [
        'email'     => 'YOUR_MAIL_ADDRESS',
        'apiKey'    => 'YOUR_API_KEY'
    ]
);
try {
    var_dump($orderService->createOrder('telekom', 'festnetz', $order), $orderService->getConnector()->getErrors());
} catch (\Spectrum8\ApiClient\Exception\SpectrumException $exception) {
    echo $exception->getMessage();
    exit;
}
