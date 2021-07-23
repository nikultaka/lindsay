/**
 * Scripts within the customizer controls window.
 *
 */

jQuery( document ).ready(function($) {

    $(".chives-chosen-select").chosen({
        width: "100%"
    });

    //Switch Control
    $('body').on('click', '.onoffswitch', function(){
        var $this = $(this);
        if($this.hasClass('switch-on')){
            $(this).removeClass('switch-on');
            $this.next('input').val( false ).trigger('change')
        }else{
            $(this).addClass('switch-on');
            $this.next('input').val( true ).trigger('change')
        }
    });

});

( function( api ) {
    // Deep linking for menus
    wp.customize.bind('ready', function() {
        jQuery('a.menu_locations').click(function(e) {
            e.preventDefault();
            wp.customize.section( 'menu_locations' ).focus()
        });
    });
} )( wp.customize );

( function( api ) {
    // upsell 
    api.sectionConstructor['upsell'] = api.Section.extend( {
        // No events for this type of section.
        attachEvents: function () {},
        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    } );
} )( wp.customize );