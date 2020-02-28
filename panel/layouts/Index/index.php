<?php
defined('_EXEC') or die;

// DataTable
$this->dependencies->add(['css', '{$path.plugins}datatables/dataTables.bootstrap4.min.css']);
$this->dependencies->add(['css', '{$path.plugins}datatables/buttons.bootstrap4.min.css']);
$this->dependencies->add(['css', '{$path.plugins}datatables/responsive.bootstrap4.min.css']);
$this->dependencies->add(['js', '{$path.plugins}datatables/jquery.dataTables.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/dataTables.bootstrap4.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/dataTables.buttons.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/buttons.bootstrap4.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/jszip.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/pdfmake.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/vfs_fonts.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/buttons.html5.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/buttons.print.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/buttons.colVis.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/dataTables.responsive.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/responsive.bootstrap4.min.js']);

// Skycons
$this->dependencies->add(['js', '{$path.plugins}skycons/skycons.min.js']);

// Sweet Alert
$this->dependencies->add(['css', '{$path.plugins}sweet-alert2/sweetalert2.min.css']);
$this->dependencies->add(['js', '{$path.plugins}sweet-alert2/sweetalert2.min.js']);

// Alertifty
$this->dependencies->add(['css', '{$path.plugins}alertify/css/alertify.css']);
$this->dependencies->add(['js', '{$path.plugins}alertify/js/alertify.js']);

// Page
$this->dependencies->add(['js', '{$path.js}pages/dashboard.js?v=1.0']);
?>

<div class="wrapper">
	<div class="container-fluid">
		<!-- Page-Title -->
		<div class="row">
			<div class="col-sm-12">
				<div class="page-title-box">
					<div class="btn-group float-right">
						<ol class="breadcrumb hide-phone p-0 m-0">
							<li class="breadcrumb-item">
								<a href="index.php">Adventrips</a>
							</li>
							<li class="breadcrumb-item active">General</li>
						</ol>
					</div>

					<h4 class="page-title">Generales</h4>
				</div>
			</div>
		</div>
		<!-- end page title end breadcrumb -->

        <div class="row">
        	<div class="col-xl-4 col-md-12">
                <div class="card bg-primary m-b-30 text-white weather-box">
                    <div class="card-body">
                        <div class="text-center" style="position: relative;z-index: 10;">
                            <div>
                                <h6><?= Dates::formatted_date(null, 'formatted') ?></h6>
								<a class="btn btn-info btn-lg btn-block" href="index.php?c=calendar&m=index" role="button">Calendario</a>
                            </div>
                        </div>
						<div class="weather-icon">
							<i class="mdi mdi-calendar"></i>
                        </div>
                    </div>
                </div>
        	</div>
        </div>

		<div class="row">
			<div class="col-sm-12">
				<div class="page-title-box">
					<h4 class="page-title">Últimas reservas</h4>
				</div>
			</div>
		</div>

		<?php
		// echo '<pre>';
		// print_r($reservations);
		// echo '</pre>';
		?>

        <div class="row">
        	<div class="col-12">
        		<div class="card m-b-30">
        			<div class="card-body">
                        <table id="table-reservations" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        	<thead>
                        		<tr>
                        			<th>Nombre / Email</th>
									<th>Fecha reservada / Tour</th>
									<th>Folio</th>
									<th>Estado</th>
                        			<th align="right"></th>
									<th class="d-none">ORDER</th>
                        		</tr>
                        	</thead>
                        	<tbody>
								<?php foreach ( $reservations as $key => $value ): ?>
									<?php
									switch ( $value['status'] )
									{
										case 'pending':
											$value['status'] = 'Pendiente de aprobar';
											break;

										case 'available':
											$value['status'] = 'Disponible';
											break;

										case 'finished':
											$value['status'] = 'Finalizada';
											break;

										case 'noshow':
											$value['status'] = 'No Show';
											break;

										case 'cancelled':
											$value['status'] = 'Cancelada';
											break;
									}
									?>
									<tr>
										<td style="overflow: hidden;text-overflow: ellipsis;"><?= $value['customer']['firstname'] ?> <?= $value['customer']['lastname'] ?> <br>
											<span class="text-muted" style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;font-size: 12px;"><?= $value['customer']['email'] ?></span></td>

										<td><?= Dates::formatted_date($value['data']['date'], 'formatted') ?> <br>
											<span class="text-muted" style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;font-size: 12px;"><?= $value['tour']['name'] ?></span></td>

										<td><?= $value['folio'] ?></td>

										<td><?= $value['status'] ?></td>

										<td align="right">
											<a href="index.php?c=reservations&m=view&p=<?= $value['folio'] ?>" class="btn btn-primary waves-effect waves-light" role="button" data-toggle="tooltip" data-placement="left" title="Ver reservación"><i class="dripicons-preview"></i></a>
										</td>

										<td class="d-none"><?= strtotime($value['data']['date']) ?><br>
									</tr>
								<?php endforeach; ?>

                        	</tbody>
                        </table>
        			</div>
        		</div>
        	</div>
        	<!-- end col -->
        </div>
        <!-- end row -->
	</div>
	<!-- end container -->
</div>
<!-- end wrapper -->
