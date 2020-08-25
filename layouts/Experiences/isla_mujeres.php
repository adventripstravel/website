<?php

defined('_EXEC') or die;

$this->dependencies->add(['css', '{$path.plugins}OwlCarousel2-2.3.4/assets/owl.carousel.min.css']);
$this->dependencies->add(['css', '{$path.plugins}OwlCarousel2-2.3.4/assets/owl.theme.default.min.css']);
$this->dependencies->add(['js', '{$path.plugins}OwlCarousel2-2.3.4/owl.carousel.min.js']);
$this->dependencies->add(['css', '{$path.plugins}fancybox-2.1.7/source/jquery.fancybox.css?v=2.1.7']);
$this->dependencies->add(['js', '{$path.plugins}fancybox-2.1.7/source/jquery.fancybox.pack.js?v=2.1.7']);
$this->dependencies->add(['css', '{$path.plugins}bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css']);
$this->dependencies->add(['js', '{$path.plugins}bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js']);
$this->dependencies->add(['js', '{$path.plugins}bootstrap-inputmask/jquery.inputmask.min.js']);
$this->dependencies->add(['js', '{$path.js}pages/experiences.js']);

?>

<header class="main-navbar" style="background-color:#00a099">
    <div class="container d-flex align-item-center">
        <a href="/" id="back-nav" class="btn btn-outline btn-light"><i class="fa fa-arrow-left"></i></a>
        <h2 class="title text-white">{$lang.return}</h2>
    </div>
</header>
<main class="main-content">
    <header class="cover d-flex flex-column justify-content-end" style="background-image: url('{$path.uploads}isla-mujeres-cover.jpg'); background-position: center 20%;">
        <div class="container">
            <h1 class="text-white">Isla Mujeres.</h1>
            <p class="text-white m-b-5"><small><i class="mdi mdi-pin"></i> Cancún, Quintana Roo, México.</small></p>
            <p class="text-white">{$lang.home_3}</p>
            <div class="p-b-20"></div>
            <div class="discount">
                <span>{$lang.discount_30}</span>
                <span>{$lang.discount_50}</span>
            </div>
            <div class="p-b-20"></div>
        </div>
    </header>
    <section class="p-t-50 p-b-50">
        <div class="container">
            <p class="text-muted">{$lang.home_6}</p>
            <p class="text-muted">{$lang.home_7}</p>
            <p class="text-muted">{$lang.home_8}</p>
            <section class="toggles m-b-50 m-t-50">
                <section class="toggle view">
                    <h3>{$lang.what_include}</h3>
                    <div>
                        <h5>{$lang.include}</h5>
                        <p class="text-muted"><i class="fa fa-check"></i> Guía.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Equipo de snorkel.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Entrada al parque marino (farito).</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Hielera (puede llevar sus bebidas y hacer uso de la hielera).</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Comida.</p>
                        <hr>
                        <h5>{$lang.not_include}</h5>
                        <p class="text-muted"><i class="fa fa-times"></i> Propinas optativas.</p>
                        <p class="text-muted"><i class="fa fa-times"></i> Fotos/videos.</p>
                    </div>
                </section>
                <section class="toggle">
                    <h3>{$lang.what_recommended}</h3>
                    <div>
                        <p class="text-muted"><i class="fa fa-check"></i> Ropa cómoda.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Traje de baño.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Toalla.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Gafas de sol.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Protector solas biodegradable.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Zapatos cómodos (sandalias).</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Dinero en efectivo para gastos adicionales.</p>
                    </div>
                </section>
            </section>
            <ul class="timeline m-b-50">
                <li>
                    <span>{$lang.out}</span>
                    <div class="card card-body m-b-30">
                        <h3 class="card-title font-20 m-t-0"><i class="fa fa-clock-o"></i> Cada 20 minutos a partir de las 10:00 AM.</h3>
                        <p class="card-text"><i class="ion-pin"></i> Muelle de API en Puerto Juarez.</p>
                    </div>
                </li>
                <li>
                    <span>{$lang.arrival}</span>
                    <div class="card card-body m-b-30">
                        <h3 class="card-title font-20 m-t-0"><i class="fa fa-clock-o"></i> 30 minutos despues de la salida.</h3>
                        <p class="card-text"><i class="ion-pin"></i> Muelle de Velázquez en Isla Mujeres.</p>
                    </div>
                </li>
                <li>
                    <span>{$lang.returned}</span>
                    <div class="card card-body m-b-30">
                        <h3 class="card-title font-20 m-t-0"><i class="fa fa-clock-o"></i> 6 horas despues de la salida.</h3>
                        <p class="card-text"><i class="ion-pin"></i> Muelle de API en Puerto Juarez.</p>
                    </div>
                </li>
            </ul>
            <div class="gallery owl-carousel owl-theme">
                <?php foreach ( $data['gallery'] as $value ): ?>
                    <div class="item">
                        <figure class="thumb">
                            <a class="fancybox" rel="group" href="{$path.uploads}<?= $value ?>"><img src="{$path.uploads}<?= $value ?>" alt="<?= $value ?>"></a>
                        </figure>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <a href="tel:+529983375918" id="reservation_phone" class="btn" target="_blank"><i class="fas fa-phone"></i></a>
    <a href="https://m.me/106456467505158" id="reservation_messenger" class="btn" target="_blank"><i class="fab fa-facebook-messenger"></i></a>
    <a href="https://api.whatsapp.com/send?phone=+529983375918" id="reservation_whatsapp" class="btn" target="_blank"><i class="fab fa-whatsapp"></i></a>
    <button id="reservation_mail" class="btn" data-button-modal="booking" style="background-color:#00a099"><i class="fas fa-envelope"></i></button>
    <a id="reservation" class="btn" style="background-color:#00a099"><i class="mdi mdi-calendar"></i></a>
</main>
<section id="booking" class="modal fullscreen" data-modal="booking">
    <div class="content">
        <header style="background-color:#00a099">
            <div class="container">
                <h6 class="m-0">¡Cotíza ahora!</h6>
            </div>
        </header>
        <main>
            <div class="container">
                <form name="booking">
                    <div class="row">
                        <div class="col-4">
                            <div class="label">
                                <label>
                                    <p>Bebés</p>
                                    <input name="babies" type="text" value="0"/>
                                    <p class="description">0 - 2 años: Gratis.</p>
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="label">
                                <label>
                                    <p>Niños</p>
                                    <input name="childs" type="text" value="0"/>
                                    <p class="description">3 - 7 años.</p>
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="label">
                                <label>
                                    <p>Adultos</p>
                                    <input name="adults" type="text" value="2"/>
                                    <p class="description">Mayores de 8 años.</p>
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="label">
                                <label>
                                    <p>Fecha</p>
                                    <input name="date" type="date"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="label">
                                <label>
                                    <p>Nombre</p>
                                    <input name="name" type="text"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="label">
                                <label>
                                    <p>Apellidos</p>
                                    <input name="lastname" type="text"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="label">
                                <label>
                                    <p>Correo electrónico</p>
                                    <input name="email" type="email"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="label">
                                <label>
                                    <p>Lada</p>
                                    <select name="lada">
                                        <?php foreach ( $this->format->import_file(PATH_INCLUDES, 'code_countries_lada', 'json') as $value ): ?>
                                            <option value="<?= $value['lada'] ?>" <?= ( $value['lada'] === '52' ) ? 'selected' : '' ?> ><?= $value['name']['es'] ?> ( +<?= $value['lada'] ?> )</option>
                                        <?php endforeach; ?>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="label">
                                <label>
                                    <p>Teléfono</p>
                                    <input name="phone" type="tel"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="label">
                                <label>
                                    <p>Comentarios</p>
                                    <textarea name="comments"></textarea>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        <footer>
            <div class="container text-right">
                <div class="action-buttons">
                    <button class="btn btn-link" button-close>Cerrar</button>
                    <button class="btn btn-primary" button-submit style="background-color:#00a099;border:none;">Cotizar</button>
                </div>
            </div>
        </footer>
    </div>
</section>
