<?php
defined('_EXEC') or die;

// Sweet Alert
$this->dependencies->add(['css', '{$path.plugins}sweet-alert2/sweetalert2.min.css']);
$this->dependencies->add(['js', '{$path.plugins}sweet-alert2/sweetalert2.min.js']);

// Page
$this->dependencies->add(['js', '{$path.js}pages/reservations/view.js?v=1.0']);

// echo '<pre>';
// print_R($reservation);
// echo '</pre>';
?>

<div class="wrapper">
	<div class="container-fluid">
		<!-- Page-Title -->
		<div class="row d-print-none">
			<div class="col-sm-12">
				<div class="page-title-box">
					<div class="btn-group float-right">
						<ol class="breadcrumb hide-phone p-0 m-0">
							<li class="breadcrumb-item">
								<a href="index.php?c=Reservations&m=list">Reservaciones</a>
							</li>
							<li class="breadcrumb-item active">Visualizando</li>
							<li class="breadcrumb-item active">#<?= $reservation['folio'] ?></li>
						</ol>
					</div>

					<h4 class="page-title">Generales</h4>
				</div>
			</div>
		</div>
		<!-- end page title end breadcrumb -->

        <div class="row">
        	<div class="col-12">
				<div class="row m-b-20 d-print-none">
					<div class="col-12">
						<div class="mo-mt-2">
							<div class="button-items text-center text-md-right">
								<!-- <button disabled type="button" id="send_notification" class="btn btn-primary waves-effect waves-light" data-folio="<?= $reservation['folio'] ?>"><i class="fa fa-send m-r-5" style="vertical-align: middle;"></i> Reenviar notificaciones</button> -->
								<div class="btn-group dropdown">
                                    <button type="button" class="btn btn-primary waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:window.print()"><i class="fa fa-print m-r-5"></i> Imprimir</a>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
				</div>

        		<div class="card m-b-30">
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<div class="invoice-title">
									<h4 class="float-right font-16"><strong>Folio #<?= $reservation['folio'] ?></strong></h4>
									<h3 class="m-t-0">
										<img src="{$path.root_uploads}icontype-white.png" alt="logo" height="22"/>
									</h3>
								</div>
								<hr>
								<div class="row">
									<div class="col-sm-6">
										<address>
											<strong>Información de contacto:</strong><br>
											<span class="badge badge-default">Nombre</span> <?= $reservation['data']['customer']['firstname'] ?> <?= $reservation['data']['customer']['lastname'] ?><br>
											<span class="badge badge-default">Correo electrónico</span> <?= $reservation['data']['customer']['email'] ?><br>
											<span class="badge badge-default">Teléfono</span> +(<?= $reservation['data']['customer']['phone_lada'] ?>) <?= $reservation['data']['customer']['phone_number'] ?><br>
											<span class="badge badge-default">Nacionalidad</span> <?= ( $reservation['data']['customer']['nationality'] == 'mexican' ) ? 'Mexicano <span class="text-muted" style="font-size: 10px;">Se aplicó un descuento especial.</span>' : 'Otro' ?>
										</address>
										<address>
											<strong>Reservación:</strong><br>
											<span class="badge badge-default">Fecha reservada</span> <?= Dates::formatted_date($reservation['data']['date'], 'formatted') ?> <br>
											<span class="badge badge-default">Tour</span> <?= $reservation['tour']['name'] ?> <br>
											<span class="badge badge-default">Paxes</span> <?= ( isset($reservation['paxes']['total']) ) ? 'Total: '. $reservation['paxes']['total'] : 'Bebes: '. $reservation['paxes']['babies'] .'; Niños: '. $reservation['paxes']['childs'] .'; Adultos: '. $reservation['paxes']['adults'] .'.' ?> <br>
											<span class="badge badge-default">Descuento aplicado</span> <?= ( $reservation['data']['customer']['nationality'] == 'mexican' ) ? $reservation['tour']['price']['discounts']['national']['amount'] . $reservation['tour']['price']['discounts']['national']['type'] : $reservation['tour']['price']['discounts']['foreign']['amount'] . $reservation['tour']['price']['discounts']['foreign']['type'] ?> <br>
										</address>

										<address>
											<strong>Nota:</strong><br>
											<?= $reservation['data']['observations'] ?><br>
										</address>
									</div>
								</div>
							</div>
						</div>

						<?php if ( $reservation['tour']['price']['type'] == 'regular' ): ?>
							<?php
								$subtotal = 0;
								$subtotal += $reservation['tour']['price']['public']['babies'] * $reservation['data']['paxes']['babies'];
								$subtotal += $reservation['tour']['price']['public']['childs'] * $reservation['data']['paxes']['childs'];
								$subtotal += $reservation['tour']['price']['public']['adults'] * $reservation['data']['paxes']['adults'];

								$total = $subtotal;
								$discount = 0;

								switch ( $reservation['customer']['nationality'] )
								{
									case 'mexican':
										$discount = $total * (int) $reservation['tour']['price']['discounts']['national']['amount'] / 100;
										break;

									default:
										$discount = $total * (int) $reservation['tour']['price']['discounts']['foreign']['amount'] / 100;
										break;
								}

								$total -= $discount;
							?>
							<div class="row">
								<div class="col-12">
									<div class="panel panel-default">
										<div class="p-2">
											<h3 class="panel-title font-20"><strong>Resumen de la reservación</strong></h3>
										</div>
										<div class="">
											<div class="table-responsive">
												<table class="table">
													<thead>
														<tr>
															<td><strong>Item</strong></td>
															<td class="text-center"><strong>Precio</strong></td>
															<td class="text-center"><strong>Cantidad</strong></td>
															<td class="text-right"><strong>Total</strong></td>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>Bebes</td>
															<td class="text-center">$<?= number_format($reservation['tour']['price']['public']['babies']) ?></td>
															<td class="text-center">x<?= $reservation['data']['paxes']['babies'] ?></td>
															<td class="text-right">$<?= number_format($reservation['tour']['price']['public']['babies'] * $reservation['data']['paxes']['babies']) ?></td>
														</tr>
														<tr>
															<td>Niños</td>
															<td class="text-center">$<?= number_format($reservation['tour']['price']['public']['childs']) ?></td>
															<td class="text-center">x<?= $reservation['data']['paxes']['childs'] ?></td>
															<td class="text-right">$<?= number_format($reservation['tour']['price']['public']['childs'] * $reservation['data']['paxes']['childs']) ?></td>
														</tr>
														<tr>
															<td>Adultos</td>
															<td class="text-center">$<?= number_format($reservation['tour']['price']['public']['adults']) ?></td>
															<td class="text-center">x<?= $reservation['data']['paxes']['adults'] ?></td>
															<td class="text-right">$<?= number_format($reservation['tour']['price']['public']['adults'] * $reservation['data']['paxes']['adults']) ?></td>
														</tr>


														<tr>
															<td class="thick-line"></td>
															<td class="thick-line"></td>
															<td class="thick-line text-center"><strong>Subtotal</strong></td>
															<td class="thick-line text-right">$<?= number_format($subtotal) ?></td>
														</tr>

														<tr>
															<td class="no-line"></td>
															<td class="no-line"></td>
															<td class="no-line text-center"><strong>Descuento</strong></td>
															<td class="no-line text-right">-$<?= number_format($discount) ?></td>
														</tr>

														<tr>
															<td class="no-line"></td>
															<td class="no-line"></td>
															<td class="no-line text-center"><strong>Total</strong></td>
															<td class="no-line text-right">
																<h4 class="m-0">$<?= number_format($total) ?></h4>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>

								</div>
							</div>
						<?php endif; ?>
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
