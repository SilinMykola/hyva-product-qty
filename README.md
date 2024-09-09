# Biotus_ProductQty module

Module adds a dynamic block on the PDP to show the product qty.

Модуль добюавляет динамический блок на страницу продукта и отображает текущее количество продукта

## Installation details

For installation please, copy the module code to app/code/Biotus/ProductQty directory

Для установки модуля пожалуйста скопируйте код в директорию app/code/Biotus/ProductQty

## Layouts

The module adds block with AJAX request for the simple products salable qty on the PDP.

Модуль добавляет блок с аякс запросом для простых продуктов и отображает количество продукта на странице деталей продукта.

## Preparation

To enable functionality, you should open the admin panel. Go to Stores > Configuration > Hyva Themes > Product Qty Block
In General Tab set Enable to Yes. Set the TTL time for the block. The Varnish will cache the block for a specified amount of time
By default the block is disabled and the ttl time is set to 3600 seconds.  Save the configuration and clear the cache.

Для включения функционала Вам необходимо открыть панель администратора, перейти по пути Stores > Configuration > Hyva Themes > Product Qty Block.
В разделе Основное включить функционал выбрав Enable в значение Yes. Для кеширования Варнишем установить в поле TTL 
время жизни кеша в секундах. Сохранить настройки, очистить кеш Magento и перезагрузить страницу продукта.

## Additional information

After the enabling the block, you can see the product qty block on the PDP for the simple products.
By default, on the PDP the block sends the AJAX request every 30 seconds to upgrade the qty information, or the data
will be upgraded with sectionData for the Hyva theme.

После включения блока вы можете увидеть блок с доступным количеством продукта на странице информации о продукте.
По умолчанию блок отправляет запросы для обновления данных о количестве продукта каждые 30 секунд при бездействии или 
обновляет данные вместе с данными секций темы Хува.

