<?php
/*
Plugin Name: rtBiz Testimonials
Plugin URI: http://rtcamp.com/
Description: This plugin add Testimonial support
Version: 0.2
Author: rtcamp
Author URI: http://rtcamp.com/
*/

define( 'RT_TESTIMONIAL', 'testimonial' );

if ( ! defined( 'RT_TESTIMONIAL_URL' ) ) {
	define( 'RT_TESTIMONIAL_URL', plugin_dir_url( __FILE__ ) );
}

add_action( 'rtbiz_init', 'rt_biz_testimonial_init', 1 );

function rt_biz_testimonial_init() {
	$rt_biz_portfolio_testimonial_loader = new RT_WP_Autoload( trailingslashit( dirname( __FILE__ ) ) . 'app' );

	$rt_biz_init = new RT_Biz_Testimonial();
}