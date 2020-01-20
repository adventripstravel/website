'use strict';

$(document).ready(function()
{
    $('form[name="contact"]').on('submit', function(e)
    {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            type: 'POST',
            data: form.serialize() + '&action=contact',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkFormDataErrors(form, response, function()
                {
                    $('[data-modal="success"] main > p').html(response.message);
                    $('[data-modal="success"]').addClass('view');
                    setTimeout(function() { location.reload(); }, 1500);
                });
            }
        });
    });
});
