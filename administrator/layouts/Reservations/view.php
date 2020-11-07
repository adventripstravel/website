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
$this->dependencies->add(['js', '{$path.js}pages/reservations/view.js?v=1.3']);
?>
<main class="wrapper">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row d-print-none">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <ol class="breadcrumb hide-phone">
                        <li class="breadcrumb-item">
                            <a href="index.php">{$vkye_webpage}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="index.php?c=reservations">Reservaciones</a>
                        </li>
                        <li class="breadcrumb-item active"><?= $reservation['folio'] ?></li>
                    </ol>

                    <h4 class="page-title">Reservación de <?= $reservation['customer_name'] ?></h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12 m-b-20 d-print-none">
                <div class="button-items text-lg-right">
                    <?php if ( in_array('{payments_create}', Session::get_value('session_permissions')) || in_array('{expenses_create}', Session::get_value('session_permissions')) ) : ?>
                        <div class="dropmenu mobile-responsive menu-right">
                            <button class="btn waves-effect waves-light">Agregar <i class="fa fa-caret-down"></i></button>
                            <div class="dropdown">
                                <a class="with-icon text-nowrap waves-effect waves-dark" href="javascript:void(0);" data-button-modal="add_hour_extra"><i class="icon fa fa-clock-o"></i> Horas extra</a>
                                <a class="with-icon text-nowrap waves-effect waves-dark" href="javascript:void(0);" data-button-modal="add_transportation"><i class="icon fa fa-bus"></i> Transportación</a>
                                <a class="with-icon text-nowrap waves-effect waves-dark" href="javascript:void(0);" data-button-modal="add_extras"><i class="icon fa fa-plus-square"></i> Otros extras</a>

                                <?php if ( in_array('{payments_create}', Session::get_value('session_permissions')) || in_array('{expenses_create}', Session::get_value('session_permissions')) ) : ?>
                                    <span class="space"></span>
                                <?php endif; ?>

                                <?php if ( in_array('{payments_create}', Session::get_value('session_permissions')) ) : ?>
                                    <a class="with-icon text-nowrap waves-effect waves-dark" href="javascript:void(0);" data-button-modal="add_payment_reference"><i class="icon fa fa-dollar"></i>Abono del cliente</a>
                                <?php endif; ?>
                                <?php if ( in_array('{expenses_create}', Session::get_value('session_permissions')) ) : ?>
                                    <a class="with-icon text-nowrap waves-effect waves-dark" href="javascript:void(0);" data-button-modal="add_expense"><i class="icon fa fa-calculator"></i>Gasto de la salída</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="dropmenu mobile-responsive menu-right">
                        <button class="btn btn-secondary waves-effect waves-light">Acciones <i class="fa fa-caret-down"></i></button>
                        <div class="dropdown">
                            <a class="with-icon text-nowrap waves-effect waves-dark" href="javascript:window.print()"><i class="icon fa fa-print"></i>Imprimir</a>
                            <a class="with-icon text-nowrap waves-effect waves-dark" href="<?= str_replace('administrator/', '', $this->format->baseurl()) ?>ticket/<?= $reservation['folio'] ?>" target="_blank"><i class="icon fa fa-link"></i>Ver ticket de cliente</a>
                            <a class="with-icon text-nowrap waves-effect waves-dark" href="whatsapp://send?text=Este es el link de tu reservación para el día <?= Dates::formatted_date($reservation['data']['reservation']['date'], 'formatted') ?>, https://www.yachtmstr.com/ticket/<?= $reservation['folio'] ?>"><i class="icon fa fa-whatsapp"></i>Compartir por WhatsApp</a>
                            <a class="with-icon text-nowrap waves-effect waves-dark" href="whatsapp://send?text=Este es el link de tu reservación para el día <?= Dates::formatted_date($reservation['data']['reservation']['date'], 'formatted') ?>, https://www.yachtmstr.com/ticket/<?= $reservation['folio'] ?>&phone=<?= str_replace(['+'], '', $reservation['data']['customer']['phone']) ?>"><i class="icon fa fa-whatsapp"></i>WhatsApp al cliente</a>

                            <?php if ( $reservation['status'] === 'available' ): ?>
                                <span class="space"></span>
                                <a class="with-icon text-nowrap waves-effect waves-dark" href="javascript:void(0);" id="send_notification" data-folio="<?= $reservation['folio'] ?>"><i class="icon fa fa-send"></i>Reenviar notificaciones</a>
                            <?php endif; ?>

                            <?php if ( in_array('{reservations_delete}', Session::get_value('session_permissions')) ) : ?>
                                <span class="space"></span>
                                <a class="with-icon text-nowrap waves-effect waves-dark" href="javascript:void(0);"><i class="icon fa fa-trash"></i>Eliminar reservación</a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if ( in_array('{reservations_update}', Session::get_value('session_permissions')) ) : ?>
                        <button class="btn btn-warning waves-effect waves-light" type="button" data-button-modal="edit_reservation">Editar reservación</button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-12 m-b-30">
                <div class="card">
                    <div class="card-body">
                        <article class="invoice">
                            <header>
                                <figure>
                                    <img src="{$path.images}logotype-large.svg" alt="logo" height="40"/>
                                </figure>

                                <h4>Cancún, Quintana Roo a <?= Dates::formatted_date($reservation['creation_date'], 'formatted') ?>.</h4>
                            </header>
                            <main>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <h4 class="header-title m-t-0">Información del cliente.</h4>

                                            <p class="text"><strong>Nombre</strong> <?= $reservation['data']['customer']['name'] ?>.</p>
                                            <p class="text"><strong>Correo electrónico</strong> <?= $reservation['data']['customer']['email'] ?>.</p>
                                            <p class="text"><strong>Teléfono</strong> <?= $reservation['data']['customer']['phone'] ?>.</p>
                                        </address>

                                        <address>
                                            <h4 class="header-title m-t-0">Información de la reservación.</h4>

                                            <?php $duration = ($reservation['data']['reservation']['hours_extra']['hours_extra'] > 0) ? $reservation['data']['yacht']['duration'] + $reservation['data']['reservation']['hours_extra']['hours_extra'] : $reservation['data']['yacht']['duration']; ?>
                                            <p class="text"><strong>Origen</strong> <?= ( array_key_exists($reservation['origin'], $type_reservations) )? $type_reservations[$reservation['origin']]['name'] : $reservation['origin'] ?>.</p>
                                            <p class="text"><strong>Yate</strong> <?= $reservation['data']['yacht']['name'] ?>.</p>
                                            <p class="text"><strong>Fecha reservada</strong> <?= Dates::formatted_date($reservation['data']['reservation']['date'], 'formatted') ?>.</p>
                                            <p class="text"><strong>Hora reservada</strong> <?= $reservation['data']['reservation']['hour'] ?> hrs a <?= date('H:i', strtotime("+{$duration} hours", strtotime($reservation['data']['reservation']['hour']))) ?> hrs.</p>
                                            <p class="text"><strong>Duración de la reserva</strong> <?= $duration ?> hrs.</p>
                                            <p class="text"><strong>Pax</strong> <?= $reservation['data']['yacht']['pax']['adults'] ?> adultos, <?= $reservation['data']['yacht']['pax']['childrens'] ?> niños.</p>
                                            <p class="text">
                                                <strong>Estado de la reservación</strong>
                                                <?php if ( in_array('{reservations_status}', Session::get_value('session_permissions')) ) : ?>
                                                    <select id="change_reservation_status" name="reservation_status" data-folio="<?= $reservation['folio'] ?>">
                                                        <?php foreach ( ['available' => 'Disponible', 'finalized' => 'Finalizada', 'no_show' => 'No se presentó', 'cancelled' => 'Cancelada'] as $key => $value ): ?>
                                                            <option value="<?= $key ?>" <?= ( $key == $reservation['status'] ? 'selected' : '' ) ?> ><?= $value ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                <?php else: ?>
                                                    <?= $reservation['status'] ?>
                                                <?php endif; ?>
                                            </p>
                                        </address>
                                    </div>

                                    <div class="col-md-6">
                                        <address class="text-md-right">
                                            <h4 class="header-title m-t-0">Incluir.</h4>

                                            <?php
                                                $txt_includes = '';
                                                foreach ( $reservation['data']['reservation']['includes']['list'] as $value )
                                                {
                                                    if ( $value != 'others' )
                                                    $txt_includes .= $includes[$value]['name'] .', ';
                                                }
                                            ?>

                                            <p class="text"><strong>Tipo de carga</strong> <?= substr($txt_includes, 0, -2) ?>.</p>
                                            <p class="text"><strong>Notas y opciones a incluir.</strong> <?= ( !empty($reservation['data']['reservation']['includes']['notes']) ) ? $reservation['data']['reservation']['includes']['notes'] : 'N/A' ?>.</p>
                                        </address>

                                        <address class="text-md-right">
                                            <h4 class="header-title m-t-0">Información de pago.</h4>

                                            <?php
                                                switch ( $reservation['data']['payment']['type_payment'] )
                                                {
                                                    case 'online': $reservation['data']['payment']['type_payment'] = 'En linea'; break;
                                                    case 'cash': $reservation['data']['payment']['type_payment'] = 'Efectivo'; break;
                                                    case 'deposit': $reservation['data']['payment']['type_payment'] = 'Depósito'; break;
                                                    case 'transfer': $reservation['data']['payment']['type_payment'] = 'Transferencia'; break;
                                                    default: $reservation['data']['payment']['type_payment'] = ucfirst($reservation['data']['payment']['type_payment']); break;
                                                }

                                                if ( !is_null($reservation['data']['payment']['discount']) )
                                                {
                                                    switch ( $reservation['data']['payment']['discount']['type'] )
                                                    {
                                                        case 'percentage': default: $reservation['data']['payment']['discount'] = $reservation['data']['payment']['discount']['amount'] .'%'; break;
                                                        case 'amount': $reservation['data']['payment']['discount'] = $reservation['data']['payment']['discount']['amount'] .' MXN'; break;
                                                    }
                                                }
                                                else $reservation['data']['payment']['discount'] = 'n/a';
                                            ?>

                                            <p class="text"><strong>Descuento</strong> <?= ( $reservation['data']['payment']['discount'] == 'n/a' )? 'N/A' : '-'. $reservation['data']['payment']['discount'] ?>.</p>
                                            <p class="text"><strong>Típo de pago</strong> <?= $reservation['data']['payment']['type_payment'] ?>.</p>
                                            <?php $reservation['data']['payment']['min_amount_reservation'] = ( isset($reservation['data']['payment']['min_amount_reservation']) ) ? $reservation['data']['payment']['min_amount_reservation'] : 30; ?>
                                            <p class="text"><strong>Monto mínimo para reservar</strong> $<?= number_format($reservation['data']['payment']['total']*$reservation['data']['payment']['min_amount_reservation']/100) ?> MXN.</p>
                                            <p class="text">
                                                <strong>Estado del pago</strong>
                                                <?php if ( in_array('{reservations_payment}', Session::get_value('session_permissions')) ) : ?>
                                                    <select id="change_payment_status" name="payment_status" data-folio="<?= $reservation['folio'] ?>">
                                                        <?php foreach ( ['pending_payment' => 'Pendiente', 'reserved_payment' => 'Reservado', 'full_payment' => 'Pago completo'] as $key => $value ): ?>
                                                            <option value="<?= $key ?>" <?= ( $key == $reservation['payment_status'] ? 'selected' : '' ) ?> ><?= $value ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                <?php else: ?>
                                                    <?= $reservation['payment_status'] ?>
                                                <?php endif; ?>
                                            </p>
                                        </address>

                                        <address class="text-md-right d-print-none">
                                            <h4 class="header-title m-t-0">Nota.</h4>

                                            <p class="text"><?= $reservation['data']['reservation']['notes'] ?></p>
                                        </address>

                                        <address class="text-md-right d-print-none">
                                            <p class="text"><strong>Usuario que registro la reservación</strong> <?= $reservation['__session']['user'] ?>.</p>
                                        </address>

                                        <address class="text-md-right d-print-none">
                                            <?php
                                                $total_payment_references = 0;
                                                foreach ( $payment_references as $key => $value )
                                                    $total_payment_references += $value['amount'];
                                            ?>
                                            <p class="text"><strong>Monto a pagar en muelle</strong> $<?= number_format($reservation['data']['payment']['total'] - $total_payment_references, 2) ?>.</p>
                                        </address>
                                    </div>

                                    <div class="col-12 m-t-20">
                                        <h4 class="header-title m-t-0">Resumen de la factura.</h4>

                                        <div class="table-box-responsive-md">
                                            <table class="table mb-0" style="font-size: 14px;">
                                                <thead>
                                                    <tr>
                                                        <th>Concepto</th>
                                                        <th class="text-md-center">Precio</th>
                                                        <th class="text-md-center">Cantidad</th>
                                                        <th class="text-md-right">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td data-title="Concepto">
                                                            <div class="content-cell"><?= $reservation['data']['yacht']['name'] ?>.</div>
                                                        </td>
                                                        <td class="text-md-center" data-title="Precio">
                                                            <div class="content-cell">$<?= number_format($reservation['data']['yacht']['price'] / $reservation['data']['yacht']['duration'], 2) ?> <small>MXN</small></div>
                                                        </td>
                                                        <td class="text-md-center" data-title="Cantidad">
                                                            <div class="content-cell">x<?= $reservation['data']['yacht']['duration'] ?> hrs.</div>
                                                        </td>
                                                        <td class="text-md-right" data-title="Total">
                                                            <div class="content-cell">$<?= number_format($reservation['data']['yacht']['price'], 2) ?> <small>MXN</small></div>
                                                        </td>
                                                    </tr>

                                                    <?php if ( $reservation['data']['reservation']['hours_extra']['hours_extra'] > 0 ): ?>
                                                        <tr>
                                                            <td data-title="Concepto">
                                                                <div class="content-cell">Horas extra.</div>
                                                            </td>
                                                            <td class="text-md-center" data-title="Precio">
                                                                <div class="content-cell">$<?= number_format($reservation['data']['reservation']['hours_extra']['price'], 2) ?> <small>MXN</small></div>
                                                            </td>
                                                            <td class="text-md-center" data-title="Cantidad">
                                                                <div class="content-cell">x<?= $reservation['data']['reservation']['hours_extra']['hours_extra'] ?> hrs.</div>
                                                            </td>
                                                            <td class="text-md-right" data-title="Total">
                                                                <div class="content-cell">$<?= number_format($reservation['data']['reservation']['hours_extra']['price'] * $reservation['data']['reservation']['hours_extra']['hours_extra'], 2) ?> <small>MXN</small></div>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>

                                                    <?php if ( $reservation['data']['yacht']['dockage'] > 0 ): ?>
                                                        <?php if ( $reservation['data']['version'] == '2.1' ): ?>
                                                            <tr>
                                                                <td data-title="Concepto">
                                                                    <div class="content-cell">Cobro de muellaje.</div>
                                                                </td>
                                                                <td class="text-md-center" data-title="Precio">
                                                                    <div class="content-cell">$<?= number_format($reservation['data']['yacht']['dockage'], 2) ?> <small>MXN</small></div>
                                                                </td>
                                                                <td class="text-md-center" data-title="Cantidad">
                                                                    <div class="content-cell">x<?= $reservation['data']['yacht']['pax']['adults'] ?></div>
                                                                </td>
                                                                <td class="text-md-right" data-title="Total">
                                                                    <div class="content-cell">$<?= number_format($reservation['data']['yacht']['dockage'] * $reservation['data']['yacht']['pax']['adults'], 2) ?> <small>MXN</small></div>
                                                                </td>
                                                            </tr>
                                                        <?php else: ?>
                                                            <tr>
                                                                <td data-title="Concepto">
                                                                    <div class="content-cell">Cobro de muellaje.</div>
                                                                </td>
                                                                <td class="text-md-center" data-title="Precio">
                                                                    <div class="content-cell">$<?= number_format($reservation['data']['yacht']['dockage'], 2) ?> <small>MXN</small></div>
                                                                </td>
                                                                <td class="text-md-center" data-title="Cantidad">
                                                                    <div class="content-cell">x1</div>
                                                                </td>
                                                                <td class="text-md-right" data-title="Total">
                                                                    <div class="content-cell">$<?= number_format($reservation['data']['yacht']['dockage'], 2) ?> <small>MXN</small></div>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                    <?php foreach ( $reservation['data']['reservation']['amenities'] as $value ): ?>
                                                        <tr>
                                                            <td data-title="Concepto">
                                                                <div class="content-cell"><?= $value['name'] ?></div>
                                                            </td>
                                                            <td class="text-md-center" data-title="Precio">
                                                                <div class="content-cell">$<?= number_format($value['price'], 2) ?> <small>MXN</small></div>
                                                            </td>
                                                            <td class="text-md-center" data-title="Cantidad">
                                                                <div class="content-cell">x1</div>
                                                            </td>
                                                            <td class="text-md-right" data-title="Total">
                                                                <div class="content-cell">$<?= number_format($value['price'], 2) ?> <small>MXN</small></div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>

                                                    <tr>
                                                        <td class="text-right d-none d-md-table-cell" data-title="Subtotal" colspan="3">
                                                            <div class="content-cell"><strong>Subtotal</strong></div>
                                                        </td>
                                                        <td class="text-md-right" data-title="Subtotal">
                                                            <div class="content-cell">$<?= number_format($reservation['data']['payment']['subtotal'], 2) ?> <small>MXN</small></div>
                                                        </td>
                                                    </tr>

                                                    <?php if( $reservation['data']['payment']['discount'] != 'n/a' ): ?>
                                                        <tr>
                                                            <td class="text-right no-line d-none d-md-table-cell" data-title="Descuento" colspan="3">
                                                                <div class="content-cell"><strong>Descuento</strong></div>
                                                            </td>
                                                            <td class="text-md-right no-line" data-title="Descuento">
                                                                <div class="content-cell">- $<?= number_format($reservation['data']['payment']['subtotal'] - $reservation['data']['payment']['total'], 2) ?> <small>MXN</small></div>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>

                                                    <tr>
                                                        <td class="text-right no-line d-none d-md-table-cell" data-title="Total" colspan="3">
                                                            <div class="content-cell"><strong>Total</strong></div>
                                                        </td>
                                                        <td class="text-md-right no-line" data-title="Total">
                                                            <div class="content-cell">$<?= number_format($reservation['data']['payment']['total'], 2) ?> <small>MXN</small></div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </main>
                        </article>
                    </div>
                </div>
            </div>

            <?php if ( in_array('{payments_read}', Session::get_value('session_permissions')) ) : ?>
                <div class="col-12 m-b-30 d-print-none">
                    <div class="card">
                        <div class="card-body">
                            <!-- Title container -->
                            <h4 class="header-title m-t-0">Pagos realizados</h4>
                            <p class="text-muted m-b-20">Lista de pagos agregados.</p>
                            <!-- End title container -->

                            <?php if ( empty($payment_references) ): ?>
                                <p class="text-muted m-0"><small>No hay pagos realizados.</small></p>
                            <?php else: ?>
                                <div class="row">
                                    <?php foreach ( $payment_references as $value ): ?>
                                        <div class="col-md-4">
                                            <dl class="row mb-0 list_payments">
                                                <dt class="col-lg-4">Fecha de pago</dt>
                                                <dd class="col-lg-8"><?= Dates::formatted_date($value['date'], 'formatted') ?></dd>
                                                <dt class="col-lg-4">Método de pago</dt>
                                                <dd class="col-lg-8"><?= $value['type'] ?></dd>
                                                <dt class="col-lg-4">Monto</dt>
                                                <dd class="col-lg-8">$<?= number_format($value['amount'], 2) ?> MXN</dd>
                                                <dt class="col-lg-4">Referencia</dt>
                                                <dd class="col-lg-8"><?= ( !empty($value['reference']) ) ? $value['reference'] : 'N/A' ?></dd>
                                                <dt class="col-lg-4">Adjutno</dt>
                                                <dd class="col-lg-8"><?= ( !empty($value['attachment']) ) ? '<a href="{$path.root_uploads}'. $value['attachment'] .'" download="'. $value['attachment'] .'">Ver</a>' : 'N/A' ?></dd>
                                                <dt class="col-lg-4">Nota</dt>
                                                <dd class="col-lg-8"><?= ( !empty($value['notes']) ) ? $value['notes'] : 'N/A' ?></dd>
                                                <p class="col-lg-12 text-muted m-0 "><small>Fecha creado en el sistema: <?= Dates::formatted_date(explode(' ', $value['creation_date'])[0], 'formatted') ?> <?= explode(' ', $value['creation_date'])[1] ?></small></p>
                                            </dl>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( in_array('{expenses_read}', Session::get_value('session_permissions')) ) : ?>
                <div class="col-12 m-b-30 d-print-none">
                    <div class="card">
                        <div class="card-body">
                            <!-- Title container -->
                            <h4 class="header-title m-t-0">Gastos realizados</h4>
                            <p class="text-muted m-b-20">Lista de gastos agregados.</p>
                            <!-- End title container -->

                            <?php if ( empty($expenses) ): ?>
                                <p class="text-muted m-0"><small>No hay gastos realizados.</small></p>
                            <?php else: ?>
                                <div class="row">
                                    <?php foreach ( $expenses as $value ): ?>
                                        <div class="col-md-4">
                                            <dl class="row mb-0 list_payments">
                                                <dt class="col-lg-4">Fecha de gasto</dt>
                                                <dd class="col-lg-8"><?= Dates::formatted_date($value['date'], 'formatted') ?></dd>
                                                <dt class="col-lg-4">Gasto</dt>
                                                <dd class="col-lg-8"><?= ( !empty($value['expenditure']) ) ? $value['expenditure'] : 'N/A' ?></dd>
                                                <dt class="col-lg-4">Monto</dt>
                                                <dd class="col-lg-8">$<?= number_format($value['amount'], 2) ?> MXN</dd>
                                                <dt class="col-lg-4">Adjutno</dt>
                                                <dd class="col-lg-8"><?= ( !empty($value['attachment']) ) ? '<a href="{$path.root_uploads}'. $value['attachment'] .'" download="'. $value['attachment'] .'">Ver</a>' : 'N/A' ?></dd>
                                                <dt class="col-lg-4">Nota</dt>
                                                <dd class="col-lg-8"><?= ( !empty($value['notes']) ) ? $value['notes'] : 'N/A' ?></dd>
                                                <p class="col-lg-12 text-muted m-0 "><small>Fecha creado en el sistema: <?= Dates::formatted_date(explode(' ', $value['creation_date'])[0], 'formatted') ?> <?= explode(' ', $value['creation_date'])[1] ?></small></p>
                                            </dl>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<!-- Editar reservación -->
<?php if ( in_array('{reservations_update}', Session::get_value('session_permissions')) ) : ?>
    <section id="edit_reservation" class="modal fullscreen" data-modal="edit_reservation">
        <div class="content">
            <header>Editar reservación</header>
            <main>
                <form name="edit_reservation">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Origen</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <select name="origin">
                                        <?php foreach ( $type_reservations as $key => $value ): ?>
                                            <option value="<?= $key ?>" <?= ( $key === $reservation['origin'] ) ? 'selected' : '' ?>><?= $value['name'] ?></option>
                                        <?php endforeach; ?>
                                        <option value="other" <?= ( !array_key_exists($reservation['origin'], $type_reservations) ) ? 'selected' : '' ?>>Otro</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row <?= ( array_key_exists($reservation['origin'], $type_reservations) ) ? "d-none" : "" ?>">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Nombre</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <input class="form-control" type="text" name="origin_name" <?= ( !array_key_exists($reservation['origin'], $type_reservations) ) ? "value='{$reservation['origin']}'" : "" ?>>
                                    <p class="description text-muted">Escriba el nombre de donde proviene la reservación.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Nombre</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <input class="form-control" type="text" name="customer_name" value="<?= $reservation['data']['customer']['name'] ?>">
                                    <p class="description text-muted">Escriba el nombre completo del cliente que realiza la reservación.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Coreo electrónico</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <input class="form-control" type="email" name="customer_email" value="<?= $reservation['data']['customer']['email'] ?>">
                                    <p class="description text-muted">Correo electrónico, aquí llegará el ticket de reservación.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Teléfono</h6>
                        </div>
                        <div class="col-sm-4 p-r-10">
                            <div class="label">
                                <label>
                                    <?php
                                        $phone_prefix = Functions::get_phone_prefix();
                                        $phone_prefix[] = [
                                            'name' => [
                                                'es' => 'México',
                                                'en' => 'México'
                                            ],
                                            'lada' => '52'
                                        ];

                                        $lada = $reservation['data']['customer']['phone'][1] . $reservation['data']['customer']['phone'][2];
                                    ?>
                                    <select name="prefix">
                                        <?php foreach ( $phone_prefix as $value ): ?>
                                            <option value="<?= $value['lada'] ?>" <?= ( $value['lada'] === $lada ) ? 'selected' : '' ?> ><?= $value['name']['es'] ?> ( +<?= $value['lada'] ?> )</option>
                                        <?php endforeach; ?>
                                    </select>
                                    <p class="description text-muted">Prefijo</p>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4 p-l-10">
                            <div class="label">
                                <label>
                                    <input class="form-control" type="text" name="customer_phone" value="<?= substr($reservation['data']['customer']['phone'], 3) ?>">
                                    <p class="description text-muted">Teléfono de contacto a 10 dígitos.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Yate</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <select class="form-control" name="yacht_name">
                                        <?php foreach ( $boats as $value ): ?>
                                            <option value="<?= $value['id'] ?>" <?= ( $reservation['data']['yacht']['id'] == $value['id'] ) ? 'selected':'' ?>><?= $value['name'] ?>, <?= $value['yacht'] ?> <?= $value['type'] ?> - <?= $value['ft'] ?> pies (<?= $value['year'] ?>).</option>
                                        <?php endforeach; ?>
                                        <option value="Waverunner G1" <?= ( $reservation['data']['yacht']['name'] == "Waverunner G1" ) ? 'selected':'' ?>>Moto Acuática G1</option>
                                        <option value="Waverunner G2" <?= ( $reservation['data']['yacht']['name'] == "Waverunner G2" ) ? 'selected':'' ?>>Moto Acuática G2</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <h6 class="p-t-5">Fecha</h6>
                        </div>
                        <div class="col-md-8">
                            <div class="label">
                                <label>
                                    <input class="form-control" type="date" name="reservation_date" value="<?= $reservation['data']['reservation']['date'] ?>">
                                    <p class="description text-muted">Elijá la fecha a reservar.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <h6 class="p-t-5">Horario</h6>
                        </div>
                        <div class="col-md-8">
                            <div class="label">
                                <label>
                                    <input class="form-control" type="time" name="reservation_hour" value="<?= $reservation['data']['reservation']['hour'] ?>">
                                    <p class="description text-muted">Establezcla el horario para la salida del yate.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Pax</h6>
                        </div>
                        <div class="col-sm-4">
                            <div class="label">
                                <label>
                                    <input type="text" name="yacht_pax_adults" value="<?= $reservation['data']['yacht']['pax']['adults'] ?>">
                                    <p class="description text-muted">Adultos.</p>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="label">
                                <label>
                                    <input type="text" name="yacht_pax_childrens" value="<?= $reservation['data']['yacht']['pax']['childrens'] ?>">
                                    <p class="description text-muted">Niños.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Duración</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <input type="text" name="yacht_hrs_duration" value="<?= $reservation['data']['yacht']['duration'] ?>">
                                    <p class="description text-muted">Seleccioné la duración de la reserva.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Precio</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <input class="form-control text-left" type="text" name="yacht_price" value="<?= $reservation['data']['yacht']['price'] ?>">
                                    <p class="description text-muted">Precio del yate (sin contar las horas extra o amenidades).</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <h6 class="p-t-5">Muelle</h6>
                        </div>
                        <div class="col-md-8">
                            <div class="label">
                                <label>
                                    <input class="form-control text-left" type="text" name="dockage" value="<?= $reservation['data']['yacht']['dockage'] ?>">
                                    <p class="description text-muted">Precio del muellaje. El precio debe ser el costo por pax.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <h6 class="p-t-5">Opciones para incluir</h6>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="label group-labels">
                                <?php foreach ( $includes as $key => $value ): ?>
                                    <?php if ( $key != 'others' ): ?>
                                        <label class="checkbox" style="margin-top: 0px; margin-right: 0px;">
                                            <p class="text-muted"><small><strong><?= $value['name'] ?></strong></small></p>
                                            <input name="includes[]" type="checkbox" value="<?= $key ?>" <?= ( in_array($key, $reservation['data']['reservation']['includes']['list']) ) ? 'checked' : '' ?> />
                                            <div class="checkbox_indicator"></div>
                                        </label>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Notas para incluir</h6>
                        </div>
                        <div class="col-md-12">
                            <div class="label">
                                <label>
                                    <textarea name="includes_others" class="form-control" rows="2"><?= $reservation['data']['reservation']['includes']['notes'] ?></textarea>
                                    <p class="description text-muted">Escriba que desea incluir.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <h6 class="p-t-5">Monto mínimo para reservar</h6>
                        </div>
                        <div class="col-sm-6">
                            <div class="label">
                                <label>
                                    <input type="text" name="min_amount_reservation" value="<?= ( !isset($reservation['data']['payment']['min_amount_reservation']) || empty($reservation['data']['payment']['min_amount_reservation']) ) ? 30 : $reservation['data']['payment']['min_amount_reservation'] ?>">
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Notas/Otros</h6>
                        </div>
                        <div class="col-md-12">
                            <div class="label">
                                <label>
                                    <textarea name="notes" class="form-control" rows="3"><?= $reservation['data']['reservation']['notes'] ?></textarea>
                                    <p class="description text-muted">Escriba las anotaciones a tener en cuenta.</p>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </main>
            <footer>
                <div class="action-buttons text-right">
                    <button class="btn btn-link" button-close><small>Cerrar sin guardar</small></button>
                    <button class="btn btn-primary waves-effect waves-light" button-submit>Guardar</button>
                </div>
            </footer>
        </div>
    </section>
<?php endif; ?>

<!-- Payment reference -->
<?php if ( in_array('{payments_create}', Session::get_value('session_permissions')) ) : ?>
    <section id="add_payment_reference" class="modal" data-modal="add_payment_reference">
        <div class="content">
            <header>
                <h3>Agregar un pago</h3>
            </header>
            <main>
                <form name="add_payment_reference" data-folio="<?= $reservation['folio'] ?>">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Fecha de pago</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <input class="form-control" type="date" name="date" value="<?= date('Y-m-d') ?>">
                                    <p class="description text-muted">Seleccione la fecha que se realizó el pago.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Tipo de pago</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <select class="form-control" name="type_payment">
                                        <?php foreach ( Functions::payment_methods() as $key => $value ): ?>
                                            <option value="<?= $value['code'] ?>"><?= ucwords($value['title']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row d-none">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Número de cupón</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <input class="form-control" type="text" name="coupon" value="">
                                    <p class="description text-muted">Escriba el número de cupón.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row d-none">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Método de pago</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <input class="form-control" type="text" name="other_type_payment" value="">
                                    <p class="description text-muted">Escriba otro metodo de pago usado.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Monto</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <input class="form-control text-left" type="text" name="amount" value="100">
                                    <p class="description text-muted">Escriba el monto del pago hecho.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Referencia</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <input class="form-control" type="text" name="reference" value="">
                                    <p class="description text-muted">Escriba la referencia del pago, como por ejemplo, el número de ticket del depósito.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Voucher</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <input name="attachment" type="file">
                                    <p class="description text-muted">Seleccione las fotos o documentos del voucher de pago. Solo se permiten archivos jpg, jpeg, png, bmp y pdf.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Notas</h6>
                        </div>
                        <div class="col-md-12">
                            <div class="label">
                                <label>
                                    <textarea name="notes" class="form-control" rows="3"></textarea>
                                    <p class="description text-muted">Agrege una nota a la referencia si lo desea.</p>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </main>
            <footer>
                <div class="action-buttons text-right">
                    <button class="btn btn-link" button-close><small>Cancelar</small></button>
                    <button class="btn btn-primary waves-effect waves-light" button-submit>Agregar pago</button>
                </div>
            </footer>
        </div>
    </section>
<?php endif; ?>

<!-- Expenses -->
<?php if ( in_array('{expenses_create}', Session::get_value('session_permissions')) ) : ?>
    <section id="add_expense" class="modal" data-modal="add_expense">
        <div class="content">
            <header>
                <h3>Agregar un gasto</h3>
            </header>
            <main>
                <form name="add_expense" data-folio="<?= $reservation['folio'] ?>">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Fecha de gasto</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <input class="form-control" type="date" name="date" value="<?= date('Y-m-d') ?>">
                                    <p class="description text-muted">Seleccione la fecha que se realizó el gasto.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Gasto</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <input class="form-control" type="text" name="expenditure" value="">
                                    <p class="description text-muted">Describa el gasto realizado.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Monto</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <input class="form-control text-left" type="text" name="amount" value="100">
                                    <p class="description text-muted">Escriba el monto del gasto hecho.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Voucher</h6>
                        </div>
                        <div class="col-sm-8">
                            <div class="label">
                                <label>
                                    <input name="attachment" type="file">
                                    <p class="description text-muted">Seleccione las fotos o documentos del voucher de gasto. Solo se permiten archivos jpg, jpeg, png, bmp y pdf.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <h6 class="p-t-5">Notas</h6>
                        </div>
                        <div class="col-md-12">
                            <div class="label">
                                <label>
                                    <textarea name="notes" class="form-control" rows="3"></textarea>
                                    <p class="description text-muted">Agrege una nota a la referencia si lo desea.</p>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </main>
            <footer>
                <div class="action-buttons text-right">
                    <button class="btn btn-link" button-close><small>Cancelar</small></button>
                    <button class="btn btn-primary waves-effect waves-light" button-submit>Agregar gasto</button>
                </div>
            </footer>
        </div>
    </section>
<?php endif; ?>

<!-- Hour extra -->
<section id="add_hour_extra" class="modal" data-modal="add_hour_extra">
    <div class="content">
        <header>
            <h3>Agregar <strong>horas extra</strong>, en la reservación.</h3>
        </header>
        <main>
            <form name="add_hour_extra" data-folio="<?= $reservation['folio'] ?>">
                <div class="form-group row">
                    <div class="col-4">
                        <h6 class="p-t-5">Número de horas</h6>
                    </div>
                    <div class="col-3 col-sm-2 suffix-5 suffix-sm-6">
                        <div class="label">
                            <label>
                                <select class="form-control" name="">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <h6 class="p-t-5">Precio</h6>
                    </div>
                    <div class="col-sm-8">
                        <div class="label">
                            <label>
                                <input class="form-control" type="text" name="add_hour_extra_price" value="2000">
                                <p class="description text-muted">Precio por hora.</p>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </main>
        <footer>
            <div class="action-buttons text-right">
                <button class="btn btn-link" button-close><small>Cancelar</small></button>
                <button class="btn btn-primary waves-effect waves-light" button-submit>Agregar</button>
            </div>
        </footer>
    </div>
</section>

<!-- Transportación -->
<section id="add_transportation" class="modal" data-modal="add_transportation">
    <div class="content">
        <header>
            <h3>Agregar <strong>transportación</strong>, en la reservación.</h3>
        </header>
        <main>
            <form name="add_transportation" data-folio="<?= $reservation['folio'] ?>">
                <div class="form-group row">
                    <div class="col-4">
                        <h6 class="p-t-5">Tipo de viaje</h6>
                    </div>
                    <div class="col-sm-8">
                        <div class="label">
                            <label>
                                <input class="form-control" type="text" name="add_transportation_title" value="">
                                <p class="description text-muted">Información del viaje.</p>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <h6 class="p-t-5">Precio</h6>
                    </div>
                    <div class="col-sm-8">
                        <div class="label">
                            <label>
                                <input class="form-control" type="text" name="add_transportation_price" value="1500">
                                <p class="description text-muted">Precio por la transportación.</p>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </main>
        <footer>
            <div class="action-buttons text-right">
                <button class="btn btn-link" button-close><small>Cancelar</small></button>
                <button class="btn btn-primary waves-effect waves-light" button-submit>Agregar</button>
            </div>
        </footer>
    </div>
</section>

<!-- Extras -->
<section id="add_extras" class="modal" data-modal="add_extras">
    <div class="content">
        <header>
            <h3>Agregar <strong>otro extra</strong>, en la reservación.</h3>
        </header>
        <main>
            <form name="add_extras" data-folio="<?= $reservation['folio'] ?>">
                <div class="form-group row">
                    <div class="col-4">
                        <h6 class="p-t-5">Extra</h6>
                    </div>
                    <div class="col-sm-8">
                        <div class="label">
                            <label>
                                <select class="form-control" name="">
                                    <option value="">Moto acuática</option>
                                    <option value="">Inflables</option>
                                    <option value="">Wakeboard</option>
                                    <option value="">Toallas</option>
                                    <option value="">Ceviche</option>
                                    <option value="">Snorkel</option>
                                </select>
                                <p class="description text-muted">Información del viaje.</p>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <h6 class="p-t-5">Precio</h6>
                    </div>
                    <div class="col-sm-8">
                        <div class="label">
                            <label>
                                <input class="form-control" type="text" name="add_transportation_price" value="1500">
                                <p class="description text-muted">Precio por el extra.</p>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </main>
        <footer>
            <div class="action-buttons text-right">
                <button class="btn btn-link" button-close><small>Cancelar</small></button>
                <button class="btn btn-primary waves-effect waves-light" button-submit>Agregar</button>
            </div>
        </footer>
    </div>
</section>
