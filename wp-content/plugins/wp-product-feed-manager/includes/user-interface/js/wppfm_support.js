function wppfm_activateFeedCategory( id ) {
	if( id !== 'wppfm_all_categories_selected' ) {
		wppfm_activateFeedCategorySelector( id );

		var children = jQuery( '#feed-selector-' + id ).attr( "data-children" ) ? JSON.parse( jQuery( '#feed-selector-' + id ).attr( "data-children" ) ) : [ ];

		for ( var i = 0; i < children.length; i++ ) { wppfm_activateFeedCategorySelector( children[i] ); }
	} else {
		
		var allIds = jQuery('tbody#wppfm-category-mapping-body').children('tr');
		
		for ( var i = 0; i < allIds.length; i++ ) { wppfm_activateFeedCategorySelector( jQuery( allIds[i] ).children('th').children('input').val() ); }
	}
}

function wppfm_activateFeedCategorySelector( id ) {

	// some channels use your own shop's categories
	var usesOwnCategories = wppfm_channelUsesOwnCategories( _feedHolder['channel'] );
	var feedCategoryText = usesOwnCategories ? 'shopCategory' : 'default';
	// activate the category in the feedHolder
	_feedHolder.activateCategory( id, usesOwnCategories );

	// get the children of this selector if any
	var children = jQuery( '#feed-selector-' + id ).attr( "data-children" ) ? JSON.parse( jQuery( '#feed-selector-' + id ).attr( "data-children" ) ) : [ ];

	if ( jQuery( '#feed-category-' + id ).html() === '' ) {
		jQuery( '#feed-category-' + id ).html( wppfm_mapToDefaultCategoryElement( id, feedCategoryText ) );
	}

	jQuery( '#feed-selector-' + id ).prop( 'checked', true );

	for ( var i = 0; i < children.length; i++ ) { wppfm_activateFeedCategorySelector( children[i] ); }
}

function wppfm_deactivateFeedCategory( id ) {

	if( id !== 'wppfm_all_categories_selected' ) {
		wppfm_deactivateFeedCategorySelector( id, true );

		var children = jQuery( '#feed-selector-' + id ).attr( "data-children" ) ? JSON.parse( jQuery( '#feed-selector-' + id ).attr( "data-children" ) ) : [ ];

		for ( var i = 0; i < children.length; i++ ) { wppfm_deactivateFeedCategorySelector( children[i], false ); }
	} else {
		
		var allIds = jQuery('tbody#wppfm-category-mapping-body').children('tr');
		
		for ( var i = 0; i < allIds.length; i++ ) { wppfm_deactivateFeedCategorySelector( jQuery( allIds[i] ).children('th').children('input').val() ); }
	}
}

function wppfm_contains_special_characters( string ) {
	var specialChars = '%^#<>{}[]\/~`@?:;=&';
	
	for( var i=0; i < specialChars.length; i++ ) {
		if ( string.indexOf( specialChars[i] ) > -1 ) return true;
	}
	
	return false;
}

function wppfm_deactivateFeedCategorySelector( id, parent ) {

	_feedHolder.deactivateCategory( id );

	jQuery( '#feed-category-' + id ).html( '' );
	jQuery( '#category-selector-catmap-' + id ).hide();

	jQuery( '#feed-selector-' + id ).prop( 'checked', false );

	if ( ! parent ) {
		var children = jQuery( '#feed-selector-' + id ).attr( "data-children" ) ? JSON.parse( jQuery( '#feed-selector-' + id ).attr( "data-children" ) ) : [ ];
		for ( var i = 0; i < children.length; i++ ) { wppfm_deactivateFeedCategorySelector( children[i], false ); }
	}
}

/**
 * Shows and hides the category sub level selectors depending on the selected level
 * 
 * @param {int} currentLevelId
 * @returns {nothing}
 */
function wppfm_hideSubs( currentLevelId ) {

	// identify the level from the level id
	var level = currentLevelId.match( /(\d+)$/ )[0];
	var idString = currentLevelId.substring( 0, currentLevelId.length - level.length );

	// only show sub fields that are at or before the selected level. Hide the rest
	for ( var i = 7; i > level; i-- ) {
		jQuery( '#' + idString + i ).css( 'display', 'none' );
		jQuery( '#' + idString + i ).empty();
	}
}

/**
 * Takes a field string from a source input string and splits it up even when a pipe character
 * is used in a combined source input string
 * 
 * @since 2.3.0
 * @param {string} fieldString
 * @returns {array}
 */
function wppfm_splitCombinedFieldElements( fieldString ) {
	if ( ! fieldString ) { return []; }
	
	var reg = /\|[0-9]/; // pipe splitter plus a number directly after it
	var result = [];
	var sliceStart = 0;

	// fetch the separate field strings and put them in the result array
	while ( ( match = reg.exec( fieldString ) ) !== null ) {
		var ind = match.index;
		result.push( fieldString.substring( sliceStart, ind ) );
		fieldString = fieldString.slice( ind + 1 );
	}
	
	// then add the final field string to the result array
	result.push( fieldString );
	
	return result;
}

function wppfm_show_feed_spinner() {
	jQuery( '#feed-spinner' ).show();
	jQuery( 'body' ).css( 'cursor', 'wait' );
	jQuery( '#wppfm-generate-feed-button-top' ).attr( 'disabled', true );
	jQuery( '#wppfm-generate-feed-button-bottom' ).attr( 'disabled', true );
	jQuery( '#wppfm-save-feed-button-top' ).attr( 'disabled', true );
	jQuery( '#wppfm-save-feed-button-bottom' ).attr( 'disabled', true );
}

function wppfm_hide_feed_spinner() {
	jQuery( '#feed-spinner' ).hide();
	jQuery( 'body' ).css( 'cursor', 'default' );
	jQuery( '#wppfm-generate-feed-button-top' ).attr( 'disabled', false );
	jQuery( '#wppfm-generate-feed-button-bottom' ).attr( 'disabled', false );
	jQuery( '#wppfm-save-feed-button-top' ).attr( 'disabled', false );
	jQuery( '#wppfm-save-feed-button-bottom' ).attr( 'disabled', false );
}

function wppfm_enableFeedActionButtons() {
	// enable the Generate and Save button
	jQuery( '#wppfm-generate-feed-button-top' ).prop( 'disabled', false );
	jQuery( '#wppfm-generate-feed-button-bottom' ).prop( 'disabled', false );
	jQuery( '#wppfm-save-feed-button-top' ).prop( 'disabled', false );
	jQuery( '#wppfm-save-feed-button-bottom' ).prop( 'disabled', false );
}

function disableFeedActionButtons() {
	// keep the Generate and Save buttons disabled
	jQuery( '#wppfm-generate-feed-button-top' ).prop( 'disabled', true );
	jQuery( '#wppfm-generate-feed-button-bottom' ).prop( 'disabled', true );
	jQuery( '#wppfm-save-feed-button-top' ).prop( 'disabled', true );
	jQuery( '#wppfm-save-feed-button-bottom' ).prop( 'disabled', true );
}

function wppfm_show_error_message( message ) {
	jQuery( '#error-message' ).empty();
	jQuery( '#error-message' ).append( '<p>' + message + '</p>' );
	jQuery( '#error-message' ).show();
}

function wppfm_show_success_message( message ) {
	jQuery( '#success-message' ).empty();
	jQuery( '#success-message' ).append( '<p>' + message + '</p>' );
	jQuery( '#success-message' ).show();
}