<?php
namespace Spectrum8\Service;

use Spectrum8\Interfaces\Connector;
use Spectrum8\Exception\SpectrumException;

/**
 * Class PaymentService
 * @package Spectrum8\Service
 */
class PaymentService extends BaseService
{
    /**
     * @var null|Connector
     */
    protected $connector = null;

    /**
     * @param string $provider [telekom, vodafone]
     * @param string $segment
     * @param array $customerData  keys: [street, housenumber, housenumber_affix, city, zipcode]
     * @return array|string|\stdClass|null
     * @throws SpectrumException
     */
    public function getBicByIban($iban)
    {
        if (
            empty($iban)
        ) {
            throw new SpectrumException('Parameters should not be empty on ' . __FUNCTION__);
        }

        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(['iban' => $iban],'payment','bicbyiban');
        }
        return null;
    }
}
