var Autocomplete = {

    /**
     * Initializes the module
     *
     * @return  void
     */
    init: function () {
        // Bind eventhandlers
        Autocomplete.set_eventhandlers();

        $("#field-card_id").chosen({disable_search_threshold: 10});

    },

    set_eventhandlers: function () {
        $(document)
        // STREAMS
            .on('keyup', '#field-amount', Autocomplete.getCards);
    },

    getCards: function(){
        var cardname = $('#field-amount').val();
        $("#field-card_id option").each(function(){
            $(this).show();

            if ($(this).text.indexOf(cardname.toLowerCase() < 0)){
                $(this).hide();
            }

        });



    }
}

$( document ).ready(function() {
    Autocomplete.init();

    $('.image-link').magnificPopup({type:'image'});
});