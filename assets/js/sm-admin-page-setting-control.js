( function( $ ){
  'use strict';

  wp.customize.bind( 'ready', function(){
    let customize = this;

    _.each( customize.section( 'sketchpad_admin_page_setting_section' ).controls(), function( control ){
      if( control.params.type === 'button' ){
        control.container.on( 'click', function(){
          let request = wp.ajax.post( 'sketchpad_ajax_admin_background_reset', {
            id: control.id,
            security: customize.settings.nonce['sketchpad-modified-admin-background-reset'],
          });
          request.done( function( response ){
            let data = JSON.parse( response.data );
            Object.keys( data ).forEach( function( key ){
              let setting = customize( key );
              if( setting ){
                setting.set( data[key] );
              }
            })
          });
        });
      }
    });
  });
})( jQuery );
