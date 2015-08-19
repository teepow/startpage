(function() {
		var submitAjaxRequest = function(e) {
		var form = $(this).parent();
		var method = form.find('input[name="_method"]').val() || 'POST';

		$.ajax({
			type: method,
			url: form.prop('action'),
			data: form.serialize()
		})

		e.preventDefault();
	};

	$('*[data-click-submits-form').on('change', submitAjaxRequest);
})();
//# sourceMappingURL=all.js.map