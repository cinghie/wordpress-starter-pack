jQuery( function() {

	jQuery( '#wppfm-feed-file-name' ).on(
		'focusout',
		function() {
			wppfm_mainInputChanged( false );
		}
	);

	jQuery( '#wpppfm-generate-merchant-promotions-feed-button-bottom').on(
		'click',
		function() {
			wpppfm_startPromotionsFeedGeneration();
		}
	);

	jQuery( '#wpppfm-save-merchant-promotions-feed-button-bottom').on(
		'click',
		function() {
			wpppfm_savePromotionsFeed();
		}
	);
} );