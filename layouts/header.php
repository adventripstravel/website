<?php defined('_EXEC') or die; ?>

<header class="main-header">
    <div class="topbar">
        <div class="container">
            <nav>
                <ul>
                    <li class="blocked"><a href="mailto:{$_vkye_email}" target="_blank">{$_vkye_email}</a></li>
                    <li class="blocked"><a href="tel:{$_vkye_phone}" target="_blank">{$_vkye_phone}</a></li>
                    <li class="unblocked"><a href="mailto:{$_vkye_email}" target="_blank"><i class="fas fa-envelope"></i></a></li>
                    <li class="unblocked"><a href="tel:{$_vkye_phone}" target="_blank"><i class="fas fa-phone"></i></a></li>
                    <li><a href="https://api.whatsapp.com/send?phone={$_vkye_phone}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                    <!-- <li><a href="{$_vkye_tripadvisor}" target="_blank"><i class="fab fa-tripadvisor"></i></a></li> -->
                    <li><a href="{$_vkye_facebook}" target="_blank"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="{$_vkye_instagram}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    <!-- <li><a href="{$_vkye_twitter}" target="_blank"><i class="fab fa-twitter"></i></a></li> -->
                    <!-- <li><a href="{$_vkye_youtube}" target="_blank"><i class="fab fa-youtube"></i></a></li> -->
                    <li><a href="{$_vkye_lang_es}"><img src="{$path.images}es.png" alt="ES" /></a></li>
                    <li><a href="{$_vkye_lang_en}"><img src="{$path.images}en.png" alt="EN" /></a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="bottombar">
        <div class="container">
            <figure>
                <!-- <a href="/"><img src="{$_vkye_logotype_color}" alt="Logotype"></a> -->
                <a href="/"><img src="{$path.images}logotype.png" alt="Logotype"></a>
            </figure>
            <nav>
                <ul>
                    <li><a href="/">{$lang.index}</a></li>
                    <li><a href="/contact">{$lang.contact}</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="movilbar">
        <div class="container">
            <figure>
                <a href="/"><img src="{$_vkye_icontype_color}" alt="Logotype"></a>
            </figure>
            <nav>
                <ul>
                    <li><a data-action="open-main-menu"><i class="material-icons">menu</i></a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
