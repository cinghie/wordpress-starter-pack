<?php

if (!class_exists('WOOCCM_Field_Shipping')) {

  class WOOCCM_Field_Shipping extends WOOCCM_Field_Compatibility {

    const PREFIX = 'shipping';
    const OPTION_NAME = 'wccs_settings2';

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
    );

    public function get_defaults() {
      return $this->default;
    }

  }
}
