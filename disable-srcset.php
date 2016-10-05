<?php
/*
 Plugin Name: BEA Disable SRCSet
 Version: 1.0.1
 Plugin URI: http://www.beapi.fr
 Description: Remove on the site responsive images
 Author: BE API Technical team
 Author URI: http://www.beapi.fr
 Domain Path: languages
 Text Domain: disable-srcset
 
 ----
 
 Copyright 2016 BE API Technical team (human@beapi.fr)
 
 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.
 
 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
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
