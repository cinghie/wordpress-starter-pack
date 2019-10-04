<?php

if (!class_exists('WOOCCM_Field_Billing')) {

  class WOOCCM_Field_Billing extends WOOCCM_Field_Compatibility {

    const PREFIX = 'billing';
    const OPTION_NAME = 'wccs_settings3';

    public $default = array(
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

    public function get_defaults() {
      return $this->default;
    }

  }
}
