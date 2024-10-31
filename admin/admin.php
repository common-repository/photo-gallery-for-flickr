<?php
defined( 'ABSPATH' ) or die();

require_once( 'inc/WL_PGF_Translate.php' );
require_once( 'inc/WL_PGF_CPT.php' );
require_once( 'inc/WL_PGF_Metabox.php' );
require_once( 'inc/WL_PGF_SaveMetabox.php' );
require_once( 'inc/WL_PGF_Menu.php' );
require_once( PGF_PLUGIN_DIR_PATH . "public/WL_PGF_Shortcode.php" );

add_action( 'plugins_loaded', array( 'WL_PGF_Translate', 'translate' ), 1 );
add_action( 'init', array( 'WL_PGF_CPT', 'cpt' ), 1 );
add_action( 'add_meta_boxes', array( 'WL_PGF_Metabox', 'metaboxes' ) );
add_action( 'admin_init', array( 'WL_PGF_Metabox', 'metaboxes' ), 1 );
add_action( 'save_post', array( 'WL_PGF_SaveMetabox', 'savemetabox' ) );
add_action('admin_menu', array( 'WL_PGF_Menu', 'create_menu' ) );
?>