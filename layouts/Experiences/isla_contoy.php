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

<header class="main-navbar" style="background-color:#3fb4d0">
    <div class="container d-flex align-item-center">
        <a href="/" id="back-nav" class="btn btn-outline btn-light"><i class="fa fa-arrow-left"></i></a>
        <h2 class="title text-white">{$lang.return}</h2>
    </div>
</header>
<main class="main-content">
    <header class="cover d-flex flex-column justify-content-end" style="background-image: url('{$path.uploads}isla-contoy-cover.jpg'); background-position: center 20%;">
        <div class="container">
            <h1 class="text-white">Isla Contoy.</h1>
            <p class="text-white m-b-5"><small><i class="mdi mdi-pin"></i> Cancún, Quintana Roo, México.</small></p>
            <p class="text-white">Visita dos preciosas islas caribeñas en un mismo día, nada y practica snórkel en el mar. Explora la reserva natural de Contoy, elige entre un montón de actividades para la tarde y disfruta de tiempo libre para relajarte en la playa de isla Mujeres.</p>
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
            <p class="text-muted">Isla Contoy es una de las principales reservas naturales de Quintana Roo, puedes visitarla en un viaje privado y personalizado para tu grupo. En la isla habitan más de 150 especies de aves y su visita es obligada para los amantes de la naturaleza.</p>
            <p class="text-muted">La Isla Contoy se trata de una reserva natural protegida. Es literalmente una isla de casi 9 kilómetros de longitud convertidos en 230 hectáreas de casa-hogar de 152 especies distintas de aves; esto lo convierte en el refugio de aves marinas más importante de la zona del Caribe Mexicano.</p>
            <p class="text-muted">Embárcate en un tour para hacer snórkel dónde podrás admirar arrecifes de coral y una gran variedad de especies marinas, después te dirigirás a la isla para admirar de cerca la belleza natural de la reserva. A continuación podrás, hacer una caminata para conocer la flora y la fauna, visitar un museo local y subir al mirador de 25 metros de altura desde el que podrás contemplar vistas espectaculares o avista alguna de las 152 especies de aves diferentes que viven en la isla.</p>
            <p class="text-muted">Disfruta del almuerzo a la orilla de la playa y dirígete a la playa Norte en isla Mujeres para nadar en las aguas más cristalinas de sus costas.</p>
            <section class="toggles m-b-50 m-t-50">
                <section class="toggle view">
                    <h3>¿Qué incluye?</h3>
                    <div>
                        <h5>Incluido</h5>
                        <p class="text-muted"><i class="fa fa-check"></i> Desayuno continental antes de partir.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Equipo y guía de snorkel.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Bebidas a boro de la embarcación.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Almuerzo.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Todas las actividades del itinerario.</p>
                        <hr>
                        <h5>No incluido</h5>
                        <p class="text-muted"><i class="fa fa-times"></i> Propinas optativas.</p>
                        <p class="text-muted"><i class="fa fa-times"></i> Fotos de recuerdo (disponibles a la venta).</p>
                        <p class="text-muted"><i class="fa fa-times"></i> Entrada a la reserva natural de Contoy (10 USD).</p>
                    </div>
                </section>
                <section class="toggle">
                    <h3>¿Qué me recomiendan llevar?</h3>
                    <div>
                        <p class="text-muted"><i class="fa fa-check"></i> Calzado cómodo.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Gafas de sol.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Sombrero.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Bañador.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Toalla.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Cámara.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Binoculares.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Protector solar biodegradable.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Pesos mexicanos para gastos adicionales.</p>
                    </div>
                </section>
                <section class="toggle">
                    <h3>¡NO se permite!</h3>
                    <div>
                        <p class="text-muted"><i class="fa fa-times"></i> Mascotas.</p>
                        <p class="text-muted"><i class="fa fa-times"></i> Fumar.</p>
                        <p class="text-muted"><i class="fa fa-times"></i> Maletas o bolsas grandes.</p>
                    </div>
                </section>
                <section class="toggle">
                    <h3>¡NO es apto! para...</h3>
                    <div>
                        <p class="text-muted"><i class="fa fa-times"></i> Embarazadas.</p>
                        <p class="text-muted"><i class="fa fa-times"></i> Personas en silla de ruedas.</p>
                    </div>
                </section>
            </section>
            <ul class="timeline m-b-50">
                <li>
                    <span>Salída</span>
                    <div class="card card-body m-b-30">
                        <h3 class="card-title font-20 m-t-0"><i class="fa fa-clock-o"></i> 09:00 Hrs.</h3>
                        <p class="card-text"><i class="ion-pin"></i> Muelle de API en Punta Sam.</p>
                    </div>
                </li>
                <li>
                    <span>Arribo (Excursión)</span>
                    <div class="card card-body m-b-30">
                        <h3 class="card-title font-20 m-t-0"><i class="fa fa-clock-o"></i> 10:00 Hrs.</h3>
                        <p class="card-text"><i class="ion-pin"></i> Muelle de Isla Contoy.</p>
                    </div>
                </li>
                <li>
                    <span>Regreso</span>
                    <div class="card card-body m-b-30">
                        <h3 class="card-title font-20 m-t-0"><i class="fa fa-clock-o"></i> 16:00 Hrs.</h3>
                        <p class="card-text"><i class="ion-pin"></i> Muelle de API en Punta Sam.</p>
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
    <a href="mailto:reservaciones@adventrips.com" id="reservation_mail" class="btn" target="_blank"><i class="fas fa-envelope"></i></a>
    <a href="tel:+529983375918" id="reservation_phone" class="btn" target="_blank"><i class="fas fa-phone"></i></a>
    <a href="https://m.me/106456467505158" id="reservation_messenger" class="btn" target="_blank"><i class="fab fa-facebook-messenger"></i></a>
    <a href="https://api.whatsapp.com/send?phone=+529983375918" id="reservation_whatsapp" class="btn" target="_blank"><i class="fab fa-whatsapp"></i></a>
    <button id="reservation" class="btn" data-button-modal="booking" style="background-color:#3fb4d0"><i class="mdi mdi-calendar"></i></button>
</main>
<section id="booking" class="modal fullscreen" data-modal="booking">
    <div class="content">
        <header style="background-color:#3fb4d0">
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
                    <button class="btn btn-primary" button-submit style="background-color:#3fb4d0;border:none;">Cotizar</button>
                </div>
            </div>
        </footer>
    </div>
</section>
