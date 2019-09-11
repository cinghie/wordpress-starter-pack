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

  var append_image = function (list, i, source, name, filetype) {

    var $list = $(list);

    if ((false === filetype.match('application/ms.*') && false === filetype.match('application/x.*') && false === filetype.match('audio.*') && false === filetype.match('text.*') && false === filetype.match('video.*')) || (0 === filetype.length || !filetype)) {
      source = wooccm.icons.interactive;
    }
    if (filetype.match('application/ms.*')) {
      source = wooccm.icons.spreadsheet;
    }
    if (filetype.match('application/x.*')) {
      source = wooccm.icons.archive;
    }
    if (filetype.match('audio.*')) {
      source = wooccm.icons.audio;
    }
    if (filetype.match('text.*')) {
      source = wooccm.icons.text;
    }
    if (filetype.match('video.*')) {
      source = wooccm.icons.video;
    }

    var html = '<span data-file_id="' + i + '" title="' + name + '" class="wooccm_file">\n\
                <span class="wooccm_file_container">\n\
                <img alt="' + name + '" src="' + source + '"/>\n\
                <a title="' + name + '" class="wooccm_file_delete" class="wooccm_dele wooccm-btn wooccm-btn-danger">×</a>\n\
                </span>\n\
                </span>';

    $list.append(html).fadeIn();

  }


  // Field
  // ---------------------------------------------------------------------------

  $('.wooccmupload-field').each(function (i, field) {

    var $field = $(field),
            $button = $field.find('[type=button]'),
            $files = $field.find('[type=file]'),
            $list = $field.find('.wooccm_checkout_attachment_upload');

    // Click
    // -------------------------------------------------------------------------

    $button.on('click', function (e) {
      e.preventDefault();
      $files.trigger('click');
    });

    // Delete
    // ---------------------------------------------------------------------------

    $(document).on('click', '.wooccm_file_delete', function (e) {

      alert('delete');

      //var $tr = $(this).closest('tr'),
      //        attachment_id = $(this).data('attachment_id');

      //$tr.hide();

      //$('#delete_attachments_ids').val($('#delete_attachments_ids').val().replace(attachment_id, ''));
    });

    // Append images
    // -------------------------------------------------------------------------

    $files.on('change', function (e) {

      var $field = $(field),
              $files = $field.find('[type=file]'),
              files = $files[0].files;

      if (files.length) {
        $.each(files, function (i, file) {

          if (window.FileReader) {

            reader = new FileReader();

            reader.onload = (function (theFile) {
              return function (e) {

                setTimeout(function () {
                  append_image($list, i, e.target.result, theFile.name, theFile.type);
                }, 200);

              };
            })(file);

            reader.readAsDataURL(file);
          }

        });
      }

    });
  });

  // Upload
  // ---------------------------------------------------------------------------

  $('#order_review').on('ajaxSuccess', function (e) {

    var $order_review = $(e.target),
            $place_order = $order_review.find('#place_order'),
            $fields = $('.wooccmupload-field'),
            fields = $fields.length;

    if (fields) {
      $place_order.addClass('wooccm-upload-process');
    }

  });

  $(document).on('click', '#place_order.wooccm-upload-process', function (e) {

    e.preventDefault();

    var $form = $('form.checkout'),
            $place_order = $(this),
            $results = $('#wooccm_checkout_attachment_results'),
            $fields = $('.wooccmupload-field'),
            fields = $fields.length;

    $fields.each(function (i, field) {

      var $field = $(field),
              $input = $field.find('[type=hidden]'),
              $files = $field.find('[type=file]'),
              files = $files[0].files;

      if (window.FormData && files.length) {

        if (!is_blocked($form)) {
          $place_order.html(wooccm.uploading);
          block($form);
        }

        var data = new FormData();

        $.each(files, function (i, file) {
          data.append('wooccm_checkout_attachment_upload[]', file);
        });

        data.append('action', 'wooccm_checkout_attachment_upload');
        data.append('nonce', wooccm.nonce);

        $.ajax({
          async: false,
          url: wooccm.ajaxurl,
          type: 'POST',
          cache: false,
          data: data,
          processData: false,
          contentType: false,
          beforeSend: function (response) {
            //$place_order.html(wooccm.uploading);
          },
          success: function (response) {
            $results.removeClass('woocommerce-message');
            if (response.success) {
              //$results.addClass('woocommerce-message').html(wooccm.success);
              //console.log(response.data);
              $input.val(response.data);
            } else {
              $results.addClass('woocommerce-error').html(response.data).show();
            }
            //$results.show();
          },
          complete: function (response) {
            //$place_order.html(text);
            fields = fields - 1;
            //console.log('ajax: fields = ' + fields);
          }
        });

      } else {
        fields = fields - 1;
        //console.log('no ajax: fields = ' + fields);
      }

      //console.log('fields = ' + fields);

      if (fields == 0) {
        //console.log('llamar al click aca');
        unblock($form);
        $place_order.removeClass('wooccm-upload-process').trigger('click');
        //return;
      }

    });
    //return false;
    //}
  });

})(jQuery);