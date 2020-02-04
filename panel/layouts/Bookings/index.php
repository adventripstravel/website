<?php

defined('_EXEC') or die;

$this->dependencies->add(['js','{$path.js}Bookings/index.min.js']);

?>

%{header}%
<a data-button-modal="create_booking"><i class="material-icons">add</i></a>
<table>
    <thead>
        <tr>
            <th>Token</th>
            <th>Fecha</th>
            <th>Excursión</th>
            <th>Paxes</th>
            <th>Contacto</th>
            <th>Total</th>
            <th>Pago</th>
            <th>Solicitud</th>
            <th>Estado</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {$tbl_bookings}
    </tbody>
</table>
<section class="modal" data-modal="create_booking">
    <div class="content">
        <header>
            <h4>Crear</h4>
        </header>
        <main>
            <form name="create_booking">
                <fieldset class="fields-group">
                    <div class="warning">
                        <p><span class="required-field">*</span>Campos obligatorios</p>
                    </div>
                </fieldset>
                <fieldset class="fields-group hidden">
                    <div class="text">
                        <h6>Token</h6>
                        <input type="text" name="token" disabled>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6>Excursión</h6>
                        <select name="tour">
                            <option value="" selected hidden>Seleccionar</option>
                            {$opt_tours}
                        </select>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="row">
                        <div class="span6">
                            <div class="text">
                                <h6>Précio (Niño)</h6>
                                <input type="text" name="price_child" value="$ 0.00 USD" disabled>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="text">
                                <h6>Précio (Adulto)</h6>
                                <input type="text" name="price_adult" value="$ 0.00 USD" disabled>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="row">
                        <div class="span4">
                            <div class="text">
                                <h6>Paxes (Niños)</h6>
                                <input type="number" name="paxes_childs" value="0" min="0">
                            </div>
                        </div>
                        <div class="span4">
                            <div class="text">
                                <h6>Paxes (Adultos)</h6>
                                <input type="number" name="paxes_adults" value="1" min="1">
                            </div>
                        </div>
                        <div class="span4">
                            <div class="text">
                                <h6>Fecha de reservación</h6>
                                <input type="date" name="booked_date" value="<?php echo Functions::get_current_date(); ?>" min="<?php echo Functions::get_current_date(); ?>">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="row">
                        <div class="span4">
                            <div class="text">
                                <h6>Total</h6>
                                <input type="number" name="total" value="0" min="0">
                            </div>
                        </div>
                        <div class="span4">
                            <div class="text">
                                <h6>Moneda de pago</h6>
                                <select name="payment_currency">
                                    <option value="USD" selected>USD</option>
                                    <option value="MXN">MXN</option>
                                </select>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="text">
                                <h6>Tipo de cambio</h6>
                                <input type="text" name="payment_exchange" value="<?php echo Functions::get_format_currency(Functions::get_currency_exchange(1, 'USD', 'MXN'), 'MXN'); ?>" disabled>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="row">
                        <div class="span6">
                            <div class="text">
                                <h6>Nombre(s)</h6>
                                <input type="text" name="firstname">
                            </div>
                        </div>
                        <div class="span6">
                            <div class="text">
                                <h6>Apellido(s)</h6>
                                <input type="text" name="lastname">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="row">
                        <div class="span6">
                            <div class="text">
                                <h6>Correo electrónico</h6>
                                <input type="email" name="email">
                            </div>
                        </div>
                        <div class="span2">
                            <div class="text">
                                <h6>Lada</h6>
                                <select name="phone_lada">
                                    <option value="" selected hidden>Seleccionar</option>
                                    {$opt_phone_ladas}
                                </select>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="text">
                                <h6>Teléfono</h6>
                                <input type="text" name="phone_number">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6>Observaciones</h6>
                        <textarea name="observations"></textarea>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="row">
                        <div class="span4">
                            <div class="text">
                                <h6>Fecha de pago</h6>
                                <input type="date" name="payment_date" min="<?php echo Functions::get_current_date(); ?>">
                            </div>
                        </div>
                        <div class="span4">
                            <div class="text">
                                <h6>Metodo de pago</h6>
                                <select name="payment_method">
                                    <option value="">Ninguno</option>
                                    <option value="transfer">Transferencia interbancaria</option>
                                    <option value="oxxo">Deposito en OXXO</option>
                                </select>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="text">
                                <h6>Estado de pago</h6>
                                <select name="payment_status">
                                    <option value="0">Pendiente</option>
                                    <option value="1">Realizado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="fields-group hidden">
                    <div class="text">
                        <h6>Tipo de solicitud</h6>
                        <input type="text" name="request_type" disabled>
                    </div>
                </fieldset>
                <fieldset class="fields-group hidden">
                    <div class="text">
                        <h6>Detalles de solicitud</h6>
                        <textarea name="request_details" disabled></textarea>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="row">
                        <div class="span12">
                            <div class="text">
                                <h6>Idioma de registro</h6>
                                <select name="language">
                                    <option value="es">Español</option>
                                    <option value="en">Ingles</option>
                                </select>
                            </div>
                        </div>
                        <div class="span4 hidden">
                            <div class="text">
                                <h6>Fecha de registro</h6>
                                <input type="date" name="registration_date" value="<?php echo Functions::get_current_date(); ?>" min="<?php echo Functions::get_current_date(); ?>" disabled>
                            </div>
                        </div>
                        <div class="span4 hidden">
                            <div class="text">
                                <h6>Estado de reservación</h6>
                                <input type="text" name="status" disabled>
                            </div>
                        </div>
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
