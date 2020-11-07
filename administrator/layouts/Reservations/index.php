<?php
defined('_EXEC') or die;

$this->dependencies->add(['other', '<script type="text/javascript">$.app.tableSearch();</script>']);
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
                        <li class="breadcrumb-item active">Reservaciones</li>
                    </ol>

                    <h4 class="page-title">Lista de todas las reservaciones</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12 m-b-20 d-print-none">
                <div class="button-items text-lg-right">
                    <?php if ( in_array('{reservations_create}', Session::get_value('session_permissions')) ) : ?>
                        <a href="index.php?c=reservations&m=create" class="btn btn-success waves-effect waves-light">Agregar reservación</a>
                    <?php endif; ?>
                    <?php if ( in_array('{reports_reservations}', Session::get_value('session_permissions')) ) : ?>
                        <a href="index.php?c=reports&m=reservations" class="btn waves-effect waves-light">Ver reportes</a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form name="search" class="m-b-20" data-table-target="reservations">
                            <input type="search" name="search" value="" placeholder="Busca la reservación por número de fólio, nombre ó correo electrónico.">
                        </form>

                        <div class="table-responsive">
                            <table id="reservations" class="table mb-0" style="font-size: 14px; min-width: 1000px">
                                <thead>
                                    <tr>
                                        <th>Nombre / Correo electrónico</th>
                                        <th>Fecha reservada / Yate</th>
                                        <th>Estado</th>
                                        <th>Folio</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ( empty($reservations) ) : ?>
                                        <tr>
                                            <td class="table-empty" colspan="5">
                                                No hay ninguna reservación
                                            </td>
                                        </tr>
                                    <?php endif; ?>

                                    <?php foreach ( $reservations as $value ): ?>
                                        <tr>
                                            <td data-title="Nombre&#xa;Correo electrónico">
                                                <span class="d-block"><?= $value['customer_name'] ?></span>
                                                <small class="d-block"><?= $value['customer_email'] ?></small>
                                            </td>
                                            <td data-title="Fecha reservada&#xa;Yate">
                                                <span class="d-block"><?= Dates::formatted_date($value['data']['reservation']['date'], 'formatted') ?> - <?= $value['data']['reservation']['hour'] ?></span>
                                                <small class="d-block"><?= $value['data']['yacht']['name'] ?></small>
                                            </td>
                                            <td data-title="Estado">
                                                <?php
                                                    if ( $value['status'] == 'finalized' || $value['status'] == 'cancelled' )
                                                        $value['payment_status'] = $value['status'];

                                                    switch ( $value['payment_status'] )
                                                    {
                                                        case 'pending_payment':
                                                        default: $status = 'Pendiente de pago'; break;
                                                        case 'reserved_payment': $status = '<span style="color:#ffc107;">Reservado</span>'; break;
                                                        case 'full_payment': $status = '<span style="color:#4caf50;">Pago completo</span>'; break;
                                                        case 'finalized': $status = '<span style="color:#bdbdbd;">Finalizada</span>'; break;
                                                        case 'cancelled': $status = '<span style="color:#f44336;">Cancelada</span>'; break;
                                                    }
                                                ?>
                                                <?= $status ?>
                                            </td>
                                            <td data-title="Folio">
                                                <span><?= $value['folio'] ?></span>
                                            </td>
                                            <td data-title="Acciones">
                                                <div class="button-items text-right">
                                                    <a href="index.php?c=reservations&m=view&folio=<?= $value['folio'] ?>" class="btn waves-effect waves-light">Ver</a>
                                                    <a href="<?= str_replace('administrator/', '', $this->format->baseurl()) ?>ticket/<?= $value['folio'] ?>" target="_blank" class="btn btn-secondary waves-effect waves-light"><i class="dripicons-link"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
