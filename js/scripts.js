'use strict';

$(document).ready(function()
{
    navScrollDown('header.main-header', 'down', 0);

    $('[data-action="open-main-menu"]').on('click', function(e)
    {
        e.stopPropagation();

        $('header.main-header > div.topbar').toggleClass('open');
        $('header.main-header > div.bottombar').toggleClass('open');
    });
});
