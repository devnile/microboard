'use strict';

const Trix = (function() {
    // Variables
    const $trix = $('trix-editor');

    // Methods
    function init($this) {
        const storeUrl = $this.data('store-url');
        const deleteUrl = $this.data('delete-url');
        const headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        };

        $this.on('trix-attachment-add', function(event) {
            event = event.originalEvent;
            const attachment = event.attachment;
            const file = attachment.file;
            const form = new FormData;
            form.append('Content-Type', file.type);
            form.append('file', file);

            $.ajax({
                type: 'POST',
                url: storeUrl,
                data: form,
                contentType: false,
                processData: false,
                headers,
                xhr: function() {
                    const xhr = new window.XMLHttpRequest();
                    xhr.upload.onprogress = function(event) {
                        attachment.setUploadProgress(
                            event.loaded / event.total * 100
                        );
                    };
                    return xhr;
                },
                success: function(data) {
                    attachment.setAttributes({
                        filename: data.name,
                        url: data.url
                    });
                }
            });
        });
        $this.on('trix-attachment-remove', function(event) {
            event = event.originalEvent;
            const name = event.attachment.attachment.attributes.values.filename;

            $.ajax({
                url: deleteUrl,
                type: "DELETE",
                data: {name},
                headers
            });
        });
    }

    // Events
    if ($trix.length) {
        $trix.each(function() {
            init($(this));
        });
    }
})();
