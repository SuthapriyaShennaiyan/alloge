(function ( $ ) {
	'use strict';

	if ( typeof qodef !== 'object' ) {
		window.qodef = {};
	}

	qodef.scroll      = 0;
	qodef.windowWidth = $( window ).width();

	$( document ).ready(
		function () {
			qodefAdminOptionsPanel.init();
			qodefInitMediaUploader.init();
			qodefColorPicker.init();
			qodefDatePicker.init();
			qodefSelect2.init();
			qodefInitIconPicker.init();
			qodefPostFormatsDependency.init();
			qodefSearchOptions.init();
			qodefAddressFields.init();
			qodefReinitRepeaterFields.init();
		}
	);

	$( window ).on(
		'load',
		function () {
			qodefPostFormatsDependency.init( true );
		}
	);

	$( window ).scroll(
		function () {
			qodef.scroll = $( window ).scrollTop();
		}
	);

	$( window ).resize(
		function () {
			qodef.windowWidth = $( window ).width();

			if ( typeof qodefAdminOptionsPanel.adminPage !== 'undefined' && qodefAdminOptionsPanel.adminPage.length ) {
				qodefAdminOptionsPanel.adminHeader.width( qodefAdminOptionsPanel.adminPage.width() );
			}
		}
	);

	$( document ).on(
		'widget-added widget-updated',
		function ( event, widget ) {
			qodefInitMediaUploader.reinit( widget );
		}
	);

	var qodefReinitRepeaterFields = {
		init: function () {
			$( document ).on(
				'qodef_add_new_row_trigger',
				function ( event, $row ) {
					qodefSearchOptions.fieldHolder.push( $row );
					qodefInitMediaUploader.reinit( $row );
					qodefColorPicker.reinit( $row );
					qodefDatePicker.reinit( $row );
					qodefSelect2.reinit( $row );
					qodefInitIconPicker.reinit( $row );
				}
			);
		}
	};

	var qodefAdminOptionsPanel = {
		init: function () {
			this.adminPage = $( '.qodef-admin-page' );

			if ( this.adminPage.length ) {
				this.navigationInit();
				this.saveOptionsInit( this.adminPage );
				this.setActivePanel();
				this.adminHeaderPosition();
			}
		},
		navigationInit: function () {
			var navigationItems = this.adminPage.find( '.qodef-tabs-navigation-wrapper ul li' );

			navigationItems.on(
				'click',
				function () {
					qodefSearchOptions.resetSearchView();
					qodefSearchOptions.resetSearchField();
					qodefAdminOptionsPanel.initNavItemClick( $( this ) );
				}
			);
		},
		initNavItemClick: function ( item ) {
			var panelName        = item.find( '.nav-link' ).data( 'section' );
			var $navigationPanes = this.adminPage.find( '.qodef-tabs-content' );

			var $activePane = $navigationPanes.find( '.tab-content:visible' );
			$activePane.addClass( 'qodef-hide-pane' );

			var $newPane = $navigationPanes.find( '.tab-content[data-section=' + panelName + ']' );
			$newPane.removeClass( 'qodef-hide-pane' );

			item.siblings( '.qodef-active' ).removeClass( 'qodef-active' );
			item.addClass( 'qodef-active' );
			this.setCookie( 'qodefActiveTab', panelName );
		},
		setActivePanel: function () {
			var cookie = this.getCookie( 'qodefActiveTab' );

			if ( cookie !== '' ) {
				this.initNavItemClick( $( '.qodef-tabs-navigation-wrapper .nav-link[data-section=' + cookie + ']' ).parent() );
			} else {
				this.initNavItemClick( $( '.qodef-tabs-navigation-wrapper ul li:first-child' ) );
			}
		},
		saveOptionsInit: function ( $adminPage ) {
			this.optionsForm = this.adminPage.find( '#qode_framework_ajax_form' );

			var buttonPressed,
				$saveResetLoader = $( '.qodef-save-reset-loading' ),
				$saveSuccess     = $( '.qodef-save-success' );

			if ( this.optionsForm.length ) {
				$( '.qodef-save-reset-button' ).on(
					'click',
					function () {
						buttonPressed = $( this ).attr( 'name' );
					}
				);

				this.optionsForm.on(
					'submit',
					function ( e ) {
						e.preventDefault();
						e.stopPropagation();
						$saveResetLoader.addClass( 'qodef-show-loader' );
						$adminPage.addClass( 'qodef-save-reset-disable' );

						var form          = $( this ),
							button_action = buttonPressed === 'qodef_save' ? 'qode_framework_action_save_options_' : 'qode_framework_action_reset_options_',
							ajaxData      = {
								action: button_action + form.data( 'options-name' ),
								options_name: form.data( 'options-name' )
							};
						$.ajax(
							{
								type: 'POST',
								url: ajaxurl,
								cache: ! 1,
								data: $.param(
									ajaxData,
									! 0
								) + '&' + form.serialize(), success: function () {
									$saveResetLoader.removeClass( 'qodef-show-loader' );
									switch (buttonPressed) {
										case 'qodef_reset':
											window.location.reload( true );
											break;
										case 'qodef_save':
											$adminPage.removeClass( 'qodef-save-reset-disable' );
											$saveSuccess.fadeIn( 300 );
											setTimeout(
												function () {
													$saveSuccess.fadeOut( 200 );
												},
												2000
											);
											break;
									}
								}
							}
						);
					}
				);
			}
		},
		setCookie: function ( name, value ) {
			document.cookie = name + '=' + value;
		},
		getCookie: function ( name ) {
			var newName       = name + '=';
			var decodedCookie = decodeURIComponent( document.cookie );
			var cookieArray   = decodedCookie.split( ';' );

			for ( var i = 0; i < cookieArray.length; i++ ) {
				var cookie = cookieArray[i];

				while (cookie.charAt( 0 ) === ' ') {
					cookie = cookie.substring( 1 );
				}

				if ( cookie.indexOf( newName ) === 0 ) {
					return cookie.substring( newName.length, cookie.length );
				}
			}
			return '';
		},
		adminHeaderPosition: function () {
			if ( typeof this.adminPage !== 'undefined' && this.adminPage.length ) {
				this.adminBarHeight         = $( '#wpadminbar' ).height();
				this.adminHeader            = $( '.qodef-admin-header' );
				this.adminHeaderHeight      = this.adminHeader.outerHeight( true );
				this.adminHeaderTopPosition = this.adminHeader.offset().top - parseInt( this.adminBarHeight );
				this.adminContent           = $( '.qodef-admin-content' );

				this.adminHeader.width( this.adminPage.width() );

				$( window ).on(
					'scroll load',
					function () {
						if ( qodef.scroll >= qodefAdminOptionsPanel.adminHeaderTopPosition ) {
							qodefAdminOptionsPanel.adminHeader.addClass( 'qodef-fixed' ).css( 'top', parseInt( qodefAdminOptionsPanel.adminBarHeight ) );
							qodefAdminOptionsPanel.adminContent.css( 'marginTop', qodefAdminOptionsPanel.adminHeaderHeight );
						} else {
							qodefAdminOptionsPanel.adminHeader.removeClass( 'qodef-fixed' ).css( 'top', 0 );
							qodefAdminOptionsPanel.adminContent.css( 'marginTop', 0 );
						}
					}
				);
			}
		},
		adminHeaderPositionLogic: function () {
			if ( qodef.windowWidth > 768 ) {
				if ( qodef.scroll > qodefAdminOptionsPanel.adminHeaderTopPosition ) {
					qodefAdminOptionsPanel.adminHeader.addClass( 'qodef-fixed' );
					qodefAdminOptionsPanel.adminContent.css( 'padding-top', qodefAdminOptionsPanel.adminHeaderHeight );
				} else {
					qodefAdminOptionsPanel.adminHeader.removeClass( 'qodef-fixed' );
					qodefAdminOptionsPanel.adminContent.css( 'padding-top', 0 );
				}
			}
		}
	};

	var qodefInitMediaUploader = {
		init: function () {
			this.$holder = $( '.qodef-image-uploader' );

			if ( this.$holder.length ) {
				this.$holder.each(
					function () {
						qodefInitMediaUploader.initField( $( this ) );
					}
				);
			}
		},
		reinit: function ( row ) {
			var $holder = $( row ).find( '.qodef-image-uploader' );

			if ( $holder.length ) {
				$holder.each(
					function () {
						qodefInitMediaUploader.initField( $( this ) );
					}
				);
			}
		},
		initField: function ( thisHolder ) {
			var varialbles = {
				$multiple: thisHolder.data( 'multiple' ) === 'yes' && thisHolder.data( 'file' ) === 'no',
				$file: thisHolder.data( 'file' ) === 'yes',
				$allowed_type: thisHolder.data( 'file' ) === 'yes' ? thisHolder.data( 'allowed-type' ) : 'image',
				$imageHolder: thisHolder,
				mediaFrame: '',
				attachment: '',
				$thumbImageHolder: thisHolder.find( '.qodef-image-thumb' ),
				$uploadId: thisHolder.find( '.qodef-image-upload-id' ),
				$removeButton: thisHolder.find( '.qodef-image-remove-btn' )
			};

			if ( varialbles.$thumbImageHolder.find( 'img' ).length ) {
				varialbles.$removeButton.show();
				qodefInitMediaUploader.remove( varialbles.$removeButton );
			}

			if ( varialbles.$multiple ) {
				qodefInitMediaUploader.multipleSelectMakeSortable( thisHolder );
			}

			varialbles.$imageHolder.on(
				'click',
				'.qodef-image-upload-btn',
				function () {

					//if the media frame already exists, reopen it.
					if ( varialbles.mediaFrame ) {
						varialbles.mediaFrame.open();
						return;
					}

					//create the media frame
					varialbles.mediaFrame = wp.media.frames.fileFrame = wp.media(
						{
							title: $( this ).data( 'frame-title' ),
							button: {
								text: $( this ).data( 'frame-button-text' )
							},
							library: {
								type: varialbles.$allowed_type
							},
							multiple: varialbles.$multiple,
						}
					);

					//call right select, multiple or single or file
					if ( varialbles.$file ) {
						qodefInitMediaUploader.fileSelect( varialbles );
					} else if ( varialbles.$multiple ) {
						qodefInitMediaUploader.multipleSelect( varialbles, thisHolder );
					} else {
						qodefInitMediaUploader.singleSelect( varialbles );
					}

					//check selected images when wp media is opened
					varialbles.mediaFrame.on(
						'open',
						function () {
							var selection = varialbles.mediaFrame.state().get( 'selection' ),
								ids       = varialbles.$uploadId.val().split( ',' );

							ids.forEach(
								function ( id ) {
									varialbles.attachment = wp.media.attachment( id );
									varialbles.attachment.fetch();
									selection.add( varialbles.attachment ? [varialbles.attachment] : [] );
								}
							);
						}
					);

					//open media frame
					varialbles.mediaFrame.open();
				}
			);
		},
		multipleSelect: function ( varialbles, $holder ) {
			varialbles.mediaFrame.on(
				'select',
				function () {
					varialbles.attachment = varialbles.mediaFrame.state().get( 'selection' ).map(
						function ( attachment ) {
							attachment.toJSON();
							return attachment;
						}
					);

					varialbles.$removeButton.show().trigger( 'change' );
					qodefInitMediaUploader.remove( varialbles.$removeButton );

					var ids = $.map(
						varialbles.attachment,
						function ( o ) {
							if ( o.attributes.type === 'image' ) {
								return o.id;
							}
						}
					);

					varialbles.$uploadId.val( ids );
					varialbles.$thumbImageHolder.find( 'ul' ).empty().trigger( 'change' );

					//loop through the array and add image for each attachment
					for ( var i = 0; i < varialbles.attachment.length; ++i ) {
						// prevent blob image uploading and unexpected JS error when sizes not found
						if ( varialbles.attachment[i].attributes.sizes === undefined ) {
							continue;
						}

						if ( varialbles.attachment[i].attributes.sizes.thumbnail !== undefined ) {
							varialbles.$thumbImageHolder.find( 'ul' ).append( '<li data-id="' + varialbles.attachment[i].attributes.id + '"><img src="' + varialbles.attachment[i].attributes.sizes.thumbnail.url + '" alt="thumbnail" /></li>' );
						} else {
							varialbles.$thumbImageHolder.find( 'ul' ).append( '<li data-id="' + varialbles.attachment[i].attributes.id + '"><img src="' + varialbles.attachment[i].attributes.sizes.full.url + '" alt="thumbnail" /></li>' );
						}
					}

					varialbles.$thumbImageHolder.show().trigger( 'change' );
					qodefInitMediaUploader.multipleSelectMakeSortable( $holder );
				}
			);
		},
		multipleSelectSaveNewOrder: function ( $holder ) {
			var $listItems     = $holder.find( 'li' ),
				$imageUploadId = $holder.find( '.qodef-image-upload-id' ),
				newOrder       = '',
				separator      = '';

			if ( $listItems.length ) {
				$listItems.each(
					function ( index ) {
						separator = 0 === index ? '' : ',';
						newOrder += separator + $( this ).data( 'id' );
					}
				);
			}

			$imageUploadId.val( newOrder );
		},
		multipleSelectMakeSortable: function ( $holder ) {
			$holder.find( 'ul' ).sortable(
				{
					opacity: 0.6,
					stop: function () {
						qodefInitMediaUploader.multipleSelectSaveNewOrder( $holder );
					}
				}
			);
		},
		singleSelect: function ( varialbles ) {
			varialbles.mediaFrame.on(
				'select',
				function () {
					varialbles.attachment = varialbles.mediaFrame.state().get( 'selection' ).first().toJSON();

					//write to url field and img tag
					if ( varialbles.attachment.hasOwnProperty( 'url' ) && varialbles.attachment.type === 'image' ) {

						varialbles.$removeButton.show();
						qodefInitMediaUploader.remove( varialbles.$removeButton );

						varialbles.$uploadId.val( varialbles.attachment.id );
						varialbles.$thumbImageHolder.empty();

						if ( varialbles.attachment.hasOwnProperty( 'sizes' ) && varialbles.attachment.sizes.thumbnail ) {
							varialbles.$thumbImageHolder.append( '<img class="qodef-single-image" src="' + varialbles.attachment.sizes.thumbnail.url + '" alt="thumbnail" />' );
						} else {
							varialbles.$thumbImageHolder.append( '<img class="qodef-single-image" src="' + varialbles.attachment.url + '" alt="thumbnail" />' );
						}
						varialbles.$thumbImageHolder.show().trigger( 'change' );
					}
				}
			);
		},
		fileSelect: function ( varialbles ) {

			varialbles.mediaFrame.on(
				'select',
				function () {
					varialbles.attachment = varialbles.mediaFrame.state().get( 'selection' ).first().toJSON();

					//write to url field and img tag
					if ( varialbles.attachment.hasOwnProperty( 'url' ) && varialbles.$allowed_type.includes( varialbles.attachment.type ) ) {

						varialbles.$removeButton.show();
						qodefInitMediaUploader.remove( varialbles.$removeButton );

						varialbles.$uploadId.val( varialbles.attachment.id );
						varialbles.$thumbImageHolder.empty();

						varialbles.$thumbImageHolder.append(
							'' +
							'<img class="qodef-file-image" src="' + varialbles.attachment.icon + '" alt="thumbnail" />' +
							'<div class="qodef-file-name">' + varialbles.attachment.filename + '</div>' +
							''
						);

						varialbles.$thumbImageHolder.show().trigger( 'change' );
					}
				}
			);
		},
		remove: function ( button ) {
			button.on(
				'click',
				function () {
					//remove images and hide it's holder
					button.siblings( '.qodef-image-thumb' ).hide();
					button.siblings( '.qodef-image-thumb' ).find( 'img' ).attr( 'src', '' );
					button.siblings( '.qodef-image-thumb' ).find( 'li' ).remove();

					//reset meta fields
					button.siblings( '.qodef-image-meta-fields' ).find( 'input[type="hidden"]' ).each(
						function () {
							$( this ).val( '' );
						}
					);

					button.hide().trigger( 'change' );
				}
			);
		}
	};

	var qodefColorPicker = {
		init: function () {
			this.$holder = $( '.qodef-color-field:not(".widefat")' );

			if ( this.$holder.length ) {
				this.$holder.each(
					function () {
						qodefColorPicker.initField( $( this ) );
					}
				);
			}
		},
		reinit: function ( row ) {
			var $holder = $( row ).find( '.qodef-color-field:not(".widefat")' );

			if ( $holder.length ) {
				qodefColorPicker.initField( $holder );
			}
		},
		initField: function ( $thisHolder ) {
			$thisHolder.wpColorPicker();
		}
	};

	var qodefDatePicker = {
		init: function () {
			this.$holder = $( '.qodef-datepicker' );

			if ( this.$holder.length ) {
				this.$holder.each(
					function () {
						qodefDatePicker.initField( $( this ) );
					}
				);
			}
		},
		reinit: function ( row ) {
			var $holder = $( row ).find( '.qodef-datepicker' );

			if ( $holder.length ) {
				qodefDatePicker.initField( $holder );
			}
		},
		initField: function ( $thisHolder ) {
			var dateFormat = $thisHolder.data( 'date-format' );
			$thisHolder.datepicker(
				{
					dateFormat: dateFormat,
					changeYear: true,
				}
			);

			$( window ).on(
				'keyup',
				function ( e ) {
					// 8 is backspace and 46 is deleted
					if ( $thisHolder.is( ':focus' ) && '' !== $thisHolder.val() && (8 === e.keyCode || 46 === e.keyCode) ) {
						$thisHolder.datepicker( 'setDate', null );
					}
				}
			);
		}
	};

	var qodefSelect2 = {
		init: function () {
			var $holder = $( 'select.qodef-select2' );

			if ( $holder.length ) {
				qodefSelect2.initField( $holder );
			}
		},
		reinit: function ( row ) {
			var $holder = $( row ).find( 'select.qodef-select2' );

			if ( $holder.length ) {
				qodefSelect2.initField( $holder );
			}
		},
		initField: function ( $thisHolder ) {
			if ( typeof $thisHolder.select2 === 'function' ) {
				var selectParams = {
					width: '100%',
					allowClear: false,
					minimumResultsForSearch: 11
				};

				if ( $thisHolder.parents( '.qodef-field-holder' ).hasClass( 'qodef-select2-with-icon' ) ) {
					selectParams.templateResult    = qodefSelect2.formatState;
					selectParams.templateSelection = qodefSelect2.formatState;
				}

				$thisHolder.select2( selectParams );
			}
		},
		formatState: function ( state ) {
			if ( ! state.id || ! $( state.element ).parents( '.qodef-field-holder' ).hasClass( 'qodef-select2-with-icon' ) ) {
				return state.text;
			}

			return $(
				'<span class="qodef-select2-icon-option"><span class="qodef-select2-icon qodef--' + state.element.value.toLowerCase().replace( ' ', '-' ) + '"></span>' + state.text + '</span>'
			);
		}
	};

	var qodefInitIconPicker = {
		init: function () {
			this.$holder = $( '.qodef-iconpicker-select:not(.qodef-select2):not(.qodef--icons-init)' );

			if ( this.$holder.length ) {
				this.$holder.each(
					function () {
						var $thisHolder = $( this );

						if ( typeof $thisHolder.fontIconPicker === 'function' ) {
							$thisHolder.addClass( 'qodef--icons-init' );
							$thisHolder.fontIconPicker();
						}
					}
				);
			}
		},
		reinit: function ( row, $element ) {
			var $holder = typeof $element !== 'undefined' && $element !== '' && $element !== false ? $element : $( row ).find( '.qodef-iconpicker-select:not(.qodef-select2)' );

			if ( $holder.length && ! $holder.hasClass( 'qodef--icons-init' ) && typeof $holder.fontIconPicker === 'function' ) {
				$holder.addClass( 'qodef--icons-init' );
				$holder.fontIconPicker();
			}
		}
	};

	var qodefPostFormatsDependency = {
		init: function ( onLoad ) {
			if ( onLoad ) {
				qodefPostFormatsDependency.initObserver();
				qodefPostFormatsDependency.gutenbergEditor();
			} else {
				qodefPostFormatsDependency.classicEditor();
			}
		},
		initObserver: function () {
			var $holder = $( '.edit-post-sidebar' );

			if ( $holder.length ) {
				var mutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;

				// create mutation observer prototype for class changes
				$.fn.attrChange = function ( attrChangeCallback ) {
					if ( mutationObserver ) {
						var options = {
							attributes: true,
							attributeFilter: ['class'],
							subtree: false,
						};

						var observer = new mutationObserver(
							function ( mutations ) {
								mutations.forEach(
									function ( event ) {
										attrChangeCallback.call( event.target );
									}
								);
							}
						);

						return this.each(
							function () {
								observer.observe( this, options );
							}
						);
					}
				};

				// append event listener
				$holder.find( '.edit-post-sidebar__panel-tabs ul li:first-child button' ).attrChange(
					function () {
						if ( $( this ).hasClass( 'is-active' ) ) {
							qodefPostFormatsDependency.gutenbergEditor();
						}
					}
				);
			}
		},
		classicEditor: function () {
			var $holder          = $( '#post-formats-select' ),
				$postFormats     = $holder.find( 'input[name="post_format"]' ),
				$selectedFormat  = $holder.find( 'input[name="post_format"]:checked' ),
				selectedFormatID = $selectedFormat.attr( 'id' );

			// This is temporary case - waiting ui style
			$postFormats.each(
				function () {
					qodefPostFormatsDependency.metaBoxVisibility( false, $( this ).attr( 'id' ) );
				}
			);

			qodefPostFormatsDependency.metaBoxVisibility( true, selectedFormatID );

			$postFormats.change(
				function () {
					qodefPostFormatsDependency.classicEditor();
				}
			);
		},
		gutenbergEditor: function () {
			var $holder = $( '.edit-post-sidebar' );

			if ( $holder.length ) {
				var $postFormats    = $holder.find( '.editor-post-format' ),
					$selectedFormat = $postFormats.find( 'select option:selected' );

				$postFormats.find( 'select option' ).each(
					function () {
						qodefPostFormatsDependency.metaBoxVisibility( false, 'post_format_' + $( this ).val() );
					}
				);

				if ( $selectedFormat.length ) {
					qodefPostFormatsDependency.metaBoxVisibility( true, 'post_format_' + $selectedFormat.val() );
				}

				$postFormats.find( 'select' ).one(
					'change',
					function () {
						qodefPostFormatsDependency.gutenbergEditor();
					}
				);
			}
		},
		metaBoxVisibility: function ( visibility, itemID ) {
			if ( itemID !== '' && itemID !== undefined ) {
				var postFormatName = itemID.replace( /-/g, '_' );

				if ( visibility ) {
					$( '.qodef-section-name-qodef_' + postFormatName + '_section' ).fadeIn();
				} else {
					$( '.qodef-section-name-qodef_' + postFormatName + '_section' ).hide();
				}
			}
		}
	};

	var qodefAddressFields = {
		init: function ( trigger ) {
			this.$addressHolder = $( '.qodef-address-field-holder' );

			if ( this.$addressHolder.length ) {
				this.$addressHolder.each(
					function () {
						qodefAddressFields.initMap( $( this ), trigger );
					}
				);
			}
		},
		initMap: function ( $holder, trigger ) {
			var $reset       = $holder.find( '.qodef-reset-marker' ),
				$inputField  = $holder.find( 'input' ),
				$mapField    = $holder.find( '.qodef-map-canvas' ),
				countryLimit = $holder.data( 'country' ),
				latFieldName = $holder.data( 'lat' ),
				$latField    = $( '.qodef-address-elements [name="' + latFieldName + '"]' ),
				lngFieldName = $holder.data( 'lng' ),
				$lngField    = $( '.qodef-address-elements [name="' + lngFieldName + '"]' );

			// This peace of code is required in order to re init maps for address field type when it's inside tabs layout
			if ( trigger ) {
				$inputField.trigger( 'geocode' );
			}

			if ( typeof $inputField.geocomplete === 'function' && typeof trigger === 'undefined' ) {
				$inputField.geocomplete(
					{
						map: $mapField,
						details: '.qodef-address-elements',
						detailsAttribute: 'data-geo',
						types: ['geocode', 'establishment'],
						country: countryLimit,
						markerOptions: {
							draggable: true
						},
					}
				).bind(
					'geocode:result',
					function () {
						$reset.show();
					}
				);

				$inputField.on(
					'geocode:dragged',
					function ( event, latLng ) {
						$latField.val( latLng.lat() );
						$lngField.val( latLng.lng() );
						$reset.show();
						var map = $inputField.geocomplete( 'map' );
						map.panTo( latLng );
						var geocoder = new google.maps.Geocoder();

						geocoder.geocode(
							{ 'latLng': latLng },
							function ( results, status ) {
								if ( status === google.maps.GeocoderStatus.OK && typeof results[0] === 'object' ) {
									$inputField.val( results[0].formatted_address );
								}
							}
						);
					}
				);

				$inputField.on(
					'focus',
					function () {
						var map = $inputField.geocomplete( 'map' );
						google.maps.event.trigger( map, 'resize' );
					}
				);

				$reset.on(
					'click',
					function ( e ) {
						e.preventDefault();

						$reset.hide();

						$inputField.geocomplete( 'resetMarker' ).val( '' );
						$latField.val( '' );
						$lngField.val( '' );
					}
				);

				$( window ).on(
					'load',
					function () {
						$inputField.trigger( 'geocode' );
					}
				);
			}
		},
	};

	qodef.qodefAddressFields = qodefAddressFields;

	var qodefSearchOptions = {
		init: function () {
			this.searchField    = $( '.qodef-search-field' );
			this.adminContent   = $( '.qodef-admin-content' );
			this.tabHolder      = $( '.tab-content' );
			this.rowHolder      = $( '.qodef-row-wrapper' );
			this.sectionHolder  = $( '.qodef-section-wrapper' );
			this.repeaterHolder = $( '.qodef-repeater-wrapper' );
			this.fieldHolder    = $( '.qodef-field-holder' );

			if ( this.searchField.length ) {
				var searchLoading = this.searchField.next( '.qodef-search-loading' ),
					searchRegex,
					keyPressTimeout;

				this.searchField.on(
					'keyup paste',
					function () {
						var field = $( this );
						field.attr( 'autocomplete', 'off' );
						searchLoading.removeClass( 'qodef-hidden' );
						clearTimeout( keyPressTimeout );

						keyPressTimeout = setTimeout(
							function () {
								var searchTerm = field.val();
								searchRegex    = new RegExp( field.val(), 'gi' );
								searchLoading.addClass( 'qodef-hidden' );

								if ( searchTerm.length < 3 ) {
									qodefSearchOptions.resetSearchView();
								} else {
									qodefSearchOptions.resetSearchView();
									qodefSearchOptions.adminContent.addClass( 'qodef-apply-search' );
									qodefSearchOptions.fieldHolder.each(
										function () {
											var thisFieldHolder = $( this );
											if ( thisFieldHolder.find( '.qodef-field-desc' ).text().search( searchRegex ) !== -1 ) {
												thisFieldHolder.parents( '.tab-content' ).addClass( 'qodef-search-show' );
												thisFieldHolder.parents( '.qodef-section-wrapper' ).addClass( 'qodef-search-show' );
												thisFieldHolder.parents( '.qodef-row-wrapper' ).addClass( 'qodef-search-show' );
												thisFieldHolder.parents( '.qodef-repeater-wrapper' ).addClass( 'qodef-search-show' );
											} else {
												thisFieldHolder.addClass( 'qodef-search-hide' );
											}
										}
									);
								}
							},
							500
						);
					}
				);
			}
		},
		resetSearchView: function () {
			this.adminContent.removeClass( 'qodef-apply-search' );
			this.tabHolder.removeClass( 'qodef-search-show' );
			this.rowHolder.removeClass( 'qodef-search-show' );
			this.sectionHolder.removeClass( 'qodef-search-show' );
			this.repeaterHolder.removeClass( 'qodef-search-show' );
			this.fieldHolder.removeClass( 'qodef-search-hide' );
		},
		resetSearchField: function () {
			this.searchField.val( '' );
		}
	};

})( jQuery );
