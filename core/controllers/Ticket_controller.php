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
		else
			Errors::http('404');
	}
}
