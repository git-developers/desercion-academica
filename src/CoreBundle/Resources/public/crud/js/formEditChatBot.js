(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formEditChatBot = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;

        var apiContent = null;
        var modalMsgDiv = null;
        var modalMsgText = null;
        var modalRefresh = null;

        var msg_error = '<p>INFO: Oops!, no se completo el proceso. Contacte a su proveedor (code 3030)</p>';
        var msg_loading = '<div class="modal-body" align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';

        base.$el = $(el);
        base.el = el;
        base.$el.data('formEditChatBot', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            modal = $('#' + options.modal_edit_id);
            apiContent = modal.find('.api-content');
        };

        base.openFormEdit = function(event, context) {
            // debug(e);

            var id = $(context).parent().parent().data('id');

            window.location.href = options.route_edit + "/" + id;

        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.formEditChatBot.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.formEditChatBot = function(options){

        return this.each(function(){

            var bp = new $.formEditChatBot(this, options);

            $(document).on('click', 'button.' + options.modal_edit_id, function() {
                bp.openFormEdit(event, this);
            });

        });
    };

})(jQuery);