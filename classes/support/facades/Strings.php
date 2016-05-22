<?php

    namespace Martin\Strings\Classes\Support\Facades;

    use Illuminate\Support\Facades\Facade;
    use Martin\Strings\Classes\StringsService as STRS;

    class Strings extends Facade {

        protected static function getFacadeAccessor() {
            return STRS::FACADE_ACCESSOR;
        }

    }

?>