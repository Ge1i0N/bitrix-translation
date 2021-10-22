<?php

namespace Gelion\BitrixTranslation;

use Bitrix\Main\Config\Configuration;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\TranslationServiceProvider as LaravelTranslationServiceProvider;
use Illuminate\Translation\Translator;
use Illuminate\Filesystem\Filesystem;

class TranslationServiceProvider extends LaravelTranslationServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLoader();
        $bitrixConfig = Configuration::getValue('bitrix-translation');

        $locale = isset($bitrixConfig['locale']) ? $bitrixConfig['locale'] : 'ru';
        $fallback_locale = isset($bitrixConfig['fallback_locale']) ? $bitrixConfig['fallback_locale'] : 'ru';

        $this->app->singleton('translator', function ($app) use ($locale, $fallback_locale) {
            $loader = $app['translation.loader'];

            $trans = new Translator($loader, $locale);

            $trans->setFallback($fallback_locale);

            return $trans;
        });

        $this->app->singleton('files', function () {
            return new Filesystem();
        });
    }

    /**
     * Register the translation line loader.
     *
     * @return void
     */
    protected function registerLoader()
    {
        $bitrixConfig = Configuration::getValue('bitrix-translation');
        $langPath = isset($bitrixConfig['langPath']) ? $bitrixConfig['langPath'] : 'local/lang';

        $this->app->singleton('translation.loader', function ($app) use ($langPath) {
            return new FileLoader($app['files'], $langPath);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['translator', 'translation.loader'];
    }
}
