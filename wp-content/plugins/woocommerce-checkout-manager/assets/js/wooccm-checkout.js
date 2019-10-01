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

    var $field_list = $(list),
            source_class;
    if (filetype.match('image.*')) {
      source_class = 'image';
    } else if (filetype.match('application/ms.*')) {
      source = wooccm.icons.spreadsheet;
      source_class = 'spreadsheet';
    } else if (filetype.match('application/x.*')) {
      source = wooccm.icons.archive;
      source_class = 'application';
    } else if (filetype.match('audio.*')) {
      source = wooccm.icons.audio;
      source_class = 'audio';
    } else if (filetype.match('text.*')) {
      source = wooccm.icons.text;
      source_class = 'text';
    } else if (filetype.match('video.*')) {
      source = wooccm.icons.video;
      source_class = 'video';
    } else {
      //if ((false === filetype.match('application/ms.*') && false === filetype.match('application/x.*') && false === filetype.match('audio.*') && false === filetype.match('text.*') && false === filetype.match('video.*')) || (0 === filetype.length || !filetype)) {
      source = wooccm.icons.interactive;
      source_class = 'interactive';
    }


    var html = '<span data-file_id="' + i + '" title="' + name + '" class="wooccmupload_file">\n\
                <span class="wooccmupload_file_container">\n\
                <a title="' + name + '" class="wooccmupload_file_delete" class="wooccm_dele wooccm-btn wooccm-btn-danger">×</a>\n\
                <span class="wooccmupload_file_image_container">\n\
                <img class="' + source_class + '" alt="' + name + '" src="' + source + '"/>\n\
                </span>\n\
                </span>\n\
                </span>';
    $field_list.append(html).fadeIn();
  }


  function field_is_required(field, is_required) {
    if (is_required) {
      field.find('label .optional').remove();
      field.addClass('validate-required');

      if (field.find('label .required').length === 0) {
        field.find('label').append(
                '&nbsp;<abbr class="required" title="' +
                wc_address_i18n_params.i18n_required_text +
                '">*</abbr>'
                );
      }
    } else {
      field.find('label .required').remove();
      field.removeClass('validate-required woocommerce-invalid woocommerce-invalid-required-field');

      if (field.find('label .optional').length === 0) {
        field.find('label').append('&nbsp;<span class="optional">(' + wc_address_i18n_params.i18n_optional_text + ')</span>');
      }
    }
  }


  $(document).on('country_to_state_changing', function (event, country, wrapper) {

    var thisform = wrapper, thislocale;

    var locale_fields = $.parseJSON(wc_address_i18n_params.locale_fields);

    $.each(locale_fields, function (key, value) {

      var field = thisform.find(value),
              required = field.find('[data-required]').data('required') || 0;

      field_is_required(field, required);
    });

  });
// Field
// ---------------------------------------------------------------------------

  var fileList = [];
  $('.wooccmupload-field').each(function (i, field) {

    var $field = $(field),
            $button_file = $field.find('[type=file]'),
            $button_click = $field.find('.wooccmupload_button'),
            $field_list = $field.find('.wooccmupload_list');
    fileList[$field.attr('id')] = [];
    // Simulate click
    // -------------------------------------------------------------------------

    $button_click.on('click', function (e) {
      e.preventDefault();
      $button_file.trigger('click');
    });
    // Delete images
    // ---------------------------------------------------------------------------

    $field_list.on('click', '.wooccmupload_file_delete', function (e) {
      $(this).closest('.wooccmupload_file').remove();
    });
    // Append images
    // -------------------------------------------------------------------------

    $button_file.on('change', function (e) {

      var files = $(this)[0].files;
      if (files.length) {

        if (window.FileReader) {

          $.each(files, function (i, file) {

            var count = $field_list.find('span[data-file_id]').length + i;
            if (count >= wooccm.limit.max_files) {
              alert('Exeeds max files limit of ' + wooccm.limit.max_files);
              return false;
            }

            if (file.size > wooccm.limit.max_file_size) {
              alert('Exeeds max file size of ' + wooccm.limit.max_file_size);
              return true;
            }

            reader = new FileReader();
            reader.onload = (function (theFile) {
              return function (e) {

                setTimeout(function () {
                  append_image($field_list, fileList[$field.attr('id')].push(file) - 1, e.target.result, theFile.name, theFile.type);
                }, 200);
              };
            })(file);
            console.log(file.name);
            reader.readAsDataURL(file);
          });
        }
      }
    });
  });
  // Add class on place order reload if upload field exists
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
  // Upload files
  // ---------------------------------------------------------------------------

  $(document).on('click', '#place_order.wooccm-upload-process', function (e) {

    e.preventDefault();
    var $form = $('form.checkout'),
            $place_order = $(this),
            //$results = $('#wooccm_checkout_attachment_results'),
            $fields = $('.wooccmupload-field'),
            fields = $fields.length;
    $fields.each(function (i, field) {

      var $field = $(field),
              $attachment_ids = $field.find('.wooccmupload_field'),
              $field_list = $field.find('.wooccmupload_list'); //,

      if (window.FormData && fileList[$field.attr('id')].length) {

        if (!is_blocked($form)) {
          $place_order.html(wooccm.message.uploading);
          block($form);
        }

        var data = new FormData();
        $field_list.find('span[data-file_id]').each(function (i, file) {

          var file_id = $(file).data('file_id');
          if (i > wooccm.limit.max_files) {
            console.log('Exeeds max files limit of ' + wooccm.limit.max_files);
            return false;
          }

          if (fileList[$field.attr('id')][file_id] === undefined) {
            console.log('Undefined ' + file_id);
            return true;
          }

          if (fileList[$field.attr('id')][file_id].size > wooccm.limit.max_file_size) {
            console.log('Exeeds max file size of ' + wooccm.limit.max_files);
            return true;
          }

          console.log('We\'re ready to upload ' + fileList[$field.attr('id')][file_id].name);
          data.append('wooccm_checkout_attachment_upload[]', fileList[$field.attr('id')][file_id]);
        });
        //return;

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
            //$place_order.html(wooccm.message.uploading);
          },
          success: function (response) {
            //$results.removeClass('woocommerce-message');
            if (response.success) {
              //console.log(response.data);
              $attachment_ids.val(response.data);
            } else {
              $('body').trigger('update_checkout');
              //console.log(response.data);
              //$results.addClass('woocommerce-error').html(response.data).show();
            }
          },
          complete: function (response) {
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
  // Update checkout fees
  // ---------------------------------------------------------------------------

  $(document).on('change', '.wooccm-add-checkout-fees', function (e) {
    $('body').trigger('update_checkout');
  });

  // Conditional
  // ---------------------------------------------------------------------------

  $('.wooccm-conditional-child').each(function (i, field) {

    var $field = $(field),
            $parent = $('.wooccm-field-' + $field.find('[data-conditional-parent]').data('conditional-parent')),
            show_if_value = $field.find('[data-conditional-parent-value]').data('conditional-parent-value');

    if ($parent.length) {

      $parent.on('change keyup', function (e) {

        var $this = $(e.target),
                value = $this.val();

        if ($this.prop('type') == 'checkbox') {
          value = $this.is(':checked');
        }

        if (show_if_value == value || ($.isArray(value) && value.indexOf(show_if_value) > -1)) {
          $field.fadeIn();
        } else {
          $field.fadeOut();
        }

      });

      $parent.find('select').trigger('change');
      $parent.find('textarea').trigger('keyup');
      $parent.find('input[type=button]').trigger('click');
      $parent.find('input[type=radio]:checked').trigger('keyup');
      $parent.find('input[type=checkbox]:checked').trigger('keyup');
      $parent.find('input[type=color]').trigger('keyup');
      $parent.find('input[type=date]').trigger('keyup');
      $parent.find('input[type=datetime-local]').trigger('keyup');
      $parent.find('input[type=email]').trigger('keyup');
      $parent.find('input[type=file]').trigger('keyup');
      $parent.find('input[type=hidden]').trigger('keyup');
      $parent.find('input[type=image]').trigger('keyup');
      $parent.find('input[type=month]').trigger('keyup');
      $parent.find('input[type=number]').trigger('keyup');
      $parent.find('input[type=password]').trigger('keyup');
      $parent.find('input[type=range]').trigger('keyup');
      $parent.find('input[type=reset]').trigger('keyup');
      $parent.find('input[type=search]').trigger('keyup');
      $parent.find('input[type=submit]').trigger('keyup');
      $parent.find('input[type=tel]').trigger('keyup');
      $parent.find('input[type=text]').trigger('keyup');
      $parent.find('input[type=time]').trigger('keyup');
      $parent.find('input[type=url]').trigger('keyup');
      $parent.find('input[type=week]').trigger('keyup');

    } else {
      $field.show();
    }

  });

  // Datepicker fields
  // ---------------------------------------------------------------------------

  $('.wooccm-type-datepicker').each(function (i, field) {

    var $field = $(field),
            $input = $field.find('input[type=text]');

    if ($.isFunction($.fn.datepicker)) {

      $input.datepicker({
        dateFormat: $input.data('formatdate') || 'dd-mm-yy',
        minDate: $input.data('mindate') || undefined,
        maxDate: $input.data('maxdate') || undefined,
        beforeShowDay: function (date) {
          var day = date.getDay(),
                  disable = $input.data('disable') || false;

          if (!disable) {
            return [true]
          } else {
            return [disable[day] !== undefined];
          }
        }
      });
    }

  });

  // Timepicker fields
  // ---------------------------------------------------------------------------

  $('.wooccm-type-timepicker').each(function (i, field) {

    var $field = $(field),
            $input = $field.find('input[type=text]');

    if ($.isFunction($.fn.timepicker)) {
      $input.timepicker({
        showPeriod: true,
        showLeadingZero: true,
        hours: $input.data('hours') || undefined,
        minutes: $input.data('minutes') || undefined,
      });
    }

  });

  // Color fields
  // ---------------------------------------------------------------------------

  $('.wooccm-colorpicker-farbtastic').each(function (i, field) {

    var $field = $(field),
            $input = $field.find('input[type=text]'),
            $container = $field.find('.wooccmcolorpicker_container');

    $input.hide();

    if ($.isFunction($.fn.farbtastic)) {

      $container.farbtastic('#' + $input.attr('id'));

      $container.on('click', function (e) {
        $input.fadeIn();
      });

    }

  });

  $('.wooccm-colorpicker-iris').each(function (i, field) {

    var $field = $(field),
            $input = $field.find('input[type=text]');//,
    //$container = $field.find('.wooccmcolorpicker_container');

    $input.css('color', '#fff').css('background', $input.val()).hide();

    $input.iris({
      wccmclass: $input.attr('id'),
      palettes: true,
      color: '',
      hide: false,
      change: function (event, ui) {
        $input.css('color', '#000').css('background', ui.color.toString()).fadeIn();
      }
    });

    //$input.wpColorPicker();
  });
})(jQuery);