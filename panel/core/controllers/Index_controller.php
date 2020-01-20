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
* @copyright Copyright (C) Code Monkey <legal@codemonkey.com.mx, wwww.codemonkey.com.mx>. All rights reserved.
*/

class Index_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (Format::exist_ajax_request() == true)
		{
			if ($_POST['action'] == 'login')
			{
				$errors = [];

				if (!isset($_POST['username']) OR empty($_POST['username']))
					array_push($errors, ['username','Ingrese su usuario o correo electrónico']);

				if (!isset($_POST['password']) OR empty($_POST['password']))
					array_push($errors, ['password','Ingrese su contraseña']);

				if (empty($errors))
				{
					$user = $this->model->get_user($_POST);

					if (!empty($user))
					{
						$password = explode(':', $user['password']);
						$password = ($this->security->create_hash('sha1', $_POST['password'] . $password[1]) === $password[0]) ? true : false;

						if ($password == true)
						{
							Session::init();

							Session::create_session_login([
								'token' => $this->security->random_string(16),
								'id_user' => $user['id_user'],
								'username' => $user['username'],
								'level' => $user['level'],
								'last_access' => Functions::get_date_hour()
							]);

							Session::set_value('_vkye_name', $user['name']);
							Session::set_value('_vkye_email', $user['email']);
							Session::set_value('_vkye_avatar', $user['avatar']);

							echo json_encode([
								'status' => 'success',
								'path' => User_level_vkye_adm::redirection()
							]);
						}
						else
						{
							echo json_encode([
								'status' => 'error',
								'message' => [
									['password','Contraseña incorrecta']
								]
							]);
						}
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => [
								['username','Usuario incorrecto']
							]
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
		}
		else
		{
			define('_title', '{$lang.title} | ' . Configuration::$web_page);

			$template = $this->view->render($this, 'index');

			echo $template;
		}
	}

	public function logout()
	{
		Session::destroy();

		header('Location: /');
	}
}
