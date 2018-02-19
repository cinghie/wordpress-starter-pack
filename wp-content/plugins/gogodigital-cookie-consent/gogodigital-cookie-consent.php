<?php

/**
 * Plugin Name: Gogodigital Cookie Consent
 * Plugin URI: http://www.gogodigital.it/development/estensioni/wordpress/wordpress-gogodigital-cookie-consent
 * Description: Adding Cookie Consent script to a Wordpress site
 * Author: Gogodigital S.r.l.s.
 * Author URI: http://www.gogodigital.it
 * Version: 2.1.0
 **/
 
define( 'GOGO_CC_VERSION', '2.1.0' );
define( 'GOGO_CC_PATH', plugin_dir_path(__FILE__) );
define( 'GOGO_CC_URL', plugin_dir_url(__FILE__) );

if ( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
 
class CookieConsentSettingsPage
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
		load_plugin_textdomain('gogodigital-cookie-consent', false, basename( __DIR__ ).'/lang' );
	}
	
    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        add_options_page(
            'Cookie Consent Settings Admin', 
            'Cookie Consent',
            'manage_options', 
            'cookie-consent-settings', 
            array( $this, 'create_admin_page' )
        );
    }
	
    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        $this->options = get_option( 'cookieconsent_options' );
        ?>
        <div class="wrap">
			<div style="border-right: 1px solid #ddd; float: left; padding-right: 2%;  width: 50%">
				<h1><?php echo __('Gogodigital Cookie Consent Settings','gogodigital-cookie-consent') ?></h1>
				<form method="post" action="options.php">
				<?php
					settings_fields( 'cookieconsent_group' );
					do_settings_sections( 'cookie-consent-settings' );
					submit_button();
				?>
				</form>
			</div>
			<div style="float: left; margin-left: 2%; width: 40%">
                <?php include_once( 'sidebar.php' ); ?>
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
            'cookieconsent_group', // Option group
            'cookieconsent_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
		
        add_settings_section(
            'setting_section_id', // ID
            '', // Title
            array( $this, 'print_section_info' ), // Callback
            'cookie-consent-settings' // Page
        );  
		
		add_settings_field(
            'theme',  // ID
			__('Theme','gogodigital-cookie-consent'),  // Title
            array( $this, 'theme_callback' ),  // Callback
            'cookie-consent-settings',  // Page
            'setting_section_id' // Section  
        );      
		
		add_settings_field(
            'message',  // ID
			__('Message','gogodigital-cookie-consent'),  // Title
            array( $this, 'message_callback' ),  // Callback
            'cookie-consent-settings',  // Page
            'setting_section_id' // Section  
        );     
		
        add_settings_field(
            'dismiss_message', // ID
	        __('Dismiss Message','gogodigital-cookie-consent'), // Title
            array( $this, 'dismiss_message_callback' ), // Callback
            'cookie-consent-settings', // Page
            'setting_section_id' // Section           
        );      
		
        add_settings_field(
            'learn_more_message',  // ID
	        __('Learn More Message','gogodigital-cookie-consent'),  // Title
            array( $this, 'learn_more_message_callback' ),  // Callback
            'cookie-consent-settings',  // Page
            'setting_section_id' // Section  
        );      
		
		add_settings_field(
            'privacy_link',  // ID
			__('Privacy Link','gogodigital-cookie-consent'),  // Title
            array( $this, 'privacy_link_callback' ),  // Callback
            'cookie-consent-settings',  // Page
            'setting_section_id' // Section  
        );      
    }
	
    /**
     * Sanitize each setting field as needed
     *
     * @param array $input
     * @return array
     */
    public function sanitize( $input )
    {
        $new_input = array();
		
		if( isset( $input['theme'] ) ) {
			$new_input['theme'] = sanitize_text_field( $input['theme'] );
        }
		
		if( isset( $input['message'] ) ) {
			$new_input['message'] = sanitize_text_field( $input['message'] );
        }
		
        if( isset( $input['dismiss_message'] ) ) {
	        $new_input['dismiss_message'] = sanitize_text_field( $input['dismiss_message'] );
        }
        if( isset( $input['learn_more_message'] ) ) {
	        $new_input['learn_more_message'] = sanitize_text_field( $input['learn_more_message'] );
        }
		
		if( isset( $input['privacy_link'] ) ) {
			$new_input['privacy_link'] = sanitize_text_field( $input['privacy_link'] );
        }
		
        return $new_input;
    }
	
    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        //print 'Enter your settings below:';
    }
	
	/** 
     * Get the settings option array and print one of its values
     */
    public function theme_callback()
    {
		$select  = '<select id="theme" name="cookieconsent_options[theme]" aria-describedby="timezone-description">';
		
		if( $this->options['theme'] === 'dark-bottom' ) {
			$select .= '<option value="dark-bottom" selected="selected">'.__('Dark Bottom','gogodigital-cookie-consent').'</option>';
		} else {
			$select .= '<option value="dark-bottom">'.__('Dark Bottom','gogodigital-cookie-consent').'</option>';
		}
		
		if( $this->options['theme'] === 'dark-floating' ) {
			$select .= '<option value="dark-floating" selected="selected">'.__('Dark Floating','gogodigital-cookie-consent').'</option>';
		} else {
			$select .= '<option value="dark-floating">'.__('Dark Floating','gogodigital-cookie-consent').'</option>';
		}
		
		if( $this->options['theme'] === 'dark-top' ) {
			$select .= '<option value="dark-top" selected="selected">'.__('Dark Top','gogodigital-cookie-consent').'</option>';
		} else {
			$select .= '<option value="dark-top">'.__('Dark Top','gogodigital-cookie-consent').'</option>';
		}
		
		if( $this->options['theme'] === 'light-bottom' ) {
			$select .= '<option value="light-bottom" selected="selected">'.__('Light Bottom','gogodigital-cookie-consent').'</option>';
		} else {
			$select .= '<option value="light-bottom">'.__('Light Bottom','gogodigital-cookie-consent').'</option>';
		}
		
		if( $this->options['theme'] === 'light-floating' ) {
			$select .= '<option value="light-floating" selected="selected">'.__('Light Floating','gogodigital-cookie-consent').'</option>';
		} else {
			$select .= '<option value="light-floating">'.__('Light Floating','gogodigital-cookie-consent').'</option>';
		}
		
		if( $this->options['theme'] === 'light-top' ) {
			$select .= '<option value="light-top" selected="selected">'.__('Light Top','gogodigital-cookie-consent').'</option>';
		} else {
			$select .= '<option value="light-top">'.__('Light Top','gogodigital-cookie-consent').'</option>';
		}
		
		$select .= '</select>';
		
        printf(
            $select,
            isset( $this->options['theme'] ) ? esc_attr( $this->options['theme']) : ''
        );
    }
	
	/** 
     * Get the settings option array and print one of its values
     */
    public function message_callback()
    {
        printf(
            '<input type="text" class="widefat" id="message" name="cookieconsent_options[message]" value="%s" />',
            isset( $this->options['message'] ) ? esc_attr( $this->options['message']) : ''
        );
    }
	
    /** 
     * Get the settings option array and print one of its values
     */
    public function dismiss_message_callback()
    {
        printf(
            '<input type="text" class="widefat" id="dismiss_message" name="cookieconsent_options[dismiss_message]" value="%s" />',
            isset( $this->options['dismiss_message'] ) ? esc_attr( $this->options['dismiss_message']) : ''
        );
    }
	
    /** 
     * Get the settings option array and print one of its values
     */
    public function learn_more_message_callback()
    {
        printf(
            '<input type="text" class="widefat" id="learn_more_message" name="cookieconsent_options[learn_more_message]" value="%s" />',
            isset( $this->options['learn_more_message'] ) ? esc_attr( $this->options['learn_more_message']) : ''
        );
    }
	
	/** 
     * Get the settings option array and print one of its values
     */
    public function privacy_link_callback()
    {
        printf(
            '<input type="text" class="widefat" id="privacy_link" name="cookieconsent_options[privacy_link]" value="%s" />',
            isset( $this->options['privacy_link'] ) ? esc_attr( $this->options['privacy_link']) : ''
        );
    }
}
/*
 * Create Cookie Consent Settings Page
 */
if( is_admin() ) {
	$my_settings_page = new CookieConsentSettingsPage();
}

/**
 * Adding Cookie Consent js
 */
function add_cookieconsent() 
{	
	wp_enqueue_script( 'cookieconsent2-js', gogodigital_cookie_consent_get_plugin_url(). '/assets/js/cookieconsent.min.js', array(), '2.0.0', true );
}

function add_cookieconsent_custom() 
{
	$cookieconsent_options = get_option('cookieconsent_options');
	$cookieconsent_dismiss = $cookieconsent_options["dismiss_message"] ? $cookieconsent_options["dismiss_message"] : 'Got It!';
	$cookieconsent_message = $cookieconsent_options["message"] ? $cookieconsent_options["message"] : 'This website uses cookies to ensure you get the best experience on our website.';
	$cookieconsent_theme   = $cookieconsent_options["theme"] ? $cookieconsent_options["theme"] : 'light-floating';
	$cookieCustom = '<script type="text/javascript">window.cookieconsent_options = {
		"theme": "'.$cookieconsent_theme.'",
		"message": "'.$cookieconsent_message.'",
		"dismiss": "'.$cookieconsent_dismiss.'"';
		
	if(isset($cookieconsent_options["privacy_link"]) && isset($cookieconsent_options["learn_more_message"])) {
		$cookieCustom .= ', 
		"learnMore":"'.$cookieconsent_options["learn_more_message"].'", 
		"link": "'.$cookieconsent_options["privacy_link"].'"';
	}		
	
	$cookieCustom .= '};</script>';
    echo $cookieCustom;
}

add_action( 'wp_enqueue_scripts', 'add_cookieconsent' );
add_action( 'wp_head', 'add_cookieconsent_custom' );

/**
 * Get Plugin URL
 * @return string
 */
function gogodigital_cookie_consent_get_plugin_url()
{
    if ( !function_exists('plugins_url') ) {
	    return get_option('siteurl') . '/wp-content/plugins/' . plugin_basename(__DIR__);
    }
    return plugins_url(plugin_basename(__DIR__));
}

/**
 * Settings Button on Plugins Panel
 */
function gogodigital_cookie_consent_plugin_action_links($links, $file) {
	static $this_plugin;
	if ( ! $this_plugin ) $this_plugin = plugin_basename( __FILE__ );
	if ( $file == $this_plugin ){
		$settings_link = '<a href="options-general.php?page=cookie-consent-settings">' . __( 'Settings', 'gogodigital-cookie-consent' ) . '</a>';
		array_unshift( $links, $settings_link );
	}
	return $links;
}
add_filter( 'plugin_action_links', 'gogodigital_cookie_consent_plugin_action_links', 10, 2 );