<?php

defined('_EXEC') or die;

class Voucher_controller extends Controller
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
	public function index($token)
	{
		if (!empty($token))
		{
			$booking = $this->model->get_booking($token);

			if (!empty($booking))
			{
				if (Format::exist_ajax_request() == true)
				{
					if ($_POST['action'] == 'request')
					{
						$header_mail  = 'MIME-Version: 1.0' . "\r\n";
						$header_mail .= 'Content-type: text/html; charset=utf-8' . "\r\n";
						$header_mail .= 'From: Exploore.mx <noreply@exploore.mx>' . "\r\n";

						if ($_POST['option'] == 'update')
						{
							$subject_mail = 'Solicitud de actualización de reservación';
							$body_mail = 'La reservación número ' . $booking['token'] . ' está haciendo una solicitud de actualización el día ' . Functions::get_date() . ' a las ' . Functions::get_hour();
							$message = 'Tu solicitud de actualización ha sido enviada correctamente. En breve uno de nuestros agentes de reservaciones se pondrá en contacto con usted para dar seguimiento a su solicitud';
						}
						else if ($_POST['option'] == 'cancel')
						{
							$subject_mail = 'Solicitud de cancelación de reservación';
							$body_mail = 'La reservación número ' . $booking['token'] . ' está haciendo una solicitud de cancelación el día ' . Functions::get_date() . ' a las ' . Functions::get_hour();
							$message = 'Your update request has been sent correctly. Soon one of our reservations agents will contact you to follow up on your request';
						}

						mail('reservaciones@exploore.mx', $subject_mail, $body_mail, $header_mail);

						echo json_encode([
							'status' => 'success',
							'message' => $message,
						]);
					}
				}
				else
				{
					define('_title', Configuration::$web_page);

					$template = $this->view->render($this, 'index');

					if ($booking['totals']['discount']['type'] == '%')
						$booking['totals']['discount'] = $booking['totals']['discount']['amount'] . ' %';
					else if ($booking['totals']['discount']['type'] == '$')
						$booking['totals']['discount'] = '$ ' . $booking['totals']['discount']['amount'] . ' USD';

					if ($booking['payment']['method'] == 'paypal')
						$booking['payment']['method'] = 'PayPal';

					if ($booking['language'] == 'es')
						$booking['language'] = 'Español';
					else if ($booking['language'] == 'en')
						$booking['language'] = 'English';

					$replace = [
						'{$token}' => $booking['token'],
						'{$name}' => $booking['name'],
						'{$email}' => $booking['email'],
						'{$cellphone}' => $booking['cellphone'],
						'{$tour_name}' => $booking['tour_name'][$this->lang],
						'{$tour_cover}' => $booking['tour_cover'],
						'{$date_booking}' => Functions::get_date('format', $booking['date_booking']),
						'{$observations}' => !empty($booking['observations']) ? $booking['observations'] : '{$lang.not_observation}',
						'{$paxes_adults}' => $booking['paxes']['adults'],
						'{$paxes_children}' => $booking['paxes']['children'],
						'{$paxes_total}' => ($booking['paxes']['adults'] + $booking['paxes']['children']),
						'{$totals_amount}' => '$ ' . $booking['totals']['amount'] . ' USD',
						'{$totals_taxes}' => '$ ' . $booking['totals']['taxes'] . ' USD',
						'{$totals_discount}' => $booking['totals']['discount'],
						'{$totals_price_adults}' => '$ ' . $booking['totals']['price']['adults'] . ' USD',
						'{$totals_price_children}' => '$ ' . $booking['totals']['price']['children'] . ' USD',
						'{$payment_method}' => $booking['payment']['method'],
						'{$payment_currency}' => $booking['payment']['currency'],
						'{$payment_datehour}' => $booking['payment']['datehour'] . ' Hrs',
						'{$language}' => $booking['language'],
						'{$date_booked}' => Functions::get_date('format', $booking['date_booked']),
						'{$promotional_code}' => $booking['code'],
					];

					$template = $this->format->replace($replace, $template);

					echo $template;
				}
			}
			else
				header('Location: /');
		}
		else
			header('Location: /');
	}
}
