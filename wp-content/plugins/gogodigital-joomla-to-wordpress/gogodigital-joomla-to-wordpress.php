<?php

/*
Plugin Name: Gogodigital Joomla to Wordpress Plugin
Description: Plugin to migrate Joomla Contents to Wordpress
Author: Gogodigital S.r.l.s.
Author URI: https://www.gogodigital.it
Version: 1.0.0
Text Domain: gogodigital-joomla-to-wordpress
*/

if ( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

class JoomlaToWordpressSettingsPage
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
		add_action('admin_menu', array($this, 'add_plugin_page'));
		add_action('admin_init', array($this, 'page_init'));
		//add_action('init', array($this, 'load_textdomain'));
	}

	/**
	 * Load Text Domain
	 */
	public function load_textdomain()
	{
		load_plugin_textdomain('gogodigital-essentials', false, basename(__DIR__) . '/languages');
	}

	/**
	 * Add options page
	 */
	public function add_plugin_page()
	{
		add_options_page(
			__('Gogodigital Joomla to Wordpress Settings', 'gogodigital-joomla-to-wordpress'),
			'Joomla to Wordpress',
			'manage_options',
			'joomla-to-wordpress-settings',
			array($this, 'create_admin_page')
		);
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page()
	{
		$this->options = get_option('gogodigital_jtw_options');
		?>

        <div class="wrap">
            <div>
                <h1><?php echo __('Joomla to Wordpress Settings', 'gogodigital-joomla-to-wordpress') ?></h1>
                <form method="post" action="options.php">
					<?php
					settings_fields('framework_group');
					do_settings_sections('joomla-to-wordpress-settings');
					submit_button();
					?>
                </form>
            </div>
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
			'gogodigital_jtw_options', // Option name
			array($this, 'sanitize') // Sanitize
		);

		add_settings_section(
			'setting_section_id', // ID
			'', // Title
			array( $this, 'print_section_info' ), // Callback
			'joomla-to-wordpress-settings' // Page
		);

		add_settings_field(
			'table_prefix',  // ID
			__('Table Prefix','gogodigital-cookie-consent'),  // Title
			array( $this, 'table_prefix_callback' ),  // Callback
			'joomla-to-wordpress-settings',  // Page
			'setting_section_id' // Section
		);
	}

	/**
	 * Print the Section text
	 */
	public function print_section_info()
	{
		print 'Enter your settings below:';
	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function table_prefix_callback()
	{
		printf(
			'<input type="text" id="table_prefix" name="gogodigital_jtw_options[table_prefix]" value="%s" />',
			isset( $this->options['table_prefix'] ) ? esc_attr( $this->options['table_prefix']) : ''
		);
	}

}

/*
 * Create Gogodigital Joomla to Wordpress Settings Page
 */
if( is_admin() ) {
	$my_settings_page = new JoomlaToWordpressSettingsPage();
}

/**
 * Get Plugin URL
 *
 * @return string
 */
function gogodigital_joomla_to_wordpress_get_plugin_url()
{
	if ( !function_exists('plugins_url') ) {
		return get_option('siteurl') . '/wp-content/plugins/' . plugin_basename(__DIR__);
	}
	return plugins_url(plugin_basename(__DIR__));
}

/**
 * Settings Button on Plugins Panel
 *
 * @param $links
 * @param $file
 *
 * @return string
 */
function gogodigital_joomla_to_wordpress_plugin_action_links($links, $file)
{
	static $this_plugin;

	if ( ! $this_plugin ) {
		$this_plugin = plugin_basename(__FILE__);
	}

	if ( $file === $this_plugin ) {
		$settings_link = '<a href="options-general.php?page=joomla-to-wordpress-settings">' . __( 'Settings', 'gogodigital-joomla-to-wordpress' ) . '</a>';
		array_unshift( $links, $settings_link );
	}

	return $links;
}

add_filter( 'plugin_action_links', 'gogodigital_joomla_to_wordpress_plugin_action_links', 10, 2 );