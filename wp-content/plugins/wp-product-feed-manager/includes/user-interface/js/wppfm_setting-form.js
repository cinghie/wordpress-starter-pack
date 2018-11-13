/*global wppfm_setting_form_vars */
function wppfm_auto_feed_fix_changed() {
	wppfm_auto_feed_fix_mode( jQuery( '#wppfm_auto_feed_fix_mode' ).is( ':checked' ), function( response ) { console.log( response ); } );	
}

function wppfm_background_processing_mode_changed() {
	wppfm_background_processing_mode( jQuery( '#wppfm_background_processing_mode' ).is( ':checked' ), function( response ) { console.log( response ); } );
}

function wppfm_third_party_attributes_changed() {
	wppfm_change_third_party_attribute_keywords( jQuery( '#wppfm_third_party_attr_keys' ).val(), function( response ) { console.log( response ); } );
}

function wppfm_notice_mailaddress_changed() {
	wppfm_change_notice_mailaddress( jQuery( '#wppfm_notice_mailaddress' ).val(), function( response ) { console.log( response ); } );
}

function wppfm_clear_feed_process() {
	wppfm_show_feed_spinner();
	wppfm_clear_feed_process_data( function( response ) { 
		console.log( response );
		wppfm_hide_feed_spinner();
	} );
}

function wppfm_reinitiate() {
	wppfm_show_feed_spinner();
	wppfm_reinitiate_plugin( function( response ) { 
		console.log( response );
		wppfm_hide_feed_spinner();
	} );
}

function wppfm_backup() {
	if ( jQuery( '#wppfm_backup-file-name' ).val() !== '' ) {
		jQuery( '#wppfm_backup-wrapper' ).hide();

		wppfm_initiateBackup( jQuery( '#wppfm_backup-file-name' ).val(), function( response ) { 
			wppfm_resetBackupsList();
			
			if ( response !== '1' ) {
				wppfm_show_error_message( response );
			}
		} );
	} else {
		alert( wppfm_setting_form_vars.first_enter_file_name );
	}
}

function wppfm_deleteBackupFile( fileName ) {
	var userInput = confirm( wppfm_setting_form_vars.confirm_file_deletion.replace( '%backup_file_name%', fileName ) );

	if ( userInput === true ) {
		wppfm_deleteBackup( fileName, function( response ) {
			wppfm_show_success_message( wppfm_setting_form_vars.file_deleted.replace( '%backup_file_name%', fileName ) );
			wppfm_resetBackupsList();
			console.log( response ); 
		} );
	}
}

function wppfm_restoreBackupFile( fileName ) {

	var userInput = confirm( wppfm_setting_form_vars.confirm_file_restoring.replace( '%backup_file_name%', fileName ) );

	if ( userInput === true ) {

		wppfm_restoreBackup( fileName, function( response ) { 

			if ( response === '1' ) {
				wppfm_show_success_message( wppfm_setting_form_vars.file_restored.replace( '%backup_file_name%', fileName ) );
				wppfm_resetOptionSettings();
			} else {
				wppfm_show_error_message( response );
			}
		} );
	}
}

function wppfm_duplicateBackupFile( fileName ) {
	
	wppfm_duplicateBackup( fileName, function( response ) { 
		
		if ( response === '1' ) { 
			wppfm_show_success_message( wppfm_setting_form_vars.file_duplicated.replace( '%backup_file_name%', fileName ) ); 
		} else {
			wppfm_show_error_message( response );
		}
		wppfm_resetBackupsList();
	} );
}