<?php

defined('_EXEC') or die;

class Bookings_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Ajax 1: Edit
	** Ajax 2: Get
	** Render: Page
	------------------------------------------------------------------------------- */
	public function index($time)
	{
		if (Format::exist_ajax_request() == true)
		{
			$action = $_POST['action'];
			$id = ($action == 'edit' OR $action == 'get') ? $_POST['id'] : null;

			if ($action == 'edit')
			{
				$name = !empty($_POST['name']) ? $_POST['name'] : null;
				$email = !empty($_POST['email']) ? $_POST['email'] : null;
				$cellphone = !empty($_POST['cellphone']) ? $_POST['cellphone'] : null;
				$observations = !empty($_POST['observations']) ? $_POST['observations'] : null;
				$language = !empty($_POST['language']) ? $_POST['language'] : null;
				$canceled = !empty($_POST['canceled']) ? $_POST['canceled'] : null;

				$errors = [];

				if (!isset($name))
					array_push($errors, ['name','No deje este campo vacío']);

				if (!isset($email))
					array_push($errors, ['email','No deje este campo vacío']);
				else if (Functions::check_email($email) == false)
					array_push($errors, ['email','Dato inválido']);

				if (!isset($language))
					array_push($errors, ['language','No deje este campo vacío']);

				if (!isset($cellphone))
					array_push($errors, ['cellphone','No deje este campo vacío']);

				if (empty($errors))
				{
					$data = [
						'id_booking' => $id,
						'name' => $name,
						'email' => $email,
						'cellphone' => $cellphone,
						'observations' => $observations,
						'language' => $language,
						'canceled' => $canceled,
					];

					$query = $this->model->edit($data);

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
							'message' => 'DATABASE OPERATION ERROR'
						]);
					}
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => $errors
					]);
				}
			}

			if ($action == 'get')
			{
				$query = $this->model->get($id);

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
						'message' => 'DATABASE OPERATION ERROR'
					]);
				}
			}
		}
		else
		{
			define('_title', '{$lang.title} | ' . Configuration::$web_page);

			$template = $this->view->render($this, 'index');

			$datas = $this->model->get('*', ['id_booking','token','name','tours.name.tour','date_booking','paxes','canceled'], $time);

			$lst_datas = '';

			foreach ($datas as $value)
			{
				if ($value['canceled'] == true)
					$value['canceled'] = '<span class="alert">Cancelada</span>';
				else if ($value['canceled'] == false AND $value['date_booking'] >= Functions::get_date())
					$value['canceled'] = '<span class="success">Activa</span>';
				else if ($value['canceled'] == false AND $value['date_booking'] < Functions::get_date())
					$value['canceled'] = '<span class="empty">Terminada</span>';

				$lst_datas .=
				'<tr>
					<td>' . $value['token'] . '</td>
					<td>' . $value['name'] . '</td>
					<td>' . $value['tour']['es'] . '</td>
					<td>' . ($value['paxes']['adults'] + $value['paxes']['children']) . ' Paxs (' . $value['paxes']['adults'] . ' Adultos, ' . $value['paxes']['children'] . ' Niños)</td>
					<td>' . Functions::get_date('format', $value['date_booking']) . '</td>
					<td>' . $value['canceled'] . '</td>
					<td><a data-action="get" data-id="' . $value['id_booking'] . '"><i class="material-icons">menu</i><span>Detalles | Editar</span></a></td>
				</tr>';
			}

			$lst_time =
			'<option value="today" ' . (($time == 'today') ? 'selected' : '') . '>Hoy / Futuras</option>
			<option value="past" ' . (($time == 'past') ? 'selected' : '') . '>Pasadas</option>';

			$replace = [
				'{$lst_datas}' => $lst_datas,
				'{$lst_time}' => $lst_time,
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
