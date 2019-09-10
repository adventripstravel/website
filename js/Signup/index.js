'use strict';

/**
* @package valkyrie.js.index
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 01 - 18, 2018 <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template (This file was created empty)
*
* @copyright Copyright (C) Code Monkey <legal@codemonkey.com.mx, wwww.codemonkey.com.mx>. All rights reserved.
*/

$(document).ready(function()
{
    /* Signup
    ------------------------------------------------------------------------------- */
    $('form[name="signup"]').on('submit', function(e)
    {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            url: '',
            type: 'POST',
            data: form.serialize() + '&action=signup',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkFormValidations(form, response, function()
                {
                    $('[data-modal="success"] main > p').html(response.message);
                    $('[data-modal="success"]').addClass('view').animate({scrollTop: 0}, 0);

                    setTimeout(function() { location.reload; }, 1500);
                });
            }
        });
    });
});
