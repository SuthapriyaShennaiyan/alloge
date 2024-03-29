(function ($) {
	"use strict";
	
	qodefCore.shortcodes.alloggio_core_room_gallery_list = {};
	qodefCore.shortcodes.alloggio_core_room_gallery_list.qodefSwiper = qodef.qodefSwiper;
	
	$(document).ready(function () {
		qodefCustomRoomGallerySlider.init();
	});
	
	var qodefCustomRoomGallerySlider = {
		init: function () {
			var $holder = $('.qodef-room-gallery-list .qodef-image-gallery.qodef-swiper-container'),//return .qodef--swiper-reveal class
				$i = 0;
			
			if ($holder.length) {
				$holder.each(function () {
					$i++;
					
					var $thisHolder = $(this);
					qodefCustomRoomGallerySlider.animateActiveItem($thisHolder, $i);
				});
			}
		},
		animateActiveItem: function($swiperHolder, $i) {
			var thisSwiper = $swiperHolder[0].swiper;
			
			if ($i%2==0) {
				/*thisSwiper.autoplay.stop();*///delay autoplay for each even slider - could not be used with rtl dir
				
				$swiperHolder.closest('.qodef-e-media-slider').attr('dir','rtl');//change slide direction for every second item
				
				/*setTimeout(function () {
					thisSwiper.autoplay.start();//delay autoplay for each even slider - could not be used with rtl dir
				}, 300);*/
			}
			
			//delete code bellow when sc finished and checked
			
			/*thisSwiper.on('slidePrevTransitionStart', function () {
				var activeSlide = $swiperHolder.find('.swiper-slide-active'),
					inactiveSlide = $swiperHolder.find('.swiper-slide:not(.swiper-slide-active)');
				
				setTimeout(function(){
					inactiveSlide.find('img').css({
						"animation": "none"
					});
				}, 500);
				
				setTimeout(function(){
					activeSlide.find('img').css({
						"animation": "qode-slide-reveal-right 1.5s forwards",
					});
				}, 10);
			});
			
			thisSwiper.on('slideNextTransitionStart', function () {
				var activeSlide = $swiperHolder.find('.swiper-slide-active'),
					inactiveSlide = $swiperHolder.find('.swiper-slide:not(.swiper-slide-active, .swiper-slide-prev)'),
					prevSlide =  $swiperHolder.find('.swiper-slide-prev');
				
				inactiveSlide.find('img').css({
					"animation": "none"
				});
				
				activeSlide.find('img').css({
					"animation": "qode-slide-reveal-right 1.5s forwards"
				});
				
				if (thisSwiper.isEnd) { //bug appearing on slider loops end
					setTimeout(function(){
						prevSlide.find('img').css({
							"animation": "qode-slide-right 1.5s forwards"
						});
					}, 10);
				} else {
					prevSlide.find('img').css({
						"animation": "qode-slide-right 1.5s"
					});
				
			});}*/
		},
	}
	
	qodefCore.shortcodes.alloggio_core_room_gallery_list.qodefCustomRoomGallerySlider = qodefCustomRoomGallerySlider;
	
})(jQuery);