<?php

    namespace Martin\Strings\Classes;

    use Exception, Lang;

    class StringException extends Exception {

        public function __construct($message = "", $code = 0, Exception $previous = null) {
            parent::__construct($message, $code, $previous);
            $translatedMessage = Lang::get('martin.strings::lang.exceptions.' . $code);
            if(null !== $translatedMessage) {
                $this->message = $translatedMessage;
            }
        }

    }

?>