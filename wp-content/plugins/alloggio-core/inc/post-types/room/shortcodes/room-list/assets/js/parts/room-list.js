(function ($) {
	"use strict";
	
	var shortcode = 'alloggio_core_room_list';
	
	qodefCore.shortcodes[shortcode] = {};
	
	if (typeof qodefCore.listShortcodesScripts === 'object') {
		$.each(qodefCore.listShortcodesScripts, function (key, value) {
			qodefCore.shortcodes[shortcode][key] = value;
		});
	}
	
	$(document).ready(function () {
		/*qodefCustomRoomSlider.init();*/
	});
	
	var qodefCustomRoomSlider = {
		init: function () {
			var $holder = $('.qodef-room-list.qodef-swiper-container');
			
			if ($holder.length) {
				$holder.each(function () {
					var $thisHolder = $(this);
					qodefCustomRoomSlider.animateActiveItem($thisHolder);
				});
			}
		},
		animateActiveItem: function($swiperHolder) {
			
			var thisSwiper = $swiperHolder[0].swiper;
			
			thisSwiper.on('slidePrevTransitionStart', function () {
				var activeSlide = $swiperHolder.find('.swiper-slide-active'),
					inactiveSlide = $swiperHolder.find('.swiper-slide:not(.swiper-slide-active)');
				
				setTimeout(function(){
					inactiveSlide.find('.qodef-e-media').css({
						"animation": "none"
					});
				}, 500);
				
				setTimeout(function(){
					activeSlide.find('.qodef-e-media').css({
						"animation": "qode-slide-reveal-right 1.5s forwards",
					});
				}, 10);
			});
			
			thisSwiper.on('slideNextTransitionStart', function () {
				var activeSlide = $swiperHolder.find('.swiper-slide-active'),
					inactiveSlide = $swiperHolder.find('.swiper-slide:not(.swiper-slide-active, .swiper-slide-prev)'),
					prevSlide =  $swiperHolder.find('.swiper-slide-prev');
				
				inactiveSlide.find('.qodef-e-media').css({
					"animation": "none"
				});
				
				activeSlide.find('.qodef-e-media').css({
					"animation": "qode-slide-reveal-right 1.5s forwards"
				});
				
				if (thisSwiper.isEnd) { //bug appearing on slider loops end
					setTimeout(function(){
						prevSlide.find('.qodef-e-media').css({
							"animation": "qode-slide-right 1.5s forwards"
						});
					}, 10);
				} else {
					prevSlide.find('.qodef-e-media').css({
						"animation": "qode-slide-right 1.5s"
					});
				}
			});
		},
		/*init: function () {
			var $holder = $('.qodef-room-list.qodef--swiper-reveal.qodef-swiper-container');
			
			if ($holder.length) {
				$holder.each(function () {
					var $thisHolder = $(this);
						/!*$thisItems = $thisHolder.find('.swiper-slide');*!/
					
					qodefCustomRoomSlider.animateActiveItem($thisHolder);
				});
			}
		},
		animateActiveItem: function($swiperHolder) {
			
			var thisSwiper = $swiperHolder[0].swiper;
			
			thisSwiper.on('slideChangeTransitionStart', function () {
				var activeSlide = $swiperHolder.find('.swiper-slide-active');
				activeSlide.addClass('qodef-swiper-revealing');
			});
			
			thisSwiper.on('slideChange', function () {
				var prevActiveSlide = $swiperHolder.find('.qodef-swiper-revealing');
				prevActiveSlide.removeClass('qodef-swiper-revealing').addClass('qodef-swiper-hiding');
			});
			
			
			$(document).ready(function () {
				setTimeout(function() {
					var activeSlide = $swiperHolder.find('.swiper-slide-active');
					activeSlide.addClass('qodef-swiper-revealing');
				}, 10);
			});
		},*/
	}
	
	
})(jQuery);