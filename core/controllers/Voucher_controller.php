<?php

defined('_EXEC') or die;

class Voucher_controller extends Controller
{
	private $page;
	private $lang;

	public function __construct()
	{
		parent::__construct();

		$this->page = 'voucher';
		$this->lang = Session::get_value('vkye_lang');
	}

	public function index($params)
	{
        $booking = $this->model->get_booking($params[0]);

        if (!empty($booking))
        {
            if (Format::exist_ajax_request() == true)
    		{
				if ($_POST['action'] == 'request_update_booking' OR $_POST['action'] == 'request_cancel_booking')
				{
					$errors = [];

					if (!isset($_POST['observations']) OR empty($_POST['observations']))
                        array_push($errors, ['observations','{$lang.dont_leave_this_field_empty}']);

					if (empty($errors))
					{
						$_POST['booking'] = $booking;

						if ($_POST['action'] == 'request_update_booking')
							$_POST['request'] = 'update';
						else if ($_POST['action'] == 'request_cancel_booking')
							$_POST['request'] = 'cancel';

						$query = $this->model->new_request($_POST);

						if (!empty($query))
						{
							if ($_POST['action'] == 'request_update_booking')
								$mail_subject = 'Nueva solicitud de actualización de reservación';
							if ($_POST['action'] == 'request_cancel_booking')
								$mail_subject = 'Nueva solicitud de cancelación de reservación';

							$mail_header  = 'MIME-Version: 1.0' . "\r\n";
							$mail_header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
							$mail_header .= 'From: ' . $booking['firstname'] . ' ' . $booking['lastname'] . ' <' . $booking['email'] . '>' . "\r\n";
							$mail_body =
							'Asunto: ' . $mail_subject . '<br>
							Número de reservación: ' . $booking['token'] . '<br>
							Excursión: ' . $booking['tour']['es'] . '<br>
							Niños: ' . $booking['paxes']['childs'] . ' Paxes<br>
							Adultos: ' . $booking['paxes']['adults'] . ' Paxes<br>
							Fecha reservada: ' . Functions::get_format_date($booking['booked_date'], 'd/m/Y') . '<br>
							Observaciones: ' . $booking['observations'] . '<br>
							Nombre: ' . $booking['firstname'] . '<br>
							Apellido: ' . $booking['lastname'] . '<br>
							Correo electrónico: ' . $booking['email'] . '<br>
							Teléfono: +' . $booking['phone']['lada'] . ' ' . $booking['phone']['number'] . '<br>
							Total: ' . Functions::get_format_currency(Functions::get_currency_exchange($booking['total'], 'USD', $booking['payment']['currency']), $booking['payment']['currency']) . '<br>
							Estado de pago: ' . (($booking['payment']['status'] == true) ? 'Pagado realizado' : 'Pago pendiente') . '<br>
							Fecha de pago: ' . (($booking['payment']['status'] == true) ? Functions::get_format_date($booking['payment']['date'], 'd/m/Y') : 'Pago pendiente') . '<br>
							Método de pago: ' . (($booking['payment']['status'] == true) ? $booking['payment']['method'] : 'Pago pendiente') . '<br>
							Moneda de pago: ' . $booking['payment']['currency'] . '<br>
							Idioma: ' . $booking['language'] . '<br>
							Estado de reservación: ' . (($booking['canceled'] == true) ? 'Cancelada' : 'Activa') . '<br>
							Fecha de registro: ' . Functions::get_format_date($booking['registration_date'], 'd/m/Y');

							mail(Session::get_value('settings')['contact']['email']['es'], $mail_subject, $mail_body, $mail_header);

							echo json_encode([
								'status' => 'success',
								'message' => '{$lang.request_operation_success}'
							]);
						}
						else
						{
							echo json_encode([
								'status' => 'error',
								'errors' => '{$lang.operation_error}'
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
    			define('_title', '{$lang.voucher} | ' . Configuration::$web_page);

    			$template = $this->view->render($this, 'index');

				Session::set_value('vkye_lang', $booking['language']);

    			$replace = [
    				'{$seo_title}' => '',
    				'{$seo_keywords}' => '',
    				'{$seo_description}' => '',
					'{$token}' => $booking['token'],
					'{$childs}' => $booking['paxes']['childs'],
					'{$adults}' => $booking['paxes']['adults'],
					'{$booked_date}' => Functions::get_format_date($booking['booked_date'], 'd/m/Y'),
					'{$observations}' => $booking['observations'],
					'{$firstname}' => $booking['firstname'],
					'{$lastname}' => $booking['lastname'],
					'{$email}' => $booking['email'],
					'{$phone}' => '+(' . $booking['phone']['lada'] . ') ' . $booking['phone']['number'],
					'{$total}' => Functions::get_format_currency(Functions::get_currency_exchange($booking['total'], 'USD', $booking['payment']['currency']), $booking['payment']['currency']),
					'{$payment_status}' => ($booking['payment']['status'] == true) ? '{$lang.paid}' : '{$lang.unpaid}',
					'{$payment_date}' => ($booking['payment']['status'] == true) ? Functions::get_format_date($booking['payment']['date'], 'd/m/Y') : '{$lang.unpaid}',
					'{$payment_method}' => ($booking['payment']['status'] == true) ? '{$lang.' . $booking['payment']['method'] . '}' : '{$lang.unpaid}',
					'{$payment_currency}' => $booking['payment']['currency'],
					'{$language}' => '{$lang.' . $booking['language'] . '}',
					'{$status}' => ($booking['canceled'] == true) ? '{$lang.canceled}' : '{$lang.active}',
					'{$registration_date}' => Functions::get_format_date($booking['registration_date'], 'd/m/Y'),
					'{$btn_request_update_booking}' => ($booking['canceled'] == false AND Functions::get_current_date() <= $booking['booked_date']) ? '<a data-button-modal="request_update_booking">{$lang.request_update_booking}</a>' : '',
					'{$btn_request_cancel_booking}' => ($booking['canceled'] == false AND Functions::get_current_date() <= $booking['booked_date']) ? '<a data-button-modal="request_cancel_booking">{$lang.request_cancel_booking}</a>' : '',
					'{$tour_name}' => $booking['tour_name'][$booking['language']],
					'{$tour_summary}' => $booking['tour_summary'][$booking['language']],
					'{$tour_cover}' => '{$path.uploads}' . $booking['tour_cover'],
					'{$tour_destination}' => $booking['tour_destination'],
					'{$tour_url}' => '/booking/' . Functions::get_cleaned_string_to_url($booking['tour_name'][$booking['language']]) . '/' . $booking['tour_id'] . ''
    			];

    			$template = $this->format->replace($replace, $template);

    			echo $template;
    		}
        }
        else
            header('Location: /');
	}
}
