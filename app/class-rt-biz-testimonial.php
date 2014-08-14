<?php

/**
 * Created by PhpStorm.
 * User: faishal
 * Date: 18/04/14
 * Time: 6:57 PM
 */
class RT_Biz_Testimonial {
    
     var $menu_position = 33;
     
	function __construct() {
		add_action( 'plugins_loaded', 'plugins_loaded' );
		add_action( 'init', array( &$this, 'init_0' ), 0 );
		add_filter( 'rt_biz_modules', array( $this, 'register_rt_portfolio_testimonial_module' ) );
		add_action( 'activated_plugin', 'flush_rewrite_rules' );
		add_action( 'deactivate_plugin', 'flush_rewrite_rules' );
		add_action( 'after_switch_theme', 'flush_rewrite_rules' );
	}

	function register_rt_portfolio_testimonial_module( $modules ) {
		global $rt_wiki_roles;
		$module_key = ( function_exists( 'rt_biz_sanitize_module_key' ) ) ? rt_biz_sanitize_module_key( RT_TESTIMONIAL ) : '';
		$modules[ $module_key ] = array(
			'label' => __( 'Portfolio & Testimonial' ),
			'post_types' => array(
				'portfolio',
				'testimonial',
			),
		);
		return $modules;
	}

	function plugins_loaded(){

	}

	function init_0() {
		$this->register_custom_post_type();
		$this->register_p2p_connections();
	}

	function register_p2p_connections(){
		if ( function_exists( 'p2p_register_connection_type' ) ) {

			p2p_register_connection_type(
				array(
					'name'        => 'testimonial_' . rt_biz_get_person_post_type(),
					'to'          => rt_biz_get_person_post_type(),
					'from'        => 'testimonial',
					'cardinality' => 'one-to-one',
					'title'       => array(
						'to'   => 'Testimonial',
						'from' => 'Client',
					)
				)
			);
		}

	}


	function register_custom_post_type() {
		register_post_type(
			'testimonial',
			array(
				'label'           => __( 'Testimonial' ),
				'description'     => __( 'Manage Testimonial items easily' ),
				'public'          => true,
				'show_ui'         => true,
				'taxonomies'      => array( 'post_tag' ),
				'capability_type' => 'testimonial',
                                'menu_icon'   => RT_TESTIMONIAL_URL.'app/assets/img/testimonial-16X16.png',
                                'menu_position' => $this->menu_position,
				'supports'        => array(
					'title',
					'editor',
					'excerpt',
					'thumbnail',
					'custom-fields',
					'revisions',
				),
				'rewrite'     => array(
					'slug'       => 'testimonials',
					'with_front' => false,
				),
				'has_archive' => true,
			)
		);
		add_rewrite_rule( '^testimonials/tag/([^/]*)/([^/]*)/([^/]*)/?','index.php?post_type=testimonial&tag=$matches[1]&paged=$matches[3]', 'top' );
		add_rewrite_rule( '^testimonials/tag/([^/]*)/?','index.php?post_type=testimonial&tag=$matches[1]', 'top' );
	}
} 