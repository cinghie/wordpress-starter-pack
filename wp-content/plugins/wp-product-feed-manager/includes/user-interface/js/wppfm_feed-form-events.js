jQuery(document).ready( function( $ ) {
    // monitor the four main feed settings and react when they change
    $( '#file-name' ).focusout( function () {
        if ( '' !== $( '#file-name' ).val() ) {
            $( '#countries' ).prop( 'disabled', false );
            $( '#lvl_0' ).prop( 'disabled', false );
			wppfm_validateFileName();
			
			if ( '0' !== $( '#merchants' ).val() ) {
				wppfm_showChannelInputs( $( '#merchants' ).val(), true );
				wppfm_mainInputChanged( false );
			} else {
				wppfm_hideFeedFormMainInputs();
			}
        } else {
            $( '#countries' ).prop( 'disabled', true );
            $( '#lvl_0' ).prop( 'disabled', true );
        }
    } );

    $( '#file-name' ).keyup( function () {

        if ( '' !== $( '#file-name' ).val() ) {
            $( '#countries' ).prop( 'disabled', false );
            $( '#lvl_0' ).prop( 'disabled', false );
        } else {
            $( '#countries' ).prop( 'disabled', true );
            $( '#lvl_0' ).prop( 'disabled', true );
        }
    } );

    $( '#countries' ).change( function () {
        if ( '0' !== $( '#countries' ).val() ) { $( '#lvl_0' ).prop( 'disabled', false ); }

        wppfm_mainInputChanged( false );
    } );
	
	$( '#language' ).change( function () { wppfm_feed_language_changed(); } );
	
	$( '#google-feed-title-selector' ).change( function() { wppfm_google_feed_title_changed(); } );
	
	$( '#google-feed-description-selector' ).change( function() { wppfm_google_feed_description_changed(); } );
    
    $( '#merchants' ).change( function () {
        if ( '0' !== $( '#merchants' ).val() && '' !== $( '#file-name' ).val() ) {
            wppfm_showChannelInputs( $( '#merchants' ).val(), true );
            wppfm_mainInputChanged( false );
        } else {
            wppfm_hideFeedFormMainInputs();
        }
    } );
	
	$( '#variations' ).change( function () { wppfm_variation_selection_changed(); } );
    
    $( '#aggregator' ).change( function() {
		wppfm_aggregatorChanged();
		wppfm_makeFieldsTable(); // reset the attribute mapping
    } );

    $( '#lvl_0' ).change( function () { wppfm_mainInputChanged( true ); } );

    $( '.cat_select' ).change( function () { wppfm_nextCategory( this.id ); } );
    
    $( '#wppfm-generate-feed-button-top' ).click( function () { wppfm_generateFeed(); } );

    $( '#wppfm-generate-feed-button-bottom' ).click( function () { wppfm_generateFeed(); } );
	
	$( '#wppfm-save-feed-button-top' ).click( function() { wppfm_saveFeedData(); } );

	$( '#wppfm-save-feed-button-bottom' ).click( function() { wppfm_saveFeedData(); } );

    $( '#days-interval' ).change( function () { wppfm_saveUpdateSchedule(); } );

    $( '#update-schedule-hours' ).change( function () { wppfm_saveUpdateSchedule(); } );

    $( '#update-schedule-minutes' ).change( function () { wppfm_saveUpdateSchedule(); } );
    
	$( '#update-schedule-frequency' ).change( function () { wppfm_saveUpdateSchedule(); } );
	
	$( '#wppfm_auto_feed_fix_mode' ).change( function () { wppfm_auto_feed_fix_changed(); } );
	
	$( '#wppfm_background_processing_mode' ).change( function() {
		wppfm_clear_feed_process();
		wppfm_background_processing_mode_changed(); 
	} );
	
	$( '#wppfm_third_party_attr_keys' ).focusout( function() { wppfm_third_party_attributes_changed(); } );
	
	$( '#wppfm_notice_mailaddress' ).focusout( function() { wppfm_notice_mailaddress_changed(); } );

	$( '#wppfm-clear-feed-process-button' ).click( function() { wppfm_clear_feed_process(); } );
	
	$( '#wppfm-reinitiate-plugin-button' ).click( function() { wppfm_reinitiate(); } );
    
    $( '.category-mapping-selector' ).change( function() {
        if ( $(this).is(":checked") ) { wppfm_activateFeedCategory( $(this).val() ); } 
		else { wppfm_deactivateFeedCategory( $(this).val() ); }
    } );
	
	$( '#categories-select-all' ).change( function() {
        if ( $(this).is(":checked") ) { wppfm_activateFeedCategory( 'wppfm_all_categories_selected' ); } 
		else { wppfm_deactivateFeedCategory( 'wppfm_all_categories_selected' ); }
	} );
    
    $( '#wppfm_accept_eula' ).change( function() {
        if ( $(this).is(":checked") ) { $( '#wppfm_license_activate' ).prop( 'disabled', false ); } 
		else { $( '#wppfm_license_activate' ).prop( 'disabled', true ); }
    } );
	
    //$( '.edit-output' ).click( function () { wppfm_editOutput( this.id ); } ); TODO: Hier nog verder naar zoeken. De this.id zou de id van de link op moeten pakken.
	
	$( '#wppfm_prepare_backup' ).click( function() { 
		$( '#wppfm_backup-file-name' ).val( '' );
		$( '#wppfm_backup-wrapper' ).show();
	} );
	
	$( '#wppfm_make_backup' ).click( function() { wppfm_backup(); } );
	
	$( '#wppfm_cancel_backup' ).click( function() { $( '#wppfm_backup-wrapper' ).hide(); } );
	
	$( '#wppfm_backup-file-name' ).keyup( function() {
		if ( '' !== $( '#wppfm_backup-file-name' ).val ) { $( '#wppfm_make_backup' ).attr( 'disabled', false ); }
	} );
});