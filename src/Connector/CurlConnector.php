<?php
namespace Spectrum8\ApiClient\Connector;

use Spectrum8\ApiClient\Exception\SpectrumException;
use Spectrum8\ApiClient\Interfaces\Connector;

/**
 * Class CurlConnector
 * @package Spectrum8\ApiClient\Connector
 */
class CurlConnector implements Connector
{
    /**
     * @var string
     */
    private $url = 'https://api.spectrum8.de';

    /**
     * @var string
     */
    private $version = 'v1';

    /**
     * @var null|resource
     */
    private $curl = null;

    /**
     * @var array
     */
    private $auth = [
        'email'     => null,
        'apiKey'  => null
    ];

    private $contentType = 'json';

    /**
     * @var string
     */
    private $responseType = 'array';

    /**
     * @var array
     */
    private $header = [];

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @var array
     */
    private $infos = [];

    /**
     * @var array
     */
    private $requestByApi = [];

    private $apiEnvironment = 'production';

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url = 'https://api.spectrum8.de')
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion($version = 'v1')
    {
        $this->version = $version;
    }

    /**
     * Contains Partner mail and apiKey for API authentication
     *
     * @param array $auth
     */
    public function setAuth(array $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @return array
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Set ContentType for Request.
     * Defines Request and Response format
     *
     * @param string $type [xml/json]
     */
    public function setContentType($type = 'json')
    {
        $this->contentType = $type;
    }

    /**
     * @return string
     */
    public function getResponseType()
    {
        return $this->responseType;
    }

    /**
     * Defines response format
     *
     * @param string $type [array|stdClass|json]
     */
    public function setResponseType($type = 'array')
    {
        $this->responseType = $type;
    }

    /**
     * Set Environment for request
     * Possible:
     * - production
     * - prod
     * - development
     * - dev
     *
     * @param string $environment
     */
    public function setApiEnvironment($environment = 'production')
    {
        $possibleEnvironments = [
            'production'    => 'production',
            'prod'          => 'production',
            'development'   => 'development',
            'dev'           => 'development'
        ];
        if (!empty($possibleEnvironments[$environment])) {
            $this->apiEnvironment = $possibleEnvironments[$environment];
        } else {
            throw new SpectrumException('Api environment "' . $environment . '"not allowed');
        }
    }

    /**
     * Returns request environment
     *
     * @return string
     */
    public function getApiEnvironment()
    {
        return $this->apiEnvironment;
    }

    /**
     * Reset Header to default (empty)
     */
    public function resetHeader()
    {
        $this->header = [];
    }

    /**
     * Adds header configuration
     *
     * @param string|array $header
     */
    public function addHeader($header)
    {
        if (!empty($header)) {
            if (is_string($header)) {
                $this->header[] = $header;
            } elseif (is_array($header)) {
                $this->header = array_merge($this->header, $header);
            }
        }
    }

    /**
     * Replace header settings
     *
     * @param $header
     */
    public function setHeader($header)
    {
        if (is_string($header)) {
            $this->header = [$header];
        } elseif (is_array($header)) {
            $this->header = $header;
        }
    }

    /**
     * Returns header
     *
     * @return array
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return void
     */
    public function initCurl()
    {
        $this->curl = curl_init();

        // set the curl options
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 600);
    }

    /**
     * Sends curl request by given settings and params
     *
     * @param mixed $data
     * @param string $section
     * @param string $action
     * @param string $method [GET|POST|HEAD|OPTIONS]
     */
    public function sendRequest($data, $section, $action, $method = 'GET')
    {
        $this->initCurl();

        // Check data and add api_environment
        if (!is_string($data)) {
            $data['api_environment'] = $this->getApiEnvironment();
            $data = json_encode($data);
        } else {
            $data = json_decode($data, true);
            $data['api_environment'] = $this->getApiEnvironment();
            $data = json_encode($data);
        }

        if (empty($method)) {
            throw new SpectrumException('Method has to be set');
        }

        $method = strtoupper($method);
        $header = $this->getHeader();

        $auth = $this->getAuth();
        $authString = $auth['email'] . ';' . $auth['apiKey'];
        $header[] = 'Authorization: ' . $authString;

        $header[] = 'Content-Length: ' . strlen($data);
        $contentTypeHeader = $this->getContentTypeHeader($this->getContentType());
        if (!empty($contentTypeHeader)) {
            $header[] = $contentTypeHeader;
        }

        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt(
            $this->curl,
            CURLOPT_URL,
            $this->getUrl()
            . '/'
            . $this->getVersion()
            . '/'
            . $section
            . '/'
            . $action
        );
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);

        // add some special options
        switch ($method) {
            case 'HEAD':
            case 'OPTIONS':
                curl_setopt($this->curl, CURLOPT_HEADER, true);
                break;
        }

        // send the request
        $response = curl_exec($this->curl);
        // close connection
        curl_close($this->curl);

        /**
         * Get Response as error to check for errors
         */
        $temp = json_decode($response, true);
        if (!empty($temp['response']) && !empty($temp['response']['errors'])) {
            $this->setErrors($temp['response']['errors']);
        } else {
            $this->setErrors([]);
        }

        if (!empty($temp['response']) && !empty($temp['response']['info'])) {
            $this->setInfos($temp['response']['info']);
        } else {
            $this->setInfos([]);
        }

        if (!empty($temp['request'])) {
            $this->setRequestByApi($temp['request']);
        }

        $response = $this->formatResponse($response);
        // return the result/response
        return $response;
    }

    /**
     * @param string $contentType
     * @return string
     * @throws SpectrumException
     */
    public function getContentTypeHeader($contentType = 'json')
    {
        if (empty($contentType)) {
            throw new SpectrumException('ContentType has to be set');
        }
        switch ($contentType) {
            case 'xml':
                return 'Content-Type: application/xml';
                break;
            case 'json':
            default:
                return 'Content-Type: application/json';
                break;
        }
    }

    /**
     * @param string $response
     */
    public function formatResponse($response)
    {
        $responseType = $this->getResponseType();
        switch ($responseType) {
            case 'json':
                $temp = json_decode($response, true);
                $response = $temp['response']['data'];
                return json_encode($response);
                break;
            case 'array':
            default:
                $temp = json_decode($response, true);
                return $temp['response']['data'];
                break;
            case 'stdClass':
                $temp = json_decode($response);
                return $temp->response->data;
                break;
        }
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return (!empty($this->errors) ? true : false);
    }

    /**
     * @param array $infos
     */
    public function setInfos(array $infos)
    {
        $this->infos = $infos;
    }

    /**
     * @return array
     */
    public function getInfos()
    {
        return $this->infos;
    }

    /**
     * Returns Request data which were incoming at API server
     *
     * @return array
     */
    public function getRequestByApi()
    {
        return $this->requestByApi;
    }

    /**
     * @param array $data
     */
    public function setRequestByApi(array $data)
    {
        $this->requestByApi = $data;
    }
}
