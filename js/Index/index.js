'use strict';

$(document).ready(function()
{
    $('form[name="search_voucher"]').on('submit', function(e)
    {
        e.preventDefault();

        let folio = $(this).find('input[name="token"]').val();

        window.location.href = 'https://adventrips.com/ticket/'+ folio;

        // var form = $(this);

        // $.ajax({
        //     type: 'POST',
        //     data: form.serialize() + '&action=search_voucher',
        //     processData: false,
        //     cache: false,
        //     dataType: 'json',
        //     success: function(response)
        //     {
        //         checkFormDataErrors(form, response, function()
        //         {
        //             window.location.href = response.path;
        //         });
        //     }
        // });
    });
});
