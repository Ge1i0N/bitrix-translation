[![Latest Stable Version](https://poser.pugx.org/ge1i0n/bitrix-translation/v/stable.svg)](https://packagist.org/packages/ge1i0n/bitrix-translation/)
[![Total Downloads](https://img.shields.io/packagist/dt/ge1i0n/bitrix-translation.svg?style=flat)](https://packagist.org/packages/ge1i0n/bitrix-translation)

# Bitrix Translation - интеграция функционала локализации фреймворка Laravel в Битрикс

## Установка

1. ```composer require ge1i0n/bitrix-translation```

2. Добавляем в init.php

```php

use Gelion\BitrixTranslation\TranslationProvider;

require $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";

TranslationProvider::register();
```

## Использование

Вызов строк локализации [аналогичен Laravel](https://laravel.com/docs/8.x/localization#defining-translation-strings).
Для смены текущего языка используйте конструкцию:
```php
app('translator')->setLocale('en');
```
## Конфигурация

При необходимости пути можно поменять в конфигурации.
.settings_extra.php
```php
'bitrix-translation' => [
    'value' => [
        'langPath' => '/absolute/path/or/path/from/document/root',  // по умолчанию 'local/lang'
        'locale' => 'ru', // по умолчанию 'ru'
        'fallback_locale' => 'ru',  // по умолчанию 'ru'
    ],
    'readonly' => true,
],
```