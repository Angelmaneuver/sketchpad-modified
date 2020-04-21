(function( $ ){
	$(document).ready(function() {
    var clipboard = new ClipboardJS( '.sketchpad-copy-button' );

    clipboard.on( 'success', ( e ) => {
      toastr.success( 'copied!' );
    });
  });
})( jQuery );
