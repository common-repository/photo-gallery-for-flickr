<?php
/**
 * Plugin Name: Photo Gallery For Flickr
 * Plugin URI: https://wordpress.org/plugins/photo-gallery-for-flickr/
 * Description: Photo Gallery For Flickr, an improved WordPress plugin built to display your flickr photo album gallery in your WordPress website through very easy steps. It allows to showcase your flickr photo gallery on your website with an improved layout.
 * Version: 2.0
 * Author: Weblizar
 * Author URI: https://weblizar.com/
 * Text Domain: WL-PGF
 * Domain Path: /languages
 * License: GPL2

Photo Gallery For Flickr is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Photo Gallery For Flickr is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Photo Gallery For Flickr. If not, see http://www.gnu.org/licenses/gpl-2.0.html.
*/

defined( 'ABSPATH' ) or die();

if ( ! defined( 'PGF_TEXT_DOMAIN' ) ) {
	define( 'PGF_TEXT_DOMAIN', 'WL-PGF' );
}

if ( ! defined( 'PGF_PLUGIN_URL' ) ) {
	define( 'PGF_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'PGF_PLUGIN_DIR_PATH' ) ) {
	define( 'PGF_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}


final class WL_PGF_PhotoGalleryForFlickr {
	private static $instance = null;

	private function __construct() {
		$this->initialize_hooks();
	}
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
	private function initialize_hooks() {
		if ( is_admin() ) {
			require_once( 'admin/admin.php' );
		}
		require_once( 'public/public.php' );
	}
}
WL_PGF_PhotoGalleryForFlickr::get_instance();
// Review Notice Box
add_action( "admin_notices", "review_admin_notice_pgf_free" );
function review_admin_notice_pgf_free() {
	global $pagenow;
	$pgf_screen = get_current_screen();
	if ( $pagenow == 'edit.php' && $pgf_screen->post_type == "fa_gallery" ) {
		include( 'pgf-banner.php' );
	}
}
function pgffile() {
	wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'pgffile' );
?>
