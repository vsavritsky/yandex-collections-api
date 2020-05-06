<?php

require_once 'vendor/autoload.php';

// О получении токена: https://yandex.ru/dev/collections/doc/concepts/access-docpage/
// Отладочный токен можно получить таким образом: https://oauth.yandex.ru/authorize?response_type=token&client_id=<APP_ID>
const OAUTH_TOKEN = 'token';

use YandexCollectionsApi\YandexCollectionsApi;
use YandexCollectionsApi\Content;

$httpClient = new \GuzzleHttp\Client();

// Так как апи работает только для организаций, нужно указать название компании (подробнее https://yandex.ru/dev/collections/doc/concepts/about-docpage/)
$companyName = 'company@companyName';
$YandexCollectionsApi = new YandexCollectionsApi($companyName, $httpClient, OAUTH_TOKEN);

try {
    echo '<pre>';
    // доски
    /*
      // все доски
      $page = 1; // страница
      $pageSize = 10; // сколько выводить на одной странице. Максимум 100
      $list = $YandexCollectionsApi->boards()->list($page, $pageSize);
      print_r($list);
      // подробнее об определенной доске
      $get = $YandexCollectionsApi->boards()->get($list->results[0]->id);
      print_r($get);
      // создать новую доску
      $insert = $YandexCollectionsApi->boards()->insert(true, 'board title', 'board description');
      print_r($insert);
      // изменить доску
      $update = $YandexCollectionsApi->boards()->update('board_id', true, 'board title', 'board description');
      print_r($update);
      // удалить доску
      $delete = $YandexCollectionsApi->boards()->delete('board_id');
      print_r($delete);
     */

    // карточки
    /*
      // все карточки определенной доски
      $page = 1; // страница
      $pageSize = 10; // сколько выводить на одной странице. Максимум 100
      $list = $YandexCollectionsApi->cards()->list($list->results[0]->id, $page, $pageSize);
      print_r($list);
      // подробнее об одной карточке
      $get = $YandexCollectionsApi->cards()->get($list->results[0]->id);
      print_r($get);
      // добавить новую карточку
      $boardID = 'board_id'; // доска на которую добавить карточку
      $domain = 'browser.yandex.ru'; // домен, который будет отображаться на карточке
      $pageTitle = 'Title целевой страницы'; // title целевой страницы. Нигде не выводится
      $cardDecription = 'Описание карточки'; // отображаемое описание карточки
      // можно вставлять несколько избражений и видео, но отображаться будет только одно. видимо ошибка в api
      $content1 = new Content(Content::SOURCE_IMAGE, 'https://avatars.mds.yandex.net/get-yablogs/51778/file_1545657911682/orig');
      $content2 = new Content(Content::SOURCE_IMAGE, 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/80/Yandex_Browser_logo.svg/1200px-Yandex_Browser_logo.svg.png');
      $link = 'https://browser.yandex.ru/blog/vstrechaem-kollektsii';
      $insert = $YandexCollectionsApi->cards()->insert($boardID, $domain, $pageTitle, $cardDecription, $link, $content1, $content2);
      print_r($insert);
      // изменить карточку
      $update = $YandexCollectionsApi->cards()->update('board_id', NULL, 'Мужская футболка Кто будет жертвой');
      print_r($update);
      // удалить карточку
      $delete = $YandexCollectionsApi->cards()->delete('card_id');
      print_r($delete);
     */
    echo '</pre>';
} catch (\Throwable $e) {
    echo "API вернул ошибку:\n";
    echo "http code:" . $e->getCode() . "\n";
    echo $e->getResponse()->getBody();
}