<?php

if (!class_exists('WOOCCM_Field_Shipping')) {

  class WOOCCM_Field_Shipping extends WOOCCM_Field_Compatibility {

    protected $prefix = 'shipping';
    protected $option_name = 'wccs_settings2';
    protected $defaults = array(
        'country',
        'first_name',
        'last_name',
        'company',
        'address_1',
        'address_2',
        'city',
        'state',
        'postcode',
    );

  }

}
