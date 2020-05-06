<?php

namespace YandexCollectionsApi;

abstract class AbstractBaseApi
{
    const API_HOST = 'https://api.collections.yandex.net';
    
    protected $companyName;
    protected $httpClient;
    protected $token;
    
    public function __construct($companyName, \GuzzleHttp\Client $httpClient, string $token)
    {
        $this->companyName = $companyName;
        $this->httpClient = $httpClient;
        $this->token = $token;
    }
    
    /**
     * Запрос к api
     *
     * @param string $httpMethod GET, POST, PATCH, DELETE
     * @param string $apiMethod Метод api к которому идет обращение
     * @param array $params Параметры api метода
     * @return \stdClass Ответ от api
     */
    protected function query(string $httpMethod, string $apiMethod, array $params = [])
    {
        $params['headers'] = ['Authorization' => 'OAuth ' . $this->token];
        $params['query'] = $this->companyName;
        if ($httpMethod == 'GET') {
            $params['headers']['Accept'] = 'application/json';
        } else if ($httpMethod == 'POST' || $httpMethod == 'PATCH') {
            $params['headers']['Content-Type'] = 'application/json; charset=utf-8';
        }
        $res = $this->httpClient->request($httpMethod, self::API_HOST . $apiMethod, $params);
        if ($res->getStatusCode() == 204) {
            return true;
        }
        return \GuzzleHttp\json_decode($res->getBody()->getContents());
    }
    
}