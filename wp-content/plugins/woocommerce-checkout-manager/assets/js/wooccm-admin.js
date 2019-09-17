(function ($) {

  /* Toggle gateway on/off.
   $('#wooccm_billing_settings_add').on('click', function () {
   
   var $button = $(this),
   $table = $('table#wooccm_billing_fields'),
   $tr = $table.find('tbody > tr'),
   $new = $tr.last().clone();
   
   // $table.find('tbody').append($new);
   
   var data = {
   action: 'wooccm_add_field',
   nonce: wooccm.nonce,
   //field_id: $tr.data('field_id')
   };
   
   $.ajax({
   url: woocommerce_admin.ajax_url,
   data: data,
   dataType: 'json',
   type: 'POST',
   success: function (response) {
   
   if (true === response.data) {
   //$toggle.removeClass('woocommerce-input-toggle--enabled, woocommerce-input-toggle--disabled');
   //$toggle.addClass('woocommerce-input-toggle--enabled');
   //$toggle.removeClass('woocommerce-input-toggle--loading');
   } else if (true !== response.data) {
   //$toggle.removeClass('woocommerce-input-toggle--enabled, woocommerce-input-toggle--disabled');
   //$toggle.addClass('woocommerce-input-toggle--disabled');
   //$toggle.removeClass('woocommerce-input-toggle--loading');
   } //else if ('needs_setup' === response.data) {
   //window.location.href = $link.attr('href');
   //}
   }
   });
   return false;
   });*/

  $('#wooccm_billing_fields').on('click', '.wooccm-field-toggle-enabled', function () {

    var $link = $(this),
            $tr = $link.closest('tr'),
            $toggle = $link.find('.woocommerce-input-toggle');

    $.ajax({
      url: woocommerce_admin.ajax_url,
      data: {
        action: 'wooccm_toggle_field_enabled',
        nonce: wooccm.nonce,
        field_id: $tr.data('field_id')
      },
      dataType: 'json',
      type: 'POST',
      beforeSend: function (response) {
        $toggle.addClass('woocommerce-input-toggle--loading');
      },
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