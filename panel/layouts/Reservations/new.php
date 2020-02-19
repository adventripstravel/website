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
$this->dependencies->add(['js', '{$path.js}pages/reservations/new.js?v=1.2']);
?>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
			<div class="col-sm-12">
				<div class="page-title-box">
					<div class="btn-group float-right">
						<ol class="breadcrumb hide-phone p-0 m-0">
							<li class="breadcrumb-item">
								<a href="index.php?c=reservations">Reservaciones</a>
							</li>
							<li class="breadcrumb-item active">Nueva reserva</li>
						</ol>
					</div>

					<h4 class="page-title">Crear nueva reservación</h4>
				</div>
			</div>
		</div>

        <form name="reservation" class="row">
            <div class="col-lg-6">
                <!-- Origin -->
                <div class="card m-b-30" data-block="type_reservation">
                    <div class="card-body">
                        <!-- Title container -->
                        <h4 class="header-title mt-0">Tipo de reservación</h4>
                        <p class="text-muted m-b-30 font-14">Texto...</p>
                        <!-- End title container -->

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Origen</label>
                            <div class="col-sm-9">
								<select class="form-control" name="origin">
                                    <?php foreach ( $type_reservations as $key => $value ): ?>
                                        <option value="<?= $key ?>"><?= $value['name'] ?></option>
                                    <?php endforeach; ?>
                                    <option value="other">Otro</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row d-none">
                            <label class="col-sm-3 col-form-label">Nombre del socio</label>
                            <div class="col-sm-9">
								<select class="form-control" name="partner_name">
                                    <option value="" selected hidden>Elegir socio</option>
                                    <?php foreach ( $partners as $key => $value ): ?>
                                        <option value="<?= $key ?>"><?= $value['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row d-none">
                            <label class="col-sm-3 col-form-label">Nombre</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="origin_name">
								<small class="form-text text-muted">Escriba el nombre de donde proviene la reservación.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer -->
                <div class="card m-b-30" data-block="customer">
        			<div class="card-body">
						<h4 class="mt-0 header-title">Cliente</h4>
                        <p class="text-muted m-b-30 font-14">Información detallada del cliente que realiza la reservación.</p>

						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nombre</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="customer_name">
								<small class="form-text text-muted">Escriba el nombre completo del cliente que realiza la reservación.</small>
                            </div>
                        </div>

						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="email" name="customer_email">
								<small class="form-text text-muted">Correo electrónico, aquí llegará el ticket de reservación.</small>
                            </div>
                        </div>

						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Teléfono</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="customer_phone">
								<small class="form-text text-muted">Teléfono de contacto a 10 dígitos.</small>
                            </div>
                        </div>
        			</div>
        		</div>

                <!-- Yacht -->
				<div class="card m-b-30" data-block="yacht">
        			<div class="card-body">
						<h4 class="mt-0 header-title">Yate</h4>
                        <p class="text-muted m-b-30 font-14">Información del Yate</p>

						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Yate</label>
                            <div class="col-sm-9">
								<select class="form-control" name="yacht_name">
                                    <option value="" selected hidden>Elegir yate</option>
                                    <?php foreach ( $boats as $value ): ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?>, <?= $value['yacht'] ?> <?= $value['type'] ?> - <?= $value['ft'] ?> pies (<?= $value['year'] ?>).</option>
                                    <?php endforeach; ?>
                                    <option value="other">Otro</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row d-none">
                            <label class="col-sm-3 col-form-label">Nombre del yate</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="yacht_name_custom">
								<small class="form-text text-muted">Escriba el nombre del yate.</small>
                            </div>
                        </div>

						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pax</label>
							<div class="col-4">
                                <input type="text" value="" name="yacht_pax_adults">
                            </div>
							<div class="col-5">
                                <input type="text" value="" name="yacht_pax_childrens">
                            </div>
							<div class="offset-sm-3 col-4">
								<small class="form-text text-muted">Adultos</small>
                            </div>
							<div class="col-5">
								<small class="form-text text-muted">Niños</small>
                            </div>
                        </div>

						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Duración</label>
							<div class="col-sm-9">
                                <input type="text" value="4" name="yacht_hrs_duration">
                            </div>
							<div class="offset-sm-3 col-sm-9">
								<small class="form-text text-muted">Seleccioné la duración de la reserva.</small>
                            </div>
                        </div>

						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Precio</label>
							<div class="col-sm-9 input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">$</span>
								</div>
								<input class="form-control mask-price" type="text" name="yacht_price">
								<div class="input-group-append">
									<span class="input-group-text">MXN</span>
								</div>
							</div>
							<div class="offset-sm-3 col-sm-9">
								<small class="form-text text-muted">Precio del yate (sin contar las horas extra o amenidades).</small>
                            </div>
                        </div>
        			</div>
        		</div>

                <!-- Reservation -->
                <div class="card m-b-30" data-block="reservation">
        			<div class="card-body">
						<h4 class="mt-0 header-title">Reserva</h4>
                        <p class="text-muted m-b-30 font-14">Información detallada de la reservación.</p>

						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Fecha</label>
                            <div class="col-sm-9">
                                <input class="form-control mask-date" type="date" name="reservation_date">
								<small class="form-text text-muted">Elijá la fecha a reservar.</small>
                            </div>
                        </div>

						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Horario</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="time" name="reservation_hour">
								<small class="form-text text-muted">Establezcla el horario para la salida del yate.</small>
                            </div>
                        </div>

						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Horas extras</label>
							<div class="col-sm-9">
                                <input type="text" value="0" name="reservation_hrs_extra">
                            </div>
							<div class="offset-sm-3 col-sm-9">
								<small class="form-text text-muted">¿Necesita agregar horas extra?</small>
                            </div>
                        </div>

						<div class="form-group row d-none">
                            <label class="col-sm-3 col-form-label">Precio</label>
							<div class="col-sm-9 input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">$</span>
								</div>
								<input class="form-control" type="text" name="reservation_hour_extra_price">
								<div class="input-group-append">
									<span class="input-group-text">MXN</span>
								</div>
							</div>
							<div class="offset-sm-3 col-sm-9">
								<small class="form-text text-muted">Precio por hora extra.</small>
                            </div>
                        </div>

						<div class="form-group row">
							<label class="col-sm-3 col-form-label">¿Descuento?</label>
                            <div class="col-sm-9">
                                <div class="custom-control custom-checkbox">
                                    <input name="reservation_discount" type="radio" class="custom-control-input" id="customCheck1" value="no" checked>
                                    <label class="custom-control-label" for="customCheck1">No hacer descuento.</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input name="reservation_discount" type="radio" class="custom-control-input" id="customCheck2" value="percentage">
                                    <label class="custom-control-label" for="customCheck2">Con porcentaje.</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input name="reservation_discount" type="radio" class="custom-control-input" id="customCheck3" value="amount">
                                    <label class="custom-control-label" for="customCheck3">Con precio.</label>
                                </div>
                            </div>
                        </div>

						<div class="form-group row d-none">
                            <label class="col-sm-3 col-form-label">Porcentaje</label>
							<div class="col-sm-9">
                                <input type="text" value="0" name="reservation_percentage_discount">
                            </div>
							<div class="offset-sm-3 col-sm-9">
								<small class="form-text text-muted">Escriba el porcentaje de descuento.</small>
                            </div>
                        </div>

						<div class="form-group row d-none">
                            <label class="col-sm-3 col-form-label">Cantidad</label>
							<div class="col-sm-9 input-group">
								<input class="form-control mask-price" type="text" name="reservation_amount_discount">
								<div class="input-group-append">
									<span class="input-group-text">MXN</span>
								</div>
							</div>
							<div class="offset-sm-3 col-sm-9">
								<small class="form-text text-muted">Escriba la cantidad que desea descontar.</small>
                            </div>
                        </div>
        			</div>
        		</div>
            </div>

            <div class="col-lg-6">
                <!-- Includes -->
                <div class="card m-b-30" data-block="includes">
        			<div class="card-body">
						<h4 class="mt-0 header-title">Opciones para incluir</h4>
                        <p class="text-muted m-b-30 font-14">Puedes seleccionar amenidades y opciones extra para incluir en la reservación.</p>

						<div class="form-group">
                            <div>
                                <?php foreach ( $includes as $key => $value ): ?>
                                    <?php $id_random = $this->security->random_string(8); ?>
                                    <div class="custom-control custom-checkbox">
                                        <input name="includes[]" type="checkbox" class="custom-control-input" id="<?= $id_random ?>" value="<?= $key ?>" <?= ( isset($value['selected']) && $value['selected'] === true ) ? 'checked' : '' ?> >
                                        <label class="custom-control-label" for="<?= $id_random ?>"><?= $value['name'] ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="form-group row d-none">
							<div class="col-sm-12">
                                <textarea name="includes_others" class="form-control" rows="3" placeholder=""></textarea>
                            </div>
							<div class="col-sm-12">
								<small class="form-text text-muted">Escriba que desea incluir.</small>
                            </div>
                        </div>
        			</div>
        		</div>

                <!-- Amenidades -->
				<div class="card m-b-30" data-block="amenities">
        			<div class="card-body">
						<h4 class="mt-0 header-title">Amenidades extra</h4>
                        <p class="text-muted m-b-30 font-14">Agregar servicios extra disponibles.</p>

						<div class="form-group">
                            <div>
								<?php foreach( $amenities as $value ) : ?>
                                    <?php $id_random = $this->security->random_string(8); ?>
									<div class="custom-control custom-checkbox">
	                                    <input name="amenities[]" type="checkbox" class="custom-control-input" id="<?= $id_random ?>" value="<?= $value['id'] ?>">
	                                    <label class="custom-control-label" for="<?= $id_random ?>"><?= $value['name'] ?> ($ <?= number_format($value['price']) ?>).</label>
	                                </div>
								<?php endforeach; ?>
                            </div>
                        </div>
        			</div>
        		</div>

                <!-- Nota -->
				<div class="card m-b-30" data-block="note">
        			<div class="card-body">
						<h4 class="mt-0 header-title">Notas extra</h4>
                        <p class="text-muted m-b-30 font-14">Use este campo para anotar algun requerimiento extra.</p>

                        <div class="form-group row">
							<div class="col-sm-12">
                                <textarea name="notes" class="form-control" rows="6" placeholder=""></textarea>
                            </div>
                        </div>
        			</div>
        		</div>

                <!-- Payment -->
				<div class="card m-b-30" data-block="payment">
        			<div class="card-body">
						<h4 class="mt-0 header-title">Pago</h4>
                        <p class="text-muted m-b-30 font-14">Información detallada del metodo de pago.</p>

						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tipo de pago</label>
                            <div class="col-sm-9">
								<select class="form-control" name="reservation_amount_payment">
                                    <option value="online" selected>En linea</option>
                                    <option value="coupon">Cupón</option>
                                    <option value="cash">Efectivo</option>
                                    <option value="other">Otro</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row d-none">
                            <label class="col-sm-3 col-form-label">Número de cupón</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="coupon">
								<small class="form-text text-muted">Escriba el número de cupón.</small>
                            </div>
                        </div>

                        <div class="form-group row d-none">
                            <label class="col-sm-3 col-form-label">Otro tipo de pago</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="other_payment">
								<small class="form-text text-muted">Escriba el tipo de pago que se realizará.</small>
                            </div>
                        </div>
        			</div>
        		</div>

                <!-- Buttons -->
				<div class="card m-b-30" data-block="buttons">
        			<div class="card-body">
                        <div class="row">
                            <button type="submit" class="btn btn-success waves-effect waves-light btn-lg offset-1 col-6" id="button_submit">Crear reservación</button>
                            <a href="index.php" class="btn btn-danger waves-effect waves-light btn-lg offset-1 col-3">Cancelar</a>
    					</div>
        			</div>
        		</div>
            </div>
        </form>
    </div>
</div>
