(function ($) {
    "use strict";

	qodefCore.shortcodes.alloggio_core_image_with_text = {};
    qodefCore.shortcodes.alloggio_core_image_with_text.qodefMagnificPopup = qodef.qodefMagnificPopup;
	
	$(document).ready(function () {
		qodefScrollingImage.init();
	});
	
	/**
	 * Init Scrolling Image effect
	 */
	var qodefScrollingImage = {
		
		init: function () {
			var scrollingImageShortcodes = $('.qodef-image-with-text.qodef-action--scrolling-image');
			
			if (scrollingImageShortcodes.length) {
				scrollingImageShortcodes.each(function () {
					var scrollingImageShortcode = $(this),
						scrollingImageContentHolder = scrollingImageShortcode.find('.qodef-m-image'),
						scrollingFrame = scrollingImageShortcode.find('.qodef-e-frame'),
						scrollingFrameHeight,
						scrollingFrameWidth,
						scrollingImage = scrollingImageShortcode.find('.qodef-e-main-image'),
						scrollingImageHeight,
						scrollingImageWidth,
						delta,
						timing,
						scrollable = false;
					
					var sizing = function () {
						scrollingFrameHeight = scrollingFrame.height();
						scrollingImageHeight = scrollingImage.height();
						scrollingFrameWidth = scrollingFrame.width();
						scrollingImageWidth = scrollingImage.width();
						
						delta = Math.round(scrollingImageHeight - scrollingFrameHeight);
						timing = Math.round(scrollingImageHeight / scrollingFrameHeight) * 2;
						
						if (scrollingImageHeight > scrollingFrameHeight) {
							scrollable = true;
						}
					}
					
					var scrollAnimation = function () {
						//scroll animation on hover
						scrollingImageContentHolder.mouseenter(function () {
							scrollingImage.css('transition-duration', timing + 's'); //transition duration set in relation to image height
							
							scrollingImage.css('transform', 'translate3d(0px, -' + delta + 'px, 0px)');
						});
						
						//scroll animation reset
						scrollingImageContentHolder.mouseleave(function () {
							if (scrollable) {
								scrollingImage.css('transition-duration', Math.min(timing / 3, 3) + 's');
								scrollingImage.css('transform', 'translate3d(0px, 0px, 0px)');
							}
						});
					};
					
					//init
					qodef.qodefWaitForImages.check(
						scrollingImageShortcode,
						function () {
							scrollingImageShortcode.css('visibility', 'visible');
							sizing();
							scrollAnimation();
						}
					);
					
					$(window).resize(function () {
						sizing();
					});
				});
			}
		}
	}
	
	qodefCore.shortcodes.alloggio_core_image_with_text.qodefScrollingImage = qodefScrollingImage;

})(jQuery);
