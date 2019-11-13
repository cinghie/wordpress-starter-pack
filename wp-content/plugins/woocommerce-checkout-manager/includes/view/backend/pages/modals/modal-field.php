<div class="media-modal-backdrop">&nbsp;</div>
<div tabindex="0" id="<?php echo esc_attr(WOOCCM_PREFIX . '_modal'); ?>" class="media-modal wp-core-ui upload-php" role="dialog" aria-modal="true" aria-labelledby="media-frame-title">
  <div class="media-modal-content" role="document">
    <form class="media-modal-form" method="POST">
      <# if ( data.id != undefined ) { #>
      <input type="hidden" name="id" value="{{data.id}}" />
      <input type="hidden" name="order" value="{{data.order}}" />
      <# } #>
      <div class="edit-attachment-frame mode-select hide-menu hide-router">
        <div class="edit-media-header">
          <# if ( data.id != undefined ) { #>
          <button type="button" class="media-modal-prev left dashicons <# if ( data.order == 1 ) { #>disabled<# } #>"><span class="screen-reader-text"><?php esc_html_e('Edit previous media item'); ?></span></button>
          <button type="button" class="media-modal-next right dashicons <# if ( data.order == <?php echo esc_attr(count($fields)); ?> ) { #>disabled<# } #>"><span class="screen-reader-text"><?php esc_html_e('Edit next media item'); ?></span></button>     <# } #>
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
                  <?php include_once( 'parts/field-tabs.php' ); ?>
                  <?php include_once( 'parts/panel-general.php' ); ?>
                  <# if ( _.contains(<?php echo json_encode(array('select', 'multiselect')); ?>, data.type)) { #>
                  <?php include_once( 'parts/panel-select2.php' ); ?>
                  <# } #>
                  <# if ( _.contains(<?php echo json_encode($option); ?>, data.type)) { #>
                  <?php include_once( 'parts/panel-options.php' ); ?>
                  <# } #>
                  <?php include_once( 'parts/panel-display.php' ); ?>
                  <# if ( !_.contains(<?php echo json_encode(array_merge($option, $template)); ?>, data.type)) { #>
                  <?php include_once( 'parts/panel-price.php' ); ?>
                  <# } #>
                  <# if (data.type == 'date') { #>
                  <?php include_once( 'parts/panel-datepicker.php' ); ?>
                  <# } #>
                  <# if (data.type == 'time') { #>
                  <?php include_once( 'parts/panel-timepicker.php' ); ?>
                  <# } #>
                  <?php include_once('parts/panel-admin.php' ); ?>        
                  <div class="clear"></div>
                </div>
              </div>
            </div>
            <div class="attachment-info">
              <?php include_once('parts/field-info.php'); ?>
            </div>
          </div>
        </div>
        <div class="media-frame-toolbar" style="left:0;">
          <div class="media-toolbar">
            <div class="media-toolbar-secondary"></div>
            <div class="media-toolbar-primary search-form">
              <button type="submit" class="media-modal-submit button button-primary media-button button-large" disabled="disabled"><?php esc_html_e('Save'); ?></button>
              <button type="button" class="media-modal-close button button-secondary media-button button-large" style="
                      height: auto;
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