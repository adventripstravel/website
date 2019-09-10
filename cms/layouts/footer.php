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
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since December 01 - 15, 2018 <@update>
* @version 1.1.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey <legal@codemonkey.com.mx, wwww.codemonkey.com.mx>. All rights reserved.
*/

?>
        <section class="modal success" data-modal="success">
            <div class="content">
                <main>
                    <i class="material-icons">check_circle</i>
                    <p></p>
                </main>
            </div>
        </section>
        <section class="modal alert" data-modal="alert">
            <div class="content">
                <header>
                    <h4>Aviso</h4>
                </header>
                <main>
                    <p></p>
                </main>
                <footer>
                    <a class="btn btn-colored" button-close>Aceptar</a>
                </footer>
            </div>
        </section>
        <footer class="lowbar">
            <p>Desarrollado por <a href="https://codemonkey.com.mx/" target="_blank">Code Monkey</a> Copyright (C) Todos los derechos reservados</p>
        </footer>
        <script src="{$path.js}jquery-2.1.4.min.js"></script>
        <script src="{$path.js}valkyrie.min.js"></script>
        <script src="{$path.js}cm-scripts.js"></script>
        <script src="{$path.js}cm-scripts-dashboard.min.js"></script>
        <script src="{$path.js}scripts.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script> <!-- Font awenson icons -->
        {$dependencies.js}
        {$dependencies.other}
    </body>
</html>
