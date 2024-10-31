<?php
defined( 'ABSPATH' ) or die();

require_once( PGF_PLUGIN_DIR_PATH . "public/Photo_gallery_for_flickr.php" );

class WL_PGF_Widget {

	public static function register_PGF() {
		register_widget( 'Photo_gallery_for_flickr' );

	}
}
?>