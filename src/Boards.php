<?php

namespace YandexCollectionsApi;

class Boards extends AbstractBaseApi
{
    /**
     * Список всех досок
     *
     * @param int $page Страница
     * @param int $pageSize Сколько элементов на странице
     * @return \stdClass Ответ от api {@link https://yandex.ru/dev/collections/doc/ref/Boards/v1_boards_get-docpage/}
     */
    public function list(int $page = 1, int $pageSize = 20)
    {
        $params['query'] = ['page' => $page, 'page_size' => $pageSize];
        return $this->query('GET', '/v1/boards/', $params);
    }
    
    /**
     * Информация о определенной доске
     *
     * @param string $id ID доски
     * @return \stdClass Ответ от api {@link https://yandex.ru/dev/collections/doc/ref/Boards/v1_boards_id_get-docpage/}
     */
    public function get(string $id)
    {
        return $this->query('GET', '/v1/boards/' . $id);
    }
    
    /**
     * Добавить новую доску
     *
     * @param bool $isPrivate Приватность. true - приватная, false - публичная
     * @param string $title Название доски
     * @param string|null $description Описание доски. null - без описания
     * @return \stdClass Ответ от api {@link https://yandex.ru/dev/collections/doc/ref/Boards/v1_boards_post-docpage/}
     */
    public function insert(bool $isPrivate, string $title, ?string $description = NULL)
    {
        $params = [
            'is_private' => $isPrivate,
            'title' => $title,
        ];
        if ($description !== NULL) {
            $params['description'] = $description;
        }
        return $this->query('POST', '/v1/boards/', ['json' => $params]);
    }
    
    /**
     * Изменить существующую доску
     *
     * @param string $id ID изменяемой доски
     * @param bool|null $isPrivate Приватность. true - приватная, false - публичная. null - не менять
     * @param string|null $title Новое название доски. null - не менять
     * @param string|null $description Новое описание доски. null - не менять
     * @return \stdClass Ответ от api {@link https://yandex.ru/dev/collections/doc/ref/Boards/v1_boards_id_patch-docpage/}
     */
    public function update(string $id, bool $isPrivate = NULL, ?string $title = NULL, ?string $description = NULL)
    {
        $params = [];
        if ($isPrivate !== NULL) {
            $params['is_private'] = $isPrivate;
        }
        if ($title !== NULL) {
            $params['title'] = $title;
        }
        if ($description !== NULL) {
            $params['description'] = $description;
        }
        return $this->query('PATCH', '/v1/boards/' . $id, ['json' => $params]);
    }
    
    /**
     * Удаление доски
     *
     * @param string $id ID удаляемой доски
     * @return bool true в случае успеха. В случае ошибки будет выброшено исключение {@see \GuzzleHttp\Exception\ClientException}
     */
    public function delete(string $id): bool
    {
        return $this->query('DELETE', '/v1/boards/' . $id);
    }
}