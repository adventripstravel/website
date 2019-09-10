<?php defined('_EXEC') or die;

/**
* @package valkyrie.layouts
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

?>

<header class="main-header">
    <div class="container">
        <figure class="logotype">
            <a href="/"><img src="{$path.images}logotype_white.png" alt="Logotype"></a>
        </figure>
        <nav class="menu">
            <a href="mailto:{$_vkye_email}">{$_vkye_email}</a>
            <a href="tel:{$_vkye_phone}">{$_vkye_phone}</a>
            <a href="?<?php echo Language::get_lang_url('es'); ?>"><img src="{$path.images}es.png" alt="ES Lang flag" /></a>
            <a href="?<?php echo Language::get_lang_url('en'); ?>"><img src="{$path.images}en.png" alt="EN Lang flag" /></a>
            <a href="{$_vkye_facebook}" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="{$_vkye_instagram}" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="{$_vkye_twitter}" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="{$_vkye_youtube}" target="_blank"><i class="fab fa-youtube"></i></a>
        </nav>
        <nav class="responsive">
            <a data-action="responsive"><i class="material-icons">menu</i></a>
        </nav>
    </div>
</header>
