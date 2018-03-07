<?php
namespace Spectrum8\ApiClient\Service;

use Spectrum8\ApiClient\Interfaces\Connector;
use Spectrum8\ApiClient\Exception\SpectrumException;

/**
 * Class ReportingService
 * @package Spectrum8\ApiClient\Service
 */
class ReportingService extends BaseService
{
    /**
     * @var null|Connector
     */
    protected $connector = null;

    /**
     * @param string $from
     * @param string $to
     * @param bool $products
     * @param bool $productGroupName
     * @param int $partnerId
     * @return array|string|\stdClass|null
     * @throws SpectrumException
     */
    public function getReportingList($from, $to, $products = false, $productGroupName = false, $partnerId = null)
    {
        if (
            empty($from)
            || empty($to)
        ) {
            throw new SpectrumException('Parameters should not be empty on ' . __FUNCTION__);
        }

        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                [
                    'from' => $from,
                    'to' => $to,
                    'partner_id' => $partnerId,
                    'productGroupName' => $productGroupName,
                    'product_category' => $products,
                ],
                'reporting',
                'list'
            );
        }
        return null;
    }

    /**
     * @param string $from
     * @param string $to
     * @param int|array $partnerId
     * @return array|string|\stdClass|null
     * @throws SpectrumException
     */
    public function getReportingLite($from, $to, $partnerId)
    {
        if (
            empty($from)
            || empty($to)
            || empty($partnerId)
        ) {
            throw new SpectrumException('Parameters should not be empty on ' . __FUNCTION__);
        }

        if (!is_array($partnerId)) {
            $partnerId = [$partnerId];
        }
        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                [
                    'from' => $from,
                    'to' => $to,
                    'partner_id' => $partnerId,
                ],
                'reporting',
                'lite'
            );
        }
        return null;
    }
}
