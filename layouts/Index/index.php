<?php

defined('_EXEC') or die;

$this->dependencies->add(['css', '{$path.plugins}OwlCarousel2-2.3.4/assets/owl.carousel.min.css']);
$this->dependencies->add(['css', '{$path.plugins}OwlCarousel2-2.3.4/assets/owl.theme.default.min.css']);
$this->dependencies->add(['js', '{$path.plugins}OwlCarousel2-2.3.4/owl.carousel.min.js']);
$this->dependencies->add(['js', '{$path.js}pages/index.js']);

?>

<header class="main-logo">
    <figure class="logotype">
        <img src="{$path.images}adventrips.svg" alt="">
    </figure>
</header>
<section class="slideshow-cover owl-carousel owl-theme">
    <div class="item d-flex flex-column justify-content-center" style="background-image: url('{$path.uploads}home-cover.jpg')">
        <div class="container">
            <p class="text-white m-b-5">{$lang.home_1}</p>
            <h2 class="slide-title display-3 text-white">{$lang.home_2}</h2>
            <div class="button-items m-t-20">
                <button class="btn btn-lg isla-mujeres-slide" style="background-color:#00a099;border:none;">Isla Mujeres</button>
                <button class="btn btn-lg isla-contoy-slide" style="background-color:#3fb4d0;border:none;">Isla Contoy</button>
                <button class="btn btn-lg tiburon-ballena-slide" style="background-color:#f29100;border:none;">Tiburón Ballena</button>
            </div>
            <div class="button-items m-t-20">
                <a href="mailto:reservaciones@adventrips.com" class="btn btn-lg" style="background:none;font-size:24px;border:none;" target="_blank"><i class="fas fa-envelope"></i></a>
                <a href="tel:+529983375918" class="btn btn-lg" style="background:none;font-size:24px;border:none;" target="_blank"><i class="fas fa-phone"></i></a>
                <a href="https://api.whatsapp.com/send?phone=+529983375918" class="btn btn-lg" style="background:none;font-size:24px;border:none;" target="_blank"><i class="fab fa-whatsapp"></i></a>
                <a href="https://m.me/106456467505158" class="btn btn-lg" style="background:none;font-size:24px;border:none;" target="_blank"><i class="fab fa-facebook-messenger"></i></a>
            </div>
        </div>
    </div>
    <div class="item d-flex flex-column justify-content-center" style="background-image: url('{$path.uploads}isla-mujeres-cover.jpg')">
        <div class="container">
            <p class="text-white m-b-5"><i class="mdi mdi-pin"></i> Cancún, Quintana Roo, México.</p>
            <h2 class="slide-title display-3 text-white">Isla Mujeres</h2>
            <p class="text-white">{$lang.home_3}</p>
            <div class="button-items m-t-20">
                <a href="/experiencia/isla-mujeres" class="btn btn-lg btn-success" style="background-color:#00a099;border:none;">{$lang.view_more} <i class="fa fa-long-arrow-right m-l-10"></i></a>
            </div>
        </div>
        <div class="nav">
            <button class="prev-slide m-r-15"><i class="mdi mdi-home"></i> {$lang.home}</button>
            <button class="next-slide m-r-15">Isla Contoy <i class="mdi mdi-arrow-right"></i></button>
        </div>
    </div>
    <div class="item d-flex flex-column justify-content-center" style="background-image: url('{$path.uploads}isla-contoy-cover.jpg')">
        <div class="container">
            <p class="text-white m-b-5"><i class="mdi mdi-pin"></i> Cancún, Quintana Roo, México.</p>
            <h2 class="slide-title display-3 text-white">Isla Contoy</h2>
            <p class="text-white">{$lang.home_4}</p>
            <div class="button-items m-t-20">
                <a href="/experiencia/isla-contoy" class="btn btn-lg btn-success" style="background-color:#3fb4d0;border:none;">{$lang.view_more} <i class="fa fa-long-arrow-right m-l-10"></i></a>
            </div>
        </div>
        <div class="nav">
            <button class="prev-slide m-l-15"><i class="mdi mdi-arrow-left"></i>  Isla Mujeres</button>
            <button class="next-slide m-l-15">Tiburon Ballena <i class="mdi mdi-arrow-right"></i></button>
        </div>
    </div>
    <div class="item d-flex flex-column justify-content-center" style="background-image: url('{$path.uploads}tiburon-ballena-cover.jpg')">
        <div class="container">
            <p class="text-white m-b-5"><i class="mdi mdi-pin"></i> Cancún, Quintana Roo, México.</p>
            <h2 class="slide-title display-3 text-white">Tiburón Ballena</h2>
            <p class="text-white">{$lang.home_5}</p>
            <div class="button-items m-t-20">
                <a href="/experiencia/tiburon-ballena" class="btn btn-lg btn-success" style="background-color:#f29100;border:none;">{$lang.view_more} <i class="fa fa-long-arrow-right m-l-10"></i></a>
            </div>
        </div>
        <div class="nav">
            <button class="prev-slide m-r-15"><i class="mdi mdi-arrow-left"></i> Isla Contoy</button>
        </div>
    </div>
</section>
