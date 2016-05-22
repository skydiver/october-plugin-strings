<?php

    namespace Martin\Strings\Classes\Support\Facades;

    use Illuminate\Support\Facades\Facade;
    use Martin\Strings\Classes\StringsManager as SMgr;

    class StringsManager extends Facade {

        protected static function getFacadeAccessor() {
            return SMgr::FACADE_ACCESSOR;
        }

    }

?>