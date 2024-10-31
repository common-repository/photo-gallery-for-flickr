<?php
defined( 'ABSPATH' ) or die();

class WL_PGF_Shortcode {

	public static function shortcode( $Id ) {

		ob_start();

		wp_enqueue_script( 'jquery' );
        wp_enqueue_script('popper', PGF_PLUGIN_URL . 'assets/js/popper.min.js', array( 'jquery' ));
		wp_enqueue_script( 'bootstrap', PGF_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'pgf-imagesloaded-pkgd-min-js', PGF_PLUGIN_URL . 'assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ), false, true );

		wp_enqueue_style( 'pgf-frontend', PGF_PLUGIN_URL . 'assets/css/frontend.css' );
		wp_enqueue_style( 'pgf-bootstrap-min-css', PGF_PLUGIN_URL . 'assets/css/bootstrap.min.css' );

		wp_enqueue_style( 'font-awesome-5', PGF_PLUGIN_URL . 'assets/css/all.min.css' );

        wp_enqueue_style( 'pgf-blueimp-gallery-min-css', PGF_PLUGIN_URL . 'assets/css/blueimp-gallery.min.css' );
        wp_enqueue_script( 'pgf-jquery-blueimp-gallery-min-js', PGF_PLUGIN_URL . 'assets/js/jquery.blueimp-gallery.min.js', array( 'jquery' ), false, true );

        wp_enqueue_style( 'pgf-photobox-css', PGF_PLUGIN_URL . 'assets/lightbox/photobox/photobox.css' );
		wp_enqueue_script( 'pgf-photobox-js', PGF_PLUGIN_URL . 'assets/lightbox/photobox/jquery.photobox.js', array( 'jquery' ) );

		if ( isset( $Id['id'] ) ) {

			/* Load All Photo Gallery For Flickr Custom Post Type  */
			$PGF_CPT_Name = "fa_gallery";
			$AllGalleries = array(
				'p'          => $Id['id'],
				'post_type'  => $PGF_CPT_Name,
				'orderby'    => 'ASC',
				'post_staus' => 'publish'
			);
			$loop         = new WP_Query( $AllGalleries );

			while ( $loop->have_posts() ) : $loop->the_post();
				/* Get All Photo Gallery For Flickr Details Post Meta */
				$ID = get_the_ID();

				$PGF_Galleries = unserialize( get_post_meta( $ID, 'fag_settings', true ) );

				if ( is_array( $PGF_Galleries ) ) {
					foreach ( $PGF_Galleries as $PGF_Gallery ) {

						if(isset($PGF_Gallery['fag_api_key'])){
                            $PGF_API_KEY       = $PGF_Gallery['fag_api_key'];
                        }else{
                            $PGF_API_KEY       = "e54499be5aedef32dccbf89df9eaf921";
                        }

                        if(isset($PGF_Gallery['fag_album_id'])){
                            $PGF_Album_ID       = $PGF_Gallery['fag_album_id'];
                        }else{
                            $PGF_Album_ID       = "72157645975425037";
                        }

                        if(isset($PGF_Gallery['fag_show_title'])){
                            $PGF_Show_Title_Check       = $PGF_Gallery['fag_show_title'];
                        }else{
                            $PGF_Show_Title_Check       = "";
                        }

                        if(isset($PGF_Gallery['PGF_Lightbox_Type'])){
                            $PGF_Lightbox_Type       = $PGF_Gallery['PGF_Lightbox_Type'];
                        }else{
                            $PGF_Lightbox_Type       = "photobox";
                        }

                        if(isset($PGF_Gallery['PGF_Show_Desc_Title_Check'])){
                            $PGF_Show_Desc_Title_Check       = $PGF_Gallery['PGF_Show_Desc_Title_Check'];
                        }else{
                            $PGF_Show_Desc_Title_Check       = "";
                        }

                        if(isset($PGF_Gallery['PGF_Gal_Desc_Text'])){
                            $PGF_Gal_Desc_Text       = $PGF_Gallery['PGF_Gal_Desc_Text'];
                        }else{
                            $PGF_Gal_Desc_Text       = "Welcome in Photo Gallery For Flickr";
                        }

                        if(isset($PGF_Gallery['PGF_Show_Thumb_Title_Check'])){
                            $PGF_Show_Thumb_Title_Check       = $PGF_Gallery['PGF_Show_Thumb_Title_Check'];
                        }else{
                            $PGF_Show_Thumb_Title_Check       = "";
                        }

                        if(isset($PGF_Gallery['PGF_Gallery_Layout'])){
                            $PGF_Gallery_Layout       = $PGF_Gallery['PGF_Gallery_Layout'];
                        }else{
                            $PGF_Gallery_Layout       = "col-md-4";
                        }

                        if(isset($PGF_Gallery['PGF_Thumb_Limit'])){
                            $PGF_Thumb_Limit       = $PGF_Gallery['PGF_Thumb_Limit'];
                        }else{
                            $PGF_Thumb_Limit       = "20";
                        }

                        if(isset($PGF_Gallery['fag_custom_css'])){
                            $PGF_Custom_CSS       = $PGF_Gallery['fag_custom_css'];
                        }else{
                            $PGF_Custom_CSS       = "";
                        }

                        ?>
                        <style>
                            .LoadingImg img {
                                max-width: 150px;
                                max-height: 150px;
                                box-shadow: none;
								margin-left:40%;
                            }

                            .gallery<?php echo esc_attr($ID); ?> {
                                overflow: hidden;
                                clear: both;
                            }

                            #pgf_<?php echo esc_attr($ID); ?> .hidepics {
                                display: none !important;
                            }

                            <?php echo esc_attr($PGF_Custom_CSS); ?>
                        </style>

                        <script type="text/javascript">
                            jQuery(function () {
                               jQuery('.gallery<?php echo esc_attr($ID); ?>').flickr<?php echo esc_attr($ID); ?>({
                                    apiKey: '<?php echo esc_attr($PGF_API_KEY); ?>',
                                    photosetId: '<?php echo esc_attr($PGF_Album_ID); ?>',
                                    photosLimit: <?php echo esc_attr($PGF_Thumb_Limit); ?>
                                });
                            });
                            /*
							* jQuery Flickr Photoset
							* https://github.com/hadalin/jquery-flickr-photoset
							*/

                            ;(function (jQuery, window, document, undefined) {
                                var fcount = 1;
                                'use strict';

                                var pluginName = "flickr<?php echo esc_attr($ID); ?>",
                                    defaults = {
                                        apiKey: "",
                                        photosetId: "",
                                        errorText: "<div class='fnf'><i class='far fa-times-circle'></i> Error generating gallery.</div>"
                                    },
                                    apiUrl = 'https://api.flickr.com/services/rest/',
                                    photos = [];

                                // The actual plugin constructor
                                function Plugin(element, options) {
                                    this.element = jQuery(element);
                                    this.settings = jQuery.extend({}, defaults, options);
                                    this._defaults = defaults;
                                    this._name = pluginName;

                                    this._hideSpinner = function () {
                                        this.element.find('.spinner-wrapper').hide().find('*').hide();
                                    };

                                    this._printError = function () {
                                        this.element.find('.gallery-container').append(jQuery("<div></div>", {"class": "col-lg-12 col-lg-offset-1"})
                                            .append(jQuery("<div></div>", {"class": "error-wrapper"})
                                                .append(jQuery("<span></span>", {"class": "label label-danger error"})
                                                    .html(this.settings.errorText))));
                                    };

                                    this._flickrAnimate = function () {
                                        this.element.find('.gallery-container img').each(jQuery.proxy(function (index, el) {
                                            var image = el;
                                            setTimeout(function () {
                                                jQuery(image).parent().fadeIn();
                                            }, this.settings.loadingSpeed * index);
                                        }, this));
                                    };

                                    this._printGallery = function (photos) {
                                        var element = this.element.find('.gallery-container');


                                        jQuery.each(photos, function (key, photo) {
                                            var flick_str = photo.title;
                                            var flick_title = flick_str.substr(0, 15);
                                            var img = jQuery('<img>', {
                                                'class': 'thumb img-thumbnail gall-img-responsive',
                                                src: photo.href,
                                            });
                                            element.append(jQuery('<div></div>', {'class': 'grid <?php echo esc_attr($PGF_Gallery_Layout); ?>'})
                                                .append(jQuery('<a></a>', {
                                                    'class': 'grid-item',
                                                    title: photo.title,
                                                    href: photo.href,
                                                    'data-gallery': ''
                                                }).hide().append(jQuery('<span><i class="fab fa-flickr fa-2x"> </i></span>'))
                                                    .append(img))<?php if($PGF_Show_Thumb_Title_Check == "yes"){?>.append(jQuery('<span id="pgfspan">' + flick_title + '</span>'))<?php } ?>);
                                        });

                                        element.imagesLoaded()
                                            .done(jQuery.proxy(this._flickrAnimate, this))
                                            .always(jQuery.proxy(this._hideSpinner, this));
                                    };

                                    this._flickrPhotoset = function (photoset) {
                                        var _this = this;
                                        var hidemeval = "";
                                        photos[photoset.id] = [];
                                        jQuery.each(photoset.photo, function (key, photo) {

                                            if (key > <?php echo esc_attr($PGF_Thumb_Limit - 1); ?>) {
                                                hidemeval = "hidepics";
                                            }

                                            // Limit number of photos.
                                            if (key >= _this.settings.photosLimit) {
                                                return false;
                                            }

                                            photos[photoset.id][key] = {
                                                thumbnail: 'https://farm' + photo.farm + '.static.flickr.com/' + photo.server + '/' + photo.id + '_' + photo.secret + '_q.jpg',
                                                href: 'https://farm' + photo.farm + '.static.flickr.com/' + photo.server + '/' + photo.id + '_' + photo.secret + '_b.jpg',
                                                title: photo.title,
                                                hideme: hidemeval
                                            };
                                        });

                                        this._printGallery(photos[photoset.id]);
                                    };

                                    this._onFlickrResponse = function (response) {
                                        if (response.stat === "ok") {
                                            this._flickrPhotoset(response.photoset);
                                        }
                                        else {
                                            this._hideSpinner();
                                            this._printError();
                                        }
                                    };

                                    this._flickrRequest = function (method, data) {
                                        var url = apiUrl + "?format=json&jsoncallback=?&method=" + method + "&api_key=" + this.settings.apiKey;

                                        jQuery.each(data, function (key, value) {
                                            url += "&" + key + "=" + value;
                                        });

                                        jQuery.ajax({
                                            dataType: "json",
                                            url: url,
                                            context: this,
                                            success: this._onFlickrResponse
                                        });
                                    };

                                    this._flickrInit = function () {
                                        this._flickrRequest('flickr.photosets.getPhotos', {
                                            photoset_id: this.settings.photosetId
                                        });
                                    };

                                    // Init
                                    this.init();
                                }

                                Plugin.prototype = {
                                    init: function () {
                                        this._flickrInit();
                                    }
                                };

                                // Wrapper
                                jQuery.fn[pluginName] = function (options) {
                                    this.each(function () {
                                        if (!jQuery.data(this, "plugin_" + pluginName)) {
                                            jQuery.data(this, "plugin_" + pluginName, new Plugin(this, options));
                                        }
                                    });

                                    // Chain
                                    return this;
                                };
                            })(jQuery, window, document);
                        </script>

                        <div class="gallery<?php echo esc_attr($ID); ?>">
                            <!-- Gallery Thumbnails -->
							<?php if ( $PGF_Show_Title_Check == "yes" ) { ?>
                                <div class="w3-container w3-center w3-animate-left">
                                    <h1 id="<?php if ( $PGF_Show_Desc_Title_Check != "yes" ) {
										echo "hrline_desc";
									} ?>"><?php echo ucwords( get_the_title( $ID ) ); ?></h1>
									<?php if ( $PGF_Show_Desc_Title_Check == "yes" ) { ?>
                                        <p id="hrline_desc"><?php echo esc_html($PGF_Gal_Desc_Text); ?></p>
									<?php } ?>
                                </div>

							<?php } ?>
                            <div class="row">
                                <div class="col-xs-12 spinner-wrapper">
                                    <div class="LoadingImg">
                                        <img src="<?php echo PGF_PLUGIN_URL . "/assets/img/loading.gif"; ?>"/>
                                    </div>
                                </div>
                                <div align="center" class="row gallery-container <?php echo "photobox-lightbox_$ID"; ?>"></div>
                            </div>
                        </div>
						<?php
					}// end of foreach
				}//end of is_array
			endwhile; ?>

			<?php if ( $PGF_Lightbox_Type == "photobox" ) {
				?>
                <!-- Photo box LightBox-->
                <script>
                    jQuery(document).ready(function () {
                        jQuery('.photobox-lightbox_<?php echo esc_attr($ID); ?>').photobox('a');
                        // or with a fancier selector and some settings, and a callback:
                        jQuery('.photobox-lightbox_<?php echo esc_attr($ID); ?>').photobox('a:first', {
                            thumbs: false,
                            time: 0
                        }, imageLoaded);

                        function imageLoaded() {
                            console.log('image has been loaded...');
                        }
                    });
                </script>
				<?php
			} else {
				/*Blueimp LightBox*/
				include( 'WL_PGF_Blueimp.php' );
			} ?>

            <div align="center" style="font-size: small; margin-bottom:20px; margin-top:25px; width:100%; float: left;">
                <?php esc_html_e( 'Photo Gallery For Flickr Powered By:', PGF_TEXT_DOMAIN ); ?> <a href="http://www.weblizar.com/" target="_blank"><?php esc_html_e( 'Weblizar', PGF_TEXT_DOMAIN ); ?></a>
            </div>
			<?php
		} else {
			echo "<div align='center' class='alert alert-danger'>" . esc_html__( "Sorry! Invalid Flickr Photo Shortcode Embedded", PGF_TEXT_DOMAIN ) . "</div>";
		}
		wp_reset_query();

		return ob_get_clean();
	}
}
?>
