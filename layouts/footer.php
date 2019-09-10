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
                    <a class="btn btn-colored" button-close>{$lang.accept}</a>
                </footer>
            </div>
        </section>
        <footer class="main-footer">
            <div class="container">
                <nav>
                    <span><a href="{$_vkye_facebook}" target="_blank"><i class="fab fa-facebook-f"></i></a></span>
                    <span><a href="{$_vkye_instagram}" target="_blank"><i class="fab fa-instagram"></i></a></span>
                    <span><a href="{$_vkye_twitter}" target="_blank"><i class="fab fa-twitter"></i></a></span>
                    <span><a href="{$_vkye_youtube}" target="_blank"><i class="fab fa-youtube"></i></a></span>
                    <span>Copyright (C) {$lang.all_rights_reserved}</span>
                    <span><a href="/notices">{$lang.notices_policies_terms_and_conditions}</a></span>
                </nav>
                <figure>
                    <a href="/"><img src="{$path.images}logotype_white.png" alt="Logotype"></a>
                </figure>
                <figure>
                    <a href="/"><img src="{$path.images}sectur.png" alt="Sectur"></a>
                </figure>
            </div>
        </footer>
        <script src="{$path.js}jquery-2.1.4.min.js"></script>
        <script src="{$path.js}valkyrie.min.js"></script>
        <script src="{$path.js}cm-scripts.min.js"></script>
        <script src="{$path.js}scripts.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        {$dependencies.js}
        {$dependencies.other}
    </body>
</html>
