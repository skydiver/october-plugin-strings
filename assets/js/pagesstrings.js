+function ($) {
    "use strict";

    var PageStrings = function () {

        this.updateString = function (recordId) {
            var newPopup = $('<a />');

            newPopup.popup({
                handler: 'onUpdateString',
                extraData: {
                    'record_id': recordId
                }
            });
        };

        this.createString = function () {
            var newPopup = $('<a />');
            newPopup.popup({ handler: 'onCreateString' });
        };

    }

    $.templateStrings = new PageStrings();

}(window.jQuery);