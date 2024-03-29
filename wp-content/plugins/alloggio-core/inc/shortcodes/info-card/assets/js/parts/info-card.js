(function ($) {
	"use strict";
	
	qodefCore.shortcodes.alloggio_core_info_card = {};
	
	$(document).ready(function () {
		qodefInfoCard.init();
	});
	
	var qodefInfoCard;
	qodefInfoCard = {
		init: function () {
			this.images = $('.qodef-info-card.qodef--has-parallax .qodef-m-image');
			
			if (this.images.length) {
				this.images.each(function () {
					var $thisImage = $(this);
					qodefInfoCard.parallaxElements($thisImage);
					qodefInfoCard.initParallaxElements($thisImage);
				});
			}
		},
		parallaxElements: function ($image) {
			var itemImage = $image.find('.qodef-m-images'),
				imgParallax = $image.find('img'),
				imgZoom = itemImage.find('img.qodef-e-main-image');
			
			if (qodef.windowWidth > 1024) {
				imgParallax.attr('data-parallax', '{"y" : -95 , "smoothness": 50}');
			}
		},
		initParallaxElements: function () {
			var parallaxInstances = $("[data-parallax]");
			
			if (parallaxInstances.length && qodef.windowWidth > 1024) {
				ParallaxScroll.init(); //initialzation removed from plugin js file to have it run only on non-touch devices
			}
		}
	};
	
	qodefCore.shortcodes.alloggio_core_info_card.qodefInfoCard = qodefInfoCard;
	
})(jQuery);