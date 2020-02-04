<?php

defined('_EXEC') or die;

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

				if (!isset($_POST['email']) OR empty($_POST['email']))
					array_push($errors, ['email','No deje este campo vacío']);

				if (!isset($_POST['password']) OR empty($_POST['password']))
					array_push($errors, ['password','No deje este campo vacío']);

				if (empty($errors))
				{
					$query = $this->model->get_login($_POST);

					if (!empty($query))
					{
						if ($query['status'] == true)
						{
							$query['password'] = explode(':', $query['password']);
							$query['password'] = ($this->security->create_hash('sha1', $_POST['password'] . $query['password'][1]) === $query['password'][0]) ? true : false;

							if ($query['password'] == true)
							{
								unset($query['password']);
								unset($query['status']);

								Session::init();
								Session::set_value('session', true);
								Session::set_value('user', $query);
								Session::set_value('_vkye_token', Functions::get_random_string());
								Session::set_value('_vkye_id_user', $query['id']);
								Session::set_value('_vkye_last_access', Functions::get_current_date());

								echo json_encode([
									'status' => 'success',
									'path' => User_level_vkye_adm::redirection()
								]);
							}
							else
							{
								echo json_encode([
									'status' => 'error',
									'errors' => [
										['password','Contraseña incorrecta']
									]
								]);
							}
						}
						else
						{
							echo json_encode([
								'status' => 'error',
								'errors' => [
									['email','Este usuario no está activado']
								]
							]);
						}
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'errors' => [
								['email','Este usuario no exíste']
							]
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
		}
		else
		{
			define('_title', '{$lang.title} | ' . Configuration::$web_page);

			$template = $this->view->render($this, 'index');

			$replace = [

			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}

	public function logout()
	{
		Session::destroy();

		header('Location: /');
	}
}
