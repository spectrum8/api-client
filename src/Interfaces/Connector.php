<?php
namespace Spectrum8\ApiClient\Interfaces;

use Spectrum8\ApiClient\Exception\SpectrumException;

/**
 * Interface Connector
 * @package Spectrum8\ApiClient\Interfaces
 */
interface Connector
{
    public function getUrl();

    /**
     * @param string $url
     */
    public function setUrl($url = 'https://api.spectrum8.de');

    /**
     * @return string
     */
    public function getVersion();

    /**
     * @param string $version
     */
    public function setVersion($version = 'v1');

    /**
     * Contains Partner mail and apiKey for API authentication
     *
     * @param array $auth
     */
    public function setAuth(array $auth);

    /**
     * @return array
     */
    public function getAuth();

    /**
     * @return string
     */
    public function getContentType();

    /**
     * Set ContentType for Request.
     * Defines Request and Response format
     *
     * @param string $type [xml/json]
     */
    public function setContentType($type = 'json');

    /**
     * @return string
     */
    public function getResponseType();

    /**
     * Defines response format
     *
     * @param string $type [array|stdClass|json]
     */
    public function setResponseType($type = 'array');

    /**
     * Reset Header to default (empty)
     */
    public function resetHeader();

    /**
     * Adds header configuration
     *
     * @param string|array $header
     */
    public function addHeader($header);

    /**
     * Replace header settings
     *
     * @param $header
     */
    public function setHeader($header);

    /**
     * Returns header
     *
     * @return array
     */
    public function getHeader();

    /**
     * @return void
     */
    public function initCurl();

    /**
     * Sends curl request by given settings and params
     *
     * @param mixed $data
     * @param string $section
     * @param string $action
     * @param string $method [GET|POST|HEAD|OPTIONS]
     */
    public function sendRequest($data, $section, $action, $method = 'GET');

    /**
     * @param string $contentType
     * @return string
     * @throws SpectrumException
     */
    public function getContentTypeHeader($contentType = 'json');

    /**
     * @param string $response
     */
    public function formatResponse($response);



    public function setErrors(array $errors);

    /**
     * @return array
     */
    public function getErrors();

    /**
     * @return bool
     */
    public function hasErrors();

    /**
     * Returns Request data which were incoming at API server
     *
     * @return array
     */
    public function getRequestByApi();

    /**
     * @param array $data
     */
    public function setRequestByApi(array $data);

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
    public function setApiEnvironment($environment = 'production');

    /**
     * Returns request environment
     *
     * @return string
     */
    public function getApiEnvironment();
}
