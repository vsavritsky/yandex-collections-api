# API сервиса Яндекс.Коллекции
Простенькая обертка для вызовов API сервиса Яндекс.Коллекции (https://yandex.ru/collections/)
  
## Требования  
PHP 7.1+  
  
## Установка
Установка с помощью Composer:  
    composer require vsavritsky/php-yandex-collections-api
  
## Пример
Нужен OAuth токен (https://yandex.ru/dev/collections/doc/concepts/access-docpage/)  
Отладочный токен можно получить таким образом: https://oauth.yandex.ru/authorize?response_type=token&client_id=<APP_ID>  
  
    <?php
    require_once __DIR__ . '/vendor/autoload.php';
    
    const OAUTH_TOKEN = 'token';

    $httpClient = new \GuzzleHttp\Client();
    $yandexCollectionsApi = new YandexCollectionsApi\YandexCollectionsApi($httpClient, OAUTH_TOKEN);
    
    try {
        $page = 1; // страница
        $pageSize = 10; // сколько выводить на одной странице. Максимум 100
        $list = $yandexCollectionsApi->boards()->list($page, $pageSize);
        print_r($list);
    } catch (\Throwable $e) {
        echo "API вернул ошибку:\n";
        echo "http code:" . $e->getCode() . "\n";
        echo $e->getResponse()->getBody();
    }
    ?>  
    
Остальные примеры есть в файле examples.php
