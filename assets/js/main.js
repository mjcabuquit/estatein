/** Estatein UI: mobile menu, dismissible promo bar, slider arrows. */
( function () {
	var toggle = document.querySelector( '.nav-toggle' ), nav = document.getElementById( 'nav' );
	if ( toggle && nav ) {
		toggle.addEventListener( 'click', function () {
			var open = nav.classList.toggle( 'is-open' );
			toggle.setAttribute( 'aria-expanded', open );
		} );
	}
	var close = document.querySelector( '.promo__close' );
	if ( close ) {
		close.addEventListener( 'click', function () { document.getElementById( 'promo' ).classList.add( 'is-hidden' ); } );
	}
	document.querySelectorAll( '.pager' ).forEach( function ( pager ) {
		var slider = pager.previousElementSibling, label = pager.querySelector( 'b' ), prev = pager.querySelector( '.pager__prev' );
		if ( ! slider ) { return; }
		pager.querySelectorAll( 'button' ).forEach( function ( btn ) {
			btn.addEventListener( 'click', function () {
				var card = slider.firstElementChild;
				if ( ! card ) { return; }
				slider.scrollBy( { left: card.offsetWidth * Number( btn.dataset.dir ), behavior: 'smooth' } );
			} );
		} );
		slider.addEventListener( 'scroll', function () {
			var card = slider.firstElementChild;
			if ( prev ) { prev.disabled = slider.scrollLeft < 5; }
			if ( card && label ) { label.textContent = String( Math.round( slider.scrollLeft / card.offsetWidth ) + 1 ).padStart( 2, '0' ); }
		}, { passive: true } );
	} );
} )();
