<?php
namespace Spectrum8\Service;

use Spectrum8\Interfaces\Connector;
use Spectrum8\Exception\SpectrumException;

/**
 * Class ValidateService
 * @package Spectrum8\Service
 */
class ValidateService extends BaseService
{
    /**
     * @var null|Connector
     */
    protected $connector = null;

    /**
     * @param string $number
     * @param string $type [mobile, landline, ndc, serial, phone]
     * @return array|string|\stdClass|null
     * @throws SpectrumException
     */
    public function validatePhone($number, $type)
    {
        if (
            empty($number)
            || empty($type)
        ) {
            throw new SpectrumException('Parameters should not be empty on ' . __FUNCTION__);
        }

        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                [
                    'number'    => $number,
                    'type'      => $type
                ],
                'service',
                'validate/phone'
            );
        }
        return null;
    }
}
