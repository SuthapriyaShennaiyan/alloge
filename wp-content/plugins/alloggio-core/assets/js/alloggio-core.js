(function ($) {
	"use strict";
	
	// This case is important when theme is not active
	if (typeof qodef !== 'object') {
		window.qodef = {};
	}
	
	window.qodefCore = {};
	qodefCore.shortcodes = {};
	qodefCore.listShortcodesScripts = {
		qodefSwiper: qodef.qodefSwiper,
		qodefPagination: qodef.qodefPagination,
		qodefFilter: qodef.qodefFilter,
		qodefMasonryLayout: qodef.qodefMasonryLayout,
	};

	qodefCore.body = $('body');
	qodefCore.html = $('html');
	qodefCore.windowWidth = $(window).width();
	qodefCore.windowHeight = $(window).height();
	qodefCore.scroll = 0;

	$(document).ready(function () {
		qodefCore.scroll = $(window).scrollTop();
		qodefInlinePageStyle.init();
	});

	$(window).resize(function () {
		qodefCore.windowWidth = $(window).width();
		qodefCore.windowHeight = $(window).height();
	});

	$(window).scroll(function () {
		qodefCore.scroll = $(window).scrollTop();
	});

	/**
	 * Check element to be in the viewport
	 */
	var qodefIsInViewport = {
		check: function ( $element, callback, onlyOnce ) {
			if ( $element.length ) {
				var offset = typeof $element.data( 'viewport-offset' ) !== 'undefined' ? $element.data( 'viewport-offset' ) : 0.15; // When item is 15% in the viewport

				var observer = new IntersectionObserver(
					function ( entries ) {
						// isIntersecting is true when element and viewport are overlapping
						// isIntersecting is false when element and viewport don't overlap
						if ( entries[0].isIntersecting === true ) {
							callback.call( $element );

							// Stop watching the element when it's initialize
							if ( onlyOnce !== false ) {
								observer.disconnect();
							}
						}
					},
					{ threshold: [offset] }
				);

				observer.observe( $element[0] );
			}
		},
	};

	qodefCore.qodefIsInViewport = qodefIsInViewport;

	var qodefScroll = {
		disable: function(){
			if (window.addEventListener) {
				window.addEventListener('wheel', qodefScroll.preventDefaultValue, {passive: false});
			}

			// window.onmousewheel = document.onmousewheel = qodefScroll.preventDefaultValue;
			document.onkeydown = qodefScroll.keyDown;
		},
		enable: function(){
			if (window.removeEventListener) {
				window.removeEventListener('wheel', qodefScroll.preventDefaultValue, {passive: false});
			}
			window.onmousewheel = document.onmousewheel = document.onkeydown = null;
		},
		preventDefaultValue: function(e){
			e = e || window.event;
			if (e.preventDefault) {
				e.preventDefault();
			}
			e.returnValue = false;
		},
		keyDown: function(e) {
			var keys = [37, 38, 39, 40];
			for (var i = keys.length; i--;) {
				if (e.keyCode === keys[i]) {
					qodefScroll.preventDefaultValue(e);
					return;
				}
			}
		}
	};

	qodefCore.qodefScroll = qodefScroll;

	var qodefPerfectScrollbar = {
		init: function ($holder) {
			if ($holder.length) {
				qodefPerfectScrollbar.qodefInitScroll($holder);
			}
		},
		qodefInitScroll: function ($holder) {
			var $defaultParams = {
				wheelSpeed: 0.6,
				suppressScrollX: true
			};

			var $ps = new PerfectScrollbar($holder[0], $defaultParams);
			$(window).resize(function () {
				$ps.update();
			});
		}
	};

	qodefCore.qodefPerfectScrollbar = qodefPerfectScrollbar;

	var qodefInlinePageStyle = {
		init: function () {
			this.holder = $('#alloggio-core-page-inline-style');

			if (this.holder.length) {
				var style = this.holder.data('style');

				if (style.length) {
					$('head').append('<style type="text/css">' + style + '</style>');
				}
			}
		}
	};

})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefBackToTop.init();
	});
	
	var qodefBackToTop = {
		init: function () {
			this.holder = $('#qodef-back-to-top');
			
			if(this.holder.length) {
				// Scroll To Top
				this.holder.on('click', function (e) {
					e.preventDefault();
					qodefBackToTop.animateScrollToTop();
				});
				
				qodefBackToTop.showHideBackToTop();
			}
		},
		animateScrollToTop: function() {
			var startPos = qodef.scroll,
				newPos = qodef.scroll,
				step = .9,
				animationFrameId;
			
			var startAnimation = function() {
				if (newPos === 0) return;
				newPos < 0.0001 ? newPos = 0 : null;
				var ease = qodefBackToTop.easingFunction((startPos - newPos) / startPos);
				$('html, body').scrollTop(startPos - (startPos - newPos) * ease);
				newPos = newPos * step;
				
				animationFrameId = requestAnimationFrame(startAnimation)
			}
			startAnimation();
			$(window).one('wheel touchstart', function() {
				cancelAnimationFrame(animationFrameId);
			});
		},
		easingFunction: function(n) {
			return 0 == n ? 0 : Math.pow(1024, n - 1);
		},
		showHideBackToTop: function () {
			$(window).scroll(function () {
				var $thisItem = $(this),
					b = $thisItem.scrollTop(),
					c = $thisItem.height(),
					d;
				
				if (b > 0) {
					d = b + c / 2;
				} else {
					d = 1;
				}
				
				if (d < 1e3) {
					qodefBackToTop.addClass('off');
				} else {
					qodefBackToTop.addClass('on');
				}
			});
		},
		addClass: function (a) {
			this.holder.removeClass('qodef--off qodef--on');
			
			if (a === 'on') {
				this.holder.addClass('qodef--on');
			} else {
				this.holder.addClass('qodef--off');
			}
		}
	};
	
})(jQuery);

(function ($) {
	"use strict";
	
	$(window).on('load', function () {
		qodefUncoverFooter.init();
	});
	
	var qodefUncoverFooter = {
		holder: '',
		init: function () {
			this.holder = $('#qodef-page-footer.qodef--uncover');
			
			if (this.holder.length && !qodefCore.html.hasClass('touchevents')) {
				qodefUncoverFooter.addClass();
				qodefUncoverFooter.setHeight(this.holder);
				
				$(window).resize(function () {
                    qodefUncoverFooter.setHeight(qodefUncoverFooter.holder);
				});
			}
		},
        setHeight: function ($holder) {
	        $holder.css('height', 'auto');
	        
            var footerHeight = $holder.outerHeight();
            
            if (footerHeight > 0) {
                $('#qodef-page-outer').css({'margin-bottom': footerHeight, 'background-color': qodefCore.body.css('backgroundColor')});
                $holder.css('height', footerHeight);
            }
        },
		addClass: function () {
			qodefCore.body.addClass('qodef-page-footer--uncover');
		}
	};
	
})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefFullscreenMenu.init();
	});
	
	var qodefFullscreenMenu = {
		init: function () {
			var $fullscreenMenuOpener = $('a.qodef-fullscreen-menu-opener'),
				$menuItems = $('#qodef-fullscreen-area nav ul li a');
			
			// Open popup menu
			$fullscreenMenuOpener.on('click', function (e) {
				e.preventDefault();
				
				if (!qodefCore.body.hasClass('qodef-fullscreen-menu--opened')) {
					qodefFullscreenMenu.openFullscreen();
					$(document).keyup(function (e) {
						if (e.keyCode === 27) {
							qodefFullscreenMenu.closeFullscreen();
						}
					});
				} else {
					qodefFullscreenMenu.closeFullscreen();
				}
			});
			
			//open dropdowns
			$menuItems.on('tap click', function (e) {
				var $thisItem = $(this);
				if ($thisItem.parent().hasClass('menu-item-has-children')) {
					e.preventDefault();
					qodefFullscreenMenu.clickItemWithChild($thisItem);
				} else if (($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")) {
					qodefFullscreenMenu.closeFullscreen();
				}
			});
		},
		openFullscreen: function () {
			qodefCore.body.removeClass('qodef-fullscreen-menu-animate--out').addClass('qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in');
			qodefCore.qodefScroll.disable();
		},
		closeFullscreen: function () {
			qodefCore.body.removeClass('qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in').addClass('qodef-fullscreen-menu-animate--out');
			qodefCore.qodefScroll.enable();
			$("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200);
		},
		clickItemWithChild: function (thisItem) {
			var $thisItemParent = thisItem.parent(),
				$thisItemSubMenu = $thisItemParent.find('.sub-menu').first();
			
			if ($thisItemSubMenu.is(':visible')) {
				$thisItemSubMenu.slideUp(300);
				$thisItemParent.removeClass('qodef--opened');
			} else {
				$thisItemSubMenu.slideDown(300);
				$thisItemParent.addClass('qodef--opened').siblings().find('.sub-menu').slideUp(400);
			}
		}
	};
	
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefHeaderScrollAppearance.init();
	});
	
	var qodefHeaderScrollAppearance = {
		appearanceType: function () {
			return qodefCore.body.attr('class').indexOf('qodef-header-appearance--') !== -1 ? qodefCore.body.attr('class').match(/qodef-header-appearance--([\w]+)/)[1] : '';
		},
		init: function () {
			var appearanceType = this.appearanceType();
			
			if (appearanceType !== '' && appearanceType !== 'none') {
                qodefCore[appearanceType + "HeaderAppearance"]();
			}
		}
	};
	
})(jQuery);

(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefMobileHeaderAppearance.init();
    });

    /*
     **	Init mobile header functionality
     */
    var qodefMobileHeaderAppearance = {
        init: function () {
            if (qodefCore.body.hasClass('qodef-mobile-header-appearance--sticky')) {

                var docYScroll1 = qodefCore.scroll,
                    displayAmount = qodefGlobal.vars.mobileHeaderHeight + qodefGlobal.vars.adminBarHeight,
                    $pageOuter = $('#qodef-page-outer');

                qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                $(window).scroll(function () {
                    qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                    docYScroll1 = qodefCore.scroll;
                });

                $(window).resize(function () {
                    $pageOuter.css('padding-top', 0);
                    qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                });
            }
        },
        showHideMobileHeader: function(docYScroll1, displayAmount,$pageOuter){
            if(qodefCore.windowWidth <= 1024) {
                if (qodefCore.scroll > displayAmount * 2) {
                    //set header to be fixed
                    qodefCore.body.addClass('qodef-mobile-header--sticky');

                    //add transition to it
                    setTimeout(function () {
                        qodefCore.body.addClass('qodef-mobile-header--sticky-animation');
                    }, 300); //300 is duration of sticky header animation

                    //add padding to content so there is no 'jumping'
                    $pageOuter.css('padding-top', qodefGlobal.vars.mobileHeaderHeight);
                } else {
                    //unset fixed header
                    qodefCore.body.removeClass('qodef-mobile-header--sticky');

                    //remove transition
                    setTimeout(function () {
                        qodefCore.body.removeClass('qodef-mobile-header--sticky-animation');
                    }, 300); //300 is duration of sticky header animation

                    //remove padding from content since header is not fixed anymore
                    $pageOuter.css('padding-top', 0);
                }

                if ((qodefCore.scroll > docYScroll1 && qodefCore.scroll > displayAmount) || (qodefCore.scroll < displayAmount * 3)) {
                    //show sticky header
                    qodefCore.body.removeClass('qodef-mobile-header--sticky-display');
                } else {
                    //hide sticky header
                    qodefCore.body.addClass('qodef-mobile-header--sticky-display');
                }
            }
        }
    };

})(jQuery);
(function ($) {
	"use strict";

	$(document).ready(function () {
		qodefNavMenu.init();
	});

	var qodefNavMenu = {
		init: function () {
			qodefNavMenu.dropdownBehavior();
			qodefNavMenu.wideDropdownPosition();
			qodefNavMenu.dropdownPosition();
		},
		dropdownBehavior: function () {
			var $menuItems = $('.qodef-header-navigation > ul > li');
			
			$menuItems.each(function () {
				var $thisItem = $(this);
				
				if ($thisItem.find('.qodef-drop-down-second').length) {
					qodef.qodefWaitForImages.check(
						$thisItem,
						function () {
							var $dropdownHolder = $thisItem.find('.qodef-drop-down-second'),
								$dropdownMenuItem = $dropdownHolder.find('.qodef-drop-down-second-inner ul'),
								dropDownHolderHeight = $dropdownMenuItem.outerHeight();

							if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
								$thisItem.on("touchstart mouseenter", function () {
									$dropdownHolder.css({
										'height': dropDownHolderHeight,
										'overflow': 'visible',
										'visibility': 'visible',
										'opacity': '1'
									});
								}).on("mouseleave", function () {
									$dropdownHolder.css({
										'height': '0px',
										'overflow': 'hidden',
										'visibility': 'hidden',
										'opacity': '0'
									});
								});
							} else {
								if (qodefCore.body.hasClass('qodef-drop-down-second--animate-height')) {
									var animateConfig = {
										interval: 0,
										over: function () {
											setTimeout(function () {
												$dropdownHolder.addClass('qodef-drop-down--start').css({
													'visibility': 'visible',
													'height': '0',
													'opacity': '1'
												});
												$dropdownHolder.stop().animate({
													'height': dropDownHolderHeight
												}, 400, 'easeInOutQuint', function () {
													$dropdownHolder.css('overflow', 'visible');
												});
											}, 100);
										},
										timeout: 100,
										out: function () {
											$dropdownHolder.stop().animate({
												'height': '0',
												'opacity': 0
											}, 100, function () {
												$dropdownHolder.css({
													'overflow': 'hidden',
													'visibility': 'hidden'
												});
											});

											$dropdownHolder.removeClass('qodef-drop-down--start');
										}
									};

									$thisItem.hoverIntent(animateConfig);
								} else {
									var config = {
										interval: 0,
										over: function () {
											setTimeout(function () {
												$dropdownHolder.addClass('qodef-drop-down--start').stop().css({'height': dropDownHolderHeight});
											}, 150);
										},
										timeout: 150,
										out: function () {
											$dropdownHolder.stop().css({'height': '0'}).removeClass('qodef-drop-down--start');
										}
									};

									$thisItem.hoverIntent(config);
								}
							}
						}
					);
				}
			});
		},
		wideDropdownPosition: function () {
			var $menuItems = $(".qodef-header-navigation > ul > li.qodef-menu-item--wide");

			if ($menuItems.length) {
				$menuItems.each(function () {
					var $menuItem = $(this);
					var $menuItemSubMenu = $menuItem.find('.qodef-drop-down-second');

					if ($menuItemSubMenu.length) {
						$menuItemSubMenu.css('left', 0);

						var leftPosition = $menuItemSubMenu.offset().left;

						if (qodefCore.body.hasClass('qodef--boxed')) {
							//boxed layout case
							var boxedWidth = $('.qodef--boxed #qodef-page-wrapper').outerWidth();
							leftPosition = leftPosition - (qodefCore.windowWidth - boxedWidth) / 2;
							$menuItemSubMenu.css({'left': -leftPosition, 'width': boxedWidth});

						} else if (qodefCore.body.hasClass('qodef-drop-down-second--full-width')) {
							//wide dropdown full width case
							$menuItemSubMenu.css({'left': -leftPosition});
						}
						else {
							//wide dropdown in grid case
							$menuItemSubMenu.css({'left': -leftPosition + (qodefCore.windowWidth - $menuItemSubMenu.width()) / 2});
						}
					}
				});
			}
		},
		dropdownPosition: function () {
			var $menuItems = $('.qodef-header-navigation > ul > li.qodef-menu-item--narrow.menu-item-has-children');

			if ($menuItems.length) {
				$menuItems.each(function () {
					var $thisItem = $(this),
						menuItemPosition = $thisItem.offset().left,
						$dropdownHolder = $thisItem.find('.qodef-drop-down-second'),
						$dropdownMenuItem = $dropdownHolder.find('.qodef-drop-down-second-inner ul'),
						dropdownMenuWidth = $dropdownMenuItem.outerWidth(),
						menuItemFromLeft = $(window).width() - menuItemPosition;

                    if (qodef.body.hasClass('qodef--boxed')) {
                        //boxed layout case
                        var boxedWidth = $('.qodef--boxed #qodef-page-wrapper').outerWidth();
                        menuItemFromLeft = boxedWidth - menuItemPosition;
                    }

					var dropDownMenuFromLeft;

					if ($thisItem.find('li.menu-item-has-children').length > 0) {
						dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
					}

					$dropdownHolder.removeClass('qodef-drop-down--right');
					$dropdownMenuItem.removeClass('qodef-drop-down--right');
					if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
						$dropdownHolder.addClass('qodef-drop-down--right');
						$dropdownMenuItem.addClass('qodef-drop-down--right');
					}
				});
			}
		}
	};

})(jQuery);

(function ($) {
    "use strict";

    $(window).on('load', function () {
        qodefParallaxBackground.init();
    });

    /**
     * Init global parallax background functionality
     */
    var qodefParallaxBackground = {
        init: function (settings) {
            this.$sections = $('.qodef-parallax');

            // Allow overriding the default config
            $.extend(this.$sections, settings);

            var isSupported = !qodefCore.html.hasClass('touchevents') && !qodefCore.body.hasClass('qodef-browser--edge') && !qodefCore.body.hasClass('qodef-browser--ms-explorer');

            if (this.$sections.length && isSupported) {
                this.$sections.each(function () {
                    qodefParallaxBackground.ready($(this));
                });
            }
        },
        ready: function ($section) {
            $section.$imgHolder = $section.find('.qodef-parallax-img-holder');
            $section.$imgWrapper = $section.find('.qodef-parallax-img-wrapper');
            $section.$img = $section.find('img.qodef-parallax-img');

            var h = $section.height(),
                imgWrapperH = $section.$imgWrapper.height();

            $section.movement = 100 * (imgWrapperH - h) / h / 2; //percentage (divided by 2 due to absolute img centering in CSS)

            $section.buffer = window.pageYOffset;
            $section.scrollBuffer = null;

			
            //calc and init loop
            requestAnimationFrame(function () {
				$section.$imgHolder.animate({opacity: 1}, 100);
                qodefParallaxBackground.calc($section);
                qodefParallaxBackground.loop($section);
            });

            //recalc
            $(window).on('resize', function () {
                qodefParallaxBackground.calc($section);
            });
        },
        calc: function ($section) {
            var wH = $section.$imgWrapper.height(),
                wW = $section.$imgWrapper.width();

            if ($section.$img.width() < wW) {
                $section.$img.css({
                    'width': '100%',
                    'height': 'auto'
                });
            }

            if ($section.$img.height() < wH) {
                $section.$img.css({
                    'height': '100%',
                    'width': 'auto',
                    'max-width': 'unset'
                });
            }
        },
        loop: function ($section) {
            if ($section.scrollBuffer === Math.round(window.pageYOffset)) {
                requestAnimationFrame(function () {
                    qodefParallaxBackground.loop($section);
                }); //repeat loop
                return false; //same scroll value, do nothing
            } else {
                $section.scrollBuffer = Math.round(window.pageYOffset);
            }

            var wH = window.outerHeight,
                sTop = $section.offset().top,
                sH = $section.height();

            if ($section.scrollBuffer + wH * 1.2 > sTop && $section.scrollBuffer < sTop + sH) {
                var delta = (Math.abs($section.scrollBuffer + wH - sTop) / (wH + sH)).toFixed(4), //coeff between 0 and 1 based on scroll amount
                    yVal = (delta * $section.movement * 1.1).toFixed(4); // 1.8 set to speed up parallax

                if ($section.buffer !== delta) {
                    $section.$imgWrapper.css('transform', 'translate3d(0,' + yVal + '%, 0)');
                }

                $section.buffer = delta;
            }

            requestAnimationFrame(function () {
                qodefParallaxBackground.loop($section);
            }); //repeat loop
        }
    };

    qodefCore.qodefParallaxBackground = qodefParallaxBackground;

})(jQuery);
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
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefSideArea.init();
	});
	
	var qodefSideArea = {
		init: function () {
			var $sideAreaOpener = $('a.qodef-side-area-opener'),
				$sideAreaClose = $('#qodef-side-area-close'),
				$sideArea = $('#qodef-side-area');
				qodefSideArea.openerHoverColor($sideAreaOpener);
			// Open Side Area
			$sideAreaOpener.on('click', function (e) {
				e.preventDefault();
				
				if (!qodefCore.body.hasClass('qodef-side-area--opened')) {
					qodefSideArea.openSideArea();
					
					$(document).keyup(function (e) {
						if (e.keyCode === 27) {
							qodefSideArea.closeSideArea();
						}
					});
				} else {
					qodefSideArea.closeSideArea();
				}
			});
			
			$sideAreaClose.on('click', function (e) {
				e.preventDefault();
				qodefSideArea.closeSideArea();
			});
			
			if ($sideArea.length && typeof qodefCore.qodefPerfectScrollbar === 'object') {
				qodefCore.qodefPerfectScrollbar.init($sideArea);
			}
		},
		openSideArea: function () {
			var $wrapper = $('#qodef-page-wrapper');
			var currentScroll = $(window).scrollTop();

			$('.qodef-side-area-cover').remove();
			$wrapper.prepend('<div class="qodef-side-area-cover"/>');
			qodefCore.body.removeClass('qodef-side-area-animate--out').addClass('qodef-side-area--opened qodef-side-area-animate--in');

			$('.qodef-side-area-cover').on('click', function (e) {
				e.preventDefault();
				qodefSideArea.closeSideArea();
			});

			$(window).scroll(function () {
				if (Math.abs(qodefCore.scroll - currentScroll) > 400) {
					qodefSideArea.closeSideArea();
				}
			});

		},
		closeSideArea: function () {
			qodefCore.body.removeClass('qodef-side-area--opened qodef-side-area-animate--in').addClass('qodef-side-area-animate--out');
		},
		openerHoverColor: function ($opener) {
			if (typeof $opener.data('hover-color') !== 'undefined') {
				var hoverColor = $opener.data('hover-color');
				var originalColor = $opener.css('color');
				
				$opener.on('mouseenter', function () {
					$opener.css('color', hoverColor);
				}).on('mouseleave', function () {
					$opener.css('color', originalColor);
				});
			}
		}
	};
	
})(jQuery);

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
(function ($) {
	"use strict";

	qodefCore.shortcodes.alloggio_core_accordion = {};

	$(document).ready(function () {
		qodefAccordion.init();
	});
	
	var qodefAccordion = {
		init: function () {
			this.holder = $('.qodef-accordion');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					
					if ($thisHolder.hasClass('qodef-behavior--accordion')) {
						qodefAccordion.initAccordion($thisHolder);
					}
					
					if ($thisHolder.hasClass('qodef-behavior--toggle')) {
						qodefAccordion.initToggle($thisHolder);
					}
					
					$thisHolder.addClass('qodef--init');
				});
			}
		},
		initAccordion: function ($accordion) {
			$accordion.accordion({
				animate: "swing",
				collapsible: true,
				active: 0,
				icons: "",
				heightStyle: "content"
			});
		},
		initToggle: function ($toggle) {
			var $toggleAccordionTitle = $toggle.find('.qodef-accordion-title'),
				$toggleAccordionContent = $toggleAccordionTitle.next();
			
			$toggle.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
			$toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
			$toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();
			
			$toggleAccordionTitle.each(function () {
				var $thisTitle = $(this);
				
				$thisTitle.hover(function () {
					$thisTitle.toggleClass("ui-state-hover");
				});
				
				$thisTitle.on('click', function () {
					$thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
					$thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
				});
			});
		}
	};

	qodefCore.shortcodes.alloggio_core_accordion.qodefAccordion = qodefAccordion;

})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.alloggio_core_button = {};

	$(document).ready(function () {
		qodefButton.init();
	});
	
	var qodefButton = {
		init: function () {
			this.buttons = $('.qodef-button');
			
			if (this.buttons.length) {
				this.buttons.each(function () {
					var $thisButton = $(this);
					
					qodefButton.buttonHoverColor($thisButton);
				});
			}
		},
		buttonHoverColor: function ($button) {
			if (typeof $button.data('hover-color') !== 'undefined') {
				var hoverColor = $button.data('hover-color');
				var originalColor = $button.css('color');
				
				$button.on('mouseenter', function () {
					qodefButton.changeColor($button, 'color', hoverColor);
				});
				$button.on('mouseleave', function () {
					qodefButton.changeColor($button, 'color', originalColor);
				});
			}
		},
		changeColor: function ($button, cssProperty, color) {
			$button.css(cssProperty, color);
		}
	};

	qodefCore.shortcodes.alloggio_core_button.qodefButton = qodefButton;


})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.alloggio_core_cards_gallery = {};

	$(document).ready(function () {
		qodefCardsGallery.init();
	});
	
	var qodefCardsGallery = {
		init: function () {
			this.holder = $('.qodef-cards-gallery');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					qodefCardsGallery.initCards( $thisHolder );
					qodefCardsGallery.initBundle( $thisHolder );
				});
			}
		},
		initCards: function ($holder) {
			var $cards = $holder.find('.qodef-m-card');
			$cards.each(function () {
				var $card = $(this);
				
				$card.on('click', function () {
					if (!$cards.last().is($card)) {
						$card.addClass('qodef-out qodef-animating').siblings().addClass('qodef-animating-siblings');
						$card.detach();
						$card.insertAfter($cards.last());
						
						setTimeout(function () {
							$card.removeClass('qodef-out');
						}, 200);
						
						setTimeout(function () {
							$card.removeClass('qodef-animating').siblings().removeClass('qodef-animating-siblings');
						}, 1200);
						
						$cards = $holder.find('.qodef-m-card');
						
						return false;
					}
				});
				
				
			});
		},
		initBundle: function($holder) {
			if ($holder.hasClass('qodef-animation--bundle') && !qodefCore.html.hasClass('touchevents')) {
				qodefCore.qodefIsInViewport.check(
					$holder,
					function () {
						$holder.addClass('qodef-appeared');
						$holder.find('img').one('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function () {
							$(this).addClass('qodef-animation-done');
						});
					}
				);
			}
		}
	};

	qodefCore.shortcodes.alloggio_core_cards_gallery.qodefCardsGallery  = qodefCardsGallery;
	
})(jQuery);

(function ($) {
	"use strict";
	
	qodefCore.shortcodes.alloggio_core_centered_slider = {};
	qodefCore.shortcodes.alloggio_core_centered_slider.qodefSwiper = qodef.qodefSwiper;
	
})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.alloggio_core_countdown = {};

	$(document).ready(function () {
		qodefCountdown.init();
	});
	
	var qodefCountdown = {
		init: function () {
			this.countdowns = $('.qodef-countdown');
			
			if (this.countdowns.length) {
				this.countdowns.each(function () {
					var $thisCountdown = $(this),
						$countdownElement = $thisCountdown.find('.qodef-m-date'),
						options = qodefCountdown.generateOptions($thisCountdown);
					
					qodefCountdown.initCountdown($countdownElement, options);
				});
			}
		},
		generateOptions: function($countdown) {
			var options = {};
			options.date = typeof $countdown.data('date') !== 'undefined' ? $countdown.data('date') : null;
			
			options.weekLabel = typeof $countdown.data('week-label') !== 'undefined' ? $countdown.data('week-label') : '';
			options.weekLabelPlural = typeof $countdown.data('week-label-plural') !== 'undefined' ? $countdown.data('week-label-plural') : '';
			
			options.dayLabel = typeof $countdown.data('day-label') !== 'undefined' ? $countdown.data('day-label') : '';
			options.dayLabelPlural = typeof $countdown.data('day-label-plural') !== 'undefined' ? $countdown.data('day-label-plural') : '';
			
			options.hourLabel = typeof $countdown.data('hour-label') !== 'undefined' ? $countdown.data('hour-label') : '';
			options.hourLabelPlural = typeof $countdown.data('hour-label-plural') !== 'undefined' ? $countdown.data('hour-label-plural') : '';
			
			options.minuteLabel = typeof $countdown.data('minute-label') !== 'undefined' ? $countdown.data('minute-label') : '';
			options.minuteLabelPlural = typeof $countdown.data('minute-label-plural') !== 'undefined' ? $countdown.data('minute-label-plural') : '';
			
			options.secondLabel = typeof $countdown.data('second-label') !== 'undefined' ? $countdown.data('second-label') : '';
			options.secondLabelPlural = typeof $countdown.data('second-label-plural') !== 'undefined' ? $countdown.data('second-label-plural') : '';
			
			return options;
		},
		initCountdown: function ($countdownElement, options) {
			var $weekHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%w</span><span class="qodef-label">' + '%!w:' + options.weekLabel + ',' + options.weekLabelPlural + ';</span></span>';
			var $dayHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%d</span><span class="qodef-label">' + '%!d:' + options.dayLabel + ',' + options.dayLabelPlural + ';</span></span>';
			var $hourHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%H</span><span class="qodef-label">' + '%!H:' + options.hourLabel + ',' + options.hourLabelPlural + ';</span></span>';
			var $minuteHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%M</span><span class="qodef-label">' + '%!M:' + options.minuteLabel + ',' + options.minuteLabelPlural + ';</span></span>';
			var $secondHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%S</span><span class="qodef-label">' + '%!S:' + options.secondLabel + ',' + options.secondLabelPlural + ';</span></span>';
			
			$countdownElement.countdown(options.date, function(event) {
				$(this).html(event.strftime($weekHTML + $dayHTML + $hourHTML + $minuteHTML + $secondHTML));
			});
		}
	};

	qodefCore.shortcodes.alloggio_core_countdown.qodefCountdown  = qodefCountdown;


})(jQuery);
(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.alloggio_core_counter = {};

	$( document ).ready(
		function () {
			qodefCounter.init();
		}
	);

	var qodefCounter = {
		init: function () {
			this.counters = $( '.qodef-counter' );

			if ( this.counters.length ) {
				this.counters.each(
					function () {
						qodefCounter.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $counterElement = $currentItem.find( '.qodef-m-digit' ),
				options         = qodefCounter.generateOptions( $currentItem );

			qodefCore.qodefIsInViewport.check(
				$currentItem,
				function () {
					qodefCounter.counterScript( $counterElement, options );
				},
				false
			);
		},
		generateOptions: function ( $counter ) {
			var options   = {};
			options.start = typeof $counter.data( 'start-digit' ) !== 'undefined' && $counter.data( 'start-digit' ) !== '' ? $counter.data( 'start-digit' ) : 0;
			options.end   = typeof $counter.data( 'end-digit' ) !== 'undefined' && $counter.data( 'end-digit' ) !== '' ? $counter.data( 'end-digit' ) : null;
			options.step  = typeof $counter.data( 'step-digit' ) !== 'undefined' && $counter.data( 'step-digit' ) !== '' ? $counter.data( 'step-digit' ) : 1;
			options.delay = typeof $counter.data( 'step-delay' ) !== 'undefined' && $counter.data( 'step-delay' ) !== '' ? parseInt( $counter.data( 'step-delay' ), 10 ) : 100;
			options.txt   = typeof $counter.data( 'digit-label' ) !== 'undefined' && $counter.data( 'digit-label' ) !== '' ? $counter.data( 'digit-label' ) : '';

			return options;
		},
		counterScript: function ( $counterElement, options ) {
			var defaults = {
				start: 0,
				end: null,
				step: 1,
				delay: 50,
				txt: '',
			};

			var settings = $.extend( defaults, options || {} );
			var nb_start = settings.start;
			var nb_end   = settings.end;

			$counterElement.text( nb_start + settings.txt );

			// Timer
			// Launches every "settings.delay"
			var counterInterval = setInterval(
				function () {
					// Definition of conditions of arrest
					if ( nb_end !== null && nb_start >= nb_end ) {
						return;
					}

					// incrementation
					nb_start = nb_start + settings.step;

					// Check is ended
					if ( nb_start >= nb_end ) {
						nb_start = nb_end;

						clearInterval( counterInterval );
					}

					// display
					$counterElement.text( nb_start + settings.txt );
				},
				settings.delay
			);
		}
	};

	qodefCore.shortcodes.alloggio_core_counter.qodefCounter = qodefCounter;

})( jQuery );

(function ($) {
	"use strict";
	
	qodefCore.shortcodes.alloggio_core_google_map = {};
	
	$(document).ready(function () {
		qodefGoogleMap.init();
	});
	
	var qodefGoogleMap = {
		init: function () {
			this.holder = $('.qodef-google-map');
			
			if (this.holder.length) {
				this.holder.each(function () {
					if (typeof window.qodefGoogleMap !== 'undefined') {
						window.qodefGoogleMap.initMap($(this).find('.qodef-m-map'));
					}
				});
			}
		}
	};
	
	qodefCore.shortcodes.alloggio_core_google_map.qodefGoogleMap = qodefGoogleMap;
	
})(jQuery);
(function ($) {
    "use strict";

	qodefCore.shortcodes.alloggio_core_icon = {};

    $(document).ready(function () {
        qodefIcon.init();
    });

    var qodefIcon = {
        init: function () {
            this.icons = $('.qodef-icon-holder');

            if (this.icons.length) {
                this.icons.each(function () {
                    var $thisIcon = $(this);

                    qodefIcon.iconHoverColor($thisIcon);
                    qodefIcon.iconHoverBgColor($thisIcon);
                    qodefIcon.iconHoverBorderColor($thisIcon);
                });
            }
        },
        iconHoverColor: function ($iconHolder) {
            if (typeof $iconHolder.data('hover-color') !== 'undefined') {
                var spanHolder = $iconHolder.find('span');
                var originalColor = spanHolder.css('color');
                var hoverColor = $iconHolder.data('hover-color');

                $iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor(spanHolder, 'color', hoverColor);
                });
                $iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor(spanHolder, 'color', originalColor);
                });
            }
        },
        iconHoverBgColor: function ($iconHolder) {
            if (typeof $iconHolder.data('hover-background-color') !== 'undefined') {
                var hoverBackgroundColor = $iconHolder.data('hover-background-color');
                var originalBackgroundColor = $iconHolder.css('background-color');

                $iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor($iconHolder, 'background-color', hoverBackgroundColor);
                });
                $iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor($iconHolder, 'background-color', originalBackgroundColor);
                });
            }
        },
        iconHoverBorderColor: function ($iconHolder) {
            if (typeof $iconHolder.data('hover-border-color') !== 'undefined') {
                var hoverBorderColor = $iconHolder.data('hover-border-color');
                var originalBorderColor = $iconHolder.css('borderTopColor');

                $iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor($iconHolder, 'border-color', hoverBorderColor);
                });
                $iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor($iconHolder, 'border-color', originalBorderColor);
                });
            }
        },
        changeColor: function (iconElement, cssProperty, color) {
            iconElement.css(cssProperty, color);
        }
    };

	qodefCore.shortcodes.alloggio_core_icon.qodefIcon = qodefIcon;

})(jQuery);
(function ($) {
    "use strict";
	qodefCore.shortcodes.alloggio_core_image_gallery = {};
	qodefCore.shortcodes.alloggio_core_image_gallery.qodefSwiper = qodef.qodefSwiper;
	qodefCore.shortcodes.alloggio_core_image_gallery.qodefMasonryLayout = qodef.qodefMasonryLayout;

})(jQuery);
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
(function ($) {
    'use strict';

    qodefCore.shortcodes.alloggio_core_progress_bar = {};

    $(document).ready(function () {
        qodefProgressBar.init();
    });

    /**
     * Init progress bar shortcode functionality
     */
    var qodefProgressBar = {
        init: function () {
            this.holder = $( '.qodef-progress-bar' );

            if ( this.holder.length ) {
                this.holder.each(
                    function () {
                        qodefProgressBar.initItem( $( this ) );
                    }
                );
            }
        },
        initItem: function ( $currentItem ) {
            var layout = $currentItem.data( 'layout' );

            qodefCore.qodefIsInViewport.check(
                $currentItem,
                function () {
                    $currentItem.addClass( 'qodef--init' );

                    var $container = $currentItem.find( '.qodef-m-canvas' ),
                        data       = qodefProgressBar.generateBarData( $currentItem, layout ),
                        number     = $currentItem.data( 'number' ) / 100;

                    switch (layout) {
                        case 'circle':
                            qodefProgressBar.initCircleBar( $container, data, number );
                            break;
                        case 'semi-circle':
                            qodefProgressBar.initSemiCircleBar( $container, data, number );
                            break;
                        case 'line':
                            data = qodefProgressBar.generateLineData( $currentItem, number );
                            qodefProgressBar.initLineBar( $container, data );
                            break;
                        case 'custom':
                            qodefProgressBar.initCustomBar( $container, data, number );
                            break;
                    }
                },
                false
            );
        },
        generateBarData: function (thisBar, layout) {
            var activeWidth = thisBar.data('active-line-width');
            var activeColor = thisBar.data('active-line-color');
            var inactiveWidth = thisBar.data('inactive-line-width');
            var inactiveColor = thisBar.data('inactive-line-color');
            var easing = 'linear';
            var duration = typeof thisBar.data('duration') !== 'undefined' && thisBar.data('duration') !== '' ? parseInt(thisBar.data('duration'), 10) : 1600;
            var textColor = thisBar.data('text-color');

            return {
                strokeWidth: activeWidth,
                color: activeColor,
                trailWidth: inactiveWidth,
                trailColor: inactiveColor,
                easing: easing,
                duration: duration,
                svgStyle: {
                    width: '100%',
                    height: '100%'
                },
                text: {
                    style: {
                        color: textColor
                    },
                    autoStyleContainer: false
                },
                from: {
                    color: inactiveColor
                },
                to: {
                    color: activeColor
                },
                step: function (state, bar) {
                    if (layout !== 'custom') {
                        bar.setText(Math.round(bar.value() * 100) + '%');
                    }
                }
            };
        },
        generateLineData: function (thisBar, number) {
            var height = thisBar.data('active-line-width');
            var activeColor = thisBar.data('active-line-color');
            var inactiveHeight = thisBar.data('inactive-line-width');
            var inactiveColor = thisBar.data('inactive-line-color');
            var duration = typeof thisBar.data('duration') !== 'undefined' && thisBar.data('duration') !== '' ? parseInt(thisBar.data('duration'), 10) : 1600;
            var textColor = thisBar.data('text-color');

            return {
                percentage: number * 100,
                duration: duration,
                fillBackgroundColor: activeColor,
                backgroundColor: inactiveColor,
                height: height,
                inactiveHeight: inactiveHeight,
                followText: thisBar.hasClass('qodef-percentage--floating'),
                textColor: textColor
            };
        },
        initCircleBar: function ($container, data, number) {
            if (qodefProgressBar.checkBar($container)) {
                var $bar = new ProgressBar.Circle($container[0], data);

                $bar.animate(number);
            }
        },
        initSemiCircleBar: function ($container, data, number) {
            if (qodefProgressBar.checkBar($container)) {
                var $bar = new ProgressBar.SemiCircle($container[0], data);

                $bar.animate(number);
            }
        },
        initCustomBar: function ($container, data, number) {
            if (qodefProgressBar.checkBar($container)) {
                var $bar = new ProgressBar.Path($container[0], data);

                $bar.set(0);
                $bar.animate(number);
            }
        },
        initLineBar: function ($container, data) {
            $container.LineProgressbar(data);
        },
        checkBar: function ($container) {
            // check if svg is already in container, elementor fix
            if ($container.find('svg').length) {
                return false;
            }

            return true;
        }
    };

    qodefCore.shortcodes.alloggio_core_progress_bar.qodefProgressBar = qodefProgressBar;

})(jQuery);

(function ($) {
	"use strict";

	qodefCore.shortcodes.alloggio_core_tabs = {};

	$(document).ready(function () {
		qodefTabs.init();
	});
	
	var qodefTabs = {
		init: function () {
			this.holder = $('.qodef-tabs');
			
			if (this.holder.length) {
				this.holder.each(function () {
					qodefTabs.initTabs($(this));
				});
			}
		},
		initTabs: function ($tabs) {
			$tabs.children('.qodef-tabs-content').each(function (index) {
				index = index + 1;
				
				var $that = $(this),
					link = $that.attr('id'),
					$navItem = $that.parent().find('.qodef-tabs-navigation li:nth-child(' + index + ') a'),
					navLink = $navItem.attr('href');
				
				link = '#' + link;
				
				if (link.indexOf(navLink) > -1) {
					$navItem.attr('href', link);
				}
			});
			
			$tabs.addClass('qodef--init').tabs();
		}
	};

	qodefCore.shortcodes.alloggio_core_tabs.qodefTabs = qodefTabs;

})(jQuery);
(function ($) {
    "use strict";

	qodefCore.shortcodes.alloggio_core_video_button = {};
    qodefCore.shortcodes.alloggio_core_video_button.qodefMagnificPopup = qodef.qodefMagnificPopup;

})(jQuery);
(function ($) {
	"use strict";
	
	$(window).on('load', function () {
		qodefStickySidebar.init();
	});
	
	var qodefStickySidebar = {
		init: function () {
			var info = $('.widget_alloggio_core_sticky_sidebar');
			
			if (info.length && qodefCore.windowWidth > 1024) {
				info.wrapper = info.parents('#qodef-page-sidebar');
				info.c = 24;
				info.offsetM = info.offset().top - info.wrapper.offset().top;
				info.adj = 15;
				
				qodefStickySidebar.callStack(info);
				
				$(window).on('resize', function () {
					if (qodefCore.windowWidth > 1024) {
						qodefStickySidebar.callStack(info);
					}
				});
				
				$(window).on('scroll', function () {
					if (qodefCore.windowWidth > 1024) {
						qodefStickySidebar.infoPosition(info);
					}
				});
			}
		},
		calc: function (info) {
			var content = $('.qodef-page-content-section'),
				headerH = qodefCore.body.hasClass('qodef-header-appearance--none') ? 0 : parseInt(qodefGlobal.vars.headerHeight, 10);
			
			info.start = content.offset().top;
			info.end = content.outerHeight();
			info.h = info.wrapper.height();
			info.w = info.outerWidth();
			info.left = info.offset().left;
			info.top = headerH + qodefGlobal.vars.adminBarHeight + info.c - info.offsetM;
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
			} else if (qodefCore.scroll >= info.start - info.top && qodefCore.scroll + info.h + info.adj <= info.start + info.end &&
				info.data('state') !== 'fixed') {
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
					'left': 0,
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
	
})(jQuery);
(function ($) {
	"use strict";
	
	var shortcode = 'alloggio_core_blog_list';
	
	qodefCore.shortcodes[shortcode] = {};
	
	if (typeof qodefCore.listShortcodesScripts === 'object') {
		$.each(qodefCore.listShortcodesScripts, function (key, value) {
			qodefCore.shortcodes[shortcode][key] = value;
		});
	}
	
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefVerticalNavMenu.init();
	});
	
	/**
	 * Function object that represents vertical menu area.
	 * @returns {{init: Function}}
	 */
	var qodefVerticalNavMenu = {
		initNavigation: function ($verticalMenuObject) {
			var $verticalNavObject = $verticalMenuObject.find('.qodef-header-vertical-navigation');
			
			if ($verticalNavObject.hasClass('qodef-vertical-drop-down--below')) {
				qodefVerticalNavMenu.dropdownClickToggle($verticalNavObject);
			} else if ($verticalNavObject.hasClass('qodef-vertical-drop-down--side')) {
				qodefVerticalNavMenu.dropdownFloat($verticalNavObject);
			}
		},
		dropdownClickToggle: function ($verticalNavObject) {
			var $menuItems = $verticalNavObject.find('ul li.menu-item-has-children');
			
			$menuItems.each(function () {
				var $elementToExpand = $(this).find(' > .qodef-drop-down-second, > ul');
				var menuItem = this;
				var $dropdownOpener = $(this).find('> a');
				var slideUpSpeed = 'fast';
				var slideDownSpeed = 'slow';
				
				$dropdownOpener.on('click tap', function (e) {
					e.preventDefault();
					e.stopPropagation();
					
					if ($elementToExpand.is(':visible')) {
						$(menuItem).removeClass('qodef-menu-item--open');
						$elementToExpand.slideUp(slideUpSpeed);
					} else if ($dropdownOpener.parent().parent().children().hasClass('qodef-menu-item--open') && $dropdownOpener.parent().parent().parent().hasClass('qodef-vertical-menu')) {
						$(this).parent().parent().children().removeClass('qodef-menu-item--open');
						$(this).parent().parent().children().find(' > .qodef-drop-down-second').slideUp(slideUpSpeed);
						
						$(menuItem).addClass('qodef-menu-item--open');
						$elementToExpand.slideDown(slideDownSpeed);
					} else {
						
						if (!$(this).parents('li').hasClass('qodef-menu-item--open')) {
							$menuItems.removeClass('qodef-menu-item--open');
							$menuItems.find(' > .qodef-drop-down-second, > ul').slideUp(slideUpSpeed);
						}
						
						if ($(this).parent().parent().children().hasClass('qodef-menu-item--open')) {
							$(this).parent().parent().children().removeClass('qodef-menu-item--open');
							$(this).parent().parent().children().find(' > .qodef-drop-down-second, > ul').slideUp(slideUpSpeed);
						}
						
						$(menuItem).addClass('qodef-menu-item--open');
						$elementToExpand.slideDown(slideDownSpeed);
					}
				});
			});
		},
		dropdownFloat: function ($verticalNavObject) {
			var $menuItems = $verticalNavObject.find('ul li.menu-item-has-children');
			var $allDropdowns = $menuItems.find(' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul');
			
			$menuItems.each(function () {
				var $elementToExpand = $(this).find(' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul');
				var menuItem = this;
				
				if (Modernizr.touch) {
					var $dropdownOpener = $(this).find('> a');
					
					$dropdownOpener.on('click tap', function (e) {
						e.preventDefault();
						e.stopPropagation();
						
						if ($elementToExpand.hasClass('qodef-float--open')) {
							$elementToExpand.removeClass('qodef-float--open');
							$(menuItem).removeClass('qodef-menu-item--open');
						} else {
							if (!$(this).parents('li').hasClass('qodef-menu-item--open')) {
								$menuItems.removeClass('qodef-menu-item--open');
								$allDropdowns.removeClass('qodef-float--open');
							}
							
							$elementToExpand.addClass('qodef-float--open');
							$(menuItem).addClass('qodef-menu-item--open');
						}
					});
				} else {
					//must use hoverIntent because basic hover effect doesn't catch dropdown
					//it doesn't start from menu item's edge
					$(this).hoverIntent({
						over: function () {
							$elementToExpand.addClass('qodef-float--open');
							$(menuItem).addClass('qodef-menu-item--open');
						},
						out: function () {
							$elementToExpand.removeClass('qodef-float--open');
							$(menuItem).removeClass('qodef-menu-item--open');
						},
						timeout: 300
					});
				}
			});
		},
		verticalAreaScrollable: function ($verticalMenuObject) {
			return $verticalMenuObject.hasClass('qodef-with-scroll');
		},
		initVerticalAreaScroll: function ($verticalMenuObject) {
			if (qodefVerticalNavMenu.verticalAreaScrollable($verticalMenuObject) && typeof qodefCore.qodefPerfectScrollbar === 'object') {
				qodefCore.qodefPerfectScrollbar.init($verticalMenuObject);
			}
		},
		init: function () {
			var $verticalMenuObject = $('.qodef-header--vertical #qodef-page-header');
			
			if ($verticalMenuObject.length) {
				qodefVerticalNavMenu.initNavigation($verticalMenuObject);
				qodefVerticalNavMenu.initVerticalAreaScroll($verticalMenuObject);
			}
		}
	};
	
})(jQuery);
(function ($) {
	"use strict";
	
	var fixedHeaderAppearance = {
		showHideHeader: function ($pageOuter, $header) {
			if (qodefCore.windowWidth > 1024) {
				if (qodefCore.scroll <= 0) {
					qodefCore.body.removeClass('qodef-header--fixed-display');
					$pageOuter.css('padding-top', '0');
					$header.css('margin-top', '0');
				} else {
					qodefCore.body.addClass('qodef-header--fixed-display');
					$pageOuter.css('padding-top', parseInt(qodefGlobal.vars.headerHeight + qodefGlobal.vars.topAreaHeight) + 'px');
					$header.css('margin-top', parseInt(qodefGlobal.vars.topAreaHeight) + 'px');
				}
			}
		},
		init: function () {
            
            if (!qodefCore.body.hasClass('qodef-header--vertical')) {
                var $pageOuter = $('#qodef-page-outer'),
                    $header = $('#qodef-page-header');
                
                fixedHeaderAppearance.showHideHeader($pageOuter, $header);
                
                $(window).scroll(function () {
                    fixedHeaderAppearance.showHideHeader($pageOuter, $header);
                });
                
                $(window).resize(function () {
                    $pageOuter.css('padding-top', '0');
                    fixedHeaderAppearance.showHideHeader($pageOuter, $header);
                });
            }
		}
	};
	
	qodefCore.fixedHeaderAppearance = fixedHeaderAppearance.init;
	
})(jQuery);
(function ($) {
	"use strict";
	
	var stickyHeaderAppearance = {
		displayAmount: function () {
			if (qodefGlobal.vars.qodefStickyHeaderScrollAmount !== 0) {
				return parseInt(qodefGlobal.vars.qodefStickyHeaderScrollAmount, 10);
			} else {
				return parseInt(qodefGlobal.vars.headerHeight + qodefGlobal.vars.adminBarHeight, 10);
			}
		},
		showHideHeader: function (displayAmount) {
			
			if (qodefCore.scroll < displayAmount) {
				qodefCore.body.removeClass('qodef-header--sticky-display');
			} else {
				qodefCore.body.addClass('qodef-header--sticky-display');
			}
		},
		init: function () {
			var displayAmount = stickyHeaderAppearance.displayAmount();
			
			stickyHeaderAppearance.showHideHeader(displayAmount);
			$(window).scroll(function () {
				stickyHeaderAppearance.showHideHeader(displayAmount);
			});
		}
	};
	
	qodefCore.stickyHeaderAppearance = stickyHeaderAppearance.init;
	
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefSearchCoversHeader.init();
	});
	
	var qodefSearchCoversHeader = {
		init: function () {
			var $searchOpener = $('a.qodef-search-opener'),
				$searchForm = $('.qodef-search-cover-form'),
				$searchClose = $searchForm.find('.qodef-m-close');
			
			if ($searchOpener.length && $searchForm.length) {
				$searchOpener.on('click', function (e) {
					e.preventDefault();
					qodefSearchCoversHeader.openCoversHeader($searchForm);
					
				});
				$searchClose.on('click', function (e) {
					e.preventDefault();
					qodefSearchCoversHeader.closeCoversHeader($searchForm);
				});
			}
		},
		openCoversHeader: function ($searchForm) {
			qodefCore.body.addClass('qodef-covers-search--opened qodef-covers-search--fadein');
			qodefCore.body.removeClass('qodef-covers-search--fadeout');
			
			setTimeout(function () {
				$searchForm.find('.qodef-m-form-field').focus();
			}, 600);
		},
		closeCoversHeader: function ($searchForm) {
			qodefCore.body.removeClass('qodef-covers-search--opened qodef-covers-search--fadein');
			qodefCore.body.addClass('qodef-covers-search--fadeout');
			
			setTimeout(function () {
				$searchForm.find('.qodef-m-form-field').val('');
				$searchForm.find('.qodef-m-form-field').blur();
				qodefCore.body.removeClass('qodef-covers-search--fadeout');
			}, 300);
		}
	};
	
})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function () {
        qodefSearch.init();
	});
	
	var qodefSearch = {
		init: function () {
            this.search = $('a.qodef-search-opener');

            if (this.search.length) {
                this.search.each(function () {
                    var $thisSearch = $(this);

                    qodefSearch.searchHoverColor($thisSearch);
                });
            }
        },
		searchHoverColor: function ($searchHolder) {
			if (typeof $searchHolder.data('hover-color') !== 'undefined') {
				var hoverColor = $searchHolder.data('hover-color'),
				    originalColor = $searchHolder.css('color');
				
				$searchHolder.on('mouseenter', function () {
					$searchHolder.css('color', hoverColor);
				}).on('mouseleave', function () {
					$searchHolder.css('color', originalColor);
				});
			}
		}
	};
	
})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function() {
		qodefProgressBarSpinner.init();
	});
	
	var qodefProgressBarSpinner = {
		percentNumber: 0,
		init: function () {
			this.holder = $('#qodef-page-spinner.qodef-layout--progress-bar');
			
			if (this.holder.length) {
				qodefProgressBarSpinner.animateSpinner(this.holder);
			}
		},
		animateSpinner: function ($holder) {
			
			var $numberHolder = $holder.find('.qodef-m-spinner-number-label'),
				$spinnerLine = $holder.find('.qodef-m-spinner-line-front'),
				numberIntervalFastest,
				windowLoaded = false;
			
			$spinnerLine.animate({'width': '100%'}, 10000, 'linear');
			
			var numberInterval = setInterval(function () {
				qodefProgressBarSpinner.animatePercent($numberHolder, qodefProgressBarSpinner.percentNumber);
			
				if (windowLoaded) {
					clearInterval(numberInterval);
				}
			}, 100);
			
			$(window).on('load', function () {
				windowLoaded = true;
				
				numberIntervalFastest = setInterval(function () {
					if (qodefProgressBarSpinner.percentNumber >= 100) {
						clearInterval(numberIntervalFastest);
						$spinnerLine.stop().animate({'width': '100%'}, 500);
						
						setTimeout(function () {
							$holder.addClass('qodef--finished');
							
							setTimeout(function () {
								qodefProgressBarSpinner.fadeOutLoader($holder);
							}, 1000);
						}, 600);
					} else {
						qodefProgressBarSpinner.animatePercent($numberHolder, qodefProgressBarSpinner.percentNumber);
					}
				}, 6);
			});
		},
		animatePercent: function ($numberHolder, percentNumber) {
			if (percentNumber < 100) {
				percentNumber += 5;
				$numberHolder.text(percentNumber);
				
				qodefProgressBarSpinner.percentNumber = percentNumber;
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
(function ($) {
	"use strict";
	
	qodefCore.shortcodes.alloggio_core_instagram_list = {};
	
	$(document).ready(function () {
		qodefInstagram.init();
	});
	
	var qodefInstagram = {
		init: function () {
			this.holder = $('.sbi.qodef-instagram-swiper-container');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this),
						sliderOptions = $thisHolder.parent().attr('data-options'),
						$instagramImage = $thisHolder.find('.sbi_item.sbi_type_image'),
						$imageHolder = $thisHolder.find('#sbi_images');
					
					$thisHolder.attr('data-options', sliderOptions);
					
					$imageHolder.addClass('swiper-wrapper');
					
					if ($instagramImage.length) {
						$instagramImage.each(function () {
							$(this).addClass('qodef-e qodef-image-wrapper swiper-slide');
						});
					}
					
					if (typeof qodef.qodefSwiper === 'object') {
						qodef.qodefSwiper.init($thisHolder);
					}
				});
			}
		},
	};
	
	qodefCore.shortcodes.alloggio_core_instagram_list.qodefInstagram = qodefInstagram;
	qodefCore.shortcodes.alloggio_core_instagram_list.qodefSwiper = qodef.qodefSwiper;
	
})(jQuery);
(function ($) {
	"use strict";
	
	var shortcode = 'alloggio_core_product_list';
	
	qodefCore.shortcodes[shortcode] = {};
	
	if (typeof qodefCore.listShortcodesScripts === 'object') {
		$.each(qodefCore.listShortcodesScripts, function (key, value) {
			qodefCore.shortcodes[shortcode][key] = value;
		});
	}
	
})(jQuery);
(function ($) {
	"use strict";
	
	qodefCore.shortcodes.alloggio_core_clients_list = {};
	qodefCore.shortcodes.alloggio_core_clients_list.qodefSwiper = qodef.qodefSwiper;
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefSideAreaCart.init();
	});
	
	var qodefSideAreaCart = {
		init: function () {
			var $holder = $('.qodef-woo-side-area-cart');
			
			if ($holder.length) {
				$holder.each(function () {
					var $thisHolder = $(this);
					
					if (qodefCore.windowWidth > 680) {
						qodefSideAreaCart.trigger($thisHolder);
						
						qodefCore.body.on('added_to_cart', function () {
							qodefSideAreaCart.trigger($thisHolder);
						});
					}
				});
			}
		},
		trigger: function ($holder) {
			var $opener = $holder.find('.qodef-m-opener'),
				$close = $holder.find('.qodef-m-close'),
				$items = $holder.find('.qodef-m-items');
			
			// Open Side Area
			$opener.on('click', function (e) {
				e.preventDefault();
				
				if (!$holder.hasClass('qodef--opened')) {
					qodefSideAreaCart.openSideArea($holder);
					
					$(document).keyup(function (e) {
						if (e.keyCode === 27) {
							qodefSideAreaCart.closeSideArea($holder);
						}
					});
				} else {
					qodefSideAreaCart.closeSideArea($holder);
				}
			});
			
			$close.on('click', function (e) {
				e.preventDefault();
				
				qodefSideAreaCart.closeSideArea($holder);
			});
			
			if ($items.length && typeof qodefCore.qodefPerfectScrollbar === 'object') {
				qodefCore.qodefPerfectScrollbar.init($items);
			}
		},
		openSideArea: function ($holder) {
			qodefCore.qodefScroll.disable();
			
			$holder.addClass('qodef--opened');
			$('#qodef-page-wrapper').prepend('<div class="qodef-woo-side-area-cart-cover"/>');
			
			$('.qodef-woo-side-area-cart-cover').on('click', function (e) {
				e.preventDefault();
				
				qodefSideAreaCart.closeSideArea($holder);
			});
		},
		closeSideArea: function ($holder) {
			if ($holder.hasClass('qodef--opened')) {
				qodefCore.qodefScroll.enable();
				
				$holder.removeClass('qodef--opened');
				$('.qodef-woo-side-area-cart-cover').remove();
			}
		}
	};
	
})(jQuery);

(function ($) {
	"use strict";
	
	qodefCore.shortcodes.alloggio_core_restaurant_menu_info = {};
	
})(jQuery);
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
(function ($) {
	"use strict";
	
	var shortcode = 'alloggio_core_masonry_gallery_list';
	
	qodefCore.shortcodes[shortcode] = {};
	qodefCore.shortcodes[shortcode].qodefMasonryLayout = qodef.qodefMasonryLayout;
	
})(jQuery);
(function ($) {
    "use strict";
	qodefCore.shortcodes.alloggio_core_testimonials_list = {};
	qodefCore.shortcodes.alloggio_core_testimonials_list.qodefSwiper = qodef.qodefSwiper;

})(jQuery);
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