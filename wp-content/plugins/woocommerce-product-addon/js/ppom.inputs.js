/**
 * PPOM input scripts
 * 
 **/

"use strict"

var ppom_bulkquantity_meta = '';
var ppom_pricematrix_discount_type = '';

jQuery(function($) {


    // $('[data-toggle="tooltip"]').tooltip({container:'body', trigger:'hover'});
    var wc_cart_button = jQuery('form.cart').find('button[name="add-to-cart"]');

    // Measure
    $('.ppom-measure').on('change', '.ppom-measure-unit', function(e) {

        e.preventDefault();
        // console.log($(this).text());

        $(this).closest('.ppom-measure').find('.ppom-measure-input').trigger('change');
    });

    // Disable ajax add to cart
    wc_cart_button.removeClass("ajax_add_to_cart")

    // Range slider updated
    $(document).on('ppom_range_slider_updated', function(e) {

        // console.log(wc_product_qty);
        $('form.cart').find('input[name="quantity"]').val(e.qty);
        // wc_product_qty.val(e.qty);
        ppom_update_option_prices();
    });

    // move modals to body bottom
    if ($('.ppom-modals').length > 0) {
        $('.ppom-modals').appendTo('body');
    }

    ppom_init_js_for_ppom_fields(ppom_input_vars.ppom_inputs);

});

// JS Init PPOM Inputs
function ppom_init_js_for_ppom_fields(ppom_fields) {

    jQuery.each(ppom_fields, function(index, input) {

        // console.log(input.type);
        var InputSelector = jQuery("#" + input.data_name);

        // Applying JS on inputs
        switch (input.type) {

            // masking
            case 'text':
                if (input.input_mask == undefined || input.input_mask == '') break;
                InputSelector.inputmask();
                if (input.type === 'text' &&
                    input.input_mask !== '' &&
                    input.use_regex !== 'on') {
                    InputSelector.inputmask(input.input_mask);
                }
                break;


                // only allow numbers and periods in number fields
            case "number":
                InputSelector.bind("keydown keyup keypress", function(event) {
                    if (event.key === "Backspace" || event.key === "Delete" || event.key === "Tab" ||
                        (event.ctrlKey === true && event.key === "a") ||
                        (event.ctrlKey === true && event.key === "x") ||
                        (event.ctrlKey === true && event.key === "Backspace") ||
                        (event.which >= 48 && event.which <= 57) ||
                        (event.which >= 96 && event.which <= 105) ||
                        (event.key === "." && $(this).val().indexOf(".") <= 1)) {
                        // think happy thoughts :-)
                    }
                    else { event.preventDefault(); }
                }).bind("focus blur", function() {
                    if (typeof InputSelector.attr("max") !== 'undefined') {
                        if (parseFloat(InputSelector.val()) > parseFloat(InputSelector.attr("max"))) {
                            InputSelector.val(InputSelector.attr("max"));
                        }
                    }
                });
                break;

            case 'date':
                if (input.jquery_dp === 'on') {

                    InputSelector.datepicker("destroy");
                    InputSelector.datepicker({
                        changeMonth: true,
                        changeYear: true,
                        dateFormat: input.date_formats,
                        yearRange: input.year_range,
                    });

                    if (typeof input.past_dates !== 'undefined') {
                        if (input.past_dates.length > 0) {
                            var minDate = input.past_dates.trim();
                            // accommodate for previous values with "on" as the option
                            if (minDate === "on") { minDate = new Date(); }
                            InputSelector.datepicker('option', 'minDate', minDate);
                        }
                    }

                    if (input.no_weekends === 'on') {
                        InputSelector.datepicker('option', 'beforeShowDay', jQuery.datepicker.noWeekends);
                    }
                }
                break;

            case 'image':

                var img_id = input.data_name;
                // Image Tooltip
                if (input.show_popup === 'on' && !ppom_input_vars.is_mobile) {
                    jQuery('.ppom-zoom-' + img_id).imageTooltip({
                        xOffset: 5,
                        yOffset: 5
                    });
                }

                // Data Tooltip
                // $(".pre_upload_image").tooltip({container: 'body'});
                break;
                // date_range
            case 'daterange':

                InputSelector.daterangepicker({
                    autoApply: (input.auto_apply == 'on') ? true : false,
                    locale: {
                        format: (input.date_formats !== '') ? input.date_formats : "YYYY-MM-DD"
                    },
                    showDropdowns: (input.drop_down == 'on') ? true : false,
                    showWeekNumbers: (input.show_weeks == 'on') ? true : false,
                    timePicker: (input.time_picker == 'on') ? true : false,
                    timePickerIncrement: (input.tp_increment !== '') ? parseInt(input.tp_increment) : '',
                    timePicker24Hour: (input.tp_24hours == 'on') ? true : false,
                    timePickerSeconds: (input.tp_seconds == 'on') ? true : false,
                    drops: (input.open_style !== '') ? input.open_style : 'down',
                    startDate: (input.start_date == '') ? false : input.start_date,
                    endDate: (input.end_date == '') ? false : input.end_date,
                    minDate: (input.min_date == '') ? false : input.min_date,
                    maxDate: (input.max_date == '') ? false : input.max_date,
                });
                break;

                // color: iris
            case 'color':

                InputSelector.css('background-color', input.default_color);
                var iris_options = {
                    'palettes': ppom_get_palette_setting(input),
                    'hide': input.show_onload == 'on' ? false : true,
                    'color': input.default_color,
                    'mode': input.palettes_mode != '' ? input.palettes_mode : 'hsv',
                    'width': input.palettes_width != '' ? input.palettes_width : 200,
                    change: function(event, ui) {


                        InputSelector.css('background-color', ui.color.toString());
                        InputSelector.css('color', '#fff');

                        // Getting Color Code for update price
                        InputSelector.val(ui.color.toString())
                        if (typeof ppomPrice != "undefined") {

                            ppomPrice.init();
                        }
                    }
                }

                InputSelector.iris(iris_options);

                // Following script is added to close picker 
                // when color is picked
                jQuery(document).click(function(e) {
                    if (!jQuery(e.target).is(".ppom-input.color, .iris-picker, .iris-picker-inner")) {
                        jQuery('.ppom-input.color').iris('hide');
                        return e;
                    }
                });

                jQuery('.ppom-input.color').click(function(event) {
                    jQuery('.ppom-input.color').iris('hide');
                    jQuery(this).iris('show');
                    return event;
                });
                break;

                // Palettes
            case 'palettes':

                // $(".ppom-single-palette").tooltip({container: 'body'});
                break;
                // Bulk quantity
            case 'bulkquantity':

                setTimeout(function() { jQuery('.quantity.buttons_added').hide(); }, 50);
                jQuery('form.cart').find('.quantity').hide();

                // setting formatter
                /*if ($('form.cart').closest('div').find('.price').length > 0){
                	wc_price_DOM = $('form.cart').closest('div').find('.price');
                }*/

                ppom_bulkquantity_meta = input.options;

                var min_quantity_value = jQuery('.ppom-bulkquantity-qty').val();

                // Starting value
                ppom_bulkquantity_price_manager(min_quantity_value);
                break;

            case 'pricematrix':

                ppom_pricematrix_discount_type = input.discount_type;

                if (input.show_slider === 'on') {
                    var slider = new Slider('.ppom-range-slide', {
                        formatter: function(value) {
                            jQuery.event.trigger({
                                type: "ppom_range_slider_updated",
                                qty: value,
                                time: new Date()
                            });
                            return ppom_input_vars.text_quantity + ": " + value;
                        }
                    });
                }
                break;
        }


    });
}



function ppom_get_palette_setting(input) {

    var palettes_setting = false;
    // first check if palettes is on
    if (input.show_palettes === 'on') {
        palettes_setting = true;
    }
    if (palettes_setting && input.palettes_colors !== '') {
        palettes_setting = input.palettes_colors.split(',');
    }

    return palettes_setting;
}

function ppom_get_field_type_by_id(field_id) {

    var field_type = '';
    jQuery.each(ppom_input_vars.ppom_inputs, function(i, field) {

        if (field.data_name === field_id) {
            field_type = field.field_type;
            return;
        }
    });

    return field_type;
}

// Get all field meta by id
function ppom_get_field_meta_by_id(field_id) {

    var field_meta = '';
    jQuery.each(ppom_input_vars.ppom_inputs, function(i, field) {

        if (field.data_name === field_id) {
            field_meta = field;
            return;
        }
    });

    return field_meta;
}

function ppom_get_field_meta_by_type(type) {

    var field_meta = Array();
    jQuery.each(ppom_input_vars.ppom_inputs, function(i, field) {

        if (field.type === type) {
            field_meta.push(field);
            return;
        }
    });

    return field_meta;
}

function ppom_bulkquantity_price_manager(quantity) {

    // 	console.log(ppom_bulkquantity_meta);
    jQuery('.ppom-bulkquantity-qty').val(quantity);

    var ppom_base_price = 0;
    jQuery.each(JSON.parse(ppom_bulkquantity_meta), function(idx, obj) {

        var qty_range = obj['Quantity Range'].split('-');
        var qty_range_from = qty_range[0];
        var qty_range_to = qty_range[1];

        if (quantity >= parseInt(qty_range_from) && quantity <= parseInt(qty_range_to)) {

            // Setting Initial Price to 0 and taking base price
            var price = 0;
            ppom_base_price = (obj['Base Price'] == undefined || obj['Base Price'] == '') ? 0 : obj['Base Price'];
            jQuery('.ppom-bulkquantity-options option:selected').attr('data-baseprice', ppom_base_price);

            // Taking selected variation price
            var variation = jQuery('.ppom-bulkquantity-options').val();
            var var_price = obj[variation];
            jQuery('.ppom-bulkquantity-options option:selected').attr('data-price', var_price);
        }

    });

    ppom_update_option_prices();
}
