<?php

    namespace Martin\Strings\Classes;

    use Illuminate\Database\Eloquent\Collection;
    use Martin\Strings\Models\String;

    class StringsManager {

        const FACADE_ACCESSOR = 'Martin\Strings\StringsManager';

        private $scope   = '';
        private $strings = null;

        public function setScope($scope) {
            $this->scope = $scope;
            return $this;
        }

        public function setStrings(Collection $strings) {
            $this->strings = $strings;
            return $this;
        }

        public function __get($stringName) {
            $string = $this->strings->find($stringName);
            if(!$string instanceof String) {
                return null;
            }
            $stringVal = $string->string_value;
            return $stringVal;
        }

        public function __isset($stringName) {
            return (bool)$this->strings->contains($stringName);
        }

    }

?>