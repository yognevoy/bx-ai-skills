<?php

/**
 * Прямые запросы к БД
 */

// Старое ядро
global $DB;
$record = $DB->Query("SELECT 1 + 1 AS result;")->Fetch();
AddMessage2Log($record);

// D7
use Bitrix\Main\Application;
use Bitrix\Main\Diag\Debug;

$record = Application::getConnection()
    ->query("SELECT 1 + 1 AS result;")
    ->fetch();
Debug::writeToFile($record);

/*
 * ORM-аналоги основных классов старого ядра:
 *
 * CUser                   Bitrix\Main\UserTable                          (b_user)
 * CFile                   Bitrix\Main\FileTable                          (b_file)
 * CGroup                  Bitrix\Main\GroupTable                         (b_group)
 * CSite                   Bitrix\Main\SiteTable                          (b_lang)
 * CIBlockElement          Bitrix\Iblock\ElementTable                     (b_iblock_element)
 * CIBlock                 Bitrix\Iblock\IblockTable                      (b_iblock)
 * CIBlockProperty         Bitrix\Iblock\PropertyTable                    (b_iblock_property)
 * CIBlockSection          Bitrix\Iblock\SectionTable                     (b_iblock_section)
 * CIBlockPropertyEnum     Bitrix\Iblock\PropertyEnumerationTable         (b_iblock_property_enum)
 * CCatalogProduct         Bitrix\Catalog\ProductTable                    (b_catalog_product)
 * CCatalogGroup           Bitrix\Catalog\GroupTable                      (b_catalog_group)
 * CCatalogStore           Bitrix\Catalog\StoreTable                      (b_catalog_store)
 * CSaleOrder              Bitrix\Sale\Internals\OrderTable               (b_sale_order)
 * CSaleBasket             Bitrix\Sale\Internals\BasketTable              (b_sale_basket)
 * CSaleOrderProps         Bitrix\Sale\Internals\OrderPropsTable          (b_sale_order_props)
 * CSaleOrderPropsValue    Bitrix\Sale\Internals\OrderPropsValueTable     (b_sale_order_props_value)
 */
