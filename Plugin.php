<?php

    namespace Martin\Strings;

    use Config, Backend, Event;
    use System\Classes\SettingsManager;

    use Cms\Classes\Controller as CmsController;
    use System\Classes\PluginBase;
    use Martin\Strings\Classes\StringsManager;
    use Martin\Strings\Classes\StringsService;
    use Martin\Strings\Classes\Support\Facades\Strings as StringsFacade;

    class Plugin extends PluginBase {

        const MARTIN_STRINGS_NS = 'Martin\Strings';

        public function pluginDetails() {
            return [
                'name'        => 'martin.strings::lang.plugin.name',
                'description' => 'martin.strings::lang.plugin.description',
                'author'      => 'Martin M.',
                'icon'        => 'icon-quote-right',
                'homepage'    => 'https://github.com/skydiver/october-plugin-strings',
            ];
        }

        public function boot() {

            $this->app->bind(StringsManager::FACADE_ACCESSOR, function($app) {
                return new StringsManager();
            });

            $this->app->bind(StringsService::FACADE_ACCESSOR, function($app) {
                return new StringsService($app);
            });

        }

        public function register() {
            Event::listen('cms.page.init', function(CmsController $controller = null) {
                if(null === $controller) {
                    return;
                }
                StringsFacade::initScopeStrings($controller);
            });
        }

        public function registerNavigation() {
            return [
                'pages_strings' => [
                    'label'       => 'martin.strings::lang.plugin.config.label',
                    'url'         => Backend::url('martin/strings/config'),
                    'permissions' => ['martin.strings.manage_strings'],
                    'icon'        => 'icon-quote-right',
                    'order'       => 800
                ]
            ];

        }

        public function registerPermissions() {
            return [
                'martin.strings.manage_strings' => [
                    'tab'   => 'martin.strings::lang.plugin.config.label',
                    'label' => 'martin.strings::lang.plugin.config.description'
                ]
            ];
        }

    }

?>