<?php

defined('_EXEC') or die;

$this->dependencies->add(['js', '{$path.js}Index/index.min.js']);

?>

<main class="login">
    <form name="login">
        <figure>
            <img src="{$_vkye_logotype_black}">
        </figure>
        <fieldset class="fields-group">
            <div class="text">
                <h6>Correo electrónico</h6>
                <input type="email" name="email">
            </div>
        </fieldset>
        <fieldset class="fields-group">
            <div class="text">
                <h6>Contraseña</h6>
                <input type="password" name="password">
            </div>
        </fieldset>
        <fieldset class="fields-group">
            <div class="button">
                <button type="submit">Iniciar Sesion</button>
            </div>
        </fieldset>
        <p>Panel desarrollado por <a href="https://codemonkey.com.mx/" target="_blank">Code Monkey</a></p>
        <p>Copyright (C) Todos los derechos reservados</p>
    </form>
</main>
