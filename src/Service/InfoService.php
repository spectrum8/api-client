<?php
namespace Spectrum8\ApiClient\Service;

use Spectrum8\ApiClient\Interfaces\Connector;
use Spectrum8\ApiClient\Exception\SpectrumException;

/**
 * Class InfoService
 * @package Spectrum8\ApiClient\Service
 */
class InfoService extends BaseService
{
    /**
     * @var null|Connector
     */
    protected $connector = null;

    /**
     * @param string $provider [telekom, vodafone]
     * @param string $segment [festnetz, mobilfunk]
     * @return array|string|\stdClass|null
     * @throws SpectrumException
     */
    public function getPortingNumbers($provider, $segment)
    {
        if (
            empty($provider)
            || empty($segment)
        ) {
            throw new SpectrumException('Parameters should not be empty on ' . __FUNCTION__);
        }
        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                [
                    'segment' => $segment
                ],
                'infos',
                'portingnumbers/'
                . $provider
            );
        }
        return null;
    }

    /**
     * @param string $provider [telekom, vodafone, 1und1, congstar]
     * @param string $segment [festnetz, mobilfunk]
     * @return array|string|\stdClass|null
     * @throws SpectrumException
     */
    public function getBookableProducts($provider, $segment)
    {
        if (
            empty($provider)
            || empty($segment)
        ) {
            throw new SpectrumException('Parameters should not be empty on ' . __FUNCTION__);
        }
        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                [
                    'provider'  => $provider,
                    'segment'   => $segment
                ],
                'infos',
                'bookableproducts'
            );
        }
        return null;
    }

    /**
     * @param string $provider [telekom, vodafone, 1und1, congstar]
     * @param string $segment [festnetz, mobilfunk]
     * @return array|string|\stdClass|null
     * @throws SpectrumException
     */
    public function getBookableBundles($provider, $segment)
    {
        if (
            empty($provider)
            || empty($segment)
        ) {
            throw new SpectrumException('Parameters should not be empty on ' . __FUNCTION__);
        }
        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                [
                    'provider'  => $provider,
                    'segment'   => $segment
                ],
                'infos',
                'bookablebundles'
            );
        }
        return null;
    }

    /**
     * @param array $groupIds
     * @return array|string|\stdClass|null
     * @throws SpectrumException
     */
    public function getBundlePrices($groupIds)
    {
        if (
            empty($groupIds)
        ) {
            throw new SpectrumException('Parameters should not be empty on ' . __FUNCTION__);
        }

        if (count($groupIds) !== 2) {
            throw new SpectrumException('There has to be 2 group ids in parameter "groupIds". Method: ' . __FUNCTION__);
        }

        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                [
                    'groupIds'  => $groupIds
                ],
                'infos',
                'bundleprice'
            );
        }
        return null;
    }

    /**
     * @return array|string|\stdClass|null
     */
    public function getNationalities()
    {
        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                [],
                'infos',
                'nationalitieslist'
            );
        }
        return null;
    }

    /**
     * @param int $tariffId
     * @param bool $withTexts
     * @return array|string|\stdClass|null
     * @throws SpectrumException
     */
    public function getBookableOptions($tariffId, $withTexts = false)
    {
        if (
            empty($tariffId)
        ) {
            throw new SpectrumException('Parameters should not be empty on ' . __FUNCTION__);
        }
        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                [
                    'tariff_id' => $tariffId,
                    'with_texts' => (bool) $withTexts
                ],
                'infos',
                'bookableoptions'
            );
        }
        return null;
    }

    /**
     * @param int|array|null $partnerTarget
     * @return array|string|\stdClass|null
     */
    public function getMobileDevices($partnerTarget = null)
    {
        if (!is_array($partnerTarget) && !is_null($partnerTarget)) {
            $partnerTarget = [(int) $partnerTarget];
        } elseif (is_array($partnerTarget)) {
            foreach ($partnerTarget as &$item) {
                $item = (int) $item;
            }
        } else {
            $partnerTarget = null;
        }

        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                [
                    'partner_target' => $partnerTarget
                ],
                'infos',
                'mobiledevices'
            );
        }
        return null;
    }
}
