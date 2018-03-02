<?php
namespace Spectrum8\Service;

use Spectrum8\Interfaces\Connector;
use Spectrum8\Exception\SpectrumException;

/**
 * Class InfoService
 * @package Spectrum8\Service
 */
class ContentService extends BaseService
{
    /**
     * @var null|Connector
     */
    protected $connector = null;

    /**
     * @param array $groupIds
     * @param array $targetIds
     * @return array|string|\stdClass|null
     * @throws SpectrumException
     */
    public function getGroupContent($groupIds, $targetIds)
    {
        if (
            empty($groupIds)
            || empty($targetIds)
        ) {
            throw new SpectrumException('Parameters should not be empty on ' . __FUNCTION__);
        }
        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest(
                [
                    'groupIds' => $groupIds,
                    'targetIds' => $targetIds
                ],
                'content',
                'groupcontent'
            );
        }
        return null;
    }
}
