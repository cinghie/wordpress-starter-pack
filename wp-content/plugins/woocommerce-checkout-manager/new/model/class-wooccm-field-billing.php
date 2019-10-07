<?php

if (!class_exists('WOOCCM_Field_Billing')) {

  class WOOCCM_Field_Billing extends WOOCCM_Field_Compatibility {

    protected $prefix = 'billing';
    protected $option_name = 'wccs_settings3';
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
        'email',
        'phone'
    );

  }

}