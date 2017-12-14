/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more:
 * @link https://git.io/vWdr2
 * @link https://github.com/wpaccessibility/a11ythemepatterns/blob/master/skip-link/skip-link-focus-fix.js
 */
(function() {
	var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
		is_opera = navigator.userAgent.toLowerCase().indexOf( 'opera' ) > -1,
		is_ie = /(trident|msie)/i.test( navigator.userAgent );

	if ( ( is_webkit || is_opera || is_ie )&& document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
})();
