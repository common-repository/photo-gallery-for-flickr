<?php
defined( 'ABSPATH' ) or die();

class WL_PGF_SaveMetabox {
	/* Save Metaboxes Data */
	public static function savemetabox( $PostID ) {

		if ( isset( $_POST['fag_api_key'] ) && isset( $_POST['fag_album_id'] ) && isset($_POST['security']) ) {
			if ( ! wp_verify_nonce( $_POST['security'], 'photo_album_flickr_settings' ) ) {
		die();}	
			$PGF_API_KEY                = isset( $_POST['fag_api_key'] ) ? sanitize_text_field( $_POST['fag_api_key'] ) : '';
			$PGF_Album_ID               = isset( $_POST['fag_album_id'] ) ? sanitize_text_field( $_POST['fag_album_id'] ) : '';
			$PGF_Show_Title_Check       = isset( $_POST['fag_show_title'] ) ? sanitize_text_field( $_POST['fag_show_title'] ) : '';
			$PGF_Lightbox_Type          = isset( $_POST['PGF_Lightbox_Type'] ) ? sanitize_text_field( $_POST['PGF_Lightbox_Type'] ) : '';
			$PGF_Show_Desc_Title_Check  = isset( $_POST['PGF_Show_Desc_Title_Check'] ) ? sanitize_text_field( $_POST['PGF_Show_Desc_Title_Check'] ) : '';
			$PGF_Gal_Desc_Text          = isset( $_POST['PGF_Gal_Desc_Text'] ) ? sanitize_text_field( $_POST['PGF_Gal_Desc_Text'] ) : '';
			$PGF_Show_Thumb_Title_Check = isset( $_POST['PGF_Show_Thumb_Title_Check'] ) ? sanitize_text_field( $_POST['PGF_Show_Thumb_Title_Check'] ) : '';
			$PGF_Gallery_Layout         = isset( $_POST['PGF_Gallery_Layout'] ) ? sanitize_text_field( $_POST['PGF_Gallery_Layout'] ) : '';                         
			$PGF_Thumb_Limit            = isset( $_POST['PGF_Thumb_Limit'] ) ? sanitize_text_field( $_POST['PGF_Thumb_Limit'] ) : '';
			$PGF_Custom_CSS             = isset( $_POST['fag_custom_css'] ) ? sanitize_text_field( $_POST['fag_custom_css'] ) : '';

			$PGFArray[] = array(
				'fag_api_key'                => $PGF_API_KEY,
				'fag_album_id'               => $PGF_Album_ID,
				'fag_show_title'       		 => $PGF_Show_Title_Check,
				'PGF_Lightbox_Type'          => $PGF_Lightbox_Type,
				'PGF_Show_Desc_Title_Check'  => $PGF_Show_Desc_Title_Check,
				'PGF_Gal_Desc_Text'          => $PGF_Gal_Desc_Text,
				'PGF_Show_Thumb_Title_Check' => $PGF_Show_Thumb_Title_Check,
				'PGF_Gallery_Layout'         => $PGF_Gallery_Layout,
				'PGF_Thumb_Limit'            => $PGF_Thumb_Limit,
				'fag_custom_css'             => $PGF_Custom_CSS,

			);
			update_post_meta( $PostID, 'fag_settings', serialize( $PGFArray ) );
		}
	}
}
?>