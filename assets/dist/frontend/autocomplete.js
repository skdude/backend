var Autocomplete = {

    /**
     * Initializes the module
     *
     * @return  void
     */
    init: function () {
        // Bind eventhandlers
        Autocomplete.set_eventhandlers();
        $("#field-card_id").find('option').remove();
        $("#field-card_id").trigger("chosen:updated");

    },

    set_eventhandlers: function () {
        $(document)
        // STREAMS
            .on('keyup', '#field-search', Autocomplete.getCards);
    },

    getCards: function(){


        var cardname = $('#field-search').val();

        if (cardname.length <= 2){
            $("#field-card_id").find('option').remove();
            $("#field-card_id").trigger("chosen:updated");
            return false;
        }

        // $("#field-card_id").find('option').remove().end();


        $.post('cards/getcards', {"search": cardname}, function(data){
            $("#field-card_id").find('option').remove().end();
            $("#field-card_id").removeClass('chosen-select');

            data = JSON.parse(data);

            $.each(data, function(k, v){
                $("#field-card_id").append('<option value="'+v.id+'">'+v.name+'</option>');
            });

            $("#field-card_id").trigger("chosen:updated");
        });


    }
}

$( document ).ready(function() {
    Autocomplete.init();

    $('.mtg-img').magnificPopup({type: 'image' });
});