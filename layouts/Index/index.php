<?php
defined('_EXEC') or die;

// OWL Carousel
$this->dependencies->add(['css', '{$path.plugins}OwlCarousel2-2.3.4/assets/owl.carousel.min.css']);
$this->dependencies->add(['css', '{$path.plugins}OwlCarousel2-2.3.4/assets/owl.theme.default.min.css']);
$this->dependencies->add(['js', '{$path.plugins}OwlCarousel2-2.3.4/owl.carousel.min.js']);

// Page
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
            <p class="text-white m-b-5">Somos amantes de la naturaleza y la diversión.</p>
            <h2 class="slide-title display-3 text-white">Descubre el caribe <br>y vive experiencias inolvidables.</h2>
            <div class="button-items m-t-20">
                <button class="btn btn-lg next-slide">Ver experiencias <i class="fa fa-long-arrow-right m-l-10"></i></button>
                <button class="btn btn-link"><small class="text-white">o escribenos tus dudas.</small></button>
            </div>
        </div>
    </div>
    <div class="item d-flex flex-column justify-content-center" style="background-image: url('{$path.uploads}isla-contoy-cover.jpg')">
        <div class="container">
            <p class="text-white m-b-5"><i class="mdi mdi-pin"></i> Cancún, Quintana Roo, México.</p>
            <h2 class="slide-title display-3 text-white">Isla Contoy</h2>
            <p class="text-white">Visita dos preciosas islas caribeñas en un mismo día, nada y practica snorkel en el mar. <br>Explora la reserva natural de Contoy, elige entre un montón de actividades para la tarde y disfruta de tiempo libre para relajarte en la playa de isla Mujeres.</p>
            <div class="button-items m-t-20">
                <a href="/experiencia/isla-contoy" class="btn btn-lg btn-success">Var más y reservar <i class="fa fa-long-arrow-right m-l-10"></i></a>
            </div>
        </div>

        <div class="nav">
            <button class="prev-slide m-r-15"><i class="mdi mdi-home"></i> Inicio</button>
            <button class="next-slide m-l-15">Isla Mujeres <i class="mdi mdi-arrow-right"></i></button>
        </div>
    </div>
    <div class="item d-flex flex-column justify-content-center" style="background-image: url('{$path.uploads}isla-mujeres-cover.jpg')">
        <div class="container">
            <p class="text-white m-b-5"><i class="mdi mdi-pin"></i> Cancún, Quintana Roo, México.</p>
            <h2 class="slide-title display-3 text-white">Isla Mujeres</h2>
            <p class="text-white">Visita una de las más hermosas islas en el caribe mexicano. <br>En esta animada excursión harás snorkel, recorrerás sus hermosas y pintorescas calles y podrás comprar extraordinarias artesanías locales.</p>
            <div class="button-items m-t-20">
                <a href="/experiencia/isla-mujeres" class="btn btn-lg btn-success">Var más y reservar <i class="fa fa-long-arrow-right m-l-10"></i></a>
            </div>
        </div>

        <div class="nav">
            <button class="prev-slide m-r-15"><i class="mdi mdi-arrow-left"></i> Isla Contoy</button>
            <button class="next-slide m-l-15">Tiburon Ballena <i class="mdi mdi-arrow-right"></i></button>
        </div>
    </div>
    <div class="item d-flex flex-column justify-content-center" style="background-image: url('{$path.uploads}tiburon-ballena-cover.jpg')">
        <div class="container">
            <p class="text-white m-b-5"><i class="mdi mdi-pin"></i> Cancún, Quintana Roo, México.</p>
            <h2 class="slide-title display-3 text-white">Tiburón Ballena</h2>
            <p class="text-white">Atrévete a nadar con el tiburon ballena y experimentar la máxima emocion de adrenalina, con estos gigantes marinos. <br>La vida marina de la región desde una perspectiva diferente.</p>
            <div class="button-items m-t-20">
                <a href="/experiencia/tiburon-ballena" class="btn btn-lg btn-success">Var más y reservar <i class="fa fa-long-arrow-right m-l-10"></i></a>
            </div>
        </div>

        <div class="nav">
            <button class="prev-slide"><i class="mdi mdi-arrow-left"></i> Isla Mujeres</button>
        </div>
    </div>
</section>
