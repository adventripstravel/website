<?php
defined('_EXEC') or die;

// Bootstrap-touchspin
$this->dependencies->add(['css', '{$path.plugins}bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css']);
$this->dependencies->add(['js', '{$path.plugins}bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js']);

// Bootstrap-inputmask
$this->dependencies->add(['js', '{$path.plugins}bootstrap-inputmask/jquery.inputmask.min.js']);

// Sweet Alert
$this->dependencies->add(['css', '{$path.plugins}sweet-alert2/sweetalert2.min.css']);
$this->dependencies->add(['js', '{$path.plugins}sweet-alert2/sweetalert2.min.js']);

// Signature
$this->dependencies->add(['css', '{$path.plugins}signature_pad/signature_pad.css']);
$this->dependencies->add(['js', '{$path.plugins}signature_pad/signature_pad.js']);

// Parsley
$this->dependencies->add(['js', '{$path.plugins}parsleyjs/parsley.min.js']);

// Select2
$this->dependencies->add(['css', '{$path.plugins}select2/dist/css/select2.min.css']);
$this->dependencies->add(['css', '{$path.plugins}select2/dist/css/select2-bootstrap-theme.min.css']);
$this->dependencies->add(['js', '{$path.plugins}select2/dist/js/select2.min.js']);

// Page
$this->dependencies->add(['js', '{$path.js}pages/reservations/checkin.js?v=1.1']);
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
								<a href="index.php?c=Reservations&m=list">Reservaciones</a>
							</li>
							<li class="breadcrumb-item active">Checkin</li>
						</ol>
					</div>

					<h4 class="page-title">Realizar checkin</h4>
				</div>
			</div>
		</div>
		<!-- end page title end breadcrumb -->

        <form name="checkin" class="row" enctype="multipart/form-data">
        	<div class="col-lg-12">
				<!-- Type -->
				<div class="card m-b-30">
        			<div class="card-body">
						<h4 class="mt-0 header-title">Reservación</h4>
                        <p class="text-muted m-b-30 font-14">Seleccione la reservación donde se hará el checkin.</p>

						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Selecciona una reservación</label>
                            <div class="col-sm-9">
								<select class="custom-select" name="folio" required>
									<option></option>
									<?php foreach ( $reservations as $value ): ?>
										<option value="<?= $value['folio'] ?>">Folio: <?= $value['folio'] ?> - <?= $value['customer_name'] ?> (<?= $value['customer_email'] ?>) - <?= Dates::formatted_date($value['data']['reservation']['date'], 'formatted') ?></option>
									<?php endforeach; ?>
                                </select>
                            </div>
                        </div>
        			</div>
        		</div>

				<!-- Yacht -->
				<div class="card m-b-30" data-block="yacht">
        			<div class="card-body">
						<h4 class="mt-0 header-title">Cliente</h4>
                        <p class="text-muted m-b-30 font-14">Información completa del viajero que abordara la embarcación.</p>

						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nombre completo</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="name" required>
                            </div>
                        </div>

						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Edad</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="number" name="age" value="20" required>
                            </div>
                        </div>

						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Número telefónico</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="phone" name="phone" required>
                            </div>
                        </div>

						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Correo electrónico</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="email" name="email" required parsley-type="email">
                            </div>
                        </div>

						<div class="form-group row" data-group-take-photo>
                            <label class="col-sm-3 col-form-label">Foto ID Personal</label>
                            <div class="col-sm-9">
								<span><i class="dripicons-camera"></i> Tomar foto</span>
                                <input name="personal_id" type="file" accept="image/*" capture="camera">
                            </div>
                        </div>

						<div class="form-group row" data-group-take-photo>
                            <label class="col-sm-3 col-form-label">Foto de la forma de pago</label>
                            <div class="col-sm-9">
								<span><i class="dripicons-camera"></i> Tomar foto</span>
                                <input name="payment_form" type="file" accept="image/*" capture="camera">
                            </div>
                        </div>

						<div class="form-group row" data-group-take-photo>
                            <label class="col-sm-3 col-form-label">Selfie de presencia</label>
                            <div class="col-sm-9">
								<span><i class="dripicons-camera"></i> Tomar foto</span>
                                <input name="selfie" type="file" accept="image/*" capture="camera">
                            </div>
                        </div>

						<div class="form-group row" data-group-take-photo>
                            <label class="col-sm-3 col-form-label">Extra</label>
                            <div class="col-sm-9">
								<span><i class="dripicons-camera"></i> Tomar foto</span>
                                <input name="other_media" type="file" accept="image/*" capture="camera">
                            </div>
                        </div>
        			</div>
        		</div>

				<div class="card m-b-30" data-block="yacht">
        			<div class="card-body">
						<?php $this->format->import_file( Security::DS(PATH_LAYOUTS . 'Legal'), 'responsive_signature', 'php' ); ?>

						<div id="signature-pad" class="signature-pad">
						    <div class="signature-pad--body">
						    	<canvas></canvas>
						    </div>
						</div>

						<div class="form-group row">
                            <div class="col-sm-12">
								<input name="signature" type="text" class="custom-control-input" value="" hidden required>
								<small class="form-text text-muted">Firma del cliente.</small>
                            </div>
                        </div>

						<div class="form-group">
                            <div>
								<div class="custom-control custom-checkbox">
									<input name="terms_and_conditions" type="checkbox" class="custom-control-input" id="terms_and_conditions" value="check" required>
									<label class="custom-control-label text-justify" for="terms_and_conditions">UNA VEZ QUE HE LEIDO Y ACEPTADO EL PRESENTE REGLAMENTO Y RESPONSIVA ENTIENDO Y RENUNCIO A CUALQUIER FUTURA QUEJA, RECLAMACION O DEMANDA, FIRMANDO VOLUNTARIAMENTE LA PRESENTE, EN LA CIUDAD DE CANCUN, QUINTANA ROO A <?= strtoupper(date('d F Y')); ?>. <br>
									<span style="opacity: 0.6;">I HAVE READ AND UNDERSTAND THIS WAIVER AND RELEASE AGREEMENT AND VOLUNTARY SIGN IT, AND WAIVE ANY FURTHER CLAIM AND POTENTIAL LAWSUIT AND AGREE THAT NO ORAL REPRESENTATIONS, STATEMENTS OR INDUCEMENTS, APART, CANCUN, QUINTANA ROO ON <?= strtoupper(date('d F Y')); ?>.</span></label>
								</div>
                            </div>
                        </div>
        			</div>
        		</div>
        	</div>
        	<!-- end col -->

			<div class="col-lg-12">
				<div class="card m-b-30" style="background-color: transparent; box-shadow: none;">
					<div class="mo-mt-2">
						<div class="float-right">
							<button type="submit" class="btn btn-success waves-effect waves-light btn-lg" id="button_submit">Guardar</button>
							<a href="index.php" class="btn btn-danger waves-effect waves-light btn-lg">Cancelar</a>
						</div>
					</div>
				</div>
			</div>
        	<!-- end col -->
        </form>
        <!-- end row -->
	</div>
	<!-- end container -->
</div>
<!-- end wrapper -->
