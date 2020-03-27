<?php
/**
 * Created by naingminkhant
 * Date: 26/03/2020
 * Time: 17:11
 * Project: nestle-member
 */

namespace Arga\LaravelLine;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * @property Client $guzzle
 * @property array $headers
 * @property array $params
 */
class HttpClient
{
    public function __construct($configs = [])
    {
        $this->params = [
            'client_id'     => array_get($configs, 'client_id'),
            'client_secret' => array_get($configs, 'client_secret'),
            'redirect_uri'  => array_get($configs, 'redirect'),
        ];
        $this->headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
        $this->guzzle = new Client();
    }

    public function setHeaders(array $headers = [])
    {
        $this->headers = $headers;

        return $this;
    }

    public function setParams(array $configs)
    {
        $this->params = array_merge($this->params, $configs);

        return $this;
    }

    public function post(string $uri)
    {
        $response = $this->guzzle->request('POST', $uri, [
            'headers'     => $this->headers,
            'form_params' => $this->params,
        ]);

        return $this->toJson($response);
    }

    public function get(string $uri)
    {
        $response = $this->guzzle->request('GET', $uri, [
            'headers' => $this->headers,
            'query'   => $this->params,
        ]);

        return $this->toJson($response);
    }

    protected function toJson(ResponseInterface $response)
    {
        $content = $response->getBody()->getContents();

        return json_decode($content, true);
    }
}
