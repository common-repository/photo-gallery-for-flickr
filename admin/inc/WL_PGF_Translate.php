<?php
defined( 'ABSPATH' ) or die();

class WL_PGF_Translate {
	public static function translate() {
		load_plugin_textdomain( PGF_TEXT_DOMAIN, false, basename( PGF_PLUGIN_DIR_PATH ) . '/languages' );
	}
}
?>