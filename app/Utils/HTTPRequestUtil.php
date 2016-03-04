<?php

namespace App\Utils;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use App\Exceptions\HTTPRequest\BadResponseException;

/**
 * HTTP Request utils
 *
 * Usage: you should injection this class object into the code
 *        where need trigger a http request.
 * example:
 *      class TestService
 *      {
 *          public function __construct(HTTPRequestUtil $httpClient)
 *          {
 *              $this->httpClient = $httpClient;
 *          }
 *          
 *          public function test()
 *          {
 *              $responseBody = $this->httpClient->get('http://www.163.com', ['user' => 'zhangsan']);
 *              // process body
 *          }
 *      }
 */
class HTTPRequestUtil
{
    /**
     * @var ClientInterface
     */
    protected $httpClient;

    public function __construct(
        ClientInterface $httpClient
    ) {
        $this->httpClient = $httpClient;
    }

    public function setHttpClient(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Trigger a get http request
     *
     * @param string $url
     * @param array $querys get request params
     *
     * @return string $respContent
     */
    public function get($url, array $querys = [])
    {
        $options = [
            RequestOptions::QUERY   => $querys,
        ];

        return $this->rawGet($url, $options);
    }

    /**
     * Trigger a post http request
     *
     * @param string $url
     * @param array $formData
     *
     * @return string $respContent
     */
    public function post($url, $formData = [])
    {
        $options = [
            RequestOptions::FORM_PARAMS    => $formData,
        ];

        return $this->rawPost($url, $options);
    }

    public function rawGet($url, $options = [])
    {
        $response = $this->httpClient->request('GET', $url, $options);
        if ($response->getStatusCode() != 200) {
            throw new BadResponseException(sprintf('http请求失败(%s): %s',
                $response->getStatusCode(),
                (string) $response->getBody()));
        }

        return (string) $response->getBody();
    }

    public function rawPost($url, $options = [])
    {
        $response = $this->httpClient->request('POST', $url, $options);
        if ($response->getStatusCode() != 200) {
            throw new BadResponseException(sprintf('http请求失败(%s): %s',
                $response->getStatusCode(),
                (string) $response->getBody()));
        }

        return (string) $response->getBody();
    }
}
