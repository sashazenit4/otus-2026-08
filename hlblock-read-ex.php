<?php

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Entity\Query;

/**
 * @var \CMain $APPLICATION
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('Пример чтения из hlblock');

Loader::includeModule('highloadblock');
//Получить массив с информацией о самом HL-блоке
$pantoneColorsHlBlockInfo = HighloadBlockTable::getList([
    'filter' => [
        '=NAME' => 'PantoneColors',
    ],
])->fetch();
// Создать класс сущности, с которым можно работать через getList или \Bitrix\Main\Entity\Query
$pantoneColorsEntity = HighloadBlockTable::compileEntity($pantoneColorsHlBlockInfo);

// $pantoneColorsClassName = \PantoneColorsTable::class; - без выполнения строки 23 Битрикс не создаст ОРМ класс
$pantoneColorsClassName = $pantoneColorsEntity->getDataClass();

// $pantoneColorsClassName::getList(['select' => ['*']]); // Получаем все элементы
$q = new Query($pantoneColorsClassName);

$q->setSelect(['*']);
$colors = $q->exec()->fetchAll();

foreach ($colors as $color) {
    echo sprintf(
        '<div style="border: 1px solid #000; background-color: #%s; padding: 10px; margin-bottom: 5px; width: 50px; height: 50px; color: #000000">%s</div>',
        $color['UF_HEX_CODE'],
        $color['UF_NAME']
    );
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
