<?php
defined( 'ABSPATH' ) or die();

class WL_PGF_Metabox {
	public static function metaboxes() {
		add_meta_box( esc_html__( 'Add Credentials', PGF_TEXT_DOMAIN ), esc_html__( 'Add Credentials', PGF_TEXT_DOMAIN ), array(
			'WL_PGF_Metabox',
			'meta_box_form_function'
		), 'fa_gallery', 'normal', 'low' );
		add_meta_box( esc_html__( 'All Album Settings', PGF_TEXT_DOMAIN ), esc_html__( 'All Album Settings', PGF_TEXT_DOMAIN ), array(
			'WL_PGF_Metabox',
			'settings_metabox_function'
		), 'fa_gallery', 'normal', 'low' );

		add_meta_box( esc_html__( 'Photo Gallery For Flickr Shortcode', PGF_TEXT_DOMAIN ), esc_html__( 'Photo Gallery For Flickr Shortcode', PGF_TEXT_DOMAIN ), array(
			'WL_PGF_Metabox',
			'shortcode_meta_box_form_function'
		), 'fa_gallery', 'side', 'low' );

        add_meta_box( esc_html__( 'FlickrAlbumGalleryPro', PGF_TEXT_DOMAIN ), esc_html__( 'Flickr Album Gallery Pro', PGF_TEXT_DOMAIN ), array(
            'WL_PGF_Metabox',
            'upgrade_to_pro_form_function'
        ), 'fa_gallery', 'side', 'low' );
	}

	public static function meta_box_form_function( $post ) {
		/*code-mirror css & js for custom css section*/
		wp_enqueue_style( 'pgf_codemirror-css', PGF_PLUGIN_URL . '/admin/css/codemirror/codemirror.css' );
		wp_enqueue_style( 'pgf_blackboard', PGF_PLUGIN_URL . '/admin/css/codemirror/blackboard.css' );
		wp_enqueue_style( 'pgf_show-hint-css', PGF_PLUGIN_URL . '/admin/css/codemirror/show-hint.css' );
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script('popper', PGF_PLUGIN_URL . 'assets/js/popper.min.js', array( 'jquery' ));
		wp_enqueue_script( 'pgf_codemirror-js', PGF_PLUGIN_URL . '/admin/css/codemirror/codemirror.js', array( 'jquery' ) );
		wp_enqueue_script( 'pgf_css-js', PGF_PLUGIN_URL . '/admin/css/codemirror/fag-css.js', array( 'jquery' ) );
		wp_enqueue_script( 'pgf_css-hint-js', PGF_PLUGIN_URL . '/admin/css/codemirror/css-hint.js', array( 'jquery' ) );

		wp_enqueue_style( 'bootstrap', PGF_PLUGIN_URL . 'assets/css/bootstrap.min.css' );
		wp_enqueue_script( 'bootstrap', PGF_PLUGIN_URL . 'assets/js/bootstrap.min.js' );

		wp_enqueue_style( 'fag_dashboard-css', PGF_PLUGIN_URL . '/admin/css/dashboard/flick_dashboard.css' );

     	$PGF_Settings = unserialize( get_post_meta( $post->ID, 'fag_settings', true ) );
		/* Default Settings */
		$PGF_API_KEY = isset( $PGF_Settings[0]['fag_api_key'] ) ? $PGF_Settings[0]['fag_api_key'] : "e54499be5aedef32dccbf89df9eaf921";
		$PGF_Album_ID = isset( $PGF_Settings[0]['fag_album_id'] ) ? $PGF_Settings[0]['fag_album_id'] : "72157645975425037";
		?>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery(".prospan").hide();
                jQuery(".prospan_layout").hide();
                var editor = CodeMirror.fromTextArea(document.getElementById("fag_custom_css"), {
                    lineWrapping: true,
                    lineNumbers: true,
                    styleActiveLine: true,
                    matchBrackets: true,
                    hint: true,
                    theme: 'blackboard',
                    extraKeys: {"Ctrl-Space": "autocomplete"},
                });

                jQuery("select.lightbox").change(function(){
                    var selectedlb = jQuery(".lightbox option:selected").val();
                    if(selectedlb=="1"){
                         jQuery(".prospan").show();
                    }else{
                        jQuery(".prospan").hide();
                    }
                });

                jQuery("select.pgf_layout").change(function(){
                    var selectedlayout = jQuery(".pgf_layout option:selected").val();
                    if(selectedlayout=="2"){
                         jQuery(".prospan_layout").show();
                    }else{
                        jQuery(".prospan_layout").hide();
                    }
                });
            });
        </script>

        <div class="flick_maindiv">
            <div class="section-content">
                <h1 class="section-header"><?php esc_html_e( 'Photo Gallery for', PGF_TEXT_DOMAIN ); ?><span class="content-header wow fadeIn " data-wow-delay="0.2s" data-wow-duration="2s"><?php esc_html_e( 'Flickr', PGF_TEXT_DOMAIN ); ?></span></h1>
                <h5><?php esc_html_e( 'Explore Your Gallery', PGF_TEXT_DOMAIN ); ?></h5>
            </div>
            <div class="flickr_api_main">
                <div class="flickr_api row">
                    <label class="col-md-3 flick_lbl"><?php esc_html_e( "Enter Flickr API Key", PGF_TEXT_DOMAIN ); ?></label>
                    <div class="input_control col-md-8">
                        <input class="form-control" required type="text" style="width:50%;" name="fag_api_key"
                               id="fag_api_key" value="<?php echo esc_attr($PGF_API_KEY); ?>">
                        <a class="meta-link" title="Get your flickr account API Key"
                           href="http://weblizar.com/get-flickr-api-key/"
                           target="_blank"><?php esc_html_e( "Get Your API Key", PGF_TEXT_DOMAIN ); ?></a>
                    </div>
                </div>

                <div class="flickr_api row">
                    <label class="col-md-3 flick_lbl"><?php esc_html_e( "Enter Flickr Album ID", PGF_TEXT_DOMAIN ); ?></label>
                    <div class="input_control col-md-8">
                        <input class="form-control" required type="text" style="width:50%;" name="fag_album_id"
                               id="fag_album_id" value="<?php echo esc_attr($PGF_Album_ID); ?>"> 
                               <a class="meta-link" title="Get your flickr photo Album ID" href="http://weblizar.com/get-flickr-album-id/" target="_blank"><?php esc_html_e( "Get Your Album ID", PGF_TEXT_DOMAIN ); ?></a>

                        <p><?php esc_html_e( "Get more Image Sliders, Album Layouts, Hover Animations, Multiple Album Shortcodes. View details", PGF_TEXT_DOMAIN ); ?>
                            <a class="meta-link" href="https://weblizar.com/plugins/flickr-album-gallery-pro/"
                               target="_blank"><?php esc_html_e( "Here", PGF_TEXT_DOMAIN ); ?></a></h5>
                        <h5><strong><?php esc_html_e( "Check Flicker Album Pro Details &", PGF_TEXT_DOMAIN ); ?></strong>
                        <a class="meta-link"  href="http://demo.weblizar.com/flickr-album-gallery-pro/" target="_blank"><?php esc_html_e( "Live Demo", PGF_TEXT_DOMAIN ); ?></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

	<?php }

	/* Default Settings of setting metabox */

	public static function settings_metabox_function( $post ) {

		$PGF_Gallery = unserialize( get_post_meta( $post->ID, 'fag_settings', true ) );

		$PGF_Show_Thumb_Title_Check = isset( $PGF_Gallery[0]['PGF_Show_Thumb_Title_Check'] ) ? $PGF_Gallery[0]['PGF_Show_Thumb_Title_Check'] : "";

		$PGF_Show_Desc_Title_Check = isset( $PGF_Gallery[0]['PGF_Show_Desc_Title_Check'] ) ? $PGF_Gallery[0]['PGF_Show_Desc_Title_Check'] : "";

		$PGF_Gal_Desc_Text = isset( $PGF_Gallery[0]['PGF_Gal_Desc_Text'] ) ? $PGF_Gallery[0]['PGF_Gal_Desc_Text'] : "Welcome in Photo Gallery For Flickr";

		$PGF_Lightbox_Type = isset( $PGF_Gallery[0]['PGF_Lightbox_Type'] ) ? $PGF_Gallery[0]['PGF_Lightbox_Type'] : "photobox";

		$PGF_Show_Title_Check = isset( $PGF_Gallery[0]['fag_show_title'] ) ? $PGF_Gallery[0]['fag_show_title'] : "";

		$PGF_Gallery_Layout = isset( $PGF_Gallery[0]['PGF_Gallery_Layout'] ) ? $PGF_Gallery[0]['PGF_Gallery_Layout'] : "col-md-4";

		$PGF_Thumb_Limit = isset( $PGF_Gallery[0]['PGF_Thumb_Limit'] ) ? $PGF_Gallery[0]['PGF_Thumb_Limit'] : "20";

		$PGF_Custom_CSS = isset( $PGF_Gallery[0]['fag_custom_css'] ) ? $PGF_Gallery[0]['fag_custom_css'] : "";

		?>

        <div class="flickr_maindiv">
            <?php $nonce = wp_create_nonce( 'photo_album_flickr_settings' ); ?>
                <input type="hidden" name="security" value="<?php echo esc_attr( $nonce ); ?>">
            <input id="tab1" type="radio" name="tabs" checked>
            <label for="tab1"><?php esc_html_e( 'Header Settings', PGF_TEXT_DOMAIN ); ?></label>
            <input id="tab2" type="radio" name="tabs">
            <label for="tab2"><?php esc_html_e( 'Album Settings', PGF_TEXT_DOMAIN ); ?></label>

            <section id="content1">
                <tr>
                    <th scope="row"><label class="flick_lbl"><?php esc_html_e( "Album Gallery Title", PGF_TEXT_DOMAIN ); ?></label></th>
                    <td>
                        <label class="switch">
                            <input type="checkbox" name="fag_show_title" id="fag_show_title"
                                   value="yes" <?php if ( $PGF_Show_Title_Check == 'yes' ) {
								echo 'checked';
							} ?>>
                            <span class="slider round"></span>
                        </label>
                    </td>
                </tr>
                <br><br>
                <tr>
                    <th scope="row"><label class="flick_lbl"><?php esc_html_e( "Show Album Description Title", PGF_TEXT_DOMAIN ); ?></label>
                    </th>
                    <td>
                        <label class="switch">
                            <input type="checkbox" name="PGF_Show_Desc_Title_Check" id="PGF_Show_Desc_Title_Check"
                                   value="yes" <?php if ( $PGF_Show_Desc_Title_Check == 'yes' ) {
								echo 'checked';
							} ?>>
                            <span class="slider round"></span>
                        </label>
                    </td>
                </tr>
                <br><br>
                <tr>
                    <th scope="row"><label class="flick_lbl"><?php esc_html_e( "Choose Lightbox for Album", PGF_TEXT_DOMAIN ); ?></label>
                    </th>
                    <td>
                        <select class="lightbox" name="PGF_Lightbox_Type" id="PGF_Lightbox_Type">
                            <optgroup label="Select Gallery Layout">
                                <option value="photobox" <?php if ( $PGF_Lightbox_Type == 'photobox' ) {
									echo "selected=selected";
								} ?>><?php esc_html_e( "Photobox", PGF_TEXT_DOMAIN ); ?></option>
                                <option value="blueimp" <?php if ( $PGF_Lightbox_Type == 'blueimp' ) {
									echo "selected=selected";
								} ?>><?php esc_html_e( "Blueimp", PGF_TEXT_DOMAIN ); ?></option>
                                <option value="1"><?php esc_html_e( 'Nivo Box', PGF_TEXT_DOMAIN ); ?></option>
                                <option value="1"><?php esc_html_e( 'Preety Photo', PGF_TEXT_DOMAIN ); ?></option>
                                <option value="1"><?php esc_html_e( 'Window Box', PGF_TEXT_DOMAIN ); ?></option>
                                <option value="1"><?php esc_html_e( 'Smooth Box', PGF_TEXT_DOMAIN ); ?></option>
                                <option value="1"><?php esc_html_e( 'Swipe Box', PGF_TEXT_DOMAIN ); ?></option>
                                <option value="1"><?php esc_html_e( 'Magnific Box', PGF_TEXT_DOMAIN ); ?></option>
                                <option value="1"><?php esc_html_e( 'Fancy Box', PGF_TEXT_DOMAIN ); ?></option>
                            </optgroup>
                        </select>
                        <span class="prospan"><?php esc_html_e( 'Available In Pro', PGF_TEXT_DOMAIN ); ?></span>
                        <p class="description"><?php esc_html_e( "Choose a column layout for Album", PGF_TEXT_DOMAIN ); ?>.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label class="flick_lbl"><?php esc_html_e( "Album Description Text", PGF_TEXT_DOMAIN ); ?></label></th>
                    <td>
                        <input class="gal-desc-text" type="text" name="PGF_Gal_Desc_Text" id="pgf-gal-desc-text"
                               value="<?php echo esc_attr($PGF_Gal_Desc_Text); ?>">
                    </td>
                </tr>
                <br><br>
            </section>

            <section id="content2">
                <tr>
                    <th scope="row"><label class="flick_lbl"><?php esc_html_e( "Show Thumbnail Title", PGF_TEXT_DOMAIN ); ?></label></th>
                    <td>
                        <label class="switch">
                            <input type="checkbox" name="PGF_Show_Thumb_Title_Check" id="PGF_Show_Thumb_Title_Check"
                                   value="yes" <?php if ( $PGF_Show_Thumb_Title_Check == 'yes' ) {
								echo 'checked';
							} ?>>
                            <span class="slider round"></span>
                        </label>
                    </td>
                </tr>
                <br><br>
                <tr>
                    <th scope="row"><label class="flick_lbl"><?php esc_html_e( "Photo Gallery Layout", PGF_TEXT_DOMAIN ); ?></label></th>
                    <td>
                        <select name="PGF_Gallery_Layout" id="PGF_Gallery_Layout" class="pgf_layout">
                            <optgroup label="Select Gallery Layout">
                                <option value="col-md-6" <?php if ( $PGF_Gallery_Layout == 'col-md-6' ) {
									echo "selected=selected";
								} ?>><?php esc_html_e( "Two Column", PGF_TEXT_DOMAIN ); ?></option>
                                <option value="col-md-4" <?php if ( $PGF_Gallery_Layout == 'col-md-4' ) {
									echo "selected=selected";
								} ?>><?php esc_html_e( "Three Column", PGF_TEXT_DOMAIN ); ?></option>
                                <option value="col-md-3" <?php if ( $PGF_Gallery_Layout == 'col-md-3' ) {
									echo "selected=selected";
								} ?>><?php esc_html_e( "Four Column", PGF_TEXT_DOMAIN ); ?></option>
                                <option value="2"><?php esc_html_e( 'Five Column ', PGF_TEXT_DOMAIN ); ?></option>
                                <option value="2"><?php esc_html_e( 'Six Column', PGF_TEXT_DOMAIN ); ?></option>
                                <option value="2"><?php esc_html_e( 'Eight Column', PGF_TEXT_DOMAIN ); ?></option>
                                <option value="2"><?php esc_html_e( 'Ten Column', PGF_TEXT_DOMAIN ); ?></option>
                            </optgroup>
                        </select>
                        <span class="prospan_layout"><?php esc_html_e( 'Available In Pro', PGF_TEXT_DOMAIN ); ?></span>
                        <p class="description"><?php esc_html_e( "Choose a column layout for Album", PGF_TEXT_DOMAIN ); ?>.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label class="flick_lbl"><?php esc_html_e( "Show Album Thumbnail Limit", PGF_TEXT_DOMAIN ); ?></label>
                    </th>
                    <td>
                        <input required class="thumb_limit_text" type="text" name="PGF_Thumb_Limit" id="PGF_Thumb_Limit"
                               value="<?php echo esc_attr($PGF_Thumb_Limit); ?>">
                        <p class="description"><?php esc_html_e( "Show no. of thumbnails from fetched images, if there are too many fetched images, you can limit theme here. Set a numeric value like: 10, 20, 25, 50, 100", PGF_TEXT_DOMAIN ); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label class="flick_lbl"><?php esc_html_e( "Custom CSS", PGF_TEXT_DOMAIN ); ?></label></th>
                    <td>
                        <textarea class="form-control" name="fag_custom_css" id="fag_custom_css" rows="5"
                                  cols="97"><?php if ( isset( $PGF_Custom_CSS ) ) {
								echo esc_html($PGF_Custom_CSS);
							} else {
								echo esc_html($PGF_Custom_CSS = "");
							} ?></textarea>

                        <p class="custnote"><?php esc_html_e( "Note: Please Do Not Use Style Tag With Custom CSS", PGF_TEXT_DOMAIN ); ?></p>
                    </td>
                </tr>
            </section>
        </div>
		<?php
	}

	public static function shortcode_meta_box_form_function() { ?>
        <p><?php esc_html_e( "Use below shortcode in any Page/Post to publish your Photo Gallery For Flickr", PGF_TEXT_DOMAIN ); ?></p>
        <input readonly type="text" value="<?php echo "[PGF id=" . get_the_ID() . "]"; ?>"> <?php
	}

    public static function upgrade_to_pro_form_function(){
        $imgpath = PGF_PLUGIN_URL."admin/img/flick.jpg";
        ?>
        <div class="">          
            <div class="update_pro_button"><a target="_blank" href="https://weblizar.com/plugins/flickr-album-gallery-pro/"><?php esc_html_e( 'Buy Now $15', PGF_TEXT_DOMAIN ); ?></a></div> 
                <div class="update_pro_image">
                    <img class="csm_getpro img-responsive" src="<?php echo esc_url($imgpath); ?>">
                </div>
            <div class="update_pro_button">
                <a class="upg_anch" target="_blank" href="https://weblizar.com/plugins/flickr-album-gallery-pro/"><?php esc_html_e( 'Buy Now $15', PGF_TEXT_DOMAIN ); ?></a>
            </div>
        </div>
        <?php
    }
}
?>