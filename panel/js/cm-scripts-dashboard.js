'use strict';

/**
* @package valkyrie.panel.js
*
* @summary Controlador del Dashboard general.
*
* @author Gersón Aarón Gómez Macías <ggomez@codemonkey.com.mx>
* <@create> 01 de enero, 2019.
*
* @version 1.0.0.
*
* @copyright Code Monkey <contacto@codemonkey.com.mx>
*/

$(document).ready(function()
{
    $('[data-action="responsive"]').on('click', function(e)
    {
        e.stopPropagation();
        $('header.sidebar').toggleClass('open');
    });
});
