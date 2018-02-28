<?php

/**
 * Plugin Name: Gogodigital Essentials
 * Plugin URI: https://wordpress.org/plugins/gogodigital-essentials
 * Description: Manage Essentials settings on your Wordpress site
 * Author: Gogodigital S.r.l.s.
 * Author URI: https://www.gogodigital.it
 * Version: 2.0.0
 * Text Domain: gogodigital-essentials
 **/

define( 'GOGO_ESSENTIALS_VERSION', '2.0.0' );
define( 'GOGO_ESSENTIALS_PATH', plugin_dir_path(__FILE__) );
define( 'GOGO_ESSENTIALS_URL', plugin_dir_url(__FILE__) );

if ( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

class EssentialsSettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
	    add_action( 'init', array( $this, 'load_textdomain' ) );
    }

	public function load_textdomain() {
		load_plugin_textdomain('gogodigital-essentials', false, basename( __DIR__ ).'/languages' );
	}

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        add_options_page(
	        __( 'Gogodigital Essentials Settings', 'gogodigital-essentials' ),
            'Essentials',
            'manage_options',
            'essentials-settings',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        $this->options = get_option( 'essentials_options' );
        ?>
        <div class="wrap">
            <div style="border-right: 1px solid #ddd; float: left; padding-right: 2%;  width: 50%">
                <h1><?php echo  __( 'Gogodigital Essentials Settings', 'gogodigital-essentials' ) ?></h1>
                <form method="post" action="options.php">
                    <?php
                    settings_fields( 'framework_group' );
                    do_settings_sections( 'template-settings' );
                    submit_button();
                    ?>
                </form>
            </div>
            <div style="float: left; margin-left: 2%; width: 40%">
	            <?php include_once 'sidebar.php' ?>
                <h3 style="border-top: 1px solid #ddd; padding-top: 12px"><?php echo  __( 'Widget Settings', 'gogodigital-essentials' ) ?></h3>
                <p><?php echo  __( 'Remember to add manually the Widget Code on your Wordpress Theme', 'gogodigital-essentials' ) ?></p>
                <p class="description" id="tagline-description" style="background-color: #fcf8e3; border-color: #faebcc; border-radius: 4px; color: #8a6d3b; padding: 10px">
                    if ( is_active_sidebar( 'footer-copyright' ) ) { dynamic_sidebar( 'footer-copyright' ); }
                </p>
                <p class="description" id="tagline-description" style="background-color: #fcf8e3; border-color: #faebcc; border-radius: 4px; color: #8a6d3b; padding: 10px">
                    <a href="https://github.com/cinghie/wordpress-gogo-essentials/blob/master/docs/footer_top_position.md" target="_blank">Footer Copyright Top Example</a>
                </p>
                <p class="description" id="tagline-description" style="background-color: #fcf8e3; border-color: #faebcc; border-radius: 4px; color: #8a6d3b; padding: 10px">
                    if ( is_active_sidebar( 'social-icons' ) ) { dynamic_sidebar( 'social-icons' ); }
                </p>
            </div>
            <div style="clear: both"></div>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
	    register_setting(
            'framework_group', // Option group
            'essentials_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

	    /**
	     * Framework Settinga
	     */
        add_settings_section(
            'template_settings_id', // ID
	        __( 'Framework Settings', 'gogodigital-essentials' ), // Title
            array( $this, 'print_framework_info' ), // Callback
            'template-settings' // Page
        );

        add_settings_field(
            'bootstrap',
	        __( 'Load Bootstrap', 'gogodigital-essentials' ),
            array( $this, 'bootstrap_callback' ),
            'template-settings',
            'template_settings_id'
        );

        add_settings_field(
            'fontawesome',
	        __( 'Load Fontawesome', 'gogodigital-essentials' ),
            array( $this, 'fontawesome_callback' ),
            'template-settings',
            'template_settings_id'
        );

        add_settings_field(
            'jqueryui',
	        __( 'Load jQuery UI', 'gogodigital-essentials' ),
            array( $this, 'jqueryui_callback' ),
            'template-settings',
            'template_settings_id'
        );

        add_settings_field(
            'jquerymobile',
	        __( 'Load jQuery Mobile', 'gogodigital-essentials' ),
            array( $this, 'jquerymobile_callback' ),
            'template-settings',
            'template_settings_id'
        );

        add_settings_field(
            'googlefonts',
	        __( 'Load Google Fonts', 'gogodigital-essentials' ),
            array( $this, 'googlefonts_callback' ),
            'template-settings',
            'template_settings_id'
        );

	    /**
	     * Miscellaneous Settinga
	     */
	    add_settings_section(
		    'miscellaneous_settings_id', // ID
		    __( 'Miscellaneous Settings', 'gogodigital-essentials' ), // Title
		    [], // Callback
		    'template-settings' // Page
	    );

	    add_settings_field(
		    'googleanalytics',
		    __( 'Google Analytics Code', 'gogodigital-essentials' ),
		    array( $this, 'googleanalytics_callback' ),
		    'template-settings',
		    'miscellaneous_settings_id'
	    );

	    add_settings_field(
		    'themeupdate',
		    __( 'Disable Theme Update', 'gogodigital-essentials' ),
		    array( $this, 'themeupdate_callback' ),
		    'template-settings',
		    'miscellaneous_settings_id'
	    );

	    /**
	     * Widget Settinga
	     */
        add_settings_section(
            'widget_settings_id', // ID
	        __( 'Widget Settings', 'gogodigital-essentials' ), // Title
            array( $this, 'print_widget_info' ), // Callback
            'template-settings' // Page
        );

        add_settings_field(
            'widgetcopyright',
	        __( 'Copyright Widget Position', 'gogodigital-essentials' ),
            array( $this, 'widgetcopyright_callback' ),
            'template-settings',
            'widget_settings_id'
        );

        add_settings_field(
            'widgetcopyrighttop',
	        __( 'Copyright Top Widget Position', 'gogodigital-essentials' ),
            array( $this, 'widgetcopyrighttop_callback' ),
            'template-settings',
            'widget_settings_id'
        );

        add_settings_field(
            'widgetsocialicons',
	        __( 'Social Icons Widget Position', 'gogodigital-essentials' ),
            array( $this, 'widgetsocialicons_callback' ),
            'template-settings',
            'widget_settings_id'
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     *
     * @return array
     */
    public function sanitize( $input )
    {
        $new_input = array();

        if( isset( $input['bootstrap'] ) ) {
	        $new_input['bootstrap'] = sanitize_text_field( $input['bootstrap'] );
        }

        if( isset( $input['fontawesome'] ) ) {
            $new_input['fontawesome'] = sanitize_text_field( $input['fontawesome'] );
        }

        if( isset( $input['jqueryui'] ) ) {
            $new_input['jqueryui'] = sanitize_text_field( $input['jqueryui'] );
        }

        if( isset( $input['jquerymobile'] ) ) {
            $new_input['jquerymobile'] = sanitize_text_field( $input['jquerymobile'] );
        }

        if( isset( $input['googlefonts'] ) ) {
            $new_input['googlefonts'] = sanitize_text_field( $input['googlefonts'] );
        }

	    if( isset( $input['googleanalytics'] ) ) {
		    $new_input['googleanalytics'] = sanitize_text_field( $input['googleanalytics'] );
	    }

	    if( isset( $input['themeupdate'] ) ) {
		    $new_input['themeupdate'] = sanitize_text_field( $input['themeupdate'] );
	    }

        if( isset( $input['widgetcopyright'] ) ) {
            $new_input['widgetcopyright'] = sanitize_text_field( $input['widgetcopyright'] );
        }

        if( isset( $input['widgetcopyrighttop'] ) ) {
            $new_input['widgetcopyrighttop'] = sanitize_text_field( $input['widgetcopyrighttop'] );
        }

        if( isset( $input['widgetsocialicons'] ) ) {
            $new_input['widgetsocialicons'] = sanitize_text_field( $input['widgetsocialicons'] );
        }

        return $new_input;
    }

    /**
     * Print the Framework Settings text
     */
    public function print_framework_info()
    {
        print __( 'Select which <strong>Framework</strong> do you wanna load on your Wordpress Theme', 'gogodigital-essentials' );
    }

    /**
     * Print the Widget Settings text
     */
    public function print_widget_info()
    {
	    print __( 'Select which <strong>Widget Position</strong> do you wanna register on your Wordpress Theme Widget', 'gogodigital-essentials' );
    }

	/**
	 * Print the Widget Examples text
	 */
	public function print_widget_examples()
	{
		print '<h3 style="border-top: 1px solid #ddd; padding-top: 12px">Widget Settings</h3>
                <p>Remember to add manually the Widget Code on your Wordpress Theme</p>
                <p class="description" id="tagline-description" style="background-color: #fcf8e3; border-color: #faebcc; border-radius: 4px; color: #8a6d3b; padding: 10px">
                    if ( is_active_sidebar( \'footer-copyright\' ) ) { dynamic_sidebar( \'footer-copyright\' ); }
                </p>
                <p class="description" id="tagline-description" style="background-color: #fcf8e3; border-color: #faebcc; border-radius: 4px; color: #8a6d3b; padding: 10px">
                    <a href="https://github.com/cinghie/wordpress-gogo-essentials/blob/master/docs/footer_top_position.md" target="_blank">Footer Copyright Top Example</a>
                </p>
                <p class="description" id="tagline-description" style="background-color: #fcf8e3; border-color: #faebcc; border-radius: 4px; color: #8a6d3b; padding: 10px">
                    if ( is_active_sidebar( \'social-icons\' ) ) { dynamic_sidebar( \'social-icons\' ); }
                </p>';
	}

	/**
     * Get the settings option array and print one of its values
     */
    public function bootstrap_callback()
    {
        $select  = '<select id="bootstrap" name="essentials_options[bootstrap]">';

        if( $this->options['bootstrap'] === 'not-load' ) {
            $select .= '<option value="not-load" selected="selected">'.__( 'Not Load Bootstrap', 'gogodigital-essentials' ).'</option>';
        } else {
            $select .= '<option value="not-load">'.__( 'Not Load Bootstrap', 'gogodigital-essentials' ).'</option>';
        }

	    if( $this->options['bootstrap'] === 'load-4.0.0' ) {
		    $select .= '<option value="load-4.0.0" selected="selected">'.__( 'Load Bootstrap', 'gogodigital-essentials' ).' 4.0.0</option>';
	    } else {
		    $select .= '<option value="load-4.0.0">'.__( 'Load Bootstrap', 'gogodigital-essentials' ).' 4.0.0</option>';
	    }

        if( $this->options['bootstrap'] === 'load-3.3.7' ) {
            $select .= '<option value="load-3.3.7" selected="selected">'.__( 'Load Bootstrap', 'gogodigital-essentials' ).' 3.3.7</option>';
        } else {
            $select .= '<option value="load-3.3.7">'.__( 'Load Bootstrap', 'gogodigital-essentials' ).' 3.3.7</option>';
        }

        $select .= '</select>';

        printf(
            $select,
            isset( $this->options['bootstrap'] ) ? esc_attr( $this->options['bootstrap']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function fontawesome_callback()
    {
        $select  = '<select id="fontawesome" name="essentials_options[fontawesome]">';

        if( $this->options['fontawesome'] === 'not-load' ) {
            $select .= '<option value="not-load" selected="selected">'.__( 'Not Load Fontawesome', 'gogodigital-essentials' ).'</option>';
        } else {
            $select .= '<option value="not-load">'.__( 'Not Load Fontawesome', 'gogodigital-essentials' ).'</option>';
        }

	    if( $this->options['fontawesome'] === 'load-5.0.6' ) {
		    $select .= '<option value="load-5.0.6" selected="selected">'.__( 'Load Fontawesome', 'gogodigital-essentials' ).' 5.0.6</option>';
	    } else {
		    $select .= '<option value="load-5.0.6">'.__( 'Load Fontawesome', 'gogodigital-essentials' ).' 5.0.6</option>';
	    }

        if( $this->options['fontawesome'] === 'load-4.7.0' ) {
            $select .= '<option value="load-4.7.0"" selected="selected">'.__( 'Load Fontawesome', 'gogodigital-essentials' ).' 4.7.0</option>';
        } else {
            $select .= '<option value="load-4.7.0"">'.__( 'Load Fontawesome', 'gogodigital-essentials' ).' 4.7.0</option>';
        }

        $select .= '</select>';

        printf(
            $select,
            isset( $this->options['fontawesome'] ) ? esc_attr( $this->options['fontawesome']) : ''
        );
    }

	/**
	 * Get the settings option array and print one of its values
	 */
	public function jqueryui_callback()
	{
		$select  = '<select id="jqueryui" name="essentials_options[jqueryui]">';

		if( $this->options['jqueryui'] === 'not-load' ) {
			$select .= '<option value="not-load" selected="selected">'.__( 'Not Load jQuery UI', 'gogodigital-essentials' ).'</option>';
		} else {
			$select .= '<option value="not-load">'.__( 'Not Load jQuery UI', 'gogodigital-essentials' ).'</option>';
		}

		if( $this->options['jqueryui'] === 'load-1.12.1' ) {
			$select .= '<option value="load-1.12.1" selected="selected">'.__( 'Load jQuery UI', 'gogodigital-essentials' ).' 1.12.1</option>';
		} else {
			$select .= '<option value="load-1.12.1">'.__( 'Load jQuery UI', 'gogodigital-essentials' ).' 1.12.1</option>';
		}

		$select .= '</select>';

		printf(
			$select,
			isset( $this->options['jqueryui'] ) ? esc_attr( $this->options['jqueryui']) : ''
		);
	}

    /**
     * Get the settings option array and print one of its values
     */
    public function jquerymobile_callback()
    {
        $select  = '<select id="jquerymobile" name="essentials_options[jquerymobile]">';

        if( $this->options['jquerymobile'] === 'not-load' ) {
            $select .= '<option value="not-load" selected="selected">'.__( 'Not Load jQuery Mobile', 'gogodigital-essentials' ).'</option>';
        } else {
            $select .= '<option value="not-load">'.__( 'Not Load jQuery Mobile', 'gogodigital-essentials' ).'</option>';
        }

        if( $this->options['jquerymobile'] === 'load-1.4.5' ) {
            $select .= '<option value="load-1.4.5" selected="selected">'.__( 'Load jQuery Mobile', 'gogodigital-essentials' ).' 1.4.5</option>';
        } else {
            $select .= '<option value="load-1.4.5">'.__( 'Load jQuery Mobile', 'gogodigital-essentials' ).' 1.4.5</option>';
        }

        $select .= '</select>';

        printf(
            $select,
            isset( $this->options['jquerymobile'] ) ? esc_attr( $this->options['jquerymobile']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function googlefonts_callback()
    {
        printf(
            '<input type="text" class="widefat" id="googlefonts" name="essentials_options[googlefonts]" value="%s" />
             <p class="description" id="tagline-description">'.__( 'Comma separated Fonts like "Open Sans,Roboto"', 'gogodigital-essentials' ).'</p>',
            isset( $this->options['googlefonts'] ) ? esc_attr( $this->options['googlefonts']) : ''
        );
    }

	/**
	 * Get the settings option array and print one of its values
	 */
	public function googleanalytics_callback()
	{
		printf(
			'<input type="text" class="widefat" id="googleanalytics" name="essentials_options[googleanalytics]" value="%s" />
             <p class="description" id="tagline-description">'.__( 'Example: UA-XXXXX-Y', 'gogodigital-essentials' ).'</p>',
			isset( $this->options['googleanalytics'] ) ? esc_attr( $this->options['googleanalytics']) : ''
		);
	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function themeupdate_callback()
	{
		$select  = '<select id="themeupdate" name="essentials_options[themeupdate]">';

		if( $this->options['themeupdate'] === 'no' ) {
			$select .= '<option value="no" selected="selected">'.__( 'No', 'gogodigital-essentials' ).'</option>';
		} else {
			$select .= '<option value="no">'.__( 'No', 'gogodigital-essentials' ).'</option>';
		}

		if( $this->options['themeupdate'] === 'yes' ) {
			$select .= '<option value="yes" selected="selected">'.__( 'Yes', 'gogodigital-essentials' ).'</option>';
		} else {
			$select .= '<option value="yes">'.__( 'Yes', 'gogodigital-essentials' ).'</option>';
		}

		$select .= '</select>';

		printf(
			$select,
			isset( $this->options['themeupdate'] ) ? esc_attr( $this->options['themeupdate']) : ''
		);
	}

    /**
     * Get the settings option array and print one of its values
     */
    public function widgetcopyright_callback()
    {
        $select  = '<select id="widgetcopyright" name="essentials_options[widgetcopyright]" aria-describedby="widget-copyright">';

        if( $this->options['widgetcopyright'] === 'not-active' ) {
            $select .= '<option value="not-active" selected="selected">'.__( 'Not Active', 'gogodigital-essentials' ).'</option>';
        } else {
            $select .= '<option value="not-active">'.__( 'Not Active', 'gogodigital-essentials' ).'</option>';
        }

        if( $this->options['widgetcopyright'] === 'active' ) {
            $select .= '<option value="active" selected="selected">'.__( 'Active', 'gogodigital-essentials' ).'</option>';
        } else {
            $select .= '<option value="active">'.__( 'Active', 'gogodigital-essentials' ).'</option>';
        }

        $select .= '</select>';

        printf(
            $select,
            isset( $this->options['widgetcopyright'] ) ? esc_attr( $this->options['widgetcopyright']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function widgetcopyrighttop_callback()
    {
        $select  = '<select id="widgetcopyrighttop" name="essentials_options[widgetcopyrighttop]" aria-describedby="widget-copyright-top">';

        if( $this->options['widgetcopyrighttop'] === 'not-active' ) {
            $select .= '<option value="not-active" selected="selected">'.__( 'Not Active', 'gogodigital-essentials' ).'</option>';
        } else {
            $select .= '<option value="not-active">'.__( 'Not Active', 'gogodigital-essentials' ).'</option>';
        }

        if( $this->options['widgetcopyrighttop'] === 'active' ) {
            $select .= '<option value="active" selected="selected">'.__( 'Active', 'gogodigital-essentials' ).'</option>';
        } else {
            $select .= '<option value="active">'.__( 'Active', 'gogodigital-essentials' ).'</option>';
        }

        $select .= '</select>';

        printf(
            $select,
            isset( $this->options['widgetcopyrighttop'] ) ? esc_attr( $this->options['widgetcopyrighttop']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function widgetsocialicons_callback()
    {
        $select  = '<select id="widgetsocialicons" name="essentials_options[widgetsocialicons]" aria-describedby="widget-social-icons">';

        if( $this->options['widgetsocialicons'] === 'not-active' ) {
            $select .= '<option value="not-active" selected="selected">'.__( 'Not Active', 'gogodigital-essentials' ).'</option>';
        } else {
            $select .= '<option value="not-active">'.__( 'Not Active', 'gogodigital-essentials' ).'</option>';
        }

        if( $this->options['widgetsocialicons'] === 'active' ) {
            $select .= '<option value="active" selected="selected">'.__( 'Active', 'gogodigital-essentials' ).'</option>';
        } else {
            $select .= '<option value="active">'.__( 'Active', 'gogodigital-essentials' ).'</option>';
        }

        $select .= '</select>';

        printf(
            $select,
            isset( $this->options['widgetsocialicons'] ) ? esc_attr( $this->options['widgetsocialicons']) : ''
        );
    }
}

/*
 * Create WP Gogo Essentials Page
 */
if( is_admin() )  {
    $my_settings_page = new EssentialsSettingsPage();
}

/*
 * Implementing Params
 */

$essentials_options = get_option('essentials_options');

// Load Bootstrap
if( isset( $essentials_options['bootstrap'] ) ) {
    if ( $essentials_options['bootstrap'] === 'load-3.3.7' ) {
        add_action('wp_enqueue_scripts', 'theme_add_bootstrap_337');
    } elseif( $essentials_options['bootstrap'] === 'load-4.0.0' ) {
        add_action('wp_enqueue_scripts', 'theme_add_bootstrap_400');
    }
}

// Load Fontawesome
if( isset( $essentials_options['fontawesome'] ) ) {
    if ( $essentials_options['fontawesome'] === 'load-4.7.0' ) {
        add_action('wp_enqueue_scripts', 'theme_add_fontawesome_470');
    } elseif( $essentials_options['fontawesome'] === 'load-5.0.6' ) {
        add_action('wp_enqueue_scripts', 'theme_add_fontawesome_506');
    }
}

// Load jQuery UI
if( isset( $essentials_options['jqueryui'] ) ) {
    if ( $essentials_options['jqueryui'] === 'load-1.12.1' ) {
        add_action('wp_enqueue_scripts', 'theme_add_jqueryui');
    }
}

// Load jQuery Mobile
if( isset( $essentials_options['jquerymobile'] ) ) {
    if ( $essentials_options['jquerymobile'] === 'load-1.4.5' ) {
        add_action('wp_enqueue_scripts', 'theme_add_jquerymobile');
    }
}

// Load Google Fonts
if( isset( $essentials_options['googlefonts'] ) ) {
	$googlefonts = str_replace(array( ' ', ',' ), array( '+', '|' ), $essentials_options['googlefonts']);
	$googlefonts = 'https://fonts.googleapis.com/css?family=' . $googlefonts;

    if ( $essentials_options['googlefonts'] !== '' ) {
        add_action('wp_enqueue_scripts', 'theme_add_googlefonts');
    }
}

// Load Google Analytics
if( isset( $essentials_options['googleanalytics'] ) ) {
	if ( $essentials_options['googleanalytics'] !== '' ) {
		add_action( 'wp_head', 'add_google_analytics' );
	}
}

// Disable Theme Update
if( isset( $essentials_options['themeupdate'] ) ) {
	if ( $essentials_options['themeupdate'] === 'yes' ) {
		add_filter( 'http_request_args', function ( $response, $url ) {
			if ( 0 === strpos( $url, 'https://api.wordpress.org/themes/update-check' ) ) {
				$themes = json_decode( $response['body']['themes'] );
				unset( $themes->themes->{get_option( 'template' )} );
				unset( $themes->themes->{get_option( 'stylesheet' )} );
				$response['body']['themes'] = json_encode( $themes );
			}
			return $response;
		}, 10, 2 );
	}
}

// Load Copyright Widget Position
if( isset( $essentials_options['widgetcopyright'] ) ) {
    if ( $essentials_options['widgetcopyright'] === 'active' ) {
        add_action( 'widgets_init', 'footer_copyright_widgets_init' );
    }
}

// Load Copyright Top Widget Position
if( isset( $essentials_options['widgetcopyrighttop'] ) ) {
    if ( $essentials_options['widgetcopyrighttop'] === 'active' ) {
        add_action( 'widgets_init', 'footer_copyright_top1_widgets_init' );
        add_action( 'widgets_init', 'footer_copyright_top2_widgets_init' );
        add_action( 'widgets_init', 'footer_copyright_top3_widgets_init' );
        add_action( 'widgets_init', 'footer_copyright_top4_widgets_init' );
    }
}

// Load Social Icons Widget Position
if( isset( $essentials_options['widgetsocialicons'] ) ) {
    if ( $essentials_options['widgetsocialicons'] === 'active' ) {
        add_action( 'widgets_init', 'socialicons_widgets_init' );
    }
}

/**
 * Adding Bootstrap 3.3.7 css and js
 */
function theme_add_bootstrap_337()
{
	wp_enqueue_style( 'bootstrap', gogodigital_essentials_get_plugin_url() . '/assets/bootstrap/3.3.7/bootstrap.min.css', array(), '3.3.7');
	wp_enqueue_script( 'bootstrap', gogodigital_essentials_get_plugin_url(). '/assets/bootstrap/3.3.7/bootstrap.min.js', array(), '3.3.7', true );
}

/**
 * Adding Bootstrap 4.0.0 css and js from CDN
 */
function theme_add_bootstrap_400()
{
	wp_enqueue_style( 'bootstrap', gogodigital_essentials_get_plugin_url() . '/assets/bootstrap/4.0.0/bootstrap.min.css', array(), '4.0.0');
	wp_enqueue_script( 'bootstrap', gogodigital_essentials_get_plugin_url(). '/assets/bootstrap/4.0.0/bootstrap.min.js', array(), '4.0.0', true );
}

/**
 * Adding Fontawesome 4.0.7 css and js
 */
function theme_add_fontawesome_470()
{
	wp_enqueue_style( 'fontawesome', gogodigital_essentials_get_plugin_url() . '/assets/fontawesome/4.7.0/font-awesome.min.css', array(), '4.7.0');
}

/**
 * Adding Fontawesome 5.0.6 css and js
 */
function theme_add_fontawesome_506()
{
	wp_enqueue_style( 'fontawesome', gogodigital_essentials_get_plugin_url() . '/assets/fontawesome/5.0.6/fontawesome.min.css', array(), '5.0.6');
}

/**
 * Adding jQuery UI 1.12.1 css and js
 */
function theme_add_jqueryui()
{
	wp_enqueue_style( 'jqueryui', gogodigital_essentials_get_plugin_url() . '/assets/jqueryui/jquery-ui.min.css', array(), '1.12.1');
	wp_enqueue_script( 'jqueryui', gogodigital_essentials_get_plugin_url(). '/assets/jqueryui/jquery-ui.min.js', array(), '1.12.1', true );
}

/**
 * Adding jQuery Mobile 1.4.5 css and js
 */
function theme_add_jquerymobile()
{
    wp_enqueue_style( 'jquerymobile', gogodigital_essentials_get_plugin_url() . '/assets/jquerymobile/jquery.mobile-1.4.5.min.css', array(), '1.4.5');
    wp_enqueue_script( 'jquerymobile', gogodigital_essentials_get_plugin_url(). '/assets/jquerymobile/jquery.mobile-1.4.5.min.js', array(), '1.4.5', true );
}

/**
 * Adding Google Fonts css
 */
function theme_add_googlefonts()
{
    global $googlefonts;
    wp_enqueue_style( 'googlefonts', $googlefonts, false);
}

/**
 * Adding Google Analytics js
 */
function add_google_analytics()
{
	global $essentials_options;
	$googleanalytics = $essentials_options['googleanalytics'];

	$googleAnalyticsCode = "<script async src='https://www.google-analytics.com/analytics.js'></script>
<script>
window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
ga('create', '".$googleanalytics."', 'auto');
ga('send', 'pageview');
</script>";

	echo $googleAnalyticsCode;
}

/*
 * Adding Copyright Widget Position
 */
function footer_copyright_widgets_init()
{
    register_sidebar( array(
        'name'          => 'Footer Copyright',
        'id'            => 'footer-copyright',
        'before_widget' => '<div class="widget-copyright">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );
}

/*
 * Adding Copyright Top1 Widget Position
 */
function footer_copyright_top1_widgets_init()
{
    register_sidebar( array(
        'name'          => 'Footer Copyright Top1',
        'id'            => 'footer-copyright-top1',
        'before_widget' => '<div class="widget-copyright-top1">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="rounded">',
        'after_title'   => '</h3>',
    ) );
}

/*
 * Adding Copyright Top2 Widget Position
 */
function footer_copyright_top2_widgets_init()
{
    register_sidebar( array(
        'name'          => 'Footer Copyright Top2',
        'id'            => 'footer-copyright-top2',
        'before_widget' => '<div class="widget-copyright-top2">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="rounded">',
        'after_title'   => '</h3>',
    ) );
}

/*
 * Adding Copyright Top3 Widget Position
 */
function footer_copyright_top3_widgets_init()
{
    register_sidebar( array(
        'name'          => 'Footer Copyright Top3',
        'id'            => 'footer-copyright-top3',
        'before_widget' => '<div class="widget-copyright-top3">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="rounded">',
        'after_title'   => '</h3>',
    ) );
}

/*
 * Adding Copyright Top4 Widget Position
 */
function footer_copyright_top4_widgets_init()
{
    register_sidebar( array(
        'name'          => 'Footer Copyright Top4',
        'id'            => 'footer-copyright-top4',
        'before_widget' => '<div class="widget-copyright-top4">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="rounded">',
        'after_title'   => '</h3>',
    ) );
}

/*
 * Adding Social Icons Widget Position
 */
function socialicons_widgets_init()
{
    register_sidebar( array(
        'name'          => 'Social Icons',
        'id'            => 'social-icons',
        'before_widget' => '<div class="widget-social-icons">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );
}

/**
 * Get Plugin URL
 *
 * @return string
 */
function gogodigital_essentials_get_plugin_url()
{
    if ( !function_exists('plugins_url') ) {
	    return get_option('siteurl') . '/wp-content/plugins/' . plugin_basename( __DIR__ );
    }

    return plugins_url(plugin_basename( __DIR__ ));
}

/**
 * Settings Button on Plugins Panel
 *
 * @param $links
 * @param $file
 *
 * @return mixed
 */
function gogodigital_essentials_plugin_action_links($links, $file) {

	static $this_plugin;
	if ( ! $this_plugin ) $this_plugin = plugin_basename( __FILE__ );

	if ( $file === $this_plugin ) {
		$settings_link = '<a href="options-general.php?page=essentials-settings">' . __( 'Settings', 'gogodigital-essentials' ) . '</a>';
		array_unshift( $links, $settings_link );
	}

	return $links;

}
add_filter( 'plugin_action_links', 'gogodigital_essentials_plugin_action_links', 10, 2 );
