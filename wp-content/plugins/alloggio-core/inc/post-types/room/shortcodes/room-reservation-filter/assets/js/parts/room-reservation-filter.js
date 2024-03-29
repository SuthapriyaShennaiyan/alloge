(function ($) {
	"use strict";
	
	qodefCore.shortcodes.alloggio_core_room_reservation_filter = {};
	
	$(document).ready(function () {
		qodefRoomReservationFilter.init();
	});
	
	var qodefRoomReservationFilter = {
		init: function () {
			var $holder = $('.qodef-room-reservation-filter');
			
			if ($holder.length) {
				$holder.each(function () {
					var $thisHolder = $(this),
						$form = $thisHolder.find('.qodef-m-form');
					
					qodefRoomReservationFilter.initCalendar($form);
					qodefRoomReservationFilter.initFormDatepicker($form);
					qodefRoomReservationFilter.initSelect2($form);
					qodefRoomReservationFilter.triggerCalendarIcon($form);
					qodefRoomReservationFilter.setGuests($form);
					qodefRoomReservationFilter.triggerBooking($form);
					
					// Random delay before loaded the form
					setTimeout(function(){
						$thisHolder.addClass('qodef--loaded');
					}, 600);
				});
			}
		},
		initCalendar: function ($form) {
			var $calendars = $form.find('.qodef-datepick-calendar');
			
			if ($calendars.length) {
				$calendars.each(
					function () {
						var $calendar = $( this );

						$calendar.datepick({
							dateFormat: qodefGlobal.vars.roomCalendarDateFormat,
							minDate: new Date(),
							selectDefaultDate: true,
							changeMonth: false,
							monthsToShow: qodefCore.windowWidth > 680 ? 2 : 1,
							useMouseWheel: false,
							prevText: qodefGlobal.vars.roomCalendarPrevText,
							nextText: qodefGlobal.vars.roomCalendarNextText,
							renderer: {
								picker: '<div class="datepick">{months}{popup:start}{popup:end}<div class="datepick-clear-fix"></div></div>',
								monthRow: '<div class="datepick-month-row">{link:prev}{months}{link:next}</div>',
							},
							showAnim: 'fadeIn',
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
							}
						});
					}
				);
			}
		},
		initFormDatepicker: function ($form) {
			var $checkInDate = $form.find('.qodef-m-field-input.qodef--check-in'),
				$checkInDateValue = $checkInDate.val(),
				$checkOutDate = $form.find('.qodef-m-field-input.qodef--check-out'),
				$checkOutDateValue = $checkOutDate.val();
			
			if ($checkInDate.length && $checkOutDate.length) {
				// Set default date values if dates are not froward through query
				if ($checkInDateValue.length <= 0) {
					$checkInDate.datepick('option', 'defaultDate', '0');
				}
				
				// Set default date values if dates are not froward through query
				if ($checkOutDateValue.length <= 0) {
					$checkOutDate.datepick('option', 'defaultDate', '+1d');
				}
				
				$checkInDate.datepick('option', 'onSelect', function (dates) {
					// Set plus 1 day for selected check in date
					var selectedDate = dates[0];
					
					$checkOutDate.datepick('setDate', selectedDate).datepick('option', 'minDate', selectedDate).datepick('show');
				});
			}
		},
		initSelect2: function ($form) {
			var $selectFields = $form.find('.qodef--select2');
			
			if ($selectFields.length) {
				$selectFields.each(function () {
					var $selectField = $(this);
					
					if (typeof $selectField.select2 === 'function') {
						$selectField.select2({
							minimumResultsForSearch: Infinity,
						});
					}
				});
			}
		},
		triggerCalendarIcon: function ($form) {
			var $iconTrigger = $form.find('.qodef-m-field-input-icon');
			
			if ($iconTrigger.length) {
				$iconTrigger.on('click', function () {
					var $calendar = $(this).prev('.qodef-datepick-calendar');
					
					if ($calendar.length && !$calendar.is(':focus')) {
						$calendar.trigger('focus');
					}
				});
			}
		},
		setGuests: function ($form) {
			var $guestsField = $form.find('.qodef-m-field.qodef--guests');
			
			if ($guestsField.length) {
				qodefRoomReservationFilter.updateGuests($guestsField);
				qodefRoomReservationFilter.setGuestsTriggers($guestsField);
			}
		},
		updateGuests: function ($guestsField) {
			var $guestsInput = $guestsField.find('.qodef-m-field-input'),
				guestsValue = '',
				$persons = $guestsField.find('.qodef-m-field-persons'),
				$personsInput = $persons.find('.qodef-e-input');
			
			if ($personsInput.length) {
				$.each($personsInput, function () {
					var $input = $(this),
						inputValue = $input.val(),
						singularLabel = $input.data('singular-label'),
						pluralLabel = $input.data('plural-label');
					
					// Set guests label
					if (inputValue > 0) {
						
						// Set separator between persons
						if (guestsValue.length) {
							guestsValue += ', ';
						}
						
						// Set new persons value
						guestsValue += inputValue;
						
						// Set singular or plural label after the number
						if (inputValue > 1) {
							guestsValue += ' ' + pluralLabel;
						} else {
							guestsValue += ' ' + singularLabel;
						}
					}
				});
			}
			
			// Update guests input field
			if (guestsValue.length) {
				$guestsInput.val(guestsValue);
			}
		},
		setGuestsTriggers: function ($guestsField) {
			var $persons = $guestsField.find('.qodef-m-field-persons');
			
			$guestsField.find('.qodef-m-field-input').on('click', function (e) {
				qodefRoomReservationFilter.setGuestsVisibility($persons);
			});
			
			$guestsField.find('.qodef-m-field-input-icon').on('click', function (e) {
				qodefRoomReservationFilter.setGuestsVisibility($persons);
			});
			
			$guestsField.find('.qodef-button').on('click', function (e) {
				e.preventDefault();
				
				qodefRoomReservationFilter.setGuestsVisibility($persons);
			});
			
			// Close on other input trigger
			$guestsField.siblings().find('input, select, .select2').on('click', function (e) {
				if ($persons.hasClass('qodef--opened')) {
					qodefRoomReservationFilter.setGuestsVisibility($persons);
				}
			});
			
			// Close on escape
			$(document).keyup(function (e) {
				if (e.keyCode === 27 && $persons.hasClass('qodef--opened')) { // KeyCode for ESC button is 27
					qodefRoomReservationFilter.setGuestsVisibility($persons);
				}
			});
			
			// Trigger recursion on input change
			$persons.find('.qodef-e-input').on('change', function () {
				qodefRoomReservationFilter.updateGuests($guestsField);
			});
		},
		setGuestsVisibility: function ($persons) {
			var itemTopOffset = $persons.offset().top,
				itemHeight = $persons.outerHeight();
			
			// Set item position
			if (itemTopOffset + itemHeight > qodefCore.windowHeight + qodefCore.scroll) {
				$persons.addClass('qodef--above');
			} else {
				$persons.removeClass('qodef--above');
			}
			
			// Set item visibility
			if ($persons.hasClass('qodef--opened')) {
				$persons.removeClass('qodef--opened');
			} else {
				$persons.addClass('qodef--opened');
			}
		},
		triggerBooking: function($form) {
			
			$form.find('.qodef--booking .qodef-button').on('click', function(e){
				e.preventDefault();
				
				$(this).parents('form').trigger('submit');
			});
		},
	}
	
	qodefCore.shortcodes.alloggio_core_room_reservation_filter.qodefRoomReservationFilter = qodefRoomReservationFilter;
	
})(jQuery);