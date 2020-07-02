'use strict';

const sweetAlert = (function () {
    // Methods
    function deleteBtn(event) {
        event.preventDefault();
        const btn = $(this);

        Swal.fire({
            type: 'warning',
            confirmButtonColor: 'var(--danger)',
            cancelButtonColor: 'var(--light)',
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            title: btn.attr('data-modal-title'),
            text: btn.attr('data-modal-text'),
            confirmButtonText: btn.attr('data-confirm'),
            cancelButtonText: btn.attr('data-cancel'),
            preConfirm: function () {
                btn.parents('form').submit();

                return new Promise(function (resolve) {
                    setTimeout(function () {
                        resolve();
                    }, 5000);
                });
            }
        });
    }

    // Events
    $(document).on('click', '.table-action-delete, .action-delete', deleteBtn);
})();
