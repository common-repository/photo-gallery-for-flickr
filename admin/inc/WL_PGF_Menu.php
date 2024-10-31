<?php
defined( 'ABSPATH' ) or die();

class WL_PGF_Menu {
	public static function create_menu() {
		$plugin_details = add_submenu_page('edit.php?post_type=fa_gallery', esc_html__('Plugin Details', PGF_TEXT_DOMAIN), esc_html__('Plugin Details', PGF_TEXT_DOMAIN), 'administrator', 'wl_flickr_plugin_detail', array('WL_PGF_Menu','plugin_details'));

		/* Dashboard submenu */
		add_action( 'admin_print_styles-' . $plugin_details, array( 'WL_PGF_Menu', 'plugin_details_assets' ) );
	}

	 public static function plugin_details(){
		?>
			<div class="row">
				<div class="col-md-12 p-details " style="padding: 25px; ">
					<h1 class="well"><?php esc_html_e( 'Photo Gallery For Flickr', PGF_TEXT_DOMAIN ); ?></h1>
					<h2 style=" color: red" class="well"><?php esc_html_e( 'Create a New Flickr Photo Gallery', PGF_TEXT_DOMAIN ); ?></h2>
					<ol>
					  <li><?php esc_html_e( 'Click on Add New Gallery link into Flickr Photo Gallery plugin menu.', PGF_TEXT_DOMAIN ); ?></li>
					  <li><?php esc_html_e( 'Provide a Title to the album gallery.', PGF_TEXT_DOMAIN ); ?></li>
					  <li><?php esc_html_e( 'Enter your Flickr Account API Key, you can get your a key through “Get Your API Key” link.', PGF_TEXT_DOMAIN ); ?></li>
					  <li><?php esc_html_e( 'Now enter your Flickr Album ID which you want to display in this album gallery, you can also get your Flickr Album ID through “Get Your Album ID” link.', PGF_TEXT_DOMAIN ); ?></li>
					  <li><?php esc_html_e( 'Click on Publish button to  publish your Flickr Photo Gallery.', PGF_TEXT_DOMAIN ); ?></li>
					  <li><?php esc_html_e( 'Copy shorcode [PGF id=xxxx], this will be use later to display your Flickr Photo Gallery in any Page / Post.', PGF_TEXT_DOMAIN ); ?></li>
					</ol>
					<h3  style=" color: red" class="well"><?php esc_html_e( 'Publish Flickr Photo Gallery In Page', PGF_TEXT_DOMAIN ); ?></h3>
					<ol>
					  <li><?php esc_html_e( 'Click on ADD New link into Pages menu.', PGF_TEXT_DOMAIN ); ?></li>
					  <li><?php esc_html_e( 'Page the copied shortcode [PGF id=xxxx] into page content editor.', PGF_TEXT_DOMAIN ); ?></li>
					  <li><?php esc_html_e( 'This step is optional and depend on your theme. If your theme allows you to select available template like Default, Full Width etc then you can use desired template for your gallery.', PGF_TEXT_DOMAIN ); ?></li>
					  <li><?php esc_html_e( 'Click on Publish button to display your Flickr Photo Gallery on created page.', PGF_TEXT_DOMAIN ); ?></li>
					  <li><?php esc_html_e( 'Now check created Flickr Album Gallery Preview through View Page button below title.', PGF_TEXT_DOMAIN ); ?></li>
					</ol>
					<h3 style=" color: red" class="well"><?php esc_html_e( 'Flickr Photo Gallery Settings', PGF_TEXT_DOMAIN ); ?></h3>
					<ol>
					  <li><?php esc_html_e( 'Album Gallery Title : Through this setting you can show/hide the Flickr Photo Gallery Title on published page / post.', PGF_TEXT_DOMAIN ); ?></li>
					  <li><?php esc_html_e( 'Choose Lightbox for Album : This setting allow to select different 8 types of light box for individual gallery.  Each light box has different style to display and represent your album photos.', PGF_TEXT_DOMAIN ); ?></li>
					  <li><?php esc_html_e( 'Photo Gallery Layout : This setting allow to set 6 types of gallery layout. If you have large number of photos in your Flickr Album use max column layout in gallery.', PGF_TEXT_DOMAIN ); ?></li>
					  <li><?php esc_html_e( 'Show Album Thumbnail Limit : If your album has large number of image then you can limit no of loading images using this settings.', PGF_TEXT_DOMAIN ); ?></li>
					</ol>
				</div>
			</div>
		<?php
	}

	public static function plugin_details_assets() {
		// wp_enqueue_style( 'bootstrap', PGF_PLUGIN_URL . 'assets/css/bootstrap.min.css' );
	}
}
?>
