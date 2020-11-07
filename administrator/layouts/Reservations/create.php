<?php
defined('_EXEC') or die;

// Bootstrap-inputmask
$this->dependencies->add(['js', '{$path.plugins}bootstrap-inputmask/jquery.inputmask.min.js']);

// Bootstrap-touchspin
$this->dependencies->add(['css', '{$path.plugins}bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css']);
$this->dependencies->add(['js', '{$path.plugins}bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js']);

// Sweet Alert
$this->dependencies->add(['css', '{$path.plugins}sweet-alert2/sweetalert2.min.css']);
$this->dependencies->add(['js', '{$path.plugins}sweet-alert2/sweetalert2.min.js']);

// Page
$this->dependencies->add(['js', '{$path.js}pages/reservations/create.js?v=1.3']);
?>
<main class="wrapper">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <ol class="breadcrumb hide-phone">
                        <li class="breadcrumb-item">
                            <a href="index.php">{$vkye_webpage}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="index.php?c=reservations">Reservaciones</a>
                        </li>
                        <li class="breadcrumb-item active">Nuevo</li>
                    </ol>

                    <h4 class="page-title">Crear una nueva reservación</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <form name="reservation" class="row font-14">
            <div class="col-xl-6">
                <!-- Customer -->
                <div class="card m-b-30" data-block="customer">
                    <div class="card-body">
                        <!-- Title container -->
                        <h4 class="header-title m-t-0">Cliente</h4>
                        <p class="text-muted m-b-20">Información detallada del cliente que realiza la reservación.</p>
                        <!-- End title container -->

                        <div class="form-group row">
                            <div class="col-md-3">
                                <h6 class="p-t-5">Nombre</h6>
                            </div>
                            <div class="col-md-9">
                                <div class="label">
                                    <label>
                                        <input class="form-control" type="text" name="customer_name">
                                        <p class="description text-muted">Escriba el nombre completo del cliente que realiza la reservación.</p>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <h6 class="p-t-5">Coreo electrónico</h6>
                            </div>
                            <div class="col-md-9">
                                <div class="label">
                                    <label>
                                        <input class="form-control" type="email" name="customer_email">
                                        <p class="description text-muted">Correo electrónico, aquí llegará el ticket de reservación.</p>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <h6 class="p-t-5">Teléfono</h6>
                            </div>
                            <div class="col-md-3 p-r-10">
                                <div class="label">
                                    <label>
                                        <select name="prefix">
                                            <?php foreach ( $ladas as $value ): ?>
                                                <option value="<?= $value['lada'] ?>" <?= ( $value['lada'] === '52' ) ? 'selected' : '' ?> ><?= $value['name']['es'] ?> ( +<?= $value['lada'] ?> )</option>
                                            <?php endforeach; ?>
                                        </select>
                                        <p class="description text-muted">Prefijo</p>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 p-l-10">
                                <div class="label">
                                    <label>
                                        <input class="form-control" type="text" name="customer_phone">
                                        <p class="description text-muted">Teléfono de contacto a 10 dígitos.</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reservation -->
                <div class="card m-b-30" data-block="reservation">
                    <div class="card-body">
                        <!-- Title container -->
                        <h4 class="header-title m-t-0">Reserva</h4>
                        <p class="text-muted m-b-20">Información detallada de la reservación.</p>
                        <!-- End title container -->

                        <div class="form-group row">
                            <div class="col-md-3">
                                <h6 class="p-t-5">Pax</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="label">
                                    <label>
                                        <input type="text" value="2" name="pax_adults">
                                        <p class="description text-muted">Adultos.</p>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="label">
                                    <label>
                                        <input type="text" value="0" name="pax_childrens">
                                        <p class="description text-muted">Niños.</p>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="label">
                                    <label>
                                        <input type="text" value="0" name="pax_babys">
                                        <p class="description text-muted">Bebés.</p>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <h6 class="p-t-5">Fecha</h6>
                            </div>
                            <div class="col-md-9">
                                <div class="label">
                                    <label>
                                        <input class="form-control" type="date" name="reservation_date" value="<?= date("Y-m-d",strtotime(date('Y-m-d') ."+ 1 days")) ?>">
                                        <p class="description text-muted">Elijá la fecha a reservar.</p>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <h6 class="p-t-5">Horario</h6>
                            </div>
                            <div class="col-md-9">
                                <div class="label">
                                    <label>
                                        <input class="form-control" type="time" name="reservation_hour" value="14:00">
                                        <p class="description text-muted">Establezcla el horario para la salida del yate.</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <!-- Reservation -->
                <div class="card m-b-30" data-block="info">
                    <div class="card-body">
                        <!-- Title container -->
                        <h4 class="header-title m-t-0">...</h4>
                        <p class="text-muted m-b-20">... ... ...</p>
                        <!-- End title container -->

                        <div class="form-group row">
                            <div class="col-md-3">
                                <h6 class="p-t-5">Hotel</h6>
                            </div>
                            <div class="col-md-5">
                                <div class="label">
                                    <label>
                                        <input type="text" value="" name="">
                                        <p class="description text-muted">Nombre del hotel.</p>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="label">
                                    <label>
                                        <input type="text" value="" name="">
                                        <p class="description text-muted">Número de habitación.</p>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <h6 class="p-t-5">Número de confirmación</h6>
                            </div>
                            <div class="col-md-9">
                                <div class="label">
                                    <label>
                                        <input class="form-control" type="text" name="">
                                        <p class="description text-muted">Escriba el nombre completo del cliente que realiza la reservación.</p>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <h6 class="p-t-5">Location ***</h6>
                            </div>
                            <div class="col-md-9">
                                <div class="label">
                                    <label>
                                        <input class="form-control" type="text" name="">
                                        <p class="description text-muted">Escriba el nombre completo del cliente que realiza la reservación.</p>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <h6 class="p-t-5">Nombre del tour.</h6>
                            </div>
                            <div class="col-md-9">
                                <div class="label">
                                    <label>
                                        <input class="form-control" type="text" name="">
                                        <p class="description text-muted">Escriba el nombre completo del cliente que realiza la reservación.</p>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <h6 class="p-t-5">Precio por tour.</h6>
                            </div>
                            <div class="col-md-9">
                                <div class="label">
                                    <label>
                                        <input class="form-control" type="text" name="">
                                        <p class="description text-muted">Escriba el nombre completo del cliente que realiza la reservación.</p>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <h6 class="p-t-5">Forma de pago</h6>
                            </div>
                            <div class="col-md-9">
                                <div class="label">
                                    <label>
                                        <select class="form-control" name="">
                                            <?php foreach ( Functions::payment_methods() as $key => $value ): ?>
                                                <option value="<?= $value['code'] ?>"><?= ucwords($value['title']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="p-t-30"></div>

                        <button type="submit" class="btn btn-block">Crear reservación</button>
                        <a href="index.php?c=reservations" class="btn btn-block btn-link p-b-0"><small>Cancelar</small></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
