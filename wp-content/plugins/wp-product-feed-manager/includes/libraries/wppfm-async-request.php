<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Abstract WPPFM_Async_Request class derived from https://github.com/A5hleyRich/wp-background-processing.
 *
 * @package WPPFM-Background-Processing
 * @abstract
 */
abstract class WPPFM_Async_Request {

	/**
	 * Prefix
	 *
	 * (default value: 'wppfm')
	 *
	 * @var string
	 * @access protected
	 */
	protected $prefix = 'wppfm';

	/**
	 * Action
	 *
	 * (default value: 'async_request')
	 *
	 * @var string
	 */
	protected $action = 'async_request';

	/**
	 * Identifier
	 *
	 * @var mixed
	 */
	protected $identifier;

	/**
	 * Data
	 *
	 * (default value: array())
	 *
	 * @var array
	 */
	protected $data = array();

	/**
	 * File Path
	 *
	 * (default value: empty string)
	 *
	 * @var string
	 */
	protected $file_path = '';

	/**
	 * Contains the general data of the feed
	 *
	 * (default value: empty string)
	 *
	 * @var string
	 */
	protected $feed_data = '';

	/**
	 * Contains general pre feed production data
	 *
	 * @var array
	 */
	protected $pre_data;

	/**
	 * Contains the channels category title and description title
	 *
	 * @var array
	 */
	protected $channel_details;

	/**
	 * Contains the relations between the WooCommerce and channel fields
	 *
	 * @var array
	 */
	protected $relations_table;

	/**
	 * Initiate new async request
	 */
	public function __construct() {
		$this->identifier = $this->prefix . '_' . $this->action;

		add_action( 'wp_ajax_' . $this->identifier, array( $this, 'maybe_handle' ) );
		add_action( 'wp_ajax_nopriv_' . $this->identifier, array( $this, 'maybe_handle' ) );
	}

	/**
	 * Set data used during the request
	 *
	 * @param array $data Data.
	 *
	 * @return $this
	 */
	public function data( $data ) {
		$this->data = $data;

		return $this;
	}

	/**
	 * Dispatch the async request to trigger the feed process with a remote post.
	 */
	public function dispatch() {
		if ( get_option( 'wppfm_disabled_background_mode', 'false' ) === 'false' ) { // start a background process
			$url  = add_query_arg( $this->get_query_args(), $this->get_query_url() );
			$args = $this->get_post_args();

			// activate the background process
			$result = wp_remote_post( esc_url_raw( $url ), $args );

			do_action( 'wppfm_dispatch_result', $result ); // $args->blocking needs to be set to true for this action to provide usable information
		} else { // start a foreground process
			$this->maybe_handle();
		}
	}

	/**
	 * Get query args
	 *
	 * @return array
	 */
	protected function get_query_args() {
		return array(
			'action' => $this->identifier,
			'nonce'  => wp_create_nonce( $this->identifier ),
		);
	}

	/**
	 * Get query URL
	 *
	 * @return string
	 */
	protected function get_query_url() {
		return admin_url( 'admin-ajax.php' );
	}

	/**
	 * Get post args
	 *
	 * @return array
	 */
	protected function get_post_args() {
		return array(
			'timeout'  => 0.01,
			'blocking' => false, // remove if you want to debug the wp_remote_post response
			'body'     => $this->data,
			'cookies'  => stripslashes_deep( $_COOKIE ),
		);
	}

	/**
	 * Maybe handle
	 *
	 * Check for correct nonce and pass to handler.
	 */
	public function maybe_handle() {
		// Don't lock up other requests while processing
		session_write_close();

		check_ajax_referer( $this->identifier, 'nonce' );

		$this->handle();

		wp_die();
	}

	/**
	 * Handle
	 *
	 * Override this method to perform any actions required
	 * during the async request.
	 */
	abstract protected function handle();
}