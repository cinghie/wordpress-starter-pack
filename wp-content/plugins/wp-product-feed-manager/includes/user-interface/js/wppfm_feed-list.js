/*global wppfm_feed_list_form_vars */
function wppfm_fillFeedList() {
    var listHtml = '';

    wppfm_getFeedList( function ( list ) {
        if ( '0' !== list ) {
            // convert the data to html code
            listHtml = wppfm_feedListTable( JSON.parse( list ) );
        }
        else {
            listHtml = wppfm_emptyListTable();
        }

        jQuery( '#wppfm-feed-list' ).empty(); // first clear the feedlist

        jQuery( '#wppfm-feed-list' ).append( listHtml );
    } );
}

function appendCategoryLists( channelId, language, isNew ) {
    if ( isNew ) {
        wppfm_getCategoryListsFromString( channelId, '', language, function ( categories ) {
            var list = JSON.parse( categories )[0];

            if ( list && list.length > 0 ) {
                jQuery( '#lvl_0' ).html( wppfm_categorySelectCntrl( list ) );
                jQuery( '#lvl_0' ).prop( 'disabled', false );
            } else {
                // as the user selected a free format, just show a text input control
                jQuery( '#category-selector-lvl' ).html( wppfm_freeCategoryInputCntrl( 'default', '0', false ) );
                jQuery( '#category-selector-lvl' ).prop( 'disabled', false );
            }
        } );
    }
}

function wppfm_resetFeedList() {
    wppfm_fillFeedList();
}

function wppfm_resetFeedStatus( feedData ) {
	wppfm_checkNextFeedInQueue( function ( feedId ) {
		wppfm_updateFeedRowStatus( feedData[ 'product_feed_id' ], parseInt( feedData[ 'status_id' ] ) );
		wppfm_updateFeedRowData( feedData );
	} );
}

function wppfm_feedListTable( list ) {
    var htmlCode = '';
	
    for ( var i = 0; i < list.length; i++ ) {
        var status = list [ i ] [ 'status' ];
        var feedId = list [ i ] ['product_feed_id'];
        var feedUrl = list [ i ] ['url'];
        var feedReady = 'on_hold' === status || 'ok' === status ? true : false;
        var nrProducts = '';
		var statusString = wppfm_list_status_text( status );
		
		if( feedReady ) {
			nrProducts = list [ i ] ['products'];
		} else if ( 'processing' === status ) {
			nrProducts = wppfm_feed_list_form_vars.processing_the_feed;
		} else if ( 'failed_processing' === status || 'in_processing_queue' === status ) {
			nrProducts = wppfm_feed_list_form_vars.unknown;
		}

        htmlCode += '<tr id="feed-row"';

        if ( i % 2 === 0 ) { htmlCode += ' class="alternate"'; } // alternate background color per row

        htmlCode += '>';
        htmlCode += '<td id="title">' + list [ i ] ['title'] + '</td>';
        htmlCode += '<td id="url">' + feedUrl + '</td>';
        htmlCode += '<td id="updated-' + feedId + '">' + list [ i ] ['updated'] + '</td>';
        htmlCode += '<td id="products-' + feedId + '">' + nrProducts + '</td>';
        htmlCode += '<td id="feed-status-' + feedId + '" value="' + status + '" style="color: ' + list [ i ] [ 'color' ] + '"><strong>';
//        htmlCode += feedReady ? status : 'Processing';
        htmlCode += statusString;
        htmlCode += '</strong></td>';
        htmlCode += '<td id="actions-' + feedId + '">';
        
        if ( feedReady ) {
            htmlCode += feedReadyActions( feedId, feedUrl, status, list [ i ] ['title'] )
        } else {
            htmlCode += feedNotReadyActions( feedId, feedUrl, list [ i ] ['title'] );
        }

        htmlCode += '</td>';
    }

    return htmlCode;
}

function feedReadyActions( feedId, feedUrl, status, title ) {
    var fileExists = 'No feed generated' === feedUrl ? false : true;
    var fileName = feedUrl.lastIndexOf( '/' ) > 0 ? feedUrl.slice( feedUrl.lastIndexOf( '/' ) - feedUrl.length + 1 ) : title;
    var changeStatus = 'ok' === status ? wppfm_feed_list_form_vars.list_deactivate : wppfm_feed_list_form_vars.list_activate;
    
    var htmlCode = '<strong><a href="javascript:void(0);" onclick="parent.location=\'admin.php?page=wp-product-feed-manager-add-new-feed&id=' + feedId + '\'">' + wppfm_feed_list_form_vars.list_edit + ' </a>';
    htmlCode += fileExists ? '| <a href="javascript:void(0);" onclick="wppfm_viewFeed(\'' + feedUrl + '\')">' + wppfm_feed_list_form_vars.list_view + ' </a>' : '';
    htmlCode += '| <a href="javascript:void(0);" onclick="wppfm_deleteSpecificFeed(' + feedId + ', \'' + fileName + '\')">' + wppfm_feed_list_form_vars.list_delete + ' </a>';
    htmlCode += fileExists ? '| <a href="javascript:void(0);" onclick="wppfm_deactivateFeed(' + feedId + ')" id="feed-status-switch-' + feedId + '">' + changeStatus + ' </a>' : '';
    htmlCode += '| <a href="javascript:void(0);" onclick="wppfm_duplicateFeed(' + feedId + ', \'' + title + '\')">' + wppfm_feed_list_form_vars.list_duplicate + '</a></strong>';
    return htmlCode;
}

function feedNotReadyActions( feedId, feedUrl, title ) {
    var fileName = feedUrl.lastIndexOf( '/' ) > 0 ? feedUrl.slice( feedUrl.lastIndexOf( '/' ) - feedUrl.length + 1 ) : title;

    var htmlCode = '<strong>';
    htmlCode += '<a href="javascript:void(0);" onclick="parent.location=\'admin.php?page=wp-product-feed-manager-add-new-feed&id=' + feedId + '\'">' + wppfm_feed_list_form_vars.list_edit + ' </a>';
    htmlCode += '| <a href="javascript:void(0);" onclick="wppfm_deleteSpecificFeed(' + feedId + ', \'' + fileName + '\')"> ' + wppfm_feed_list_form_vars.list_delete + '</a>';
    htmlCode += '</strong>';
    htmlCode += wppfm_addFeedStatusChecker( feedId );
    return htmlCode;
}

function wppfm_emptyListTable() {

    var htmlCode = '';

    htmlCode += '<tr>';
    htmlCode += '<td colspan = 4>' + wppfm_feed_list_form_vars.no_data_found + '</td>';
    htmlCode += '</tr>';

    return htmlCode;
}

function wppfm_updateFeedRowData( rowData ) {
    if ( rowData['status_id'] === '1' || rowData['status_id'] === '2' ) {
        var feedId = rowData['product_feed_id'];
        var status = rowData['status_id'] === '1' ? wppfm_feed_list_form_vars.ok : wppfm_feed_list_form_vars.other;

        jQuery( '#updated-' + feedId ).html( rowData['updated'] );
        jQuery( '#products-' + feedId ).html( rowData['products'] );
        jQuery( '#actions-' + feedId ).html( feedReadyActions( feedId, rowData['url'], status, rowData['title'] ) );
    }
}

function wppfm_list_status_text( status ) {
	switch( status ) {
		case 'unknown':
			return wppfm_feed_list_form_vars.unknown;
			break;

		case 'ok':
			return wppfm_feed_list_form_vars.status_ok;
			break;

		case 'on_hold':
			return wppfm_feed_list_form_vars.on_hold;
			break;

		case 'processing':
			return wppfm_feed_list_form_vars.processing;
			break;

		case 'in_processing_queue':
			return wppfm_feed_list_form_vars.processing_queue;
			break;

		case 'has_errors':
			return wppfm_feed_list_form_vars.has_errors;
			break;

		case 'failed_processing':
			return wppfm_feed_list_form_vars.failed_processing;
			break;
	}
}

function wppfm_updateFeedRowStatus( feedId, status ) {
    switch( status ) {
        case 0: // unknown
            jQuery( '#feed-status-' + feedId ).html( '<strong>' + wppfm_feed_list_form_vars.unknown + '</strong>' );
            jQuery( '#feed-status-' + feedId ).css( 'color', '#6549F7' );
            jQuery( '#feed-status-switch-' + feedId ).html( '' );
            break;

        case 1: // OK
            jQuery( '#feed-status-' + feedId ).html( '<strong>' + wppfm_feed_list_form_vars.ok + '</strong>' );
            jQuery( '#feed-status-' + feedId ).css( 'color', '#0073AA' );
            jQuery( '#feed-status-switch-' + feedId ).html( wppfm_feed_list_form_vars.list_deactivate + ' ' );
            break;

        case 2: // On hold
            jQuery( '#feed-status-' + feedId ).html( '<strong>' + wppfm_feed_list_form_vars.on_hold + '</strong>' );
            jQuery( '#feed-status-' + feedId ).css( 'color', '#0173AA' );
            jQuery( '#feed-status-switch-' + feedId ).html( wppfm_feed_list_form_vars.list_activate + ' ' );
            break;

        case 3: // Processing
            jQuery( '#feed-status-' + feedId ).html( '<strong>' + wppfm_feed_list_form_vars.processing + '</strong>' );
            jQuery( '#feed-status-' + feedId ).css( 'color', '#0000FF' );
            jQuery( '#feed-status-switch-' + feedId ).html( '' );
            jQuery( '#products-' + feedId ).html( wppfm_feed_list_form_vars.processing_the_feed );
            break;

        case 4: // In queue
            jQuery( '#feed-status-' + feedId ).html( '<strong>' + wppfm_feed_list_form_vars.processing_queue + '</strong>' );
            jQuery( '#feed-status-' + feedId ).css( 'color', '#00CCFF' );
            jQuery( '#feed-status-switch-' + feedId ).html( wppfm_feed_list_form_vars.list_activate + ' ' );
            break;

        case 5: // Has errors
            jQuery( '#feed-status-' + feedId ).html( '<strong>' + wppfm_feed_list_form_vars.has_errors + '</strong>' );
            jQuery( '#feed-status-' + feedId ).css( 'color', '#FF0000' );
            jQuery( '#products-' + feedId ).html( wppfm_feed_list_form_vars.unknown );
            jQuery( '#feed-status-switch-' + feedId ).html( wppfm_feed_list_form_vars.list_activate + ' ' );
            break;
			
		case 6: // Failed processing
            jQuery( '#feed-status-' + feedId ).html( '<strong>' + wppfm_feed_list_form_vars.processing_failed + '</strong>' );
            jQuery( '#feed-status-' + feedId ).css( 'color', '#FF3300' );
            jQuery( '#products-' + feedId ).html( wppfm_feed_list_form_vars.unknown );
            jQuery( '#feed-status-switch-' + feedId ).html( '' );
            break;
    }
}

/**
 * Document ready actions
 */
jQuery( document ).ready( function () {
    // fill the items on the main admin page
    wppfm_resetFeedList();
} );