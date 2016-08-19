<?php
/*
 Plugin Name: BEA Disable SRCSet
 Plugin URI: http://www.beapi.fr
 Description: Remove on the site responsive images
 Author: BeAPI
 Author URI: http://www.beapi.fr
 Version: 1.0.1

 ----
 Copyright 2016 BE API Technical Team (technique@beapi.fr)
 ----
 */

// Clean the up the image from wp_get_attachment_image()
add_filter( 'wp_get_attachment_image_attributes', 'bea_remove_srcset', PHP_INT_MAX, 1 );
function bea_remove_srcset( $attr ) {
	if ( class_exists( 'BEA_Images' ) ) {
		return $attr;
	}


	if ( isset( $attr['sizes'] ) ) {
		unset( $attr['sizes'] );
	}

	if ( isset( $attr['srcset'] ) ) {
		unset( $attr['srcset'] );
	}

	return $attr;
}

// Override the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_false', PHP_INT_MAX );

// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );

// Remove the reponsive stuff from the content
remove_filter( 'the_content', 'wp_make_content_images_responsive' );
