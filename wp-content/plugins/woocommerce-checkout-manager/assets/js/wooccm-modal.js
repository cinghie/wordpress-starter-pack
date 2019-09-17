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

  var wpmi = {
    __instance: undefined
  };
  wpmi.Application = Backbone.View.extend({
    id: 'wpmi_modal',
    events: {
      'click .media-modal-backdrop': 'Close',
      'click .media-modal-close': 'Close',
      'click .media-modal-delete': 'Delete',
      'click .media-modal-save': 'Save',
      'click .media-modal-prev': 'update',
      'click .media-modal-next': 'update',
    },
    templates: {},
    initialize: function (e) {
      'use strict';
      _.bindAll(this, 'open', 'update', 'render', 'Close', 'Save');
      this.init();
      this.open(e);
    },
    init: function () {
      this.templates.window = wp.template('wpmi-modal-window');
    },
    render: function (field_id) {
      'use strict';

      var $modal = this;

      $.ajax({
        url: woocommerce_admin.ajax_url,
        data: {
          action: 'wooccm_edit_field',
          nonce: wooccm.nonce,
          //options_name: $tr.data('options_name'),
          //options_key: $tr.data('options_key'),
          field_id: field_id
        },
        dataType: 'json',
        type: 'POST',
        beforeSend: function () {
          //block($tr);
        },
        complete: function () {
          //unblock($tr);
        },
        error: function () {
          alert('Error!');
        },
        success: function (response) {
          $modal.$el.attr('tabindex', '0');
          $modal.$el.html($modal.templates.window(response.data));
          //$(document).on('focusin', $modal.preserveFocus);
          $modal.$el.focus().trigger('wc-init-tabbed-panels');
        }
      });
    },
    update: function (e) {
      'use strict';

      var $button = $(e.target),
              field_id = $button.data('field_id');

      this.render(field_id);
    },
    open: function (e) {
      'use strict';

      var $button = $(e.target),
              $tr = $button.closest('tr'),
              field_id = $tr.data('field_id');

      this.render(field_id);

      $('body').addClass('modal-open').append(this.$el);

    },
    /*preserveFocus: function (e) {
      'use strict';

      if (this.$el[0] !== e.target && !this.$el.has(e.target).length) {
        this.$el.focus();
      }
    },*/
    Close: function (e) {
      'use strict';
      e.preventDefault();
      this.undelegateEvents();
      $(document).off('focusin');
      $('body').removeClass('modal-open');
      this.remove();
      wpmi.__instance = undefined;
    },
    Save: function (e) {
      'use strict';
      e.preventDefault();

      var $modal = this;


      $modal.Close(e);
    },
    Delete: function (e) {
      'use strict';
      e.preventDefault();

      var $modal = this;

      $modal.Close(e);
    }
  });
  $('#wooccm_billing_settings_add').on('click', function (e) {
    e.preventDefault();
    if (wpmi.__instance === undefined) {
      wpmi.__instance = new wpmi.Application(e);
    }
  });
  $('.wooccm_billing_settings_edit').on('click', function (e) {
    e.preventDefault();
    if (wpmi.__instance === undefined) {
      wpmi.__instance = new wpmi.Application(e);
    }
  });
})(jQuery);