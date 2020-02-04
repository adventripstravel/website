<?php

defined('_EXEC') or die;

class Bookings_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index($time)
	{
		if (Format::exist_ajax_request() == true)
		{
			if ($_POST['action'] == 'get_tour_price')
			{
				$query = $this->model->get_tour($_POST['id']);

				if (!empty($query))
				{
					$query['price']['child'] = Functions::get_format_currency($query['price']['child'], 'USD');
					$query['price']['adult'] = Functions::get_format_currency($query['price']['adult'], 'USD');

					echo json_encode([
						'status' => 'success',
						'data' => $query
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'Error de operación'
					]);
				}
			}

			if ($_POST['action'] == 'get_total')
			{
				$errors = [];

				if (!empty($_POST['paxes_childs']) AND $_POST['paxes_childs'] < 0)
					array_push($errors, ['paxes_childs','Campo inválido']);

				if (!isset($_POST['paxes_adults']) OR empty($_POST['paxes_adults']))
					array_push($errors, ['paxes_adults','No deje este campo vacío']);
				else if ($_POST['paxes_adults'] < 1)
					array_push($errors, ['paxes_adults','Campo inválido']);

				if (empty($errors))
				{
					$query = $this->model->get_total($_POST);

					if (!empty($query))
					{
						echo json_encode([
							'status' => 'success',
							'data' => [
								'total' => Functions::get_currency_exchange($query, 'USD', $_POST['payment_currency'])
							]
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'errors' => 'Error de operación'
						]);
					}
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'errors' => $errors
					]);
				}
			}

			if ($_POST['action'] == 'get_booking')
			{
				$query = $this->model->get_booking($_POST['id']);

				if (!empty($query))
				{
					echo json_encode([
						'status' => 'success',
						'data' => $query
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'Error de operación'
					]);
				}
			}

			if ($_POST['action'] == 'create_booking' OR $_POST['action'] == 'update_booking')
			{
				$errors = [];

				if (!isset($_POST['tour']) OR empty($_POST['tour']))
					array_push($errors, ['tour','No deje este campo vacío']);

				if (!empty($_POST['paxes_childs']) AND $_POST['paxes_childs'] < 0)
					array_push($errors, ['paxes_childs','Campo inválido']);

				if (!isset($_POST['paxes_adults']) OR empty($_POST['paxes_adults']))
					array_push($errors, ['paxes_adults','No deje este campo vacío']);
				else if ($_POST['paxes_adults'] < 1)
					array_push($errors, ['paxes_adults','Campo inválido']);

				if (!isset($_POST['booked_date']) OR empty($_POST['booked_date']))
					array_push($errors, ['booked_date','No deje este campo vacío']);
				else if ($_POST['booked_date'] < Functions::get_current_date())
					array_push($errors, ['booked_date','Campo inválido']);

				if (!isset($_POST['total']) OR empty($_POST['total']))
					array_push($errors, ['total','No deje este campo vacío']);

				if (!isset($_POST['payment_currency']) OR empty($_POST['payment_currency']))
					array_push($errors, ['payment_currency','No deje este campo vacío']);

				if (!isset($_POST['firstname']) OR empty($_POST['firstname']))
					array_push($errors, ['firstname','No deje este campo vacío']);

				if (!isset($_POST['lastname']) OR empty($_POST['lastname']))
					array_push($errors, ['lastname','No deje este campo vacío']);

				if (!isset($_POST['email']) OR empty($_POST['email']))
					array_push($errors, ['email','No deje este campo vacío']);
				else if (Functions::check_email($_POST['email']) == false)
					array_push($errors, ['email','Campo inválido']);

				if (!isset($_POST['phone_lada']) OR empty($_POST['phone_lada']))
					array_push($errors, ['phone_lada','No deje este campo vacío']);

				if (!isset($_POST['phone_number']) OR empty($_POST['phone_number']))
					array_push($errors, ['phone_number','No deje este campo vacío']);

				if (!empty($_POST['payment_date']) AND $_POST['payment_date'] < $_POST['booked_date'])
					array_push($errors, ['total','Campo inválido']);

				if (!isset($_POST['language']) OR empty($_POST['language']))
					array_push($errors, ['language','No deje este campo vacío']);

				if (empty($errors))
				{
					if ($_POST['action'] == 'create_booking')
						$query = $this->model->create_booking($_POST);
					else if ($_POST['action'] == 'update_booking')
						$query = $this->model->update_booking($_POST);

					if (!empty($query))
					{
						echo json_encode([
							'status' => 'success',
							'message' => 'Operación realizada correctamente'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'errors' => 'Error de operación'
						]);
					}
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'errors' => $errors
					]);
				}
			}

			// if ($action == 'cancel_booking')
			// {
			// 	$query = $this->model->cancel_booking($_POST['id']);
			//
			// 	if (!empty($query))
			// 	{
			// 		echo json_encode([
			// 			'status' => 'success',
			// 			'message' => 'Operación realizada correctamente'
			// 		]);
			// 	}
			// 	else
			// 	{
			// 		echo json_encode([
			// 			'status' => 'error',
			// 			'message' => 'Error de operación'
			// 		]);
			// 	}
			// }
		}
		else
		{
			define('_title', '{$lang.title} | ' . Configuration::$web_page);

			$template = $this->view->render($this, 'index');

			$tbl_bookings = '';

			foreach ($this->model->get_bookings() as $value)
			{
				$tbl_bookings .=
				'<tr>
					<td>' . $value['token'] . '</td>
					<td>' . Functions::get_format_date($value['booked_date'], 'd M, y') . '</td>
					<td>' . $value['tour']['es'] . '</td>
					<td>
						' . ($value['paxes']['childs'] + $value['paxes']['adults']) . ' Paxes <br>
						' . $value['paxes']['childs'] . ' Niños <br>
						' . $value['paxes']['adults'] . ' Adultos
					</td>
					<td>
						' . $value['firstname'] . ' ' . $value['lastname'] . ' <br>
						' . $value['email'] . ' <br>
						+' . $value['phone']['lada'] . ' ' . $value['phone']['number'] . '
					</td>
					<td>
						' . Functions::get_format_currency(Functions::get_currency_exchange($value['total'], $value['payment']['currency'], 'USD'), 'USD') . ' <br>
						' . Functions::get_format_currency(Functions::get_currency_exchange($value['total'], $value['payment']['currency'], 'MXN'), 'MXN') . '
					</td>';

				if ($value['payment']['status'] == true)
					$tbl_bookings .= '<td><span class="success">Realizado</span></td>';
				else if ($value['payment']['status'] == false)
					$tbl_bookings .= '<td><span class="alert">Pendiente</span></td>';

				if ($value['request']['type'] == 'none')
					$tbl_bookings .= '<td><span class="success">Sin cambios</span></td>';
				else if ($value['request']['type'] == 'update')
					$tbl_bookings .= '<td><span class="busy">Actualización</span></td>';
				else if ($value['request']['type'] == 'cancel')
					$tbl_bookings .= '<td><span class="alert">Cancelación</span></td>';

				if ($value['canceled'] == true)
					$tbl_bookings .= '<td><span class="alert">Cancelada</span></td>';
				else if ($value['canceled'] == false AND $value['booked_date'] >= Functions::get_current_date())
					$tbl_bookings .= '<td><span class="success">Activa</span></td>';
				else if ($value['canceled'] == false AND $value['booked_date'] < Functions::get_current_date())
					$tbl_bookings .= '<td><span class="empty">Terminada</span></td>';

				$tbl_bookings .=
				'	<td>' . (($value['canceled'] == true OR $value['booked_date'] < Functions::get_current_date()) ? '' : '<a data-action="cancel_booking" data-id="' . $value['id'] . '"><i class="material-icons">cancel</i></a>') . '</td>
					<td><a data-action="update_booking" data-id="' . $value['id'] . '"><i class="material-icons">edit</i></a></td>
				</tr>';
			}

			$opt_tours = '';

			foreach ($this->model->get_tours() as $value)
				$opt_tours .= '<option value="' . $value['id'] . '">' . $value['name']['es'] . '</option>';

			$opt_phone_ladas = '';

			foreach ($this->model->get_phone_ladas() as $value)
				$opt_phone_ladas .= '<option value="' . $value['code'] . '">' . $value['name']['es'] . ' (+' . $value['code'] . ')</option>';

			$replace = [
				'{$tbl_bookings}' => $tbl_bookings,
				'{$opt_tours}' => $opt_tours,
				'{$opt_phone_ladas}' => $opt_phone_ladas
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
