<?php

if ( ! function_exists( 'alloggio_core_get_room_reservation_filter_revolution_sliders' ) ) {
	/**
	 * Function that return revolution sliders
	 *
	 * @return array
	 */
	function alloggio_core_get_room_reservation_filter_revolution_sliders() {
		$sliders = array();
		
		if ( class_exists( 'RevSliderSlider' ) ) {
			$slider         = new RevSliderSlider();
			$slider_objects = $slider->get_sliders();
			
			if ( ! empty( $slider_objects ) ) {
				foreach ( $slider_objects as $slider_object ) {
					$sliders[ $slider_object->alias ] = $slider_object->title;
				}
			}
		}
		
		return $sliders;
	}
}