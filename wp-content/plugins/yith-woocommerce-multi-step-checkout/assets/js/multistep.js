/**
 * YITH WooCommerce Multi Step Checkout
 * @version 2.0.0
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 */

/**
 * ================= *
 * Standard Step Mapping
 * before version 2.0.0
 *
 * 0 -> Login
 * 1 -> Billing
 * 2 -> Shipping
 * 3 -> Order Info
 * 4 -> Payment
 * ================= *
 */

(function ($) {
  var $body = $('body'),
    login = $(yith_wcms.dom.login),
    billing = $(yith_wcms.dom.billing),
    shipping = $(yith_wcms.dom.shipping),
    order = $(yith_wcms.dom.order),
    payment = $(yith_wcms.dom.payment),
    form_actions = $(yith_wcms.dom.form_actions),
    coupon = $(yith_wcms.dom.coupon),
    steps = {
      login: login,
      billing: billing,
      shipping: shipping,
      order: order,
      payment: payment
    },
    get_prev_and_next_step = function ($current_step) {
      return yith_wcms.steps_timeline[$current_step];
    };

  $body.on('updated_checkout yith_wcms_myaccount_order_pay', function (e) {
    if (e.type == 'updated_checkout') {
      steps['payment'] = $(yith_wcms.dom.payment);
    }

    var current_step = form_actions.data('step');
    if (current_step == 'payment') {
      $(yith_wcms.dom.payment).show();
    }

    $body.trigger('yith_wcms_updated_checkout');
  });

  if ($body.hasClass('woocommerce-order-pay')) {
    $body.trigger('yith_wcms_myaccount_order_pay');
  }

  //enable select2
  $body.on('yith_wcms_select2', function (event) {
    if ($().select2) {
      var wc_country_select_select2 = function () {
        $('select.country_select, select.state_select').each(function () {
          var select2_args = {
            placeholder: $(this).attr('placeholder'),
            placeholderOption: 'first',
            width: '100%'
          };

          $(this).select2(select2_args);
        });
      };

      wc_country_select_select2();

      $body.bind('country_to_state_changed', function () {
        wc_country_select_select2();
      });
    }
  });

  if (yith_wcms.wc_shipping_multiple != 1) {
    $body.trigger('yith_wcms_select2');
  }

  form_actions.find(yith_wcms.dom.button_prev).add(yith_wcms.dom.button_next).on('click', function (e) {
    var t = $(this),
      current_step = form_actions.data('step'),
      linked_step = get_prev_and_next_step(current_step),
      next_step = linked_step['next'],
      prev_step = linked_step['prev'];

    change_step(t, current_step, next_step, prev_step);

  });

  var change_step = function (t, current_step, next_step, prev_step) {

    var timeline = $(yith_wcms.dom.checkout_timeline),
      action = t.data('action'),
      prev = form_actions.find(yith_wcms.dom.button_prev),
      next = form_actions.find(yith_wcms.dom.button_next),
      active_step = timeline.find('.active').data('step'),
      checkout_form = $(yith_wcms.dom.checkout_form);

    if (action == 'prev') {
      next.removeClass('disabled').removeAttr('disabled');
    }

    var show_coupon = function (current_step) {
      // Your order
      if (current_step == 'order' || $(document).triggerHandler('yith_wmcs_show_coupon', current_step)) {
        coupon.fadeIn(yith_wcms.transition_duration);
      } else {
        coupon.fadeOut(yith_wcms.transition_duration);
      }
    };

    timeline.find('.active').removeClass('active');

    if (action == 'next') {
      form_actions.data('step', next_step);
      var next_timeline_step = $(yith_wcms.dom.timeline_id_prefix + next_step);
      steps[current_step].fadeOut(yith_wcms.transition_duration, function () {
        steps[next_step].fadeIn(yith_wcms.transition_duration);
        show_coupon(next_step);
      });

      next_timeline_step.toggleClass('active');
    } else if (action == 'prev') {

      var prev_timeline_step = $(yith_wcms.dom.timeline_id_prefix + prev_step);
      form_actions.data('step', prev_step);

      steps[current_step].fadeOut(yith_wcms.transition_duration, function () {
        steps[prev_step].fadeIn(yith_wcms.transition_duration);
      });

      show_coupon(prev_step);
      prev_timeline_step.toggleClass('active');
    }

    current_step = form_actions.data('step');

    var checkout_timeline = $(yith_wcms.dom.checkout_timeline),
      active_step = checkout_timeline.find('li.active'),
      index = active_step.index(),
      done_step = checkout_timeline.find('li').filter(':lt(' + index + ')').filter(':not(.active)');

    checkout_timeline.find('li.done').removeClass('done');

    done_step.addClass('done');

    /** Disable Prev Button if...
     * 1. Current step is billing and current user logged in
     * 2. Current step is login and current user not logged in
     * Disable Next Button if in Payment step
     */
    var disable_prev_button = false,
      disable_next_button = false;
    /**
     * yith_wcms.steps_timeline[next_step][action] === false
     *
     * Means: if I haven't next step, if this is the last step
     */
    if (action == 'next' && yith_wcms.steps_timeline[next_step][action] === false) {
      disable_next_button = true;
    }

    /**
     * yith_wcms.steps_timeline[prev_step][action] === false
     *
     * Means: if I haven't previous step, if this is the first step
     */
    if (action == 'prev' && yith_wcms.steps_timeline[prev_step][action] === false) {
      disable_prev_button = true;
    }

    if (disable_prev_button === true) {
      prev.fadeOut(yith_wcms.transition_duration);
    } else {
      prev.fadeIn(yith_wcms.transition_duration).css('display', 'inline-block');
    }

    if (disable_next_button === true) {
      next.fadeOut(yith_wcms.transition_duration);
    } else {
      next.fadeIn(yith_wcms.transition_duration).css('display', 'inline-block');
    }

    // Last step
    if (current_step == 'payment') {
      checkout_form.removeClass('processing');
      /**
       * Disable prev button if the admin
       * want to remove prev button in last step
       * (added via plugin option)
       */
      if (yith_wcms.disabled_prev_button == 'yes') {
        prev.fadeOut(yith_wcms.transition_duration);
      }
    } else {
      checkout_form.addClass('processing');
    }
  };
})(jQuery);
