<?php
defined('_EXEC') or die;

class Ticket_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index( $param )
	{
		$response = $this->model->get_ticket($param[0]);

		if ( !is_null($response) )
		{
			if ( Format::exist_ajax_request() == true )
			{
				$notification = new Send_email_notifications();

				$mail = new Mailer(true);
				// $mail->SMTPDebug = 3;
				$mail->isSMTP();
				$mail->setFrom('noreplay@adventrips.com', 'Adventrips');
				$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
				$mail->SMTPOptions = [ 'ssl' => [ 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ] ];
				$mail->addAddress('reservaciones@adventrips.com');
				// $mail->addAddress('davidgomezmacias@gmail.com');
				$mail->Subject = "{$response['customer']['firstname']}, solicitó una actualización en su reservación.";
				$mail->Body    = "Folio: {$response['folio']} <br><br> Mensaje: {$_POST['request']}";

				try {
					$mail->send();
				} catch (Exception $e) {}

				echo json_encode([
					'status' => 'success'
				]);
			}
			else
			{
				global $data;

				$data = $response;

				define('_title', 'Reservación #'. $data['folio']);

				$template = $this->view->render($this, [
					'head' => [
						"path" => PATH_LAYOUTS . "Ticket",
						"file" => "head"
					],
					'main' => [
						"path" => PATH_LAYOUTS . "Ticket",
						"file" => "index"
					],
					'footer' => [
						"path" => PATH_LAYOUTS . "Ticket",
						"file" => "footer"
					]
				]);

				echo $template;
			}
		}
		else
			Errors::http('404');
	}
}
