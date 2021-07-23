jQuery(document).ready(function($) {

    $(document).on("click", ".chives-accordion", function (e) {
        e.preventDefault();
        var $button = $(this);

        $button.next('.chives-panel').slideToggle();
    
    });

    function chives_contentTypeChange() {
        $( '.content-type' ).on( 'change', function() {
            var $this = $( this );
            var parent = $this.parent().parent();
            var block = parent.find( '.block' );
            var same = parent.find( '.'+ $this.val() );
            block.removeClass( 'block' ).addClass( 'none' );
            same.removeClass( 'none' ).addClass( 'block' );
        } );
    }
    chives_contentTypeChange();

    function chives_widget_chosen() {
        $(".chives-widget-chosen-select").chosen({
            width: "100%"
        });
    }
    chives_widget_chosen();

    $(document).on('widget-updated widget-added', function(){

        chives_widget_chosen();

        chives_contentTypeChange();
    });
});
