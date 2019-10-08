<?php

if (!class_exists('WOOCCM_Field_Additional')) {

  class WOOCCM_Field_Additional extends WOOCCM_Field_Compatibility {

  protected static $_instance;
    protected $prefix = 'additional';
    protected $option_name = 'wccs_settings';

    public static function instance() {
      if (is_null(self::$_instance)) {
        self::$_instance = new self();
      }
      return self::$_instance;
    }

  }

}
