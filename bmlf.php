<?php
/*
Plugin Name: Better Media Library Fields
Description: Displays extra columns (Alternative Text, Caption, Description, Permalink and File URL) in the media library view. You can choose to hide or show these new columns under the <a href="http://codex.wordpress.org/Administration_Screens#Screen_Options">Screen Options</a> dropdown.
Version: 1.0.0
Author: Adam W. Warner, Brad Vincent
Author URI: http://fooplugins.com
Plugin URI: https://github.com/fooplugins/Better-Media-Library-Fields
License: GPLv2 or later

COPYRIGHT 2014 Adam W. Warner

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

add_action( 'manage_media_custom_column', 'bmlf_field_input' );
add_filter( 'manage_media_columns', 'bmlf_display_column' );

function bmlf_field_input($column) {
	global $post;

	// Display column values
	switch ( $column ) {
		case 'bmlf-column-alt' :
			echo get_post_meta( $post->ID, '_wp_attachment_image_alt', true );
			break;
		case 'bmlf-column-caption':
			echo $post->post_excerpt;
			break;
		case 'bmlf-column-desc':
			echo $post->post_content;
			break;
		case 'bmlf-column-href':
			echo get_permalink( $post->ID );
			break;
		case 'bmlf-column-src':
			echo $post->guid;
			break;
	}
}

function bmlf_display_column($columns) {
	// Register the columns to display
	$columns['bmlf-column-alt']     = __( 'Alternative Text' );
	$columns['bmlf-column-caption'] = __( 'Caption' );
	$columns['bmlf-column-desc']    = __( 'Description' );
	$columns['bmlf-column-href']    = __( 'Permalink' );
	$columns['bmlf-column-src']     = __( 'File URL' );

	return $columns;
}