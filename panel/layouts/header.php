<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.layouts
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 01 - 18, 2018 <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey <legal@codemonkey.com.mx, wwww.codemonkey.com.mx>. All rights reserved.
*/

 ?>

<header class="topbar">
    <nav class="responsive">
        <a data-action="responsive"><i class="material-icons">menu</i></a>
    </nav>
    <figure class="logotype">
        <img src="{$path.images}logotype_black.png">
    </figure>
    <nav class="menu">
        <a class="logged"><i class="material-icons">lens</i><?php echo Session::get_value('_vkye_username') ?></a>
        <a href="index.php?c=index&m=logout"><i class="material-icons">lock</i><span>Cerrar sesión</span></a>
    </nav>
    <div class="clear"></div>
</header>
<header class="sidebar">
    <?php if (Functions::check_access(['{owner}']) == true) : ?>
    <a href="index.php?c=bookings&m=index&p=today"><i class="material-icons">assignment_turned_in</i><span>Reservaciones</span></a>
    <?php endif; ?>
    <?php if (Functions::check_access(['{owner}']) == true) : ?>
    <a href="index.php?c=tours"><i class="material-icons">beach_access</i><span>Tours</span></a>
    <?php endif; ?>
    <?php if (Functions::check_access(['{owner}']) == true) : ?>
    <a href="index.php?c=destinations"><i class="material-icons">place</i><span>Destinos</span></a>
    <?php endif; ?>
    <?php if (Functions::check_access(['{owner}']) == true) : ?>
    <a href="index.php?c=providers"><i class="material-icons">face</i><span>Proveedores</span></a>
    <?php endif; ?>
    <?php if (Functions::check_access(['{owner}']) == true) : ?>
    <a href="index.php?c=users"><i class="material-icons">supervisor_account</i><span>Usuarios</span></a>
    <?php endif; ?>
</header>
