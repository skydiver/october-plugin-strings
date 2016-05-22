<?php

    namespace Martin\Strings\Classes;

    use Illuminate\Container\Container;
    use Cms\Classes\Controller as CmsController;
    use Martin\Strings\Classes\StringsManager;
    use Martin\Strings\Models\String as StringsModel;

    class StringsService {

        const FACADE_ACCESSOR = 'Martin\Strings\StringsRegistrationService';

        const STRING_SCOPE_GLOBAL = 'global';
        const STRING_SCOPE_PAGE   = 'page';
        const STRING_SCOPE_LAYOUT = 'layout';

        private $app;
        private $tmplTag = 'mstr';

        public function __construct(Container $container) {
            $this->app = $container;
        }

        public function initScopeStrings(CmsController $controller = null) {
            if(!$controller instanceof CmsController) {
                return $this;
            }
            $scopeBase = &$controller->vars['this'];
            foreach($this->getScopeStrings() as $stringScope) {
                $strings = StringsModel::stringScope($stringScope)->get();
                if(self::STRING_SCOPE_GLOBAL === $stringScope) {
                    $scopeBase[$this->tmplTag] = new \stdClass();
                    $scope = &$scopeBase[$this->tmplTag];
                } else {
                    $scopeBase[$stringScope]->mstr = new \stdClass();
                    $scope = &$scopeBase[$stringScope]->{$this->tmplTag};
                }
                $scope = $this->initScope($stringScope, $strings);
                unset($scope);
            }
            return $this;
        }

        public function getScopeStrings() {
            $stringConsts = [
                self::STRING_SCOPE_GLOBAL,
                self::STRING_SCOPE_PAGE,
                self::STRING_SCOPE_LAYOUT,
            ];
            return $stringConsts;
        }

        protected function initScope($scope, $strings) {
            $scopeObj = null;
            try {
                $scopeObj = $this->app
                    ->make(StringsManager::FACADE_ACCESSOR)
                    ->setScope($scope)
                    ->setStrings($strings);
            } catch (\Exception $exc) {
                throw new StringException($exc->getMessage(), 10001);
            }
            return $scopeObj;
        }

    }

?>