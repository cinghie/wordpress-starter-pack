<?php

/**
 * Starts the logging
 *
 * @since 2.7.0
 * @param string $feed_id
 * @param bool $silent
 */
function wppfm_logger_prepare_logging( $feed_id, $silent ) {
	if ( $feed_id ) {
		WPPFM_Feed_Process_Logging::initiate_feed_process_logging( $feed_id, $silent );
	}
}

add_action( 'wppfm_feed_process_prepared', 'wppfm_logger_prepare_logging', 10, 6 );

/**
 * Adds a message to the logging
 *
 * @since 2.7.0
 * @param string $feed_id
 * @param string $message
 * @param string $tag options are MESSAGE, NOTICE, WARNING and ERROR
 */
function wppfm_logger_handle_feed_generation_message( $feed_id, $message, $tag = 'MESSAGE' ) {
	if ( $feed_id && $message ) {
		WPPFM_Feed_Process_Logging::add_to_feed_process_logging( $feed_id, $message, $tag );
	}
}

add_action( 'wppfm_feed_generation_message', 'wppfm_logger_handle_feed_generation_message', 10, 3 );

function wppfm_logger_feed_queue_filled_message( $feed_id, $nr_products ) {
	if ( $feed_id ) {
		WPPFM_Feed_Process_Logging::add_to_feed_process_logging( $feed_id, sprintf( 'Pushed %s products in the feed queue', $nr_products ) );
	}
}

add_action( 'wppfm_feed_queue_filled', 'wppfm_logger_feed_queue_filled_message', 10, 2 );

function wppfm_logger_started_batch( $feed_id, $memory_limit ) {
	if ( $feed_id ) {
		WPPFM_Feed_Process_Logging::add_to_feed_process_logging( $feed_id, sprintf( 'Started a batch with %s memory available.', $memory_limit ) );
	}
}

add_action( 'wppfm_feed_processing_batch_activated', 'wppfm_logger_started_batch', 10, 2 );

function wppfm_logger_started_product_processing( $feed_id, $product_id ) {
	if ( $feed_id ) {
		WPPFM_Feed_Process_Logging::add_to_feed_process_logging( $feed_id, sprintf( 'Started processing product %s', $product_id ) );
	}
}

add_action( 'wppfm_started_product_processing', 'wppfm_logger_started_product_processing', 10, 2 );

function wppfm_logger_add_product_to_feed_message( $feed_id, $product_id ) {
	if ( $feed_id ) {
		WPPFM_Feed_Process_Logging::add_to_feed_process_logging( $feed_id, sprintf( 'Added product %s to the feed', $product_id ) );
	}
}

add_action( 'wppfm_add_product_to_feed', 'wppfm_logger_add_product_to_feed_message', 10, 2 );

function wppfm_logger_activated_next_batch_message( $feed_id ) {
	if ( $feed_id ) {
		WPPFM_Feed_Process_Logging::add_to_feed_process_logging( $feed_id, 'Starting a next batch' );
	}
}

add_action( 'wppfm_activated_next_batch', 'wppfm_logger_activated_next_batch_message', 10, 1 );

function wppfm_logger_completed_a_feed_message( $feed_id ) {
	if ( $feed_id ) {
		WPPFM_Feed_Process_Logging::add_to_feed_process_logging( $feed_id, 'Completed the feed' );
	}
}

add_action( 'wppfm_complete_a_feed', 'wppfm_logger_completed_a_feed_message', 10, 1 );

function wppfm_logger_processing_stopped_message( $feed_id, $ids_remaining_in_queue ) {
	if ( $feed_id ) {
		WPPFM_Feed_Process_Logging::add_to_feed_process_logging( $feed_id, sprintf( 'Feed processing stopped as the file size did not increase anymore with still %s products in the queue', $ids_remaining_in_queue ), 'ERROR' );
	}
}

add_action( 'wppfm_feed_processing_failed_file_size_stopped_increasing', 'wppfm_logger_processing_stopped_message', 10, 2 );

function wppfm_logger_feed_generation_warning_message( $feed_id, $message ) {
	if ( $feed_id ) {
		if ( is_wp_error( $message ) ) {
			$err_msgs = method_exists( $message, 'get_error_messages' ) ? $message->get_error_messages() : array( 'Error unknown' );
			$message  = ! empty( $err_msgs ) ? implode( ' :: ', $err_msgs ) : 'Error unknown!';
		}

		WPPFM_Feed_Process_Logging::add_to_feed_process_logging( $feed_id, $message, 'WARNING' );
	}
}

add_action( 'wppfm_feed_generation_warning', 'wppfm_logger_feed_generation_warning_message', 10, 2 );

/**
 * Registers when the memory limit of a batch is reached
 *
 * @since 2.7.0
 *
 * @param $feed_id
 * @param $current_memory
 * @param $memory_limit
 */
function wppfm_logger_batch_memory_limit_exceeded( $feed_id, $current_memory, $memory_limit ) {
	$message = sprintf( 'Batch memory limit reached. Currently %s bytes used with a limit of %s bytes.', $current_memory, $memory_limit );

	WPPFM_Feed_Process_Logging::add_to_feed_process_logging( $feed_id, $message );
}

add_action( 'wppfm_batch_memory_limit_exceeded', 'wppfm_logger_batch_memory_limit_exceeded', 10, 3 );

/**
 * Registers when the time limit of a batch is reached
 *
 * @since 2.7.0
 *
 * @param $feed_id
 * @param $time_limit
 */
function wppfm_logger_batch_time_limit_exceeded( $feed_id, $time_limit ) {
	$message = sprintf( 'Batch time limit reached. Current limit is %s seconds', $time_limit );

	WPPFM_Feed_Process_Logging::add_to_feed_process_logging( $feed_id, $message );
}

add_action( 'wppfm_batch_time_limit_exceeded', 'wppfm_logger_batch_time_limit_exceeded', 10, 2 );