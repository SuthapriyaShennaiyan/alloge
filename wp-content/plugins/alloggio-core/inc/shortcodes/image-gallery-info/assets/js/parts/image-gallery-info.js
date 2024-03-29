(function ($) {
	"use strict";
	
	qodefCore.shortcodes.alloggio_core_image_gallery_info = {};
	qodefCore.shortcodes.alloggio_core_image_gallery_info.qodefSwiper = qodef.qodefSwiper;
	
	$(document).on('alloggio_trigger_swiper_slide_change_event', function (e, $gallery, slideIndex) {
		qodefImageGalleryInfo.init($gallery, slideIndex);
	});
	
	var qodefImageGalleryInfo = {
		init: function ($gallery, slideIndex) {
			this.holder = $('.qodef-image-gallery-info');
			
			if (this.holder.length && $gallery.$el.parents('.qodef-image-gallery-info')) {
				var $items = this.holder.find('.qodef-m-text-items');
				
				$items.children().removeClass('qodef--active');
				$items.children('.qodef-m-text:nth-child(' + (parseInt(slideIndex, 10) + 1) + ')').addClass('qodef--active');
			}
		}
	};
	
	qodefCore.shortcodes.alloggio_core_image_gallery_info.qodefImageGalleryInfo = qodefImageGalleryInfo;
	
})(jQuery);