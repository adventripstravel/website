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
                                            <p class="text"><strong>Correo electrónico</strong> <?= $reservation['data']['customer']['email'] ?></p>
                                            <p class="text"><strong>Teléfono</strong> +<?= $reservation['data']['customer']['phone'] ?></p>
                                        </address>
                                    </div>

                                    <div class="col-md-6">
                                        <address class="text-right">
                                            <h4 class="header-title m-t-0">Información del tour.</h4>

                                            <p class="text"><strong>Pax</strong> Adultos (<?= $reservation['data']['reservation']['pax']['adults'] ?>), Niños (<?= $reservation['data']['reservation']['pax']['childrens'] ?>), Bebés (<?= $reservation['data']['reservation']['pax']['babys'] ?>).</p>
                                            <p class="text"><strong>Fecha</strong> <?= Dates::formatted_date($reservation['data']['reservation']['date'], 'formatted') ?>.</p>
                                            <p class="text"><strong>Hora</strong> <?= $reservation['data']['reservation']['hour'] ?>.</p>
                                            <p class="text"><strong>Hotel</strong> <?= $reservation['data']['reservation']['hotel']['name'] ?>, habitación <?= $reservation['data']['reservation']['hotel']['room'] ?>.</p>
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
                                                            <div class="content-cell">Tour: <?= $reservation['data']['reservation']['tour']['name'] ?>.</div>
                                                        </td>
                                                        <td class="text-md-center" data-title="Precio">
                                                            <div class="content-cell">$<?= number_format($reservation['data']['reservation']['tour']['price'], 2) ?> <small>MXN</small></div>
                                                        </td>
                                                        <td class="text-md-center" data-title="Cantidad">
                                                            <div class="content-cell">x1</div>
                                                        </td>
                                                        <td class="text-md-right" data-title="Total">
                                                            <div class="content-cell">$<?= number_format($reservation['data']['reservation']['tour']['price'], 2) ?> <small>MXN</small></div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="text-right d-none d-md-table-cell" data-title="Subtotal" colspan="3">
                                                            <div class="content-cell"><strong>Subtotal</strong></div>
                                                        </td>
                                                        <td class="text-md-right" data-title="Subtotal">
                                                            <div class="content-cell">$<?= number_format($reservation['data']['payment']['subtotal'], 2) ?> <small>MXN</small></div>
                                                        </td>
                                                    </tr>

                                                    <?php if( !is_null($reservation['data']['payment']['discount']) ): ?>
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
        </div>
    </div>
</main>
