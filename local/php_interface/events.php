<?php

use Bitrix\Main\EventManager;

$eventManager = EventManager::getInstance();

/**
 * Названия события для ORM-классов, в том числе, для Highload-блоков:
 * Название события которое нужно\ передать во второй аргумент функции addEventHandler сторит по формуле
 * "поле NAME из таблицы b_hlblock_entity" + событие из списка ниже 
 * OnBeforeAdd
 * OnAfterAdd
 * OnBeforeUpdate
 * OnAfterUpdate
 * OnBeforeDelete
 */

// Правило именования событий: <имя_hl_block><имя_события>
$eventManager->addEventHandler('', 'PantoneColorsOnBeforeAdd', [
    '\Otus\Hlblock\Event',
    'onBeforeElementAdd'
]);
