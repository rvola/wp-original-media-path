(function($) {
	$(document).ready(function () {

		var $row = $( 'body.settings_page_wpomp-options .form-table tr:nth-of-type(2)' );

		function check_mode() {
			if ( $( '#wpomp_mode' ).is( ':checked' ) ){
				$row.css({ 'display': 'table-row' });
			} else {
				$row.hide();
			}
		}

		$( '#wpomp_mode' ).on( 'change', function(){
			check_mode();
		});

		check_mode();

	});
})(jQuery);
