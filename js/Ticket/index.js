$( document ).ready(function ()
{
    const DOM = $( document );

    $("#toggle").toggles(true);

    DOM.on('submit', 'form[name="request_update"]', function ( event )
    {
        event.preventDefault();

        $('body').prepend('<div data-ajax-loader><div class="loader"></div></div>');

        $.ajax({
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                $('.form_request').html('<p style="margin: 0px;text-align: center;">Gracias por tu mensaje, en breve nos pondremos en contacto.</p>');
                $('body').find('[data-ajax-loader]').remove();
            }
        });
    });
});
