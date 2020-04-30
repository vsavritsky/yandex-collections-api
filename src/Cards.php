<?php

namespace YandexCollectionsApi;

class Cards extends AbstractBaseApi
{
    /**
     * Получить все карточки доски
     *
     * @param string $boardId ID доски
     * @param int $page Страница
     * @param int $pageSize Сколько элементов на странице. Максимум 100
     * @return \stdClass Ответ от api {@link https://yandex.ru/dev/collections/doc/ref/Cards/v1_cards_get-docpage/}
     */
    public function list(string $boardId, int $page = 1, int $pageSize = 20): \stdClass
    {
        $params['query'] = ['board_id' => $boardId, 'page' => $page, 'page_size' => $pageSize];
        return $this->query('GET', '/v1/cards/', $params);
    }
    
    /**
     * Информация о определенной карточке
     *
     * @param string $id ID карточки
     * @return \stdClass Ответ от api {@link https://yandex.ru/dev/collections/doc/ref/Cards/v1_cards_id_get-docpage/}
     */
    public function get(string $id): \stdClass
    {
        return $this->query('GET', '/v1/cards/' . $id . '/');
    }
    
    /**
     * Добавить на доску новую карточку
     *
     * @param string $boardId ID доски, к которой будет прикреплена карточка
     * @param string $pageDomain Домен сайта, который будет отображаться для этой карточки
     * @param string $pageTitle Title страницы, на которую ведет ссылка. Нигде не отображается.
     * @param string $description Описание карточки. Видно при просмотре карточки
     * @param string $pageURL Ссылка на страницу-источник этой карточки
     * @param \YandexCollectionsApi\Data\Content $content Перечисление картинок и видео, которые будут прикреплены к карточке {@see \YandexCollectionsApi\Data\Content}. Можно прикреплять несколько объектов, но выводиться будет только первый. При проверке по id карточки тоже показывает один объект. Непонятно зачем сделали возможность прикреплять несколько.
     * @return \stdClass Ответ от api {@link https://yandex.ru/dev/collections/doc/ref/Cards/v1_cards_post-docpage/}
     *
     * Списки аргументов переменной длины - {@link https://www.php.net/manual/ru/functions.arguments.php#functions.variable-arg-list}
     */
    public function insert(string $boardId, string $pageDomain, string $pageTitle, string $description, string $pageURL, Data\Content ...$content): \stdClass
    {
        $params = [
            'board_id' => $boardId,
            'description' => $description,
            'source_meta' => [
                'page_domain' => $pageDomain,
                'page_title' => $pageTitle,
                'page_url' => $pageURL,
            ]
        ];
        foreach ($content as $value) {
            $tmp = [];
            $tmp['source_type'] = $value->sourceType;
            if ($value->sourceUrl !== NULL) {
                $tmp['source']['url'] = $value->sourceUrl;
            }
            $params['content'][] = $tmp;
        }
        return $this->query('POST', '/v1/cards/', ['json' => $params]);
    }
    
    /**
     * Изменить существующую карточку
     *
     * @param string $cardID ID изменяемой карточки
     * @param string|null $boardId ID доски, к которой нужно прикрепить эту карточку. null - не менять
     * @param string|null $description Описание карточки. null - не менять
     * @return \stdClass Ответ от api {@link https://yandex.ru/dev/collections/doc/ref/Cards/v1_cards_id_patch-docpage/}
     */
    public function update(string $cardID, ?string $boardId = NULL, ?string $description = NULL): \stdClass
    {
        $params = [];
        if ($boardId !== NULL) {
            $params['board_id'] = $boardId;
        }
        if ($description !== NULL) {
            $params['description'] = $description;
        }
        return $this->query('PATCH', '/v1/cards/' . $cardID . '/', ['json' => $params]);
    }
    
    public function delete(string $id): bool
    {
        return $this->query('DELETE', '/v1/cards/' . $id);
    }
    
}