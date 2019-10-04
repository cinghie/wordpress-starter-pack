(function ($) {

  $.fn.serializeArrayAll = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
      if (o[this.name] !== undefined) {
        if (!o[this.name].push) {
          o[this.name] = [o[this.name]];
        }
        o[this.name].push(this.value || '');
      } else {
        o[this.name] = this.value || '';
      }
    });
    var $radio = $('input[type=radio],input[type=checkbox]', this);
    $.each($radio, function () {
      if (!o.hasOwnProperty(this.name)) {
        o[this.name] = '';
      }
    });
    return o;
  };

  function date_picker_select(datepicker) {
    var option = $(datepicker).next().is('.hasDatepicker') ? 'minDate' : 'maxDate',
            otherDateField = 'minDate' === option ? $(datepicker).next() : $(datepicker).prev(),
            date = $(datepicker).datepicker('getDate');

    $(otherDateField).datepicker('option', option, date);
    $(datepicker).change();
  }

  function getEnhancedSelectFormatString() {
    return {
      'language': {
        errorLoading: function () {
          // Workaround for https://github.com/select2/select2/issues/4355 instead of i18n_ajax_error.
          return wc_enhanced_select_params.i18n_searching;
        },
        inputTooLong: function (args) {
          var overChars = args.input.length - args.maximum;

          if (1 === overChars) {
            return wc_enhanced_select_params.i18n_input_too_long_1;
          }

          return wc_enhanced_select_params.i18n_input_too_long_n.replace('%qty%', overChars);
        },
        inputTooShort: function (args) {
          var remainingChars = args.minimum - args.input.length;

          if (1 === remainingChars) {
            return wc_enhanced_select_params.i18n_input_too_short_1;
          }

          return wc_enhanced_select_params.i18n_input_too_short_n.replace('%qty%', remainingChars);
        },
        loadingMore: function () {
          return wc_enhanced_select_params.i18n_load_more;
        },
        maximumSelected: function (args) {
          if (args.maximum === 1) {
            return wc_enhanced_select_params.i18n_selection_too_long_1;
          }

          return wc_enhanced_select_params.i18n_selection_too_long_n.replace('%qty%', args.maximum);
        },
        noResults: function () {
          return wc_enhanced_select_params.i18n_no_matches;
        },
        searching: function () {
          return wc_enhanced_select_params.i18n_searching;
        }
      }
    };
  }

  $(document).on('wooccm-tab-panels', function (e, active) {

    var $modal = $(e.target),
            $tabs = $modal.find('ul.wc-tabs'),
            $active = $tabs.find('a[href="' + active + '"]');

    $tabs.show();

    $tabs.find('a').click(function (e) {
      e.preventDefault();

      var panel_wrap = $(this).closest('div.panel-wrap');

      $tabs.find('li', panel_wrap).removeClass('active');

      $(this).parent().addClass('active');

      $('div.panel', panel_wrap).hide();

      $($(this).attr('href')).show();
    });

    if ($active.length && $($active.attr('href')).length) {
      $active.click();
    } else {
      $tabs.find('li.active').find('a').click();
    }

  });

  $(document).on('wooccm-enhanced-select', function (e) {

    $('.wooccm-enhanced-between-dates').filter(':not(.enhanced)').each(function () {

      $(this).find('input').datepicker({
        defaultDate: '',
        dateFormat: 'yy-mm-dd',
        numberOfMonths: 1,
        showButtonPanel: true,
        onSelect: function () {
          date_picker_select($(this));
        }
      });

      $(this).find('input').each(function () {
        date_picker_select($(this));
      });

    });

  });

  $(document).on('wooccm-enhanced-select', function (e) {

    $('.wooccm-enhanced-select').filter(':not(.enhanced)').each(function () {
      var select2_args = $.extend({
        minimumResultsForSearch: 10,
        allowClear: $(this).data('allow_clear') ? true : false,
        placeholder: $(this).data('placeholder')
      }, getEnhancedSelectFormatString());

      $(this).selectWoo(select2_args).addClass('enhanced');
    });

    $('.wooccm-product-search').filter(':not(.enhanced)').each(function () {

      var select2_args = {
        allowClear: $(this).data('allow_clear') ? true : false,
        placeholder: $(this).data('placeholder'),
        minimumInputLength: $(this).data('minimum_input_length') ? $(this).data('minimum_input_length') : '3',
        escapeMarkup: function (m) {
          return m;
        },
        ajax: {
          url: wc_enhanced_select_params.ajax_url,
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              term: params.term,
              action: $(this).data('action') || 'wooccm_select_search_products',
              //nonce: wooccm_admin.nonce,              
              security: wc_enhanced_select_params.search_products_nonce,
              selected: $(this).select2('val') || 0,
              exclude: $(this).data('exclude'),
              include: $(this).data('include'),
              limit: $(this).data('limit'),
              display_stock: $(this).data('display_stock')
            };
          },
          processResults: function (data) {
            var terms = [];
            if (data) {
              $.each(data, function (id, text) {
                terms.push({id: id, text: text});
              });
            }
            return {
              results: terms
            };
          },
          cache: true
        }
      };

      select2_args = $.extend(select2_args, getEnhancedSelectFormatString());

      $(this).selectWoo(select2_args).addClass('enhanced');

      if ($(this).data('sortable')) {
        var $select = $(this);
        var $list = $(this).next('.select2-container').find('ul.select2-selection__rendered');

        $list.sortable({
          placeholder: 'ui-state-highlight select2-selection__choice',
          forcePlaceholderSize: true,
          items: 'li:not(.select2-search__field)',
          tolerance: 'pointer',
          stop: function () {
            $($list.find('.select2-selection__choice').get().reverse()).each(function () {
              var id = $(this).data('data').id;
              var option = $select.find('option[value="' + id + '"]')[0];
              $select.prepend(option);
            });
          }
        });
        // Keep multiselects ordered alphabetically if they are not sortable.
      } else if ($(this).prop('multiple')) {
        $(this).on('change', function () {
          var $children = $(this).children();
          $children.sort(function (a, b) {
            var atext = a.text.toLowerCase();
            var btext = b.text.toLowerCase();

            if (atext > btext) {
              return 1;
            }
            if (atext < btext) {
              return -1;
            }
            return 0;
          });
          $(this).html($children);
        });
      }
    });

  });

  $(document).on('click', '.wooccm-field-toggle-attribute', function (e) {
    e.preventDefault();

    var $link = $(this),
            $tr = $link.closest('tr'),
            $toggle = $link.find('.woocommerce-input-toggle');

    $.ajax({
      url: wooccm_admin.ajax_url,
      data: {
        action: 'wooccm_toggle_field_attribute',
        nonce: wooccm_admin.nonce,
        field_attr: $(this).data('field_attr'),
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

  $(document).on('change', '.wooccm-field-change-attribute', function (e) {
    e.preventDefault();

    var $change = $(this),
            $tr = $change.closest('tr');

    $.ajax({
      url: wooccm_admin.ajax_url,
      data: {
        action: 'wooccm_change_field_attribute',
        nonce: wooccm_admin.nonce,
        field_attr: $change.data('field_attr'),
        field_value: $change.val(),
        field_id: $tr.data('field_id'),
      },
      dataType: 'json',
      type: 'POST',
      beforeSend: function (response) {
        $change.prop('disabled', true);
      },
      success: function (response) {
        console.log(response.data);
      },
      complete: function (response) {
        $change.prop('disabled', false);
      },
    });
    return false;
  }); 

})(jQuery);