<?php

defined('_EXEC') or die;

/**
* @package valkyrie.core.controllers
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

class Signup_controller extends Controller
{
	private $lang;

	public function __construct()
	{
		parent::__construct();

		$this->lang = Session::get_value('lang');
	}

	/* Ajax: No ajax
	** Render: Page
	------------------------------------------------------------------------------- */
	public function index()
	{
		if (Format::exist_ajax_request() == true)
		{
			if ($_POST['action'] == 'signup')
			{
				$name = !empty($_POST['name']) ? $_POST['name'] : null;
				$email = !empty($_POST['email']) ? $_POST['email'] : null;
				$phone = !empty($_POST['phone']) ? $_POST['phone'] : null;
				$username = !empty($_POST['username']) ? $_POST['username'] : null;
				$password = !empty($_POST['password']) ? $_POST['password'] : null;

				$errors = [];

				if (!isset($name))
					array_push($errors, ['name','{$lang.dont_leave_this_field_empty}']);

				if (!isset($email))
					array_push($errors, ['email','{$lang.dont_leave_this_field_empty}']);
				else if (Functions::check_email($email) == false)
					array_push($errors, ['email','{$lang.invalid_data}']);

				if (!isset($username))
					array_push($errors, ['username','{$lang.dont_leave_this_field_empty}']);

				if (!isset($password))
					array_push($errors, ['password','{$lang.dont_leave_this_field_empty}']);

				if (empty($errors))
				{
					$data = [
						'token' => Functions::get_random(6),
						'name' => $name,
						'email' => strtolower($email),
						'phone' => $phone,
						'username' => strtolower($username),
						'password' => Functions::get_encrypted($password),
						'id_user_level' => 2,
						'avatar' => null,
						'profile' => 'airbnb',
						'register_date' => Functions::get_date(),
						'status' => true,
					];

					$query = $this->model->new_user($data);

					if (!empty($query))
					{
						$header_mail  = 'MIME-Version: 1.0' . "\r\n";
						$header_mail .= 'Content-type: text/html; charset=utf-8' . "\r\n";
						$header_mail .= 'From: ' . Configuration::$web_page . ' <partners@exploore.mx>' . "\r\n";

						if ($this->lang == 'es')
							$subject_mail = '¡Gracias por resgistrarte con nosotros!';
						else if ($this->lang == 'en')
							$subject_mail = '¡Thanks for signup with us!';

						$body_mail =
						'<html>
						    <head>
						        <title>' . $subject_mail . '</title>
						    </head>
						    <body>
						        <table style="width:600px;margin:0px;border:0px;padding:20px;box-sizing:border-box;background-color:#eee">
						            <tr style="width:100%;margin:0px:margin-bottom:10px;border:0px;padding:0px;">
						                <td style="width:100%;margin:0px;border:0px;padding:40px 20px;box-sizing:border-box;background-color:#fff;">
						                    <figure style="width:100%;margin:0px;padding:0px;text-align:center;">
						                        <img style="width:100%;max-width:300px;" src="https://' . Configuration::$domain . '/images/logotype_black.png" />
						                    </figure>
						                </td>
						            </tr>
						            <tr style="width:100%;margin:0px;margin-bottom:10px;border:0px;padding:0px;">
						                <td style="width:100%;margin:0px;border:0px;padding:40px 20px;box-sizing:border-box;background-color:#fff;">
											<p style="font-size:14px;font-weight:400;text-align:center;color:#212121;margin:0px;padding:0px;"><strong>' . $data['name'] . '</strong>, ' . $subject_mail . '. Tu usuario : ' . $data['username'] . ', Tu contraseña : ' . $password . 'Tu código : ' . $data['token'] . '</p>
						                </td>
						            </tr>
						            <tr style="width:100%;margin:0px;border:0px;padding:0px;">
						                <td style="width:100%;margin:0px;border:0px;padding:20px;box-sizing:border-box;background-color:#fff;">
						                    <a style="width:100%;display:block;padding:20px 0px;box-sizing:border-box;font-size:14px;font-weight:400;text-align:center;text-decoration:none;color:#201d33;" href="https://' . Configuration::$domain . '">www.' . Configuration::$domain . '</a>
						                </td>
						            </tr>
						        </table>
						    </body>
						</html>';

						mail($data['email'], $subject_mail, $body_mail, $header_mail);
						mail('partners@exploore.mx', $subject_mail, $body_mail, $header_mail);

						echo json_encode([
							'status' => 'success',
							'message' => $subject_mail,
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
		}
		else
		{
			define('_title', Configuration::$web_page . ' | {$lang.index}');

			$template = $this->view->render($this, 'index');

			$replace = [

			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
