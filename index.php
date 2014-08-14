<?php
/*
Plugin Name: rtBiz Portfolio and Testimonials
Plugin URI: http://rtcamp.com/
Description: This plugin add Portfolio and Testimonial support
Version: 0.1-beta
Author: rtcamp
Author URI: http://rtcamp.com/
*/

define( 'RT_TESTIMONIAL', 'testimonial' );

if ( ! defined( 'RT_TESTIMONIAL_URL' ) ) {
	define( 'RT_TESTIMONIAL_URL', plugin_dir_url( __FILE__ ) );
}

add_action( 'rt_biz_init', 'rt_biz_testimonial_init', 1 );

function rt_biz_testimonial_init(){
	$rt_biz_portfolio_testimonial_loader = new RT_WP_Autoload( trailingslashit( dirname( __FILE__ ) ) . 'app' );

        $rt_biz_init = new RT_Biz_Testimonial();
}