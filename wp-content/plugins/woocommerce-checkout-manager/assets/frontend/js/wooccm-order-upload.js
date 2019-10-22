(function ($) {

  var is_blocked = function ($node) {
    return $node.is('.processing') || $node.parents('.processing').length;
  };
  var block = function ($node) {
    if (!is_blocked($node)) {
      $node.addClass('processing').block({
        message: null,
        overlayCSS: {
          background: '#fff',
          opacity: 0.6
        }
      });
    }
  };
  var unblock = function ($node) {
    $node.removeClass('processing').unblock();
  };

  $(document).ready(function ($) {

    // Delete
    // -------------------------------------------------------------------------
    $(document).on('click', '.wooccm_delete_attachment', function (e) {

      var $tr = $(this).closest('tr'),
              attachment_id = $(this).data('attachment_id');

      $tr.hide();

      $('#wooccm_order_attachment_update').prop('disabled', false);

      $('#delete_attachments_ids').val($('#delete_attachments_ids').val().replace(attachment_id, ''));
    });

    $(document).on('click', '#wooccm_order_attachment_update', function (e) {

      $.ajax({
        url: wooccm_upload.ajax_url,
        type: 'POST',
        cache: false,
        data: {
          action: 'wooccm_order_attachment_update',
          nonce: wooccm_upload.nonce,
          delete_attachments_ids: $('#delete_attachments_ids').val(),
          all_attachments_ids: $('#all_attachments_ids').val()
        },
        beforeSend: function (response) {
          $('.wccm_results').html(wooccm_upload.message.saving);
        },
        success: function (response) {
          if (response.success) {
            $('.wccm_results').html(wooccm_upload.message.deleted);

            $('#wooccm_order_attachment_update').prop('disabled', true);
          } else {
            $('.wccm_results').html(response.data);
          }
        }
      });
    });
    // Upload
    // -------------------------------------------------------------------------

    $(document).on('change', '#wooccm_order_attachment_upload', function (e) {

      var data = false,
              order_id = $(this).data('order_id');

      if (window.FormData) {
        data = new FormData();
      }

      var i = 0, len = this.files.length, img, reader, file;
      for (; i < len; i++) {
        file = this.files[i];
        if (data) {
          data.append('wooccm_order_attachment_upload[]', file);
        }
      }

      /*
       * filter file types
       * var file_array = ' . wooccm_js_array($file_types) . ';
       var wooempt = "' . implode(',', $file_types) . '";
       
       for ( i = 0; i < length; i++ ) {
       file = this.files[i];
       for(x=0; x < ' . $number_of_types . '; x++){
       if( !wooempt || file.type.match(file_array[x])  ) {
       if (formdata) {
       formdata.append("files_wccm[]",file); 
       }
       }
       }
       }
       */

      if (data) {

        data.append('action', 'wooccm_order_attachment_upload');
        data.append('nonce', wooccm_upload.nonce);
        data.append('order_id', order_id);

        $.ajax({
          url: wooccm_upload.ajax_url,
          type: 'POST',
          cache: false,
          data: data,
          processData: false,
          contentType: false,
          beforeSend: function (response) {

            $('.wccm_results').html(wooccm_upload.message.uploading);

            block($('#wooccm_order_attachment_inner'));
          },
          success: function (response) {

            if (response.success) {
              $('#wooccm_order_attachment_inner').fadeOut();
              $('#wooccm_order_attachment_inner').replaceWith($(response.data).fadeIn());
              $('.wccm_results').html(wooccm_upload.message.success);
            } else {
              $('.wccm_results').html(response.data);
            }

            unblock($('#wooccm_order_attachment_inner'));
          }
        });
      }
    });
  });
})(jQuery);