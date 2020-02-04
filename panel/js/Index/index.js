'use strict';

$(document).ready(function()
{
    $('form[name="login"]').on('submit', function(e)
    {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            type: 'POST',
            data: form.serialize() + '&action=login',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkFormDataErrors(form, response, function()
                {
                    window.location.href = response.path;
                });
            }
        });
    });
});
