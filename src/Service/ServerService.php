<?php
namespace Spectrum8\Service;

use Spectrum8\Interfaces\Connector;

/**
 * Class ServerService
 * @package Spectrum8\Service
 */
class ServerService extends BaseService
{
    /**
     * @var null|Connector
     */
    protected $connector = null;

    /**
     * @return array|string|\stdClass|null
     */
    public function getTime()
    {
        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest([], 'server', 'time');
        }
        return null;
    }

    /**
     * @return array|string|\stdClass|null
     */
    public function getDate()
    {
        if ($this->connector instanceof Connector) {
            return $this->connector->sendRequest([], 'server', 'date');
        }
        return null;
    }
}
