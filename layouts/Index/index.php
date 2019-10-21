<?php

defined('_EXEC') or die;

/**
* @package valkyrie.layouts.index
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 01 - 18, 2018 <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since December 01 - 15, 2018 <@update>
* @version 1.1.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey <legal@codemonkey.com.mx, wwww.codemonkey.com.mx>. All rights reserved.
*/

$this->dependencies->add(['js', '{$path.js}Index/index.min.js']);

?>

%{header}%
<section class="home" data-image-src="{$path.images}background.png">
    <h1>{$lang.seo_description}</h1>
    <form name="search_booking">
        <fieldset>
            <input type="text" name="booking_number" placeholder="{$lang.booking_number}">
            <button type="submit">{$lang.search_my_booking}</button>
        </fieldset>
    </form>
</section>
<section class="tours">
    {$art_tours}
</section>
<section class="get-promtional-code">
    <h2>¡{$lang.wait}!</h2>
    <h3>{$lang.if_you_dont_have_promotional_code}</h3>
    <form name="get_promotional_code">
        <fieldset>
            <input type="email" name="email" placeholder="{$lang.email}">
            <button type="submit">{$lang.get_my_code}</button>
        </fieldset>
    </form>
</section>
