<?php

class WOOCCM_Install {

  public static function install() {

    // Check if we are not already running this routine.
    if ('yes' === get_transient('wooccm_installing')) {
      return;
    }

    // If we made it till here nothing is running yet, lets set the transient now.
    set_transient('wooccm_installing', 'yes', MINUTE_IN_SECONDS * 10);
    set_transient('wooccm-first-rating', true, MONTH_IN_SECONDS);

    wooccm_install();
  }

}
