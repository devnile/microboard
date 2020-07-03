'use strict';

const dt = (function () {
    // Variables
    const datatable = $('.dataTables_wrapper'),
        buttons = $('.dt-buttons', datatable),
        dtHead = $('thead', datatable);

    // Methods
    function init($this) {
        $this
            .removeClass('btn-group')
            .find('.btn')
            .removeClass('btn-secondary')
            .addClass('btn-sm btn-default');

        $('.btn', $this).each(function (index, btn) {
            btn = $(btn);

            const span = $('span > span', btn);
            const title = span.text();
            span.remove();
            btn.attr('title', title)
                .tooltip({
                    'placement': 'bottom'
                })
        });
    }

    function addTHeadClasses(head) {
        head.addClass('thead-light');
    }

    function makeFilterLabelAsPlaceholder(label) {
        const text = label.find('span').text();
        label.find('span').remove();
        label.find('input').attr('placeholder', text);
    }

    // Events
    if (datatable.length) {
        init(buttons);

        if (dtHead.length) {
            addTHeadClasses(dtHead);
        }

        if ($('.dataTables_filter', datatable).length) {
            makeFilterLabelAsPlaceholder($('.dataTables_filter', datatable));
        }
    }
})();
