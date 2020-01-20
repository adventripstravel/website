'use strict';

/**
* @package valkyrie.cms.js
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 01 - 18, 2018 <@create>
* @version 1.0.0
* @summary cm-valkyrie-framework
*
* @copyright Copyright (C) Code Monkey <legal@codemonkey.com.mx, wwww.codemonkey.com.mx>. All rights reserved.
*/

$(document).ready(function()
{
    $('[data-action="responsive"]').on('click', function(e)
    {
        e.stopPropagation();
        $('header.sidebar').toggleClass('open');
    });
});
