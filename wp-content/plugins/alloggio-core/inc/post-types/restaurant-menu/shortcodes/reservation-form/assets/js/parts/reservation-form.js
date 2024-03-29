(function ($) {
	'use strict';
	
	qodefCore.shortcodes.alloggio_core_reservation_form = {};
	
	$(document).ready(function () {
		qodefReservationForm.init();
	});
	
	$(document).on("qodefAjaxPageLoad", function () {
		qodefReservationForm.init();
	});
	
	var qodefReservationForm = {
		init: function () {
			this.holder = $('.qodef-reservation-form');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					
					qodefReservationForm.initDatePicker($thisHolder);
					qodefReservationForm.initSelect2($thisHolder);
				});
			}
		},
		initDatePicker: function ($holder) {
			var $datepicker = $holder.find('.qodef-m-date');
			
			if ($datepicker.length) {
				$datepicker.each(function () {
					$(this).datepicker({
						prevText: '<span class="arrow_carrot-left"></span>',
						nextText: '<span class="arrow_carrot-right"></span>',
						dateFormat: 'MM d, yy'
					});
				});
			}
		},
		initSelect2: function ($holder) {
			var $select = $holder.find('.qodef-m-field select');
			
			if ($select.length && typeof $select.select2 === 'function') {
				$select.select2({
					minimumResultsForSearch: Infinity
				});
			}
		}
	};
	
	qodefCore.shortcodes.alloggio_core_reservation_form.qodefReservationForm = qodefReservationForm;
	
})(jQuery);