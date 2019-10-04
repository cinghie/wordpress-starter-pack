<?php

if (!class_exists('WOOCCM_Field_Additional')) {

  class WOOCCM_Field_Additional extends WOOCCM_Field_Compatibility {

    const PREFIX = 'additional';
    const OPTION_NAME = 'wccs_settings';

    public $default = array();

    public function get_defaults() {
      return $this->default;
    }

  }
}
