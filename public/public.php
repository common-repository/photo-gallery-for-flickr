<?php
defined( 'ABSPATH' ) or die();

require_once( PGF_PLUGIN_DIR_PATH . "public/WL_PGF_Shortcode.php" );
require_once( PGF_PLUGIN_DIR_PATH . "public/WL_PGF_Widget.php" );

add_action( 'widgets_init', array( 'WL_PGF_Widget', 'register_PGF' ) );
add_shortcode( 'PGF', array( 'WL_PGF_Shortcode', 'shortcode' ) );
?>