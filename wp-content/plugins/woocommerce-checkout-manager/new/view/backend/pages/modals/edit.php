<div class="media-modal-backdrop">&nbsp;</div>
<div tabindex="0" id="<?php echo esc_attr(WOOCCM_PREFIX . '_modal'); ?>" class="media-modal wp-core-ui upload-php" role="dialog" aria-modal="true" aria-labelledby="media-frame-title">
  <div class="media-modal-content" role="document">
    <form class="media-modal-form" method="POST">
      <div class="edit-attachment-frame mode-select hide-menu hide-router">
        <div class="edit-media-header">
          <# if ( data.id != undefined ) { #>
          <button type="button" class="media-modal-prev left dashicons <# if ( data.id <= 0 ) { #>disabled<# } #>"><span class="screen-reader-text"><?php esc_html_e('Edit previous media item'); ?></span></button>
          <button type="button" class="media-modal-next right dashicons <# if ( data.id >= <?php echo esc_attr(count($fields)) - 1 ?>) { #>disabled<# } #>"><span class="screen-reader-text"><?php esc_html_e('Edit next media item'); ?></span></button>
          <# } #>
          <button type="button" class="media-modal-close"><span class="media-modal-icon"><span class="screen-reader-text"><?php esc_html_e('Close dialog'); ?></span></span></button>
        </div>
        <div class="media-frame-title">
          <h1><?php esc_html_e('Edit field', 'woocommerce-checkout-manager'); ?> #<# if ( data.id != undefined ) { #>{{data.id}}<# } else { #><?php echo esc_html_e('New', 'woocommerce-checkout-manager'); ?><# } #></h1>
        </div>
        <div class="media-frame-content" style="bottom:61px;">
          <div class="attachment-details">
            <div class="attachment-media-view landscape" style="overflow: hidden;">
              <div id="woocommerce-product-data">
                <div class="panel-wrap product_data" style="overflow:visible;">
                  <?php include_once('parts/edit-tabs.php'); ?>
                  <?php include_once('parts/panel-general.php'); ?>
                  <?php include_once('parts/panel-display.php'); ?>
                  <?php //include_once('parts/panel-conditional.php'); ?>
                  <?php //include_once('parts/panel-amount.php'); ?>
                  <?php //include_once('parts/panel-datepicker.php'); ?>
                  <?php //include_once('parts/panel-timepicker.php'); ?>
                  <?php //include_once('parts/panel-advanced.php'); ?>
                  <?php //include_once('parts/panel-suggestions.php'); ?>            
                  <div class="clear"></div>
                </div>
              </div>
            </div>
            <div class="attachment-info">
              <?php include_once('parts/edit-info.php'); ?>
            </div>
          </div>
        </div>
        <div class="media-frame-toolbar" style="left:0;">
          <div class="media-toolbar">
            <div class="media-toolbar-secondary"></div>
            <div class="media-toolbar-primary search-form">
              <button type="submit" class="media-modal-save button button-primary media-button button-large"><?php esc_html_e('Save'); ?></button>
              <button type="button" class="media-modal-close button button-secondary media-button button-large" style="
                      float: none;
                      position: inherit;
                      padding: inherit;
                      "><?php esc_html_e('Close'); ?></button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>