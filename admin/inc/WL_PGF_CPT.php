<?php
defined( 'ABSPATH' ) or die();

class WL_PGF_CPT {
	public static function cpt() {
		$labels = array(
			'name'               => esc_html__( 'Photo Gallery For Flickr', PGF_TEXT_DOMAIN ),
			'singular_name'      => esc_html__( 'Photo Gallery For Flickr', PGF_TEXT_DOMAIN ),
			'add_new'            => esc_html__( 'Add New Gallery', PGF_TEXT_DOMAIN ),
			'add_new_item'       => esc_html__( 'Add New Gallery', PGF_TEXT_DOMAIN ),
			'edit_item'          => esc_html__( 'Edit Album', PGF_TEXT_DOMAIN ),
			'new_item'           => esc_html__( 'New Photo Gallery', PGF_TEXT_DOMAIN ),
			'view_item'          => esc_html__( 'View Photo Gallery', PGF_TEXT_DOMAIN ),
			'search_items'       => esc_html__( 'Search Photo Gallery', PGF_TEXT_DOMAIN ),
			'not_found'          => esc_html__( 'No Photo Gallery Found', PGF_TEXT_DOMAIN ),
			'not_found_in_trash' => esc_html__( 'No Photo Gallery Found in Trash', PGF_TEXT_DOMAIN ),
			'parent_item_colon'  => esc_html__( 'Parent Album:', PGF_TEXT_DOMAIN ),
			'all_items'          => esc_html__( 'All Photo Galleries', PGF_TEXT_DOMAIN ),
			'menu_name'          => esc_html__( 'Photo Gallery For Flickr', PGF_TEXT_DOMAIN ),
		);

		$args = array(
			'labels'              => $labels,
			'hierarchical'        => false,
			'supports'            => array( 'title', ),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 10,
			'menu_icon'           => 'dashicons-screenoptions',
			'show_in_nav_menus'   => false,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'has_archive'         => true,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => false,
			'capability_type'     => 'post'
		);

		register_post_type( 'fa_gallery', $args );
		add_filter( 'manage_edit-fa_gallery_columns', array( 'WL_PGF_CPT', 'fa_gallery_columns' ) );
		add_action( 'manage_fa_gallery_posts_custom_column', array(
			'WL_PGF_CPT',
			'fa_gallery_manage_columns'
		), 10, 2 );
	}


	public static function fa_gallery_columns( $columns ) {
		$columns = array(
			'cb'        => '<input type="checkbox" />',
			'title'     => esc_html__( 'Album', PGF_TEXT_DOMAIN),
			'shortcode' => esc_html__( 'Photo Gallery For Flickr Shortcode', PGF_TEXT_DOMAIN ),
			'author'    => esc_html__( 'Author', PGF_TEXT_DOMAIN),
			'date'      => esc_html__( 'Date', PGF_TEXT_DOMAIN )
		);

		return $columns;
	}

	public static function fa_gallery_manage_columns( $column, $post_id ) {
		global $post;
		switch ( $column ) {
			case 'shortcode' :
				echo '<input type="text" value="[PGF id=' . $post_id . ']" readonly="readonly" />';
				break;
			default :
				break;
		}
	}
}
?>