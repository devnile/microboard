'use strict';

const Select2 = (function() {
	// Variables
	const $select = $('[data-toggle="select"]');

	// Methods
	function init($this) {
		const options = {
			// dropdownParent: $this.closest('.modal').length ? $this.closest('.modal') : $(document.body),
			// minimumResultsForSearch: $this.data('minimum-results-for-search'),
			// templateResult: formatAvatar
		};

		$this.select2(options);
	}

	// Events
	if ($select.length) {
		$select.each(function() {
			init($(this));
		});
	}
})();
