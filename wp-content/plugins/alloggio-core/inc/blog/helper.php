<?php

if ( ! function_exists( 'alloggio_core_include_blog_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function alloggio_core_include_blog_shortcodes() {
		foreach ( glob( ALLOGGIO_CORE_INC_PATH . '/blog/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}
	
	add_action( 'qode_framework_action_before_shortcodes_register', 'alloggio_core_include_blog_shortcodes' );
}

if ( ! function_exists( 'alloggio_core_include_blog_shortcodes_widget' ) ) {
	/**
	 * Function that includes widgets
	 */
	function alloggio_core_include_blog_shortcodes_widget() {
		foreach ( glob( ALLOGGIO_CORE_INC_PATH . '/blog/shortcodes/*/widget/include.php' ) as $widget ) {
			include_once $widget;
		}
	}
	
	add_action( 'qode_framework_action_before_widgets_register', 'alloggio_core_include_blog_shortcodes_widget' );
}

if ( ! function_exists( 'alloggio_core_set_blog_single_page_title' ) ) {
	/**
	 * Function that enable/disable page title area for blog single page
	 *
	 * @param bool $enable_page_title
	 *
	 * @return bool
	 */
	function alloggio_core_set_blog_single_page_title( $enable_page_title ) {
		
		if ( is_singular( 'post' ) ) {
			$option = alloggio_core_get_post_value_through_levels( 'qodef_blog_single_enable_page_title' ) !== 'no';
			
			if ( isset ( $option ) ) {
				$enable_page_title = $option;
			}
			
			$meta_option = get_post_meta( get_the_ID(), 'qodef_enable_page_title', true );
			
			if ( ! empty( $meta_option ) ) {
				$enable_page_title = $meta_option;
			}
		}
		
		return $enable_page_title;
	}
	
	add_filter( 'alloggio_filter_enable_page_title', 'alloggio_core_set_blog_single_page_title' );
}

if ( ! function_exists( 'alloggio_core_set_blog_single_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param string $layout
	 *
	 * @return string
	 */
	function alloggio_core_set_blog_single_sidebar_layout( $layout ) {
		
		if ( is_singular( 'post' ) ) {
			$option = alloggio_core_get_post_value_through_levels( 'qodef_blog_single_sidebar_layout' );
			
			if ( ! empty( $option ) ) {
				$layout = $option;
			}
			
			$meta_option = get_post_meta( get_the_ID(), 'qodef_page_sidebar_layout', true );
			
			if ( ! empty( $meta_option ) ) {
				$layout = $meta_option;
			}
		}
		
		return $layout;
	}
	
	add_filter( 'alloggio_filter_sidebar_layout', 'alloggio_core_set_blog_single_sidebar_layout' );
}

if ( ! function_exists( 'alloggio_core_set_blog_single_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param string $sidebar_name
	 *
	 * @return string
	 */
	function alloggio_core_set_blog_single_custom_sidebar_name( $sidebar_name ) {
		
		if ( is_singular( 'post' ) ) {
			$option = alloggio_core_get_post_value_through_levels( 'qodef_blog_single_custom_sidebar' );
			
			if ( ! empty( $option ) ) {
				$sidebar_name = $option;
			}
			
			$meta_option = get_post_meta( get_the_ID(), 'qodef_page_custom_sidebar', true );
			
			if ( ! empty( $meta_option ) ) {
				$sidebar_name = $meta_option;
			}
		}
		
		return $sidebar_name;
	}
	
	add_filter( 'alloggio_filter_sidebar_name', 'alloggio_core_set_blog_single_custom_sidebar_name' );
}

if ( ! function_exists( 'alloggio_core_set_blog_single_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function alloggio_core_set_blog_single_sidebar_grid_gutter_classes( $classes ) {
		
		if ( is_singular( 'post' ) ) {
			$option = alloggio_core_get_post_value_through_levels( 'qodef_blog_single_sidebar_grid_gutter' );
			
			if ( ! empty( $option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $option );
			}
			
			$meta_option = get_post_meta( get_the_ID(), 'qodef_page_sidebar_grid_gutter', true );
			
			if ( ! empty( $meta_option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $meta_option );
			}
		}
		
		return $classes;
	}
	
	add_filter( 'alloggio_filter_grid_gutter_classes', 'alloggio_core_set_blog_single_sidebar_grid_gutter_classes' );
}

if ( ! function_exists( 'alloggio_core_set_blog_holder_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function alloggio_core_set_blog_holder_classes( $classes ) {
		$enable_page_padding = alloggio_core_get_post_value_through_levels( 'qodef_blog_single_enable_page_padding' );
		$archive_hide_info   = alloggio_core_get_post_value_through_levels( 'qodef_blog_archive_hide_info' );
		
		if ( is_single() ) {
			
			if ( $enable_page_padding === 'yes' ) {
				$classes[] = 'qodef-has-padding';
			}
			
		} else {
			
			if ( $archive_hide_info === 'yes' ) {
				$classes[] = 'qodef-info-hidden';
			}
		}
		
		return $classes;
	}
	
	add_filter( 'alloggio_filter_blog_holder_classes', 'alloggio_core_set_blog_holder_classes' );
}

if ( ! function_exists( 'alloggio_core_enable_posts_order' ) ) {
	/**
	 * Function that enable page attributes options for blog single page
	 */
	function alloggio_core_enable_posts_order() {
		add_post_type_support( 'post', 'page-attributes' );
	}
	
	add_action( 'admin_init', 'alloggio_core_enable_posts_order' );
}

if ( ! function_exists( 'alloggio_core_set_blog_list_excerpt_length' ) ) {
	/**
	 * Function that set number of characters for excerpt on blog list page
	 *
	 * @param int $excerpt_length
	 *
	 * @return int
	 */
	function alloggio_core_set_blog_list_excerpt_length( $excerpt_length ) {
		$option = alloggio_core_get_post_value_through_levels( 'qodef_blog_list_excerpt_number_of_characters' );
		
		if ( $option !== '' ) {
			$excerpt_length = $option;
		}
		
		return $excerpt_length;
	}
	
	add_filter( 'alloggio_filter_blog_list_excerpt_length', 'alloggio_core_set_blog_list_excerpt_length' );
}

if ( ! function_exists( 'alloggio_core_get_allowed_pages_for_blog_sidebar_layout' ) ) {
	/**
	 * Function that return pages where blog sidebar is allowed
	 *
	 * @return bool
	 */
	function alloggio_core_get_allowed_pages_for_blog_sidebar_layout() {
		return ( is_archive() || ( is_home() && is_front_page() ) ) && get_post_type() === 'post';
	}
}

if ( ! function_exists( 'alloggio_core_set_blog_archive_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param string $layout
	 *
	 * @return string
	 */
	function alloggio_core_set_blog_archive_sidebar_layout( $layout ) {
		
		if ( alloggio_core_get_allowed_pages_for_blog_sidebar_layout() ) {
			$option = alloggio_core_get_post_value_through_levels( 'qodef_blog_archive_sidebar_layout' );
			
			if ( ! empty( $option ) ) {
				$layout = $option;
			}
		}
		
		return $layout;
	}
	
	add_filter( 'alloggio_filter_sidebar_layout', 'alloggio_core_set_blog_archive_sidebar_layout' );
}

if ( ! function_exists( 'alloggio_core_set_blog_archive_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param string $sidebar_name
	 *
	 * @return string
	 */
	function alloggio_core_set_blog_archive_custom_sidebar_name( $sidebar_name ) {
		
		if ( alloggio_core_get_allowed_pages_for_blog_sidebar_layout() ) {
			$option = alloggio_core_get_post_value_through_levels( 'qodef_blog_archive_custom_sidebar' );
			
			if ( ! empty( $option ) ) {
				$sidebar_name = $option;
			}
		}
		
		return $sidebar_name;
	}
	
	add_filter( 'alloggio_filter_sidebar_name', 'alloggio_core_set_blog_archive_custom_sidebar_name' );
}

if ( ! function_exists( 'alloggio_core_set_blog_archive_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function alloggio_core_set_blog_archive_sidebar_grid_gutter_classes( $classes ) {
		
		if ( alloggio_core_get_allowed_pages_for_blog_sidebar_layout() ) {
			$option = alloggio_core_get_post_value_through_levels( 'qodef_blog_single_archive_grid_gutter' );
			
			if ( ! empty( $option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $option );
			}
		}
		
		return $classes;
	}
	
	add_filter( 'alloggio_filter_grid_gutter_classes', 'alloggio_core_set_blog_archive_sidebar_grid_gutter_classes' );
}

if ( ! function_exists( 'alloggio_core_blog_single_set_post_title_instead_of_page_title_text' ) ) {
	/**
	 * Function that set current post title text for single posts
	 *
	 * @param string $title
	 *
	 * @return string
	 */
	function alloggio_core_blog_single_set_post_title_instead_of_page_title_text( $title ) {
		$option = alloggio_core_get_option_value( 'admin', 'qodef_blog_single_set_post_title_in_title_area' );
		
		if ( is_singular( 'post' ) && $option === 'yes' ) {
			$title = get_the_title( qode_framework_get_page_id() );
		}
		
		return $title;
	}
	
	add_filter( 'alloggio_filter_page_title_text', 'alloggio_core_blog_single_set_post_title_instead_of_page_title_text' );
}

if ( ! function_exists( 'alloggio_core_get_blog_single_post_taxonomies' ) ) {
	/**
	 * Function that return single post taxonomies list
	 *
	 * @param int $post_id
	 *
	 * @return array
	 */
	function alloggio_core_get_blog_single_post_taxonomies( $post_id ) {
		$options = array();
		
		if ( ! empty( $post_id ) ) {
			$options['tag']      = get_the_tags( $post_id );
			$options['category'] = get_the_category( $post_id );
		}
		
		return $options;
	}
}

if ( ! function_exists( 'alloggio_core_add_social_share_after_content' ) ) {
	/**
	 * Function which add social share for blog single and page
	 */
	function alloggio_core_add_social_share_after_content() {
		
		echo '<div class="qodef-e-info-item qodef-e-info-social-share">';
		
		echo AlloggioCoreSocialShareShortcode::call_shortcode( array(
			'layout'            => 'list'
		) );
		
		echo '</div>';
	}
	
	add_action( 'alloggio_action_after_blog_bottom_right_content', 'alloggio_core_add_social_share_after_content' );
}