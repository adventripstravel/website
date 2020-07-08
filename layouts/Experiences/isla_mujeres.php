<?php
defined('_EXEC') or die;

// OWL Carousel
$this->dependencies->add(['css', '{$path.plugins}OwlCarousel2-2.3.4/assets/owl.carousel.min.css']);
$this->dependencies->add(['css', '{$path.plugins}OwlCarousel2-2.3.4/assets/owl.theme.default.min.css']);
$this->dependencies->add(['js', '{$path.plugins}OwlCarousel2-2.3.4/owl.carousel.min.js']);

// FancyBox
$this->dependencies->add(['css', '{$path.plugins}fancybox-2.1.7/source/jquery.fancybox.css?v=2.1.7']);
$this->dependencies->add(['js', '{$path.plugins}fancybox-2.1.7/source/jquery.fancybox.pack.js?v=2.1.7']);

// Bootstrap-touchspin
$this->dependencies->add(['css', '{$path.plugins}bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css']);
$this->dependencies->add(['js', '{$path.plugins}bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js']);

// Bootstrap-inputmask
$this->dependencies->add(['js', '{$path.plugins}bootstrap-inputmask/jquery.inputmask.min.js']);

// Page
$this->dependencies->add(['js', '{$path.js}pages/experiences.js']);
?>
<header class="main-navbar">
    <div class="container d-flex align-item-center">
        <a href="/" id="back-nav" class="btn btn-outline btn-light"><i class="fa fa-arrow-left"></i></a>

        <h2 class="title text-white"><?= $data['title'] ?></h2>
    </div>
</header>

<main class="main-content">
    <header class="cover d-flex flex-column justify-content-end" style="background-image: url('{$path.uploads}isla-mujeres-cover.jpg'); background-position: center 20%;">
        <div class="container">
            <h1 class="text-white">Isla Mujeres.</h1>
            <p class="text-white m-b-5"><small><i class="mdi mdi-pin"></i> Cancún, Quintana Roo, México.</small></p>
            <p class="text-white">Visita una de las más hermosas islas en el caribe mexicano. En esta animada excursión harás snorkel, recorrerás sus hermosas y pintorescas calles y podrás comprar extraordinarias artesanías locales.</p>
            <p class="text-warning">¡Si eres mexicano, solicita tu descuento del 50%!</p>

            <div class="p-b-20"></div>
        </div>
    </header>
    <section class="p-t-50 p-b-50">
        <div class="container">
            <p class="text-muted">Después de disfrutar un delicioso desayuno continental, harás snorkel en un precioso arrecife para observar de cerca muchísimos peces tropicales de todos colores, increíbles formaciones coralinas y otras especies marinas que habitan el mar entre Isla Mujeres y Cancún. Ya en la isla podrás recorrer las tranquilas calles del centro de Isla Mujeres; ahí verás locales ofreciendo artesanías hechas sobre todo con conchas y caracoles marinos, además de restaurantes, bares y más.</p>
            <p class="text-muted">Parte desde puerto Juárez a Isla Mujeres (salidas a partir de las 9:00 am y después cada 15 minutos) a bordo de una lancha, al llegar conoce la zona centro de la isla donde podrás admirar y disfrutar de los bellos paisajes que el pueblo mágico, regresa a la lacha y diríjase al MÍA Reef una alberca natural donde podrá bajar y nadar sin que el gua le pase de la cintura, a continuación diríjase al farito hacer snorkel donde recibirá el equipo de snorkel necesario así como las indicaciones, al terminar irá al lugar destinado para que disfrute de su pescado a las brasas, después regrese a la lancha para regresar al punto de inicio.</p>
            <p class="text-muted">Conocerás la zona centro de Isla Mujeres, visitaremos playa norte, también podrás nadar en una alberca natural, sin perdernos del snorkel en el "Farito" un arrecife de coral donde habítan una gran variedad de peces. También podrás satisfacer tu hambre comiendo un "tikin xic", plato típico de Isla Mujeres.</p>

            <section class="toggles m-b-50 m-t-50">
                <section class="toggle view">
                    <h3>¿Qué incluye?</h3>
                    <div>
                        <h5>Incluido</h5>
                        <p class="text-muted"><i class="fa fa-check"></i> Guía.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Equipo de snorkel.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Entrada al parque marino (farito).</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Hielera (puede llevar sus bebidas y hacer uso de la hielera).</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Comida.</p>

                        <hr>

                        <h5>No incluido</h5>
                        <p class="text-muted"><i class="fa fa-times"></i> Propinas optativas.</p>
                        <p class="text-muted"><i class="fa fa-times"></i> Fotos/videos.</p>
                    </div>
                </section>
                <section class="toggle">
                    <h3>¿Qué me recomiendan llevar?</h3>
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
                    <span>Salída</span>
                    <div class="card card-body m-b-30">
                        <h3 class="card-title font-20 m-t-0"><i class="fa fa-clock-o"></i> Cada 20 minutos a partir de las 10:00 AM.</h3>
                        <p class="card-text"><i class="ion-pin"></i> Muelle de API en Puerto Juarez.</p>
                    </div>
                </li>
                <li>
                    <span>Arribo (Excursión)</span>
                    <div class="card card-body m-b-30">
                        <h3 class="card-title font-20 m-t-0"><i class="fa fa-clock-o"></i> 30 minutos despues de la salida.</h3>
                        <p class="card-text"><i class="ion-pin"></i> Muelle de Velázquez en Isla Mujeres.</p>
                    </div>
                </li>
                <li>
                    <span>Regreso</span>
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

    <button id="reservation" class="btn" data-button-modal="booking"><i class="mdi mdi-calendar"></i></button>
</main>

<section id="booking" class="modal fullscreen" data-modal="booking">
    <div class="content">
        <header>
            <div class="container">
                <h6 class="m-0">Cotíza tu experiencia.</h6>
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
                        <div class="col-12">
                            <div class="label">
                                <label>
                                    <p>Fecha</p>
                                    <input name="date" type="date"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="label">
                                <label>
                                    <p>Nombre</p>
                                    <input name="name" type="text"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="label">
                                <label>
                                    <p>Apellidos</p>
                                    <input name="lastname" type="text"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="label">
                                <label>
                                    <p>Correo electrónico</p>
                                    <input name="email" type="email"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="label">
                                <label>
                                    <p>Nacionalidad</p>
                                    <select name="nationality">
                                        <option value="mexican">Mexicano</option>
                                        <option value="other">Otra</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
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
                        <div class="col-6">
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

                <p class="text-muted m-t-20">Para nosotros es muy importante la opinión de nuestros turistas, por ello queremos otorgarte la mejor experiencia en cada uno de nuestros tours.</p>
                <p class="text-muted">Una vez enviado este formulario, nos contactaremos contigo para otorgarte los precios de tu experiencia, ya que suelen variar muy seguido.</p>
            </div>
        </main>
        <footer>
            <div class="container text-right">
                <div class="action-buttons">
                    <button class="btn btn-link" button-close>Cerrar</button>
                    <button class="btn btn-primary" button-submit>Enviar</button>
                </div>
            </div>
        </footer>
    </div>
</section>
