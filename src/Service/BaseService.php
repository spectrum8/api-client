<?php
namespace Spectrum8\Service;

use Spectrum8\Connector\CurlConnector;
use Spectrum8\Interfaces\Connector;

/**
 * Class BaseService
 * @package Spectrum8\Service
 */
class BaseService
{
    /**
     * @var null|Connector
     */
    protected $connector = null;

    /**
     * BaseService constructor.
     *
     * @param string|Connector $connector
     * @param array $auth
     */
    public function __construct($connector = 'curl', array $auth = [])
    {
        if (!empty($connector)) {
            $this->initConnector($auth, $connector);
        }
    }

    /**
     * Set an custom Connector as string or prepared Connector object
     * @param array $auth
     * @param string|Connector $connector
     */
    public function initConnector(array $auth = [], $connector = 'curl')
    {
        if (is_string($connector)) {
            switch ($connector) {
                case 'curl':
                    $this->connector = new CurlConnector();
                    $this->connector->setAuth($auth);
                    break;
            }
        } elseif ($connector instanceof Connector) {
            $this->connector = $connector;
        }
    }

    /**
     * @return null|Connector
     */
    public function getConnector()
    {
        return $this->connector;
    }
}
