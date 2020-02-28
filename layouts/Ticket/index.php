<?php
defined('_EXEC') or die;

$this->dependencies->add(['other', ' <script> $("#toggle").toggles(); </script> ']);
?>
<div id="page" class="payment">
    <header>
        <h2>Reservación #<?= $data['folio'] ?> <strong>{$vkye_webpage}.</strong></h2>
    </header>

    <!-- Content -->
    <main id="main-content">
        <div class="content-box">
            <section class="ticket">
                <header>
                    <div class="day">
                        <span><?= Dates::get_day_week($data['data']['date']) ?></span>
                        <span><strong><?= date('d', strtotime($data['data']['date'])) ?> <?= Dates::get_month($data['data']['date']) ?></strong></span>
                    </div>
                    <div class="person_info">
                        <span><strong>Nombre:</strong> <?= $data['customer']['firstname'] ?> <?= $data['customer']['lastname'] ?></span>
                        <?php
                            if ( $data['status'] == 'finalized' || $data['status'] == 'cancelled' )
                                $data['status_payment'] = $data['status'];

                            switch ( $data['status_payment'] )
                            {
                                case 'pending_payment':
                                default:
                                    echo '<span><strong>Estado:</strong> Pendiente de pago.</span>';
                                    break;
                                case 'reserved_payment':
                                    echo '<span style="color:#4caf50;"><strong>Estado:</strong> Reservación pagada</span>';
                                    break;
                                case 'full_payment':
                                    echo '<span style="color:#4caf50;"><strong>Estado:</strong> Pago completo</span>';
                                    break;
                                case 'finalized':
                                    echo '<span style="color:#bdbdbd;"><strong>Estado:</strong> Finalizada</span>';
                                    break;
                                case 'cancelled':
                                    echo '<span style="color:#f44336;"><strong>Estado:</strong> Reserva cancelada</span>';
                                    break;
                            }
                        ?>
                    </div>
                    <div class="amount">
                        <span>Depósito</span>
                        <?php if ( $data['tour']['price']['type'] == 'regular' ): ?>
                            <?php
                                $subtotal = 0;
                                $subtotal += $data['tour']['price']['public']['babies'] * $data['data']['paxes']['babies'];
                                $subtotal += $data['tour']['price']['public']['childs'] * $data['data']['paxes']['childs'];
                                $subtotal += $data['tour']['price']['public']['adults'] * $data['data']['paxes']['adults'];

                                $to_report_subtotal = 0;
                                $to_report_subtotal += $data['tour']['price']['to_report']['babies'] * $data['data']['paxes']['babies'];
                                $to_report_subtotal += $data['tour']['price']['to_report']['childs'] * $data['data']['paxes']['childs'];
                                $to_report_subtotal += $data['tour']['price']['to_report']['adults'] * $data['data']['paxes']['adults'];

                                $total = $subtotal;
                                $discount = 0;

                                switch ( $data['customer']['nationality'] )
                                {
                                    case 'mexican':
                                        $discount = $total * (int) $data['tour']['price']['discounts']['national']['amount'] / 100;
                                        // $to_report_subtotal = $to_report_subtotal * (int) $data['tour']['price']['discounts']['national']['amount'] / 100;
                                        break;

                                    default:
                                        $discount = $total * (int) $data['tour']['price']['discounts']['foreign']['amount'] / 100;
                                        // $to_report_subtotal = $to_report_subtotal * (int) $data['tour']['price']['discounts']['foreign']['amount'] / 100;
                                        break;
                                }

                                $to_report_subtotal = ($subtotal - $discount) - $to_report_subtotal;

                                $total -= $discount;
                            ?>

                            <span><strong>$<?= number_format($to_report_subtotal) ?> MXN</strong></span>
                        <?php endif; ?>

                        <?php if ( $data['tour']['price']['type'] == 'height' ): ?>
                            <?php
                                $subtotal = $data['tour']['price']['public']['max'] * $data['data']['paxes']['total'];

                                $to_report_subtotal = $data['tour']['price']['to_report']['max'] * $data['data']['paxes']['total'];

                                $total = $subtotal;
                                $discount = 0;

                                switch ( $data['customer']['nationality'] )
                                {
                                    case 'mexican':
                                        $discount = $total * (int) $data['tour']['price']['discounts']['national']['amount'] / 100;
                                        // $to_report_subtotal = $to_report_subtotal * (int) $data['tour']['price']['discounts']['national']['amount'] / 100;
                                        break;

                                    default:
                                        $discount = $total * (int) $data['tour']['price']['discounts']['foreign']['amount'] / 100;
                                        // $to_report_subtotal = $to_report_subtotal * (int) $data['tour']['price']['discounts']['foreign']['amount'] / 100;
                                        break;
                                }

                                $to_report_subtotal = ($subtotal - $discount) - $to_report_subtotal;

                                $total -= $discount;
                            ?>

                            <span><strong>$<?= number_format($to_report_subtotal) ?> MXN</strong></span>
                        <?php endif; ?>
                    </div>
                </header>
                <main>
                    <?php if ( $data['tour']['price']['type'] == 'regular' ): ?>
                        <div class="breakdown">
                            <p>
                                <span>Tour: <strong><?= $data['tour']['name'] ?></strong></span>
                            </p>
                            <p>
                                <span>Bebes: <strong>x<?= $data['data']['paxes']['babies'] ?></strong></span>
                                <span>$<?= number_format($data['tour']['price']['public']['babies']) ?></span>
                            </p>
                            <p>
                                <span>Niños: <strong>x<?= $data['data']['paxes']['childs'] ?></strong></span>
                                <span>$<?= number_format($data['tour']['price']['public']['childs']) ?> MXN</span>
                            </p>
                            <p>
                                <span>Adultos: <strong>x<?= $data['data']['paxes']['adults'] ?></strong></span>
                                <span>$<?= number_format($data['tour']['price']['public']['adults']) ?> MXN</span>
                            </p>

                            <p class="subtotal">
                                <span>Subtotal</span>
                                <span>$<?= number_format($subtotal, 2) ?> MXN</span>
                            </p>

                            <p>
                                <span>Descuento</span>
                                <span>- $<?= number_format($discount, 2) ?> MXN</span>
                            </p>

                            <p class="total">
                                <span>Total</span>
                                <span>$<?= number_format($total, 2) ?> MXN</span>
                            </p>
                        </div>
                    <?php endif; ?>
                    <?php if ( $data['tour']['price']['type'] == 'height' ): ?>
                        <div class="breakdown">
                            <p>
                                <span>Tour: <strong><?= $data['tour']['name'] ?></strong></span>
                            </p>

                            <p>
                                <span>Total de pax: <strong>x<?= $data['data']['paxes']['total'] ?></strong></span>
                            </p>
                        </div>
                    <?php endif; ?>
                    <div class="booking_info">
                        <!-- <p><strong>Importante:</strong> Información importante.</p> -->
                    </div>
                    <div class="ticket_info">
                        <p><span><strong>Número de ticket:</strong> #<?= $data['folio'] ?></span>
                           <span><strong>Fecha de creación:</strong> <?= date('d-M-Y H:i', strtotime($data['creation_date'])) ?></span>
                           <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={$vkye_base}ticket/<?= $data['folio'] ?>" alt="QR Ticket" />
                       </p>
                        <p>Una vez pagado, la cancelacion deberá ser con 72 hrs de antelación. Despues de este plazo no hay reembolsos y/o compensaciones de ningún tipo. Para mayores informes puedes escribirnos a <strong>contacto@yachtmstr.com</strong>. Te invitamos a que visites nuestros términos y condiciones <a href="{$vkye_domain}/terminos-y-condiciones" target="_blank">aquí</a>.</p>
                    </div>
                </main>
            </section>
        </div>

        <section id="toggle" class="toggles">
            <section class="toggle view">
                <h3>Depósito o transferencía interbancaria</h3>
                <div>
                    <div class="content-box">
                        <p style="font-size: 13px;line-height: 1.2;">Puedes realizar tu pago por medio de transferencia y/o deposito bancarío. Tienes hasta el día <strong><?= Dates::formatted_date(date('d-m-Y', strtotime("-2 day", strtotime($data['data']['date']))), 'formatted') ?></strong> <i style="font-size: 11px;"></i> para realizar el pago antes de que venza tu descuento y tu órden de reservación.</p>

                        <ul class="step-payment-offline">
                            <li>
                                <h4 data-step="1">Paso 1</h4>
                                <p>Realiza una transferencia bancaria o un deposito en ventanilla a cualquiera de nuestras siguientes cuentas bancarias.</p>
                                <div class="bank_accounts">
                                    <div>
                                        <h6>Santander</h6>
                                        <p>Razón social EMPRESA</p>
                                        <p>Número de cuenta 444444444-2</p>
                                        <p>Clabe interbancaria 44444444444444444</p>
                                    </div>
                                    <div>
                                        <h6>BBVA Bancomer</h6>
                                        <p>Razón social EMPRESA</p>
                                        <p>Número de cuenta 4444444444</p>
                                        <p>Clabe interbancaria 4444444444444</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <h4 data-step="2">Paso 2</h4>
                                <p style="font-size: 14px;line-height: 1.2;margin-bottom: 5px;">Envía un <strong>WhatsApp</strong> (<a href="https://api.whatsapp.com/send?phone=529982904203&text=He%20realizado%20el%20pago%20de%20mi%20reservación,%20con%20folio%20<?= $data['folio'] ?>%20a%20través%20de%20transferencia%20y/o%20depósito%20bancario.%20Envío%20mi%20voucher%20de%20pago." target="_blank">click aquí</a>).</p>
                                <p style="font-size: 14px;line-height: 1.2;margin-bottom: 5px;">También puedes escanear o tomar una foto al comprobante de pago. Enviandolo al e-mail <strong>reserva@yachtmstr.com</strong>. Como asunto usa el número de ticket generado por {$vkye_webpage}. <i style="font-size: 12px;">Ejem: Pago para reservación del ticket #<?= $data['folio'] ?>.</i></p>

                            </li>
                            <li>
                                <h4 data-step="3">Paso 3</h4>
                                <p style="font-size: 14px;line-height: 1.2;margin-bottom: 0px;">Recibe nuestro correo de confirmación de tu reservación.</p>
                                <p style="font-size: 14px;line-height: 1.2;margin-bottom: 0px;">En todo momento puedes revisar online, el estado de tu reservación.<br> Únicamente con tu número de ticket (<strong><?= $data['folio'] ?></strong>) en el siguiente enlace: <a href="{$vkye_base}ticket/<?= $data['folio'] ?>"><?= Configuration::$domain ?>/ticket/<?= $data['folio'] ?></a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </section>

        <div class="content-box" style="padding: 0px; box-shadow: none; background-color: transparent; text-align: justify;">
            <div class="terms_condition">
                <?= Session::get_value('settings')['terms_and_conditions'][Session::get_value('vkye_lang')] ?>
            </div>
        </div>
    </main>
</div>
