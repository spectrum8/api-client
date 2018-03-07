<?php
namespace Spectrum8\ApiClient\Service;

use Spectrum8\ApiClient\Interfaces\Connector;
use Spectrum8\ApiClient\Exception\SpectrumException;

/**
 * Class PaymentService
 * @package Spectrum8\ApiClient\Service
 */
class PaymentService extends BaseService
{
    /**
     * @var null|Connector
     */
    protected $connector = null;

    /**
     * @param string $iban
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
