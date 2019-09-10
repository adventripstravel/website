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

class Index_controller extends Controller
{
	private $lang;

	public function __construct()
	{
		parent::__construct();

		$this->lang = Session::get_value('lang');
	}

	/* Ajax 1: Search booking
	** Ajax 2: Get promotional code
	** Render: Home
	------------------------------------------------------------------------------- */
	public function index()
	{
		if (Format::exist_ajax_request() == true)
		{
			if ($_POST['action'] == 'search_booking')
			{
				$errors = [];

				if (!isset($_POST['token']) OR empty($_POST['token']))
					array_push($errors, ['token','{$lang.dont_leave_this_field_empty}']);
				else if ($this->model->check_exist_booking($_POST['token']) == false)
					array_push($errors, ['token','{$lang.invalid_data}']);

				if (empty($errors))
				{
					echo json_encode([
						'status' => 'success',
						'path' => '/voucher/index/' . $_POST['token'],
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'errors' => $errors,
					]);
				}
			}

			if ($_POST['action'] == 'get_promotional_discount')
			{
				$errors = [];

				if (!isset($_POST['email']) OR empty($_POST['email']))
					array_push($errors, ['email','{$lang.dont_leave_this_field_empty}']);
				else if (Functions::check_email($_POST['email']) == false)
					array_push($errors, ['email','{$lang.invalid_data}']);

				if (empty($errors))
				{
					$header_mail  = 'MIME-Version: 1.0' . "\r\n";
					$header_mail .= 'Content-type: text/html; charset=utf-8' . "\r\n";
					$header_mail .= 'From: Exploore.mx <noreply@exploore.mx>' . "\r\n";

					if ($this->lang == 'es')
					{
						$subject_mail = 'Obten tu código promocional';
						$message_mail = 'Ingresa tu código promocional en cualquier reservación que hagas y obten los inigualables descuentos que tenemos para ti';
						$book_now_mail = 'Reserva ahora';
						$success_mail = 'Hemos enviado un correo electrónico a ' . $_POST['mail'] . ' con tu código promocional';
					}
					else if ($this->lang == 'en')
					{
						$subject_mail = 'Get your promotional discount';
						$message_mail = 'Enter your promotional code in any reservation you make and get the unmatched discounts we have for you';
						$book_now_mail = 'Book now';
						$success_mail = 'We have sent an email to ' . $_POST ['mail'] . ' with your promotional code';
					}

					$body_mail =
					'<html>
						<head>
							<title>' . $subject_mail . '</title>
						</head>
						<body>
							<table style="width:600px;margin:0px;border:0px;padding:20px;box-sizing:border-box;background-color:#eee">
								<tr style="width:100%;margin:0px:margin-bottom:10px;border:0px;padding:0px;">
									<td style="width:100%;margin:0px;border:0px;padding:40px 20px;box-sizing:border-box;background-color:#201d33;">
										<figure style="width:100%;margin:0px;padding:0px;text-align:center;">
											<img style="width:100%;max-width:300px;" src="https://exploore.mx/images/logotype_white.png" />
										</figure>
									</td>
								</tr>
								<tr style="width:100%;margin:0px;margin-bottom:10px;border:0px;padding:0px;">
									<td style="width:100%;margin:0px;border:0px;padding:40px 20px;box-sizing:border-box;background-color:#fff;">
										<p style="font-size:60px;font-weight:600;text-align:center;color:#212121;margin:0px;margin-bottom:20px;padding:0px;">EX18AZ</p>
										<p style="font-size:14px;font-weight:400;text-align:center;color:#212121;margin:0px;margin-bottom:20px;padding:0px;">' . $message_mail . '</p>
										<a style="width:100%;display:block;margin:0px;border-radius:20px;padding:20px 0px;box-sizing:border-box;font-size:14px;font-weight:400;text-align:center;text-decoration:none;color:#fff;background-color:#201d33;" href="https://exploore.mx">' . $book_now_mail . '</a>
									</td>
								</tr>
								<tr style="width:100%;margin:0px;border:0px;padding:0px;">
									<td style="width:100%;margin:0px;border:0px;padding:20px;box-sizing:border-box;background-color:#fff;">
										<a style="width:100%;display:block;padding:20px 0px;box-sizing:border-box;font-size:14px;font-weight:400;text-align:center;text-decoration:none;color:#201d33;" href="https://exploore.mx">www.exploore.mx</a>
									</td>
								</tr>
							</table>
						</body>
					</html>';

				    mail($_POST['email'], $subject_mail, $body_mail, $header_mail);

					echo json_encode([
						'status' => 'success',
						'message' => $success_mail
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'errors' => $errors,
					]);
				}
			}
		}
		else
		{
			define('_title', Configuration::$web_page . ' | {$lang.seo_description}');

			$template = $this->view->render($this, 'index');

			$art_tours = '';

			foreach ($this->model->get_tours() as $value)
			{
				if ($value['discount']['type'] == '%')
					$value['discount'] = '<span> + ' . $value['discount']['amount'] . '% {$lang.to_discount_with_promotional_code}</span>';
				else if ($value['discount']['type'] == '$')
					$value['discount'] = '<span> + $ ' . $value['discount']['amount'] . ' USD {$lang.to_discount_with_promotional_code}</span>';

				$art_tours .=
				'<article data-image-src="{$path.uploads}' . $value['cover'] . '">
					<p>{$lang.from} $ ' . $value['price']['adults'] . ' USD ' . $value['discount'] . '</p>
					<h4>' . $value['name'][$this->lang] . '</h4>
					<p>' . $value['destination'] . '</p>
					<a href="/booking/index/' . $value['id'] . '">{$lang.book_now}</a>
		        </article>';
			}

			$replace = [
				'{$art_tours}' => $art_tours,
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
