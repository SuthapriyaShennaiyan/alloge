(function ($) {
	"use strict";
	
	qodefCore.shortcodes.alloggio_core_room_calendar = {};
	
	$(document).ready(function () {
		qodefRoomCalendar.init();
	});
	
	var qodefRoomCalendar = {
		init: function () {
			var $holder = $('.qodef-room-calendar');
			
			if ($holder.length) {
				$holder.each(function () {
					var $form = $(this).find('.qodef-m-form');
					
					qodefRoomCalendar.initCalendar($form);
					qodefRoomCalendar.triggerBooking($form);
				});
			}
		},
		initCalendar: function ($form) {
			var $calendar = $form.find('.qodef-datepick-calendar');
			
			$calendar.datepick({
				dateFormat: qodefGlobal.vars.roomCalendarDateFormat,
				minDate: new Date(),
				changeMonth: false,
				rangeSelect: true,
				useMouseWheel: false,
				prevText: qodefGlobal.vars.roomCalendarPrevText,
				nextText: qodefGlobal.vars.roomCalendarNextText,
				renderer: {
					picker: '<div class="datepick">{months}{popup:start}{popup:end}<div class="datepick-clear-fix"></div></div>',
					monthRow: '<div class="datepick-month-row">{link:prev}{months}{link:next}</div>',
				},
				showAnim: 'fadeIn',
				onSelect: function (dates) {
					var $checkIn = dates[0],
						$checkOut = dates[1];
					
					$form.find('[name="check_in"]').val($checkIn.toDateString());
					$form.find('[name="check_out"]').val($checkOut.toDateString());
					
					if ($checkIn !== $checkOut && !$form.hasClass('qodef--selected')) {
						$form.addClass('qodef--selected');
					} else {
						$form.removeClass('qodef--selected');
					}
				},
				onShow: function ($picker) {
					var reservedDates = $calendar.data('reserved-dates');
					
					if (typeof reservedDates !== 'undefined') {
						var dates = reservedDates.split('|');
						
						$.each(dates, function (index, value) {
							var reserved = $picker.find('.datepick-month tr td a[title*="'+value+'"]');
							
							if (reserved.length) {
								reserved.addClass('datepick-disabled');
							}
						});
					}
					
					// Random delay before loaded the form
					setTimeout(function(){
						$form.addClass('qodef--loaded');
					}, 300);
				}
			});
		},
		triggerBooking: function($form) {
			
			$form.find('.qodef-button').on('click', function(e){
				e.preventDefault();
				
				$form.trigger('submit');
			});
		},
	}
	
	qodefCore.shortcodes.alloggio_core_room_calendar.qodefRoomCalendar = qodefRoomCalendar;
	
})(jQuery);