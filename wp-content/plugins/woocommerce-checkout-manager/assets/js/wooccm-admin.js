(function ($) {

// Toggle gateway on/off.
  $('.wooccm_billing_fields').on('click', '.wooccm-field-toggle-enabled', function () {
    
    var $link = $(this),
            $row = $link.closest('tr'),
            $toggle = $link.find('.woocommerce-input-toggle');
            
    var data = {
      action: 'wooccm_toggle_field_enabled',
      nonce: wooccm.nonce,
      field_id: $row.data('field_id')
    };
    
    $toggle.addClass('woocommerce-input-toggle--loading');
    
    $.ajax({
      url: woocommerce_admin.ajax_url,
      data: data,
      dataType: 'json',
      type: 'POST',
      success: function (response) {
        
        if (true === response.data) {
          $toggle.removeClass('woocommerce-input-toggle--enabled, woocommerce-input-toggle--disabled');
          $toggle.addClass('woocommerce-input-toggle--enabled');
          $toggle.removeClass('woocommerce-input-toggle--loading');
        } else if (true !== response.data) {
          $toggle.removeClass('woocommerce-input-toggle--enabled, woocommerce-input-toggle--disabled');
          $toggle.addClass('woocommerce-input-toggle--disabled');
          $toggle.removeClass('woocommerce-input-toggle--loading');
        } //else if ('needs_setup' === response.data) {
        //window.location.href = $link.attr('href');
        //}
      }
    });
    return false;
  });
})(jQuery);