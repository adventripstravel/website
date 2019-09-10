<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.layouts.index
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 01 - 18, 2018 <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey <legal@codemonkey.com.mx, wwww.codemonkey.com.mx>. All rights reserved.
*/

$this->dependencies->add(['js', '{$path.js}Index/index.min.js']);

?>

<section class="login">
    <form name="login">
        <figure>
            <img src="{$path.images}logotype_black.png">
        </figure>
        <fieldset class="fields-group">
            <div class="text">
                <h6>Usuario</h6>
                <input type="text" name="username">
            </div>
        </fieldset>
        <fieldset class="fields-group">
            <div class="text">
                <h6>Contraseña</h6>
                <input type="password" name="password">
            </div>
        </fieldset>
        <button type="submit" class="btn btn-colored">Iniciar Sesion</button>
        <p>Desarrollado por <a href="https://codemonkey.com.mx/" target="_blank">Code Monkey</a></p>
        <p>Copyright (C) Todos los derechos reservados</p>
    </form>
</section>
