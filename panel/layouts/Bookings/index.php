<?php

defined('_EXEC') or die;

$this->dependencies->add(['js','{$path.js}Bookings/index.min.js']);

$this->dependencies->add(['css','{$path.plugins}datatables/css/jquery.dataTables.min.css']);
$this->dependencies->add(['css','{$path.plugins}datatables/css/dataTables.material.min.css']);
$this->dependencies->add(['css','{$path.plugins}datatables/css/responsive.dataTables.min.css']);
$this->dependencies->add(['css','{$path.plugins}datatables/css/buttons.dataTables.min.css']);
$this->dependencies->add(['js','{$path.plugins}datatables/js/jquery.dataTables.min.js']);
$this->dependencies->add(['js','{$path.plugins}datatables/js/dataTables.material.min.js']);
$this->dependencies->add(['js','{$path.plugins}datatables/js/dataTables.responsive.min.js']);
$this->dependencies->add(['js','{$path.plugins}datatables/js/dataTables.buttons.min.js']);
$this->dependencies->add(['js','{$path.plugins}datatables/js/vfs_fonts.js']);
$this->dependencies->add(['js','{$path.plugins}datatables/js/buttons.html5.min.js']);

?>

%{header}%
<section class="main-container">
    <div class="title">
        <h1>Reservaciones</h1>
    </div>
    <div class="buttons">
        <fieldset class="fields-group">
            <div class="text">
                <select name="time">
                    {$lst_time}
                </select>
            </div>
        </fieldset>
    </div>
    <div class="content">
        <table class="display" data-page-length="100">
            <thead>
                <tr>
                    <th width="100px">Token</th>
                    <th>Contacto</th>
                    <th>Excursión</th>
                    <th width="200px">Paxs</th>
                    <th width="100px">Fecha</th>
                    <th width="100px">Estado</th>
                    <th width="30px"></th>
                </tr>
            </thead>
            <tbody>
                {$lst_datas}
            </tbody>
        </table>
    </div>
</section>
<section class="modal" data-modal="datas">
    <div class="content">
        <header>
            <h4>Detalles / Editar</h4>
        </header>
        <main>
            <form name="datas">
                <fieldset class="fields-group">
                    <p class="warning"><span class="required-field">*</span>Campos obligatorios</p>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6>Token</h6>
                        <input type="text" name="token" disabled>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="title">
                        <h4>Información de contacto</h4>
                    </div>
                    <div class="text">
                        <h6><span class="required-field">*</span>Nombre</h6>
                        <input type="text" name="name">
                    </div>
                </fieldset>
                <fieldset class="fields-group row">
                    <div class="text span6">
                        <h6><span class="required-field">*</span>Correo electrónico</h6>
                        <input type="email" name="email">
                    </div>
                    <div class="text span6">
                        <h6><span class="required-field">*</span>Teléfono</h6>
                        <input type="text" name="cellphone">
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="title">
                        <h4>Información de reservación</h4>
                    </div>
                    <div class="text">
                        <h6>Excursión</h6>
                        <input type="text" name="tour" disabled>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6>Fecha de excursión</h6>
                        <input type="text" name="date_booking" disabled>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6>Paxes</h6>
                        <input type="text" name="paxes" disabled>
                    </div>
                </fieldset>
                <fieldset class="fields-group row">
                    <div class="text span6">
                        <h6>Total</h6>
                        <input type="text" name="totals_amount" disabled>
                    </div>
                    <div class="text span6">
                        <h6>Descuento</h6>
                        <input type="text" name="totals_discount" disabled>
                    </div>
                </fieldset>
                <fieldset class="fields-group row">
                    <div class="text span6">
                        <h6>Método de pago</h6>
                        <input type="text" name="payment_method" disabled>
                    </div>
                    <div class="text span6">
                        <h6>Moneda de pago</h6>
                        <input type="text" name="payment_currency" disabled>
                    </div>
                </fieldset>
                <fieldset class="fields-group row">
                    <div class="text span6">
                        <h6>Estado</h6>
                        <select name="language">
                            <option value="es">Español</option>
                            <option value="en">Ingles</option>
                        </select>
                    </div>
                    <div class="text span6">
                        <h6>Estado</h6>
                        <select name="canceled">
                            <option value="0">Activa</option>
                            <option value="1">Cancelada</option>
                        </select>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6>Observaciones</h6>
                        <textarea name="observations"></textarea>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6>Fecha de reservación</h6>
                        <input type="text" name="date_booked" disabled>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6>Airbnb</h6>
                        <input type="text" name="airbnb" disabled>
                    </div>
                </fieldset>
            </form>
        </main>
        <footer>
            <a class="btn btn-colored" button-success>Aceptar</a>
            <a class="btn" button-cancel>Cerrar</a>
        </footer>
    </div>
</section>
