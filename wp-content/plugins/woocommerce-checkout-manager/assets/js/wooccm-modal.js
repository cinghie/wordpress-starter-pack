(function ($) {

  var count = 0,
          timer;

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

  var Field = Backbone.Model.extend({
    defaults: wooccm.fields.args
  });

  var FieldView = Backbone.View.extend({
    id: 'wooccm_modal',
    events: {
      'click .media-modal-backdrop': 'close',
      'click .media-modal-close': 'close',
      'click .media-modal-delete': 'Delete',
      'click .media-modal-prev': 'update',
      'click .media-modal-next': 'update',
      'change .media-modal-change': 'change',
      'submit .media-modal-form': 'save',
    },
    templates: {},
    initialize: function () {
      _.bindAll(this, 'open', 'update', 'change', 'load', 'render', 'close', 'save');
      this.init();
      this.open();
    },
    init: function () {
      this.templates.window = wp.template('wpmi-modal-window');
    },
    render: function () {
      this.$el.attr('tabindex', '0');
      this.$el.html(this.templates.window(this.model.attributes));
      this.$el.focus().trigger('wc-init-tabbed-panels');
      this.$el.focus().trigger('init_tooltips');
      this.$el.focus().trigger('wooccm-enhanced-select');
    },
    load: function () {

      var $modal = this;
      $.ajax({
        url: woocommerce_admin.ajax_url,
        data: {
          action: 'wooccm_edit_field',
          nonce: wooccm.nonce,
          //options_name: $tr.data('options_name'),
          //options_key: $tr.data('options_key'),
          field_id: this.model.attributes.id
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
          console.log(response);
          $modal.model.set(response.data)
          $modal.render();
        }
      });
    },
    update: function (e) {
      e.preventDefault();

      var $modal = this,
              $button = $(e.target),
              field_id = $modal.model.get('id');

      count++;

      if (timer) {
        clearTimeout(timer);
      }

      timer = setTimeout(function () {

        if ($button.hasClass('media-modal-next')) {
          field_id = field_id + count;
        } else {
          field_id = field_id - count;
        }

        $modal.model.set({
          id: field_id
        });

        count = 0;

        $modal.load();

      }, 300);
    },
    open: function (e) {

      this.load();

      $('body').addClass('modal-open').append(this.$el);
    },
    change: function (e) {

      e.preventDefault();

      var $field = $(e.target),
              name = $field.attr('name'),
              value = $field.val();

      this.model.attributes[name] = value;

      this.render();
    },
    close: function (e) {
      e.preventDefault();
      this.undelegateEvents();
      $(document).off('focusin');
      $('body').removeClass('modal-open');
      this.remove();
      //wpmi.__instance = undefined;
    },
    save: function (e) {

      e.preventDefault();
      var $form = $(e.target),
              $modal = this.$el,
              $details = $modal.find('.attachment-details');

      $.ajax({
        url: woocommerce_admin.ajax_url,
        data: {
          action: 'wooccm_save_field',
          nonce: wooccm.nonce,
          field_id: this.model.attributes.id,
          //options_name: $tr.data('options_name'),
          //options_key: $tr.data('options_key'),
          field_data: $form.serializeArrayAll()
        },
        dataType: 'json',
        type: 'POST',
        beforeSend: function () {
          $details.addClass('save-waiting');
          //block($modal);
        },
        complete: function () {
          $details.addClass('save-complete');
          $details.removeClass('save-waiting');
          //unblock($modal);
          //$modal.close(e);
        },
        error: function () {
          alert('Error!');
        },
        success: function (response) {
          console.log(response);
        }
      });
      return false;
    }
  });

  var FieldModal = Backbone.View.extend({
    initialize: function (e) {

      var $button = $(e.target),
              field_id = $button.closest('[data-field_id]').data('field_id');

      var model = new Field();

      model.set({
        id: field_id
      });

      new FieldView({
        model: model
      });
    },
  });

  $('.wooccm_billing_settings_edit').on('click', function (e) {
    e.preventDefault();

    new FieldModal(e);
  });


})(jQuery);