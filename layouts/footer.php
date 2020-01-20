<?php defined('_EXEC') or die; ?>

        <footer class="main-footer">
            <div class="container">
                <nav>
                    <ul>
                        <li><span>Copyright (C) Adventrips</span></li>
                        <li><i class="fas fa-circle"></i></li>
                        <li><span>{$lang.development_by}</span><a href="https://codemonkey.com.mx" target="_blank">Code Monkey</a></li>
                        <li><i class="fas fa-circle"></i></li>
                        <li><a href="/terms">{$lang.terms_and_conditions}</a></li>
                    </ul>
                </nav>
                <figure>
                    <img src="{$_vkye_icontype_color}" alt="Icontype">
                </figure>
            </div>
        </footer>
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
                    <h4>{$lang.warning}</h4>
                </header>
                <main>
                    <p></p>
                </main>
                <footer>
                    <a class="btn btn-colored" button-close>{$lang.accept}</a>
                </footer>
            </div>
        </section>
        <script src="{$path.js}jquery-2.1.4.min.js"></script>
        <script src="{$path.js}valkyrie.min.js"></script>
        <script src="{$path.js}cm-scripts.min.js"></script>
        <script src="{$path.js}scripts.min.js"></script>
        <script defer src="https://kit.fontawesome.com/743152b0c5.js"></script> <!-- Font awenson icons -->
        {$dependencies.js}
        {$dependencies.other}
    </body>
</html>
