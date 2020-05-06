<?php

namespace YandexCollectionsApi;

/**
 * API сервиса Яндекс.Коллекции
 *
 */
class YandexCollectionsApi
{
    private $boards;
    private $cards;
    
    /**
     * Класс для хранения объектов, через которые идет взаимодействие с API Яндекс коллекций
     *
     * @param $companyName название компании (подробнее https://yandex.ru/dev/collections/doc/concepts/about-docpage/)
     * @param \GuzzleHttp\Client $httpClient HTTP клиент для запросов к Яндекс API
     * @param string $token OAuth токен пользователя, от имени которого будут вызываться методы API {@link https://yandex.ru/dev/collections/doc/concepts/access-docpage/}
     */
    public function __construct($companyName, \GuzzleHttp\Client $httpClient, string $token)
    {
        $this->boards = new Boards($companyName, $httpClient, $token);
        $this->cards = new Cards($companyName, $httpClient, $token);
    }
    
    /**
     *
     * @return \YandexCollectionsApi\Boards объект для работы с досками {@link https://yandex.ru/dev/collections/doc/ref/Boards-docpage/}
     */
    public function boards(): Boards
    {
        return $this->boards;
    }
    
    /**
     *
     * @return \YandexCollectionsApi\Cards объект для работы с карточками {@link https://yandex.ru/dev/collections/doc/ref/Cards-docpage/}
     */
    public function cards(): Cards
    {
        return $this->cards;
    }
}

