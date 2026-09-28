<?php

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Type\DateTime;

/**
 * @var \CMain $APPLICATION
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('Пример создания элемента hlblock');

Loader::includeModule('highloadblock');

$hlblockCode = 'PantoneColors';

$hlblockInfo = HighloadBlockTable::getList([
    'filter' => [
        '=NAME' => $hlblockCode,
    ],
])->fetch();

$hlblockEntity = HighloadBlockTable::compileEntity($hlblockInfo);

$hlblockClassName = $hlblockEntity->getDataClass();

$data = [
    [
        'UF_NAME' => 'Жёлтый',
        // 'UF_ACTIVE_FROM' => (new DateTime())->add('-50 days'),
        'UF_XML_ID' => \CUtil::translit('Жёлтый', 'ru'),
        'UF_HEX_CODE' => 'fffb00',
        'UF_TAGS' => [
            'Как у пчёл',
        ],
    ],
    [
        'UF_NAME' => 'Зелёный',
        'UF_XML_ID' => \CUtil::translit('Зелёный', 'ru'),
        // 'UF_ACTIVE_FROM' => (new DateTime())->add('+30 days'),
        'UF_HEX_CODE' => '338347',
        'UF_TAGS' => [
            'Как светофор',
        ],
    ],
];

$hlblockClassName::add($data[0]);
$hlblockClassName::add($data[1]);

$hlblockClassName::update(1, ['UF_XML_ID' => '0f0000']);
// $hlblockClassName::delete(11);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
