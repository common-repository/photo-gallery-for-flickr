<?php defined( 'ABSPATH' ) or die(); ?>
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev"> <?php esc_html_e( '‹', PGF_TEXT_DOMAIN ); ?></a>
    <a class="next"> <?php esc_html_e( '›', PGF_TEXT_DOMAIN ); ?></a>
    <a class="close"><?php esc_html_e( '×', PGF_TEXT_DOMAIN ); ?></a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
						<?php esc_html_e( "Previous", PGF_TEXT_DOMAIN ); ?>
                    </button>
                    <button type="button" class="btn btn-primary next">
						<?php esc_html_e( "Next", PGF_TEXT_DOMAIN ); ?>
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(function () {
        jQuery.extend(blueimp.Gallery.prototype.options, {
            useBootstrapModal: false,
            hidePageScrollbars: false,
            /*carousel: true*/
        });
    });

</script>