<?php
namespace Spectrum8\Service;

use Spectrum8\Exception\SpectrumException;
use Spectrum8\Interfaces\Connector;

/**
 * Class AvailabilityService
 * @package Spectrum8\Service
 */
class AvailabilityService extends BaseService
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
    public function getAvailability($provider, $segment, $customerData)
    {
        if (
            empty($provider)
            || empty($segment)
            || empty($customerData)
        ) {
            throw new SpectrumException('Parameters should not be empty on ' . __FUNCTION__);
        }
        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                [
                    'customerData' => $customerData
                ],
                'availability',
                $provider
                . '/'
                . $segment
            );
        }
        return null;
    }
}
