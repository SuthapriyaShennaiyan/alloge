(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefRoomSingle.init();
	});
	
	$(window).on('load', function () {
		qodefRoomStickySidebar.init();
	});
	
	$(window).on('resize', function () {
		if (qodefCore.windowWidth > 1024 && qodefRoomStickySidebar.holder.length) {
			qodefRoomStickySidebar.callStack(qodefRoomStickySidebar.holder);
		}
	});
	
	$(window).on('scroll', function () {
		if (qodefCore.windowWidth > 1024 && qodefRoomStickySidebar.holder.length) {
			qodefRoomStickySidebar.infoPosition(qodefRoomStickySidebar.holder);
		}
	});
	
	$(document).on('alloggio_trigger_get_new_posts', function (e) {
		qodefRoomStickySidebar.init();
	});
	
	var qodefRoomStickySidebar = {
		holder: $('#qodef-room-sticky-widget'),
		init: function () {
			var info = this.holder;
			
			if (info.length && qodefCore.windowWidth > 1024) {
				info.wrapper = info.parents('#qodef-room-list-sidebar');
				info.offsetM = info.offset().top - info.wrapper.offset().top;
				info.adj = 15;
				
				qodefRoomStickySidebar.callStack(info);
			}
		},
		calc: function (info) {
			var content = $('.qodef-page-content-section'),
				headerH = qodefCore.body.hasClass('qodef-header-appearance--none') ? 0 : parseInt(qodefGlobal.vars.headerHeight, 10);
			
			if (qodefCore.windowWidth > 1024 && content.height() < 100) {
				content.css('height', info.wrapper.height() - content.height());
			}
			
			info.start = content.offset().top;
			info.end = content.height();
			info.h = info.wrapper.height();
			info.w = info.width();
			info.left = info.offset().left;
			info.top = headerH + qodefGlobal.vars.adminBarHeight - info.offsetM;
			info.data('state', 'top');
		},
		infoPosition: function (info) {
			if (qodefCore.scroll < info.start - info.top && qodefCore.scroll + info.h && info.data('state') !== 'top') {
				TweenMax.to(info.wrapper, .1, {
					y: 5,
				});
				TweenMax.to(info.wrapper, .3, {
					y: 0,
					delay: .1,
				});
				info.data('state', 'top');
				info.wrapper.css({
					'position': 'static',
				});
			} else if (qodefCore.scroll >= info.start - info.top && qodefCore.scroll + info.h + info.adj <= info.start + info.end && info.data('state') !== 'fixed') {
				var c = info.data('state') === 'top' ? 1 : -1;
				info.data('state', 'fixed');
				info.wrapper.css({
					'position': 'fixed',
					'top': info.top,
					'left': info.left,
					'width': info.w
				});
				TweenMax.fromTo(info.wrapper, .2, {
					y: 0
				}, {
					y: c * 10,
					ease: Power4.easeInOut
				});
				TweenMax.to(info.wrapper, .2, {
					y: 0,
					delay: .2,
				});
			} else if (qodefCore.scroll + info.h + info.adj > info.start + info.end && info.data('state') !== 'bottom') {
				info.data('state', 'bottom');
				info.wrapper.css({
					'position': 'absolute',
					'top': info.end - info.h - info.adj,
					'left': parseInt(info.wrapper.parents('.qodef-page-sidebar-section').css('paddingLeft'), 10),
				});
				TweenMax.fromTo(info.wrapper, .1, {
					y: 0
				}, {
					y: -5,
				});
				TweenMax.to(info.wrapper, .3, {
					y: 0,
					delay: .1,
				});
			}
		},
		callStack: function (info) {
			this.calc(info);
			this.infoPosition(info);
		}
	};
	
	var qodefRoomSingle = {
		holder: $('.qodef-room-single'),
		form: $('#qodef-room-reservation-form'),
		date: [],
		priceField: '',
		price: 0,
		guestsPrice: 0,
		init: function () {
			
			if (this.holder.length) {
				qodefRoomSingle.initCalendar();
				qodefRoomSingle.initFormDatepicker();
				
				// Prevent scrolling on page load, because of form focus
				window.scrollTo(0, 0);
				qodefCore.body.scrollTop = 0;
				
				qodefRoomSingle.initSelect2();
				qodefRoomSingle.setFormTriggers();
				qodefRoomSingle.triggerBooking();
				
				// Random delay before loaded the form
				setTimeout(function(){
					qodefRoomSingle.form[0].classList.add('qodef--loaded');
				}, 600);
			}
		},
		initCalendar: function () {
			var $calendars = qodefRoomSingle.holder.find('.qodef-datepick-calendar');
			
			if ($calendars.length) {
				$calendars.each(function(){
					var $calendar = $(this),
						isRangeSlider = $calendar.hasClass('qodef--range-on');
					
					$calendar.datepick({
						dateFormat: qodefGlobal.vars.roomCalendarDateFormat,
						minDate: new Date(),
						changeMonth: false,
						rangeSelect: isRangeSlider,
						monthsToShow: isRangeSlider && qodefCore.windowWidth > 680 ? 2 : 1,
						useMouseWheel: ! isRangeSlider,
						prevText: qodefGlobal.vars.roomCalendarPrevText,
						nextText: qodefGlobal.vars.roomCalendarNextText,
						renderer: {
							picker: '<div class="datepick">{months}{popup:start}{popup:end}<div class="datepick-clear-fix"></div></div>',
							monthRow: '<div class="datepick-month-row">{link:prev}{months}{link:next}</div>',
						},
						showAnim: 'fadeIn',
						onShow: function ($picker) {
							var reservedDates = $calendar.data('reserved-dates');
					
							if (typeof reservedDates !== 'undefined' && reservedDates !== '') {
								var dates = reservedDates.split('|');
								
								$.each(dates, function (index, value) {
									var reserved = $picker.find('.datepick-month tr td a[title*="'+value+'"]');
									
									if (reserved.length) {
										reserved.addClass('datepick-disabled');
									}
								});
							}
							
							var lastRoomDates = $calendar.data('last-room-dates');
							if (typeof lastRoomDates !== 'undefined' && lastRoomDates !== '') {
								var lastDates = lastRoomDates.split('|');
								
								$.each(lastDates, function (index, value) {
									var $lastRoom = $picker.find('.datepick-month tr td a[title*="'+value+'"]');
									
									if ($lastRoom.length) {
										$lastRoom.addClass('datepick-last-room');
									}
								});
							}
						}
					});
				});
			}
		},
		initFormDatepicker: function () {
			var $checkInDate = qodefRoomSingle.form.find('.qodef-m-field-input.qodef--check-in'),
				$checkInDateValue = $checkInDate.val(),
				$checkOutDate = qodefRoomSingle.form.find('.qodef-m-field-input.qodef--check-out'),
				$checkOutDateValue = $checkOutDate.val();

			if ($checkInDate.length && $checkOutDate.length) {
				// Set default date values if dates are not froward through query
				if ($checkInDateValue.length <= 0) {
					$checkInDate.datepick('option', 'selectDefaultDate', true);
					$checkInDate.datepick('option', 'defaultDate', '0');
				}
				
				$checkInDate.datepick('option', 'onSelect', function (dates) {
					// Set plus 1 day for selected check in date
					var selectedDate = new Date(dates[0].getFullYear(), dates[0].getMonth(), dates[0].getDate() + 1);
				
					$checkOutDate.datepick('setDate', selectedDate).datepick('option', 'minDate', selectedDate).datepick('show');
				});
				
				// Set default date values if dates are not froward through query
				if ($checkOutDateValue.length <= 0) {
					$checkOutDate.datepick('option', 'selectDefaultDate', true);
					$checkOutDate.datepick('option', 'defaultDate', '+1d');
				}
				
				$checkOutDate.datepick('option', 'onSelect', function (dates) {
					// Calculate a room price
					qodefRoomSingle.calculatePrice();
				});
				
				// Populate date and price fields into global variable
				qodefRoomSingle.date.checkIn = $checkInDate;
				qodefRoomSingle.date.checkOut = $checkOutDate;
				qodefRoomSingle.priceField = qodefRoomSingle.form.find('.qodef-m-field.qodef--price .qodef-m-price-value');
				qodefRoomSingle.price = qodefRoomSingle.priceField.length ? qodefRoomSingle.priceField.data('room-price') : 0;
			}
		},
		initSelect2: function () {
			var $selectFields = qodefRoomSingle.form.find('.qodef--select2');
			
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
		setFormTriggers: function () {
			qodefRoomSingle.triggerCalendarIcon();
			qodefRoomSingle.setRoomsAmount();
			qodefRoomSingle.setGuests();
			qodefRoomSingle.setExtraServicesTriggers();
		},
		triggerCalendarIcon: function () {
			var $iconTrigger = qodefRoomSingle.form.find('.qodef-m-field-input-icon');
			
			if ($iconTrigger.length) {
				$iconTrigger.on('click', function () {
					var $calendar = $(this).prev('.qodef-datepick-calendar');
					
					if ($calendar.length && !$calendar.is(':focus')) {
						$calendar.trigger('focus');
					}
				});
			}
		},
		setRoomsAmount: function () {
			var $roomAmountField = qodefRoomSingle.form.find('[name="qodef_room_amount"]');
			
			if ($roomAmountField.length) {
				$roomAmountField.on('change', function () {
					qodefRoomSingle.form.find('[name="quantity"]').val(parseInt($(this).val(), 10));
				});
			}
		},
		setGuests: function () {
			var $guestsField = qodefRoomSingle.form.find('.qodef-m-field.qodef--guests');
		
			if ($guestsField.length) {
				qodefRoomSingle.updateGuests($guestsField);
				qodefRoomSingle.setGuestsTriggers($guestsField);
			}
		},
		updateGuests: function ($guestsField) {
			var $guestsInput = $guestsField.find('.qodef-m-field-input'),
				guestsValue = '',
				guestsCount = 0,
				$persons = $guestsField.find('.qodef-m-field-persons'),
				$personsInput = $persons.find('.qodef-e-input');
			
			if ($personsInput.length) {
				$.each($personsInput, function () {
					var $input = $(this),
						inputValue = parseInt($input.val(), 10),
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
				
					// Set guests count
					if (!$input.parents().hasClass('qodef--infant')) {
						guestsCount += inputValue;
					}
				});
			}
			
			// Update guests input field
			if (guestsValue.length) {
				$guestsInput.val(guestsValue);
				$guestsInput.data('count', guestsCount);
			}
			
			// Calculate a new room price
			qodefRoomSingle.updateGuestsPrice($persons);
		},
		setGuestsTriggers: function ($guestsField) {
			var $persons = $guestsField.find('.qodef-m-field-persons');
			
			$guestsField.find('.qodef-m-field-input').on('click', function (e) {
				qodefRoomSingle.setGuestsVisibility($persons);
			});
			
			$guestsField.find('.qodef-m-field-input-icon').on('click', function (e) {
				qodefRoomSingle.setGuestsVisibility($persons);
			});
			
			$guestsField.find('.qodef-button').on('click', function (e) {
				e.preventDefault();
				
				qodefRoomSingle.setGuestsVisibility($persons);
			});
			
			// Close on other input trigger
			$guestsField.siblings().find('input, select, .select2').on('click', function (e) {
				if ($persons.hasClass('qodef--opened')) {
					qodefRoomSingle.setGuestsVisibility($persons);
				}
			});
			
			// Close on escape
			$(document).keyup(function (e) {
				if (e.keyCode === 27 && $persons.hasClass('qodef--opened')) { // KeyCode for ESC button is 27
					qodefRoomSingle.setGuestsVisibility($persons);
				}
			});
			
			// Trigger recursion on input change
			$persons.find('.qodef-e-input').on('change', function () {
				qodefRoomSingle.updateGuests($guestsField);
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
		updateGuestsPrice: function($persons) {
			var minCapacity = parseInt(qodefRoomSingle.form.find('input[name="qodef_room_min_capacity"]').val(), 10),
				$adultInput = $persons.find('.qodef--adult .qodef-e-input'),
				adultsNumber = parseInt($adultInput.val(), 10),
				adultPrice = parseFloat($adultInput.data('price')),
				$childrenInput = $persons.find('.qodef--children .qodef-e-input'),
				childrenNumber = parseInt($childrenInput.val(), 10),
				childrenPrice = parseFloat($childrenInput.data('price')),
				additionalPrice = 0;

			if ( adultsNumber > minCapacity ) {
				additionalPrice += adultPrice * ( adultsNumber - minCapacity );
			}
		
			if ( childrenNumber > 0 ) {
				
				if ( adultsNumber < minCapacity ) {
					additionalPrice += childrenPrice * ( childrenNumber - minCapacity + adultsNumber );
				} else {
					additionalPrice += childrenPrice * childrenNumber;
				}
			}
			
			// Set a new room price depend of guests number
			qodefRoomSingle.guestsPrice = additionalPrice;
			
			// Calculate a room price
			qodefRoomSingle.calculatePrice();
		},
		setExtraServicesTriggers: function () {
			var $extraServices = qodefRoomSingle.form.find('.qodef-m-field.qodef--extra-services .qodef-m-field-item');
			
			if ($extraServices.length) {
				$extraServices.find('.qodef-e-field-label, .qodef-e-field-checkbox').on('click', function () {
					var $clickedItem = $(this),
						$extraServiceItem = $clickedItem.parent(),
						$inputField = $extraServiceItem.children('.qodef-e-field-input');
					
					if (!$inputField.is(':disabled')) {
						var increment = 1;
						
						if ($extraServiceItem.hasClass('qodef--checked')) {
							increment = -1;
							$inputField.prop('checked', false);
							$extraServiceItem.removeClass('qodef--checked');
						} else {
							$inputField.prop('checked', true);
							$extraServiceItem.addClass('qodef--checked');
						}
						
						var	$inputPrice = qodefRoomSingle.getExtraServicePrice($inputField, $inputField.data('price')) * increment;
						
						// Calculate a new room price
						qodefRoomSingle.updatePrice($inputPrice, true);
					}
				});
			}
		},
		calculateExtraServices: function() {
			var $extraServices = qodefRoomSingle.form.find('.qodef-m-field.qodef--extra-services .qodef-e-field-input:checked'),
				extraServicesPrice = 0;
			
			if ($extraServices.length) {
				$.each($extraServices, function () {
					var $currentItem = $(this);
					
					extraServicesPrice += qodefRoomSingle.getExtraServicePrice($currentItem, $currentItem.data('price'));
				});
			}
			
			// Calculate a new room price
			qodefRoomSingle.updatePrice(extraServicesPrice);
		},
		getExtraServicePrice: function ($item, price) {
			var totalPrice = 0,
				daysNumber = Math.round(Math.abs(new Date(qodefRoomSingle.date.checkOut.val()) - new Date(qodefRoomSingle.date.checkIn.val())) / (1000 * 60 * 60 * 24));
			
			switch ($item.data('service-type')) {
				case 'per-night':
					totalPrice = daysNumber * parseFloat(price);
					break;
				case 'per-person':
					var personsNumber = Math.abs(qodefRoomSingle.form.find('.qodef-m-field-input.qodef--guests').data('count'));
					
					totalPrice = personsNumber * parseFloat(price);
					break;
				case 'per-person-per-night':
					var personsNumber = Math.abs( qodefRoomSingle.form.find( '.qodef-m-field-input.qodef--guests' ).data( 'count' ) );
					totalPrice = personsNumber * daysNumber * parseFloat( price );
					break;
				case 'subtract':
					totalPrice -= parseFloat(price);
					break;
				case 'subtract-per-night':
					totalPrice -= daysNumber * parseFloat(price);
					break;
				default:
					totalPrice = parseFloat(price);
					break;
			}
			
			return totalPrice;
		},
		calculatePrice: function () {
			var daysNumber = Math.round(Math.abs(new Date(qodefRoomSingle.date.checkOut.val()) - new Date(qodefRoomSingle.date.checkIn.val())) / (1000 * 60 * 60 * 24)),
				price = qodefRoomSingle.price,
				additionalGuestsPrice = qodefRoomSingle.guestsPrice > 0 ? qodefRoomSingle.guestsPrice : 0;
			
			// Set min days number
			if (daysNumber < 1) {
				daysNumber = 1;
			}
	
			// Calculate a new room price
			var fullPrice = ( price + additionalGuestsPrice ) * daysNumber;
			
			// Check seasonal dates
			var seasonalDatesMeta = qodefRoomSingle.priceField.data('room-seasonal-dates'),
				seasonalData = [];
	
			if (typeof seasonalDatesMeta !== 'undefined' && seasonalDatesMeta !== '') {
				var seasonalDateMeta = seasonalDatesMeta.split('|');

				$.each(seasonalDateMeta, function (index, value) {
					var seasonalMeta = value.split(':'),
						seasonalDates = seasonalMeta[1].split(';'),
						seasonalDaysNumber = 0;
					
					$.each(seasonalDates, function (dateIndex, dateValue) {
						var currentSeasonalDate = new Date(dateValue);
					
						if (new Date(qodefRoomSingle.date.checkIn.val()) <= currentSeasonalDate && currentSeasonalDate < new Date(qodefRoomSingle.date.checkOut.val())) {
							seasonalDaysNumber++;
							
							seasonalData[index] = {
								price: parseFloat(seasonalMeta[0]),
								days: seasonalDaysNumber
							};
						}
					});
				});
			}

			// Adjust room price if seasonal date is active
			if (seasonalData.length > 0) {
				$.each(seasonalData, function (index, seasonal) {
					if (typeof seasonal !== 'undefined') {
						// Check if seasonal price larger than the initial price
						if (seasonal.price >= price) {
							fullPrice += Math.abs(price - seasonal.price) * seasonal.days;
						} else {
							fullPrice -= Math.abs(price - seasonal.price) * seasonal.days;
						}
					}
				});
			}
			
			// Set new room price
			qodefRoomSingle.priceField.data('room-price', fullPrice);
			
			// Update price with extra services
			qodefRoomSingle.calculateExtraServices();
		},
		updatePrice: function (extraPrice, updateCurrentPrice) {
			var $priceField = qodefRoomSingle.priceField,
				price = updateCurrentPrice === true ? $priceField.text() : $priceField.data('room-price'),
				newPrice = Math.round((parseFloat(price) + extraPrice)*1000000)/1000000;
		
			$priceField.text(newPrice);
		},
		triggerBooking: function() {
			
			qodefRoomSingle.form.on('submit', function(e){
				var $form = $(this);
				
				if (!$form.hasClass('qodef--book-now')) {
					e.preventDefault();
					
					$form.addClass('qodef--checking');
					
					var $responseHolder = $form.find('.qodef-m-response');
					
					$responseHolder.removeClass('qodef--show qodef--success qodef--error qodef--undefined').empty();
					
					var ajaxData = {
						room_id: $form.find('input[name="add-to-cart"]').val(),
						check_in: $form.find('input[name="qodef_room_check_in"]').val(),
						check_out: $form.find('input[name="qodef_room_check_out"]').val(),
						room_amount: parseInt($form.find('[name="qodef_room_amount"]').val(), 10),
						adult: parseInt($form.find('[name="qodef_room_adult"]').val(), 10),
						children: parseInt($form.find('[name="qodef_room_children"]').val(), 10),
						infant: parseInt($form.find('[name="qodef_room_infant"]').val(), 10),
						extra_services: '',
						min_capacity: parseInt($form.find('input[name="qodef_room_min_capacity"]').val(), 10),
						max_capacity: parseInt($form.find('input[name="qodef_room_max_capacity"]').val(), 10),
						price: parseFloat(qodefRoomSingle.priceField.text()),
					};
					
					var $extraServices = $form.find('.qodef-m-field.qodef--extra-services .qodef-e-field-input:checked');
					
					if ($extraServices.length) {
						var extraServicesItems = [];
						
						$extraServices.each(function () {
							extraServicesItems.push($(this).val());
						});
						
						if (extraServicesItems.length) {
							ajaxData.extra_services = extraServicesItems.join(',');
						}
					}
					
					$.ajax({
						type: "GET",
						url: qodefGlobal.vars.restUrl + qodefGlobal.vars.getRoomReservationRestRoute,
						data: {
							options: ajaxData,
						},
						success: function (response) {
							$responseHolder.addClass('qodef--show qodef--' + response.status).html(response.message);
							
							if (response.status === 'success') {
								$form.find('[name="qodef_room_price"]').val(response.data.price);
								
								setTimeout(function () {
									$form.addClass('qodef--book-now').trigger('submit');
								}, 400); // Wait a little bit before trigger add to cart handler
							}
						},
						error: function (response) {
							console.log(response);
						},
						complete: function () {
							$form.removeClass('qodef--checking');
						}
					});
				}
			});
		},
	};
	
	qodefCore.qodefRoomSingle = qodefRoomSingle;
	
})(jQuery);