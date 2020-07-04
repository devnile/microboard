'use strict';

const form = (function () {
    // Variables
    const submitBtn = $('.action-submit');

    // Methods
    function submit(event, btn = null) {
        if (!btn) {
            btn = $(this);
        }

        btn.prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i>');
        $(btn.attr('data-form')).submit();
    }

    // Events
    if (submitBtn.length) {
        submitBtn.on('click', submit);

        $(document).keypress(function (event) {
            const code = (event.keyCode ? event.keyCode : event.which);

            if (code === 13) {
                submit(event, $(this).closest('.action-submit'));
            }
        })
    }
})();
