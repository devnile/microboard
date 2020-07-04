'use strict';

const Dropzones = (function() {
	// Variables
	const $dropzone = $('[data-toggle="dropzone"]');
	const $dropzonePreview = $('.dz-preview');

	// Methods
	function init($this) {
		const multiple = ($this.data('dropzone-multiple') !== undefined) ? true : false;
		const deleteUrl = $this.data('delete');
		const preview = $this.find($dropzonePreview);
		const acceptedFiles = $this.data('accept');
		const maxFiles = $this.data('max-files');
		const currentFiles = $this.data('files');
		const defaultFile = $this.data('default');
		const dictDefaultMessage = $this.data('label');
		const headers = {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		};
		const inputName = $this.data('name');
		let currentFile = undefined;
		let uploadedMap = {};
		let fileInputName = 'file';

		if (inputName) {
			fileInputName = inputName;
		}

		fileInputName += (multiple ? '[]' : '');

		// Init options
		var options = {
			url: $this.data('dropzone-url'),
			thumbnailWidth: null,
			thumbnailHeight: null,
			previewsContainer: preview.get(0),
			previewTemplate: preview.html(),
			maxFiles: (!multiple) ? 1 : maxFiles,
			acceptedFiles: acceptedFiles,
			dictDefaultMessage,
			headers,
			init() {
				this.on("addedfile", function(file) {
					if (!multiple && currentFile) {
						this.options.maxFiles = 1;
						this.removeFile(currentFile);
					}

					currentFile = file;
				});

				if (currentFiles) {
					for (const mock of currentFiles) {
						this.displayExistingFile(mock, mock.url);
					}

					this.options.maxFiles = (this.options.maxFiles - currentFiles.length);

					if (this.options.maxFiles === 0) {
						this._updateMaxFilesReachedClass();
					}
				}

				if (defaultFile && !currentFiles) {
					const mock = {url: defaultFile};
					this.displayExistingFile(mock, mock.url);
				}
			},
			success(file, response) {
				$this.after('<input type="hidden" name="'+ fileInputName +'" value="' + response.name + '">');
				uploadedMap[file.name] = response.name;
			},
			removedfile(file) {
				const name = uploadedMap[file.name];
				file.previewElement.remove();

				if (deleteUrl) {
					$.ajax({
						url: deleteUrl,
						type: "DELETE",
						data: {name},
						headers
					});
				}

				$this.nextAll('input[name="'+ fileInputName +'"][value="' + name + '"]').remove();
			},
		}

		// Clear preview html
		preview.html('');

		// Init dropzone
		$this.dropzone(options);
	}

	function globalOptions() {
		Dropzone.autoDiscover = false;
	}

	// Events
	if ($dropzone.length) {
		globalOptions();

		$dropzone.each(function() {
			init($(this));
		});
	}
})();
