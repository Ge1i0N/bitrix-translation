<?php

namespace Gelion\BitrixTranslation;

use Illuminate\Container\Container;

class TranslationProvider
{
    public static function register()
    {
        $provider = new TranslationServiceProvider(Container::getInstance());
        $provider->register();
    }
}
