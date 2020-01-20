<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.core.controllers
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 01 - 18, 2018 <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since December 01 - 15, 2018 <@update>
* @version 1.1.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey <legal@codemonkey.com.mx, wwww.codemonkey.com.mx>. All rights reserved.
*/

class Users_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Ajax 1: New or Edit
	** Ajax 2: Restore
	** Ajax 2: Get
	** Ajax 3: Delete
	** Render: Page
	------------------------------------------------------------------------------- */
	public function index()
	{
		if (Format::exist_ajax_request() == true)
		{
			if ($_POST['action'] == 'get')
			{
				$query = $this->model->get($_POST['id']);

				echo json_encode([
					'status' => (!empty($query)) ? 'success' : 'error',
					'data' => (!empty($query)) ? $query : '',
					'message' => (!empty($query)) ? 'Operación realizada correctamente' : 'DATABASE OPERATION ERROR',
				]);
			}

			if ($_POST['action'] == 'new' OR $_POST['action'] == 'edit')
			{
				$errors = [];

				if (!isset($_POST['name']) OR empty($_POST['name']))
					array_push($errors, ['name','No deje este campo vacío']);

				if (!isset($_POST['email']) OR empty($_POST['email']))
					array_push($errors, ['email','No deje este campo vacío']);
				else if (Functions::check_email($_POST['email']) == false)
					array_push($errors, ['email','Campo inválido']);

				if (!isset($_POST['user_level']) OR empty($_POST['user_level']))
					array_push($errors, ['user_level','No deje este campo vacío']);

				if (!isset($_POST['password']) OR empty($_POST['password']))
					array_push($errors, ['password','No deje este campo vacío']);

				if (empty($errors))
				{
					if ($_POST['action'] == 'new')
						$query = $this->model->new($_POST);
					else if ($_POST['action'] == 'edit')
						$query = $this->model->edit($_POST);

					echo json_encode([
						'status' => (!empty($query)) ? 'success' : 'error',
						'message' => (!empty($query)) ? 'Operación realizada correctamente' : 'DATABASE OPERATION ERROR'
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => $errors
					]);
				}
			}

			if ($_POST['action'] == 'restore_password')
			{
				$errors = [];

				if (!isset($_POST['password']) OR empty($_POST['password']))
					array_push($errors, ['password','No deje este campo vacío']);

				if (empty($errors))
				{
					$query = $this->model->edit($_POST);

					echo json_encode([
						'status' => (!empty($query)) ? 'success' : 'error',
						'message' => (!empty($query)) ? 'Operación realizada correctamente' : 'DATABASE OPERATION ERROR'
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => $errors
					]);
				}
			}

			if ($_POST['action'] == 'delete')
			{
				$query = $this->model->delete($_POST['id']);

				echo json_encode([
					'status' => (!empty($query)) ? 'success' : 'error',
					'message' => (!empty($query)) ? 'Operación realizada correctamente' : 'DATABASE OPERATION ERROR'
				]);
			}
		}
		else
		{
			define('_title', '{$lang.title} | ' . Configuration::$web_page);

			$template = $this->view->render($this, 'index');

			$datas = $this->model->get('*', ['id_user','token','name','email','phone','users_levels.name.user_level','avatar','status']);

			$lst_datas = '';

			foreach ($datas as $value)
			{
				$lst_datas .=
				'<tr>
					<td><figure><img src="' . (!empty($value['avatar']) ? '{$path.uploads}' . $value['avatar'] : '{$path.images}empty.png') . '"></figure></td>
					<td>' . $value['name'] . '</td>
					<td>' . $value['email'] . '</td>
					<td>' . ((!empty($value['phone'])) ? $value['phone'] : 'No disponible') . '</td>
					<td>' . $value['token'] . '</td>
					<td>' . $value['user_level'] . '</td>
					<td>' . (($value['status'] == true) ? '<span class="success">Activo</span>' : '<span class="empty">Desactivado</span>') . '</td>
					<td>
						<a data-action="delete" data-id="' . $value['id_user'] . '"><i class="material-icons">delete</i><span>Eliminar</span></a>
						<a data-action="get" data-id="' . $value['id_user'] . '" data-restore><i class="material-icons">lock</i><span>Restablecer contraseña</span></a>
						<a data-action="get" data-id="' . $value['id_user'] . '"><i class="material-icons">menu</i><span>Detalles | Editar</span></a>
					</td>
				</tr>';
			}

			$users_levels = $this->model->get('*', ['id_user_level','name'], 'users_levels');

			$lst_users_levels = '';

			foreach ($users_levels as $value)
				$lst_users_levels .= '<option value="' . $value['id_user_level'] . '" ' . (($value['id_user_level'] == 2) ? 'selected' : '') . '>' . $value['name'] . '</option>';

			$replace = [
				'{$lst_datas}' => $lst_datas,
				'{$lst_users_levels}' => $lst_users_levels
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
