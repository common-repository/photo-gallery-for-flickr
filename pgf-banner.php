<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wp_enqueue_style( 'respport-banner', PGF_PLUGIN_URL . 'assets/css/pgf-banner.css' );
$pgf_imgpath = PGF_PLUGIN_URL . "assets/img/pgf_pro_banner.png";
?>
<div class="wb_plugin_feature notice  is-dismissible">
    <div class="wb_plugin_feature_banner default_pattern pattern_ ">
        <div class="wb-col-md-6 wb-col-sm-12 box">
            <div class="ribbon"><span><?php esc_html_e( 'Go Pro', PGF_TEXT_DOMAIN ); ?></span></div>
            <img class="wp-img-responsive" src="<?php echo esc_url($pgf_imgpath); ?>" alt="img">
        </div>
        <div class="wb-col-md-6 wb-col-sm-12 wb_banner_featurs-list">
            <span class="gp_banner_head"><h2><?php esc_html_e( 'Flickr Album Gallery Pro Features', PGF_TEXT_DOMAIN ); ?> </h2></span>
            <ul>
                <li><?php esc_html_e( 'Responsive Design Layout', PGF_TEXT_DOMAIN ); ?></li>
                <li><?php esc_html_e( '8 Types of Animation Effect ', PGF_TEXT_DOMAIN ); ?></li>
                <li><?php esc_html_e( '6 Types of Gallery design layout', PGF_TEXT_DOMAIN ); ?></li>
                <li><?php esc_html_e( 'Use Flickr Gallery Shortcodes', PGF_TEXT_DOMAIN ); ?></li>
                <li><?php esc_html_e( 'Use Flickr Gallery Widget', PGF_TEXT_DOMAIN ); ?></li>
                <li><?php esc_html_e( '8 Types Of Light Box Sliders ', PGF_TEXT_DOMAIN ); ?></li>
                <li><?php esc_html_e( '500+ Google Fonts Style', PGF_TEXT_DOMAIN ); ?></li>
                <li><?php esc_html_e( 'Unlimited Colors Scheme With Opacity Effects', PGF_TEXT_DOMAIN ); ?></li>
                <li><?php esc_html_e( 'Admin Dashboard for Gallery Creation & Settings', PGF_TEXT_DOMAIN ); ?></li>
            </ul>
            <br><br><br><br>
            <div class="wp_btn-grup mt-5">
                <a class="wb_button-primary" href="http://demo.weblizar.com/flickr-album-gallery-pro/"
                   target="_blank"><?php esc_html_e( 'View Demo', PGF_TEXT_DOMAIN ); ?></a>
                <a class="wb_button-primary" href="https://weblizar.com/plugins/flickr-album-gallery-pro/"
                   target="_blank"><?php esc_html_e( ' Buy Now ', PGF_TEXT_DOMAIN ); ?> <?php esc_html_e( ' $10 ', PGF_TEXT_DOMAIN ); ?></a>
            </div>
        </div>
    </div>
</div>