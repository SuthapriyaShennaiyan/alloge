(function ($) {
	"use strict";
	
	$(window).on('elementor/frontend/init', function() {
		var isEditMode = Boolean( elementorFrontend.isEditMode() );
		if( isEditMode) {
			qodefSpinner.fadeOutLoader($('#qodef-page-spinner:not(.qodef--custom-spinner)'));
		}
	});
	
	$(document).ready(function() {
		qodefSpinner.init();
	});
	
	var qodefSpinner = {
		init: function () {
			this.holder = $('#qodef-page-spinner:not(.qodef--custom-spinner)');
			
			if (this.holder.length) {
				if (! this.holder.hasClass('qodef-layout--textual')) {
					qodefSpinner.animateSpinner(this.holder);
				} else {
					qodefSpinner.animateCustomSpinner(this.holder);
				}
			}
		},
		animateSpinner: function ($holder) {
			$(window).on('load', function () {
				qodefSpinner.fadeOutLoader($holder);
			});
		},
		animateCustomSpinner: function ($holder) {
			var preloaderText = this.holder.find('.qodef-textual-spinner-text'),
				preloaderCharacter = preloaderText.find('.qodef-e-character'),
				mainRevHolder = $('#qodef-main-rev-holder'),
				// Preloader Text Length
				n = preloaderCharacter.length,
				
				// Transition duration and delay for fade in and fade out animation
				durationIn    = 1.15,
				delayIn       = 0.13,
				durationOut   = 0.8,
				delayOut      = 0.1,
				
				// Calculating the duration of the entire fade in animation with ( transition duration = 1.15s ) and ( transition delay = 0.13 * index )
				timeoutLengthIn = 1000 * ( durationIn + delayIn * n ),
				// Calculating the duration of the entire fade out animation with ( transition duration = .8s ) and ( transition delay = 0.1 * index )
 				timeoutLengthOut = 1000 * ( durationOut + delayOut * n ),
				
				qodefSpinnerInterval;
			
			if( preloaderText.length ) {
				setTimeout(function () {
					var qodefAnimatePredefinedSpinner = function () {
						preloaderCharacter.each(function (index) {
							preloaderCharacter.eq(index).css({
								'opacity': '1',
								'transition': durationIn +'s ' + delayIn * index + 's'
							});
						});
						
						setTimeout(function() {
							preloaderCharacter.each(function ( index ) {
								preloaderCharacter.eq(index).css({
									'opacity': '0',
									'transition': durationOut + 's ' + delayOut * index + 's'
								});
							});
						}, timeoutLengthIn - 500 );
					};
					
					preloaderText.css({'opacity': '1'});
					qodefAnimatePredefinedSpinner();
					qodefSpinnerInterval = setInterval(function(){
						qodefAnimatePredefinedSpinner();
					}, timeoutLengthIn + timeoutLengthOut);
				}, 100);
				
				$(window).on('load', function() {
					if(mainRevHolder.length) {
						setTimeout(function() {
							mainRevHolder.find('rs-module').revstart();
						}, 3000);
					}

					qodefSpinner.fadeOutLoader($holder, 1000, 3000);

					setTimeout(function () {
						clearInterval(qodefSpinnerInterval);
					}, 3200);
				});
			}
		},
		fadeOutLoader: function ($holder, speed, delay, easing) {
			speed = speed ? speed : 600;
			delay = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			$holder.delay(delay).fadeOut(speed, easing);

			$(window).on('bind', 'pageshow', function (event) {
				if (event.originalEvent.persisted) {
					$holder.fadeOut(speed, easing);
				}
			});
		}
	};
	
})(jQuery);