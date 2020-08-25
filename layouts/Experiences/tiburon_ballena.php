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

<header class="main-navbar" style="background-color:#f29100">
    <div class="container d-flex align-item-center">
        <a href="/" id="back-nav" class="btn btn-outline btn-light"><i class="fa fa-arrow-left"></i></a>
        <h2 class="title text-white">{$lang.return}</h2>
    </div>
</header>
<main class="main-content">
    <header class="cover d-flex flex-column justify-content-end" style="background-image: url('{$path.uploads}tiburon-ballena-cover.jpg'); background-position: center 20%;">
        <div class="container">
            <h1 class="text-white">Tiburon Ballena.</h1>
            <p class="text-white m-b-5"><small><i class="mdi mdi-pin"></i> Cancún, Quintana Roo, México.</small></p>
            <p class="text-white">Haga snorkel con tiburones ballena. Obtenga la máxima emoción de adrenalina en el Caribe mexicano y vea a los gigantes suaves y la vida marina de la región desde una perspectiva diferente.</p>
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
            <h4 class="m-b-20">Desde $ 3,780.00 MXN + Descuentos</h4>
            <p class="text-muted">Nada con tiburones ballena cuando visiten la costa mexicana entre mediados de mayo hasta mitad de septiembre.</p>
            <p class="text-muted">Salida desde Punta Sam, bebidas de cortesía a bordo en el camino hacia el sitio de snorkel, donde se le dará su equipo de snórkel y se le proporcionará la información de seguridad sobre qué esperar en el mar. Salte al océano para bucear con los peces más grandes del mundo mientras se encuentra cara a cara con los tiburones ballena. Algunos ejemplares adultos pueden medir hasta 13 metros de longitud, aunque se han registrado relatos de individuos de hasta 18 metros, al subir a bordo le darán sándwiches de desayuno.</p>
            <p class="text-muted">Luego, se dirigirá a Playa Norte en Isla Mujeres para disfrutar de un delicioso almuerzo mientras disfruta de las cristalinas aguas de la isla, regrese a bordo de su barco para el traslado de regreso al punto de inicio. Tenga en cuenta que el encuentro con el tiburón ballena es una actividad segura y está disponible de mayo a septiembre.</p>
            <p class="text-muted"><strong>Nota:</strong> Es importante saber que no podemos controlar la naturaleza, por lo tanto, no podemos garantizar el nado con el avistamiento de los tiburones ballena. Los tiburones ballena vienen a el agua que se encuentran cerca de Cancún para alimentarse de plancton, sin embarco cuando hay poco alimento o no hay, es difícil poder ver al tiburón ballena, es por eso que ofrecemos el tour desde mediados de mayo hasta mediados de septiembre, por ellos le recomendamos para mediados de junio y los dos meses de julio y agosto ya que hay una mayor posibilidad de ver a los amistosos gigantes.</p>
            <section class="toggles m-b-50 m-t-50">
                <section class="toggle view">
                    <h3>¿Qué incluye?</h3>
                    <div>
                        <h5>Incluido</h5>
                        <p class="text-muted"><i class="fa fa-check"></i> Entradas.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Guías profesionales.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Equipo de sonorkel: Aletas, visor, tubo para respirar, y chaleco salvavidas.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Sándwiches.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Bebidas (aguas, sodas, cervezas).</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Ceviche.</p>
                        <hr>
                        <h5>No incluido</h5>
                        <p class="text-muted"><i class="fa fa-times"></i> Traje de neopreno, se ofrece como una alternativa en muelle y tiene un costo adicional de 15 USD por persona (pude llevar el suyo).</p>
                        <p class="text-muted"><i class="fa fa-times"></i> Gastos personales (suvenires).</p>
                        <p class="text-muted"><i class="fa fa-times"></i> Fotos y videos.</p>
                        <p class="text-muted"><i class="fa fa-times"></i> Propinas.</p>
                    </div>
                </section>
                <section class="toggle">
                    <h3>¿Qué me recomiendan llevar?</h3>
                    <div>
                        <p class="text-muted"><i class="fa fa-check"></i> Traje de baño.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Toalla.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Calzado cómodo.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Playera de algodón de manga larga.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Gafas de sol.</p>
                        <p class="text-muted"><i class="fa fa-check"></i> Sombrero.</p>
                    </div>
                </section>
                <section class="toggle">
                    <h3>¡NO se permite!</h3>
                    <div>
                        <p class="text-muted"><i class="fa fa-times"></i> Mascotas.</p>
                        <p class="text-muted"><i class="fa fa-times"></i> Fumar.</p>
                    </div>
                </section>
            </section>
            <ul class="timeline m-b-50">
                <li>
                    <span>Salída</span>
                    <div class="card card-body m-b-30">
                        <h3 class="card-title font-20 m-t-0"><i class="fa fa-clock-o"></i> 08:00 Hrs.</h3>
                        <p class="card-text"><i class="ion-pin"></i> Muelle de API en Punta Sam.</p>
                    </div>
                </li>
                <li>
                    <span>Arribo (Excursión)</span>
                    <div class="card card-body m-b-30">
                        <h3 class="card-title font-20 m-t-0"><i class="fa fa-clock-o"></i> 09:30 Hrs.</h3>
                        <p class="card-text"><i class="ion-pin"></i> Mar Caribe.</p>
                    </div>
                </li>
                <li>
                    <span>Regreso</span>
                    <div class="card card-body m-b-30">
                        <h3 class="card-title font-20 m-t-0"><i class="fa fa-clock-o"></i> 14:00 Hrs.</h3>
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
    <a href="tel:+529983375918" id="reservation_phone" class="btn" target="_blank"><i class="fas fa-phone"></i></a>
    <a href="https://m.me/106456467505158" id="reservation_messenger" class="btn" target="_blank"><i class="fab fa-facebook-messenger"></i></a>
    <a href="https://api.whatsapp.com/send?phone=+529983375918" id="reservation_whatsapp" class="btn" target="_blank"><i class="fab fa-whatsapp"></i></a>
    <button id="reservation_mail" class="btn" data-button-modal="booking" style="background-color:#f29100"><i class="fas fa-envelope"></i></button>
    <a id="reservation" class="btn" style="background-color:#f29100"><i class="mdi mdi-calendar"></i></a>
</main>
<section id="booking" class="modal fullscreen" data-modal="booking">
    <div class="content">
        <header style="background-color:#f29100">
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
                    <button class="btn btn-primary" button-submit style="background-color:#f29100;border:none;">Cotizar</button>
                </div>
            </div>
        </footer>
    </div>
</section>
