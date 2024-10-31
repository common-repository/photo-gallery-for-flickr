<?php
defined( 'ABSPATH' ) or die();

/* Adds widget */
class Photo_gallery_for_flickr extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'pgf_gallery', // Base ID
			' Photo Gallery For Flickr ', // Name
			array( 'description' => esc_html__( 'Display Photo Gallery For Flickr', PGF_TEXT_DOMAIN ) )// Args
		);
	}

	public function widget( $args, $instance ) {
		$Title = apply_filters( 'flickr_widget_title', $instance['Title'] );
		echo wp_kses_post($args['before_widget']);

		$FID = apply_filters( 'flickr_widget_shortcode', $instance['Shortcode'] );

		if ( is_numeric( $FID ) ) {
			if ( ! empty( $instance['Title'] ) ) {
				echo wp_kses_post($args['before_title'] . apply_filters( 'widget_title', $instance['Title'] ) . $args['after_title']);
			}
			echo do_shortcode( '[PGF id=' . $FID . ']' );
		} else {
			 echo "<p>";
			 esc_html_e( 'Sorry! No Photo Gallery For Flickr Shortcode Found.', PGF_TEXT_DOMAIN );
			 echo "</p>";
		}
		echo wp_kses_post($args['after_widget']);
		wp_reset_query();
	}


	public function form( $instance ) {

		if ( isset( $instance['Title'] ) ) {
			$Title = $instance['Title'];
		} else {
			$Title = "Photo Gallery For Flickr";
		}

		if ( isset( $instance['Shortcode'] ) ) {
			$Shortcode = $instance['Shortcode'];
		} else {
			$Shortcode = "Select Any Photo Gallery For Flickr";
		}
		?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'Title' )); ?>"><?php esc_html_e( 'Widget Title', PGF_TEXT_DOMAIN ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'Title' )); ?>"
                   name="<?php echo esc_attr($this->get_field_name( 'Title' )); ?>" type="text"
                   value="<?php echo esc_attr( $Title ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'Shortcode' )); ?>"><?php esc_html_e( 'Select Any', PGF_TEXT_DOMAIN ); ?>
                <?php esc_html_e( '(Required)', PGF_TEXT_DOMAIN ); ?></label>
			<?php
			/**
			 * Get All Flickr Shortcode Custom Post Type
			 */
			$FLICKR_CPT_Name  = "fa_gallery";
			$FLICKR_All_Posts = wp_count_posts( $FLICKR_CPT_Name )->publish;
			global $All_Flickr;
			$All_Flickr = array( 'post_type'      => $FLICKR_CPT_Name,
			                     'orderby'        => 'ASC',
			                     'posts_per_page' => $FLICKR_All_Posts
			);
			$All_Flickr = new WP_Query( $All_Flickr );
			?>
            <select id="<?php echo esc_attr($this->get_field_id( 'Shortcode' )); ?>"
                    name="<?php echo esc_attr($this->get_field_name( 'Shortcode' )); ?>" style="width: 100%;">
                <option value="Select Any Settings" <?php if ( $Shortcode == "Select Any Gallery" ) {
					echo 'selected="selected"';
				} ?>><?php esc_html_e( 'Select Any Gallery', PGF_TEXT_DOMAIN ); ?>
                </option>
				<?php
				if ( $All_Flickr->have_posts() ) { ?>
					<?php while ( $All_Flickr->have_posts() ) : $All_Flickr->the_post();
						$PostId    = get_the_ID();
						$PostTitle = get_the_title( $PostId );
						?>
                        <option value="<?php echo esc_attr($PostId); ?>" <?php if ( $Shortcode == $PostId ) {
							echo 'selected="selected"';
						} ?>><?php if ( $PostTitle ) {
								echo esc_html($PostTitle);
							} else {
								esc_html_e( "No Title", PGF_TEXT_DOMAIN );
							} ?></option>
					<?php endwhile; ?>
					<?php
				} else {
					 echo "<option>" . esc_html__( 'Sorry! No Photo Gallery For Flickr Shortcode Found.', PGF_TEXT_DOMAIN ) . "</option>";
				}
				?>
            </select>
        </p>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance              = array();
		$instance['Title']     = ( ! empty( $new_instance['Title'] ) ) ? strip_tags( $new_instance['Title'] ) : '';
		$instance['Shortcode'] = ( ! empty( $new_instance['Shortcode'] ) ) ? strip_tags( $new_instance['Shortcode'] ) : 'Select Any Photo Gallery For Flickr';

		return $instance;
	}
}
?>