<?php

if ( ! function_exists( 'alloggio_core_add_working_hours_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function alloggio_core_add_working_hours_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => ALLOGGIO_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'working-hours',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( 'Working Hours', 'alloggio-core' ),
				'description' => esc_html__( 'Global Working Hours Options', 'alloggio-core' )
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_working_hours_monday',
					'title'      => esc_html__( 'Working Hours For Monday', 'alloggio-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_working_hours_tuesday',
					'title'      => esc_html__( 'Working Hours For Tuesday', 'alloggio-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_working_hours_wednesday',
					'title'      => esc_html__( 'Working Hours For Wednesday', 'alloggio-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_working_hours_thursday',
					'title'      => esc_html__( 'Working Hours For Thursday', 'alloggio-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_working_hours_friday',
					'title'      => esc_html__( 'Working Hours For Friday', 'alloggio-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_working_hours_saturday',
					'title'      => esc_html__( 'Working Hours For Saturday', 'alloggio-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_working_hours_sunday',
					'title'      => esc_html__( 'Working Hours For Sunday', 'alloggio-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'checkbox',
					'name'       => 'qodef_working_hours_special_days',
					'title'      => esc_html__( 'Special Days', 'alloggio-core' ),
					'options'    => array(
						'monday'    => esc_html__( 'Monday', 'alloggio-core' ),
						'tuesday'   => esc_html__( 'Tuesday', 'alloggio-core' ),
						'wednesday' => esc_html__( 'Wednesday', 'alloggio-core' ),
						'thursday'  => esc_html__( 'Thursday', 'alloggio-core' ),
						'friday'    => esc_html__( 'Friday', 'alloggio-core' ),
						'saturday'  => esc_html__( 'Saturday', 'alloggio-core' ),
						'sunday'    => esc_html__( 'Sunday', 'alloggio-core' ),
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_working_hours_special_text',
					'title'      => esc_html__( 'Featured Text For Special Days', 'alloggio-core' )
				)
			);

			// Hook to include additional options after module options
			do_action( 'alloggio_core_action_after_working_hours_options_map', $page );
		}
	}

	add_action( 'alloggio_core_action_default_options_init', 'alloggio_core_add_working_hours_options', alloggio_core_get_admin_options_map_position( 'working-hours' ) );
}