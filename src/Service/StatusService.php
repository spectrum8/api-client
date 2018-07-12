<?php
namespace Spectrum8\ApiClient\Service;

use Spectrum8\ApiClient\Interfaces\Connector;
use Spectrum8\ApiClient\Exception\SpectrumException;

/**
 * Class StatusService
 * @package Spectrum8\ApiClient\Service
 */
class StatusService extends BaseService
{
    /**
     * @var null|Connector
     */
    protected $connector = null;

    /**
     * ONLY for special Marketplace-Solution Projects!
     *
     * @param int $orderId
     * @param int $partnerId
     * @return array|string|\stdClass|null
     * @throws SpectrumException
     */
    public function getMpsStatus($orderId, $partnerId = null)
    {
        if (
        empty($orderId)
        ) {
            throw new SpectrumException('Parameters should not be empty on ' . __FUNCTION__);
        }

        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                [
                    'order_id' => $orderId,
                    'partner_id' => $partnerId,
                ],
                'status',
                'mpsOrderStatus',
                'GET'
            );
        }
        return null;
    }

    /**
     * ONLY for special Marketplace-Solution Projects!
     *
     * @param int $orderId
     * @param string $new_status
     * @param int $partnerId
     * @param array $additionalData
     * @return array|string|\stdClass|null
     * @throws SpectrumException
     */
    public function setMpsStatus($orderId, $new_status, $partnerId = null, $additionalData = array())
    {
        if (
            empty($orderId) ||
            empty($new_status)
        ) {
            throw new SpectrumException('Parameters should not be empty on ' . __FUNCTION__);
        }

        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                [
                    'order_id' => $orderId,
                    'partner_id' => $partnerId,
                    'new_status' => $new_status,
                    'additionalData' => $additionalData
                ],
                'status',
                'mpsOrderStatus',
                'POST'
            );
        }
        return null;
    }
}
