<?php
defined('_EXEC') or die;

class Reservations_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
		Format::set_time_zone();
	}

	public function edit_status( $param = null )
	{
		if ( Format::exist_ajax_request() )
		{
			header('Content-type: application/json');

			$this->model->edit_status( $_POST['value'], $param );

			echo json_encode([
				'status' => 'OK'
			], JSON_PRETTY_PRINT);
		}
		else
			Errors::http('404');
	}

	public function view( $param = null )
	{
		$response = $this->model->get_reservations_by_folio([
			'folio' => strtoupper($param)
		]);

		if ( !is_null($response) )
		{
			if ( Format::exist_ajax_request() )
			{
				// TODO
			}
			else
			{
				global $reservation;

				$reservation = $response;

				define('_title', 'Viendo la reservación número: '. $response['folio']);
				$template = $this->view->render($this, 'view');

				echo $template;
			}
		}
		else
			Errors::http('404');
	}
}
