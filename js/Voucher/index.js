'use strict';

$(document).ready(function()
{
    /* Request update or cancel booking
    ------------------------------------------------------------------------------- */
    $('[data-action="request"]').on('click', function()
    {
        $.ajax({
            url: '',
            type: 'POST',
            data: 'action=request&option=' + $(this).data('option'),
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == 'success')
                {
                    $('[data-modal="success"] main > p').html(response.message);
                    $('[data-modal="success"]').addClass('view').animate({scrollTop: 0}, 0);

                    setTimeout(function() { location.reload() }, 1000);
                }
                else if (response.status == 'error')
                {
                    $('[data-modal="alert"] main > p').html(response.message);
                    $('[data-modal="alert"]').addClass('view').animate({scrollTop: 0}, 0);
                }
            }
        });
    });
});
