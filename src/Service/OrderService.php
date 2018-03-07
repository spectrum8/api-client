<?php
namespace Spectrum8\ApiClient\Service;

use Spectrum8\ApiClient\Exception\SpectrumException;
use Spectrum8\ApiClient\Interfaces\Connector;

/**
 * Class OrderService
 * @package Spectrum8\ApiClient\Service
 */
class OrderService extends BaseService
{
    /**
     * @var null|Connector
     */
    protected $connector = null;

    /**
     * @param string|int|null $externalId
     * @param int|null $tkwNumber
     * @return array|string|\stdClass|null
     * @throws SpectrumException
     */
    public function getOrderStatus($externalId = null, $tkwNumber = null)
    {
        if (empty($externalId) && empty($tkwNumber)) {
            throw new SpectrumException('External ID or tkwNumber has to be set');
        }
        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                [
                    'externalId' => $externalId,
                    'tkw_number' => $tkwNumber
                ],
                'order',
                'status'
            );
        }
        return null;
    }

    /**
     * @param string|int|null $externalId
     * @param int|null $tkwNumber
     * @param string $reason
     * @return array|string|\stdClass|null
     * @throws SpectrumException
     */
    public function cancelOrder($externalId = null, $tkwNumber = null, $reason = null)
    {
        if (empty($externalId) && empty($tkwNumber)) {
            throw new SpectrumException('External ID or tkwNumber has to be set');
        }
        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                [
                    'externalId' => $externalId,
                    'tkw_number' => $tkwNumber,
                    'reason' => (string) $reason
                ],
                'order',
                'storno'
            );
        }
        return null;
    }

    /**
     * @param string $provider [telekom, congstar]
     * @param string $segment  [festnetz, mobilfunk]
     * @param array $data
     * @return array|string|\stdClass|null
     * @throws SpectrumException
     */
    public function createOrder($provider, $segment, $data)
    {
        if (
            empty($provider)
            || empty($segment)
            || empty($data)
        ) {
            throw new SpectrumException('Parameters should not be empty on ' . __FUNCTION__);
        }
        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                $data,
                'order',
                $provider
                . '/'
                . $segment,
                'POST'
            );
        }
        return null;
    }

    /**
     * @param int $tkwNumber
     * @return array|string|\stdClass|null
     * @throws SpectrumException
     */
    public function getProductsToOrder($tkwNumber)
    {
        if (empty($tkwNumber)) {
            throw new SpectrumException('Parameters should not be empty on ' . __FUNCTION__);
        }
        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                ['tkw_number' => $tkwNumber],
                'order',
                'products',
                'GET'
            );
        }
        return null;
    }
}
