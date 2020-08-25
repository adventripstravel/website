<?php

defined('_EXEC') or die;

class Experiences_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function view($param)
	{
		if (Format::exist_ajax_request())
		{
			$post['babies'] = (isset($_POST['babies']) && !empty($_POST['babies'])) ? (int) $_POST['babies'] : 0;
			$post['childs'] = (isset($_POST['childs']) && !empty($_POST['childs'])) ? (int) $_POST['childs'] : 0;
			$post['adults'] = (isset($_POST['adults']) && !empty($_POST['adults'])) ? (int) $_POST['adults'] : 0;
			$post['date'] = (isset($_POST['date']) && !empty($_POST['date'])) ? $_POST['date'] : null;
			$post['name'] = (isset($_POST['name']) && !empty($_POST['name'])) ? $_POST['name'] : null;
			$post['lastname'] = (isset($_POST['lastname']) && !empty($_POST['lastname'])) ? $_POST['lastname'] : null;
			$post['email'] = (isset($_POST['email']) && !empty($_POST['email'])) ? $_POST['email'] : null;
			$post['lada'] = (isset($_POST['lada']) && !empty($_POST['lada'])) ? $_POST['lada'] : null;
			$post['phone'] = (isset($_POST['phone']) && !empty($_POST['phone'])) ? $_POST['phone'] : null;
			$post['comments'] = (isset($_POST['comments']) && !empty($_POST['comments'])) ? $_POST['comments'] : null;

			$labels = [];

			if (is_null($post['adults']) || $post['adults'] <= 0)
				array_push($labels, ['adults', 'Debe ir al menos 1 adulto.']);

			if (is_null($post['date']))
				array_push($labels, ['date', 'Debes elegir una fecha para la excursión.']);

			if (is_null($post['name']))
				array_push($labels, ['name', '¿Cómo te llamas?']);

			if (is_null($post['lastname']))
				array_push($labels, ['lastname', '¿Cómo te apellidas?']);

			if (is_null($post['email']))
				array_push($labels, ['email', '¿Cúal es tu correo electrónico?']);

			if (!empty($labels))
			{
				echo json_encode([
					'status' => 'error',
					'labels' => $labels
				], JSON_PRETTY_PRINT);
			}
			else
			{
				$header_mail  = 'MIME-Version: 1.0' . "\r\n";
				$header_mail .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				$header_mail .= 'From: Adventrips.com <noreply@adventrips.com>' . "\r\n";
				$subject_mail .= 'Cotización';
				$body_mail =
				'Bebés: ' . (!empty($post['babies']) ? $post['babies'] : '0') . '<br>
				Niños: ' . (!empty($post['childs']) ? $post['childs'] : '0') . '<br>
				Adultos: ' . $post['adults'] . '<br>
				Fecha: ' . $post['date'] . '<br>
				Nombre: ' . $post['name'] . ' ' . $post['lastname'] . '<br>
				Correo: ' . $post['email'] . '<br>
				Teléfono: ' . $post['lada'] . ' ' . $post['phone'] . '<br>
				Comentarios: ' . $post['comments'];

			    mail('reservaciones@adventrips.com', $subject_mail, $body_mail, $header_mail);

				echo json_encode([
					"status" => "OK"
				], JSON_PRETTY_PRINT);
			}
		}
		else
		{
			switch ($param[0])
			{
				case 'isla-contoy':
					$this->isla_contoy();
					break;

				case 'isla-mujeres':
					$this->isla_mujeres();
					break;

				case 'tiburon-ballena':
					$this->tiburon_ballena();
					break;

				default:
					Errors::http('404');
					break;
			}
		}
	}

	private function isla_contoy()
	{
		global $data;

		$data = [
			'title' => 'Isla Contoy, dos preciosas islas caribeñas.',
			'gallery' => [
				'isla-contoy-gallery-1.jpg',
				'isla-contoy-gallery-2.jpg',
				'isla-contoy-gallery-3.jpg',
				'isla-contoy-gallery-4.jpg',
				'isla-contoy-gallery-5.jpg',
				'isla-contoy-gallery-6.jpg',
				'isla-contoy-gallery-7.jpg',
				'isla-contoy-gallery-8.jpg',
				'isla-contoy-gallery-9.jpg',
				'isla-contoy-gallery-10.jpg',
				'isla-contoy-gallery-11.jpg',
				'isla-contoy-gallery-12.jpg',
				'isla-contoy-gallery-13.jpg',
				'isla-contoy-gallery-14.jpg',
				'isla-contoy-gallery-15.jpg',
				'isla-contoy-gallery-16.jpg',
				'isla-contoy-gallery-17.jpg',
				'isla-contoy-gallery-18.jpg',
				'isla-contoy-gallery-19.jpg',
				'isla-contoy-gallery-20.jpg',
				'isla-contoy-gallery-21.jpg',
				'isla-contoy-gallery-22.jpg',
				'isla-contoy-gallery-23.jpg',
				'isla-contoy-gallery-24.jpg',
				'isla-contoy-gallery-25.jpg',
				'isla-contoy-gallery-26.jpg',
				'isla-contoy-gallery-27.jpg',
				'isla-contoy-gallery-28.jpg',
				'isla-contoy-gallery-29.jpg',
				'isla-contoy-gallery-30.jpg',
				'isla-contoy-gallery-31.jpg',
				'isla-contoy-gallery-32.jpg',
				'isla-contoy-gallery-33.jpg',
				'isla-contoy-gallery-34.jpg',
				'isla-contoy-gallery-35.jpg',
				'isla-contoy-gallery-36.jpg',
				'isla-contoy-gallery-37.jpg',
				'isla-contoy-gallery-38.jpg',
				'isla-contoy-gallery-39.jpg',
				'isla-contoy-gallery-40.jpg',
				'isla-contoy-gallery-41.jpg',
			]
		];

		define('_title', $data['title'] .' - Adventrips');

		echo $this->view->render($this, 'isla_contoy');
	}

	private function isla_mujeres()
	{
		global $data;

		$data = [
			'title' => 'Isla Mujeres, una de las mas hermosas islas del caribe mexicano.',
			'gallery' => [
				'isla-mujeres-gallery-1.jpg',
				'isla-mujeres-gallery-2.jpg',
				'isla-mujeres-gallery-3.jpg',
				'isla-mujeres-gallery-4.jpg',
				'isla-mujeres-gallery-5.jpg',
				'isla-mujeres-gallery-6.jpg',
				'isla-mujeres-gallery-7.jpg',
				'isla-mujeres-gallery-8.jpg',
				'isla-mujeres-gallery-9.jpg',
				'isla-mujeres-gallery-10.jpg',
				'isla-mujeres-gallery-11.jpg',
				'isla-mujeres-gallery-12.jpg',
				'isla-mujeres-gallery-13.jpg',
				'isla-mujeres-gallery-14.jpg',
				'isla-mujeres-gallery-15.jpg',
				'isla-mujeres-gallery-16.jpg',
				'isla-mujeres-gallery-17.jpg',
				'isla-mujeres-gallery-18.jpg',
				'isla-mujeres-gallery-19.jpg',
				'isla-mujeres-gallery-20.jpg',
				'isla-mujeres-gallery-21.jpg',
				'isla-mujeres-gallery-22.jpg',
				'isla-mujeres-gallery-23.jpg',
				'isla-mujeres-gallery-24.jpg',
				'isla-mujeres-gallery-25.jpg',
				'isla-mujeres-gallery-26.jpg',
				'isla-mujeres-gallery-27.jpg',
				'isla-mujeres-gallery-28.jpg',
				'isla-mujeres-gallery-29.jpg',
				'isla-mujeres-gallery-30.jpg',
				'isla-mujeres-gallery-31.jpg',
				'isla-mujeres-gallery-32.jpg',
				'isla-mujeres-gallery-33.jpg',
				'isla-mujeres-gallery-34.jpg',
				'isla-mujeres-gallery-35.jpg',
				'isla-mujeres-gallery-36.jpg',
			]
		];

		define('_title', $data['title'] .' - Adventrips');

		echo $this->view->render($this, 'isla_mujeres');
	}

	private function tiburon_ballena()
	{
		global $data;

		$data = [
			'title' => 'Tiburon Ballena, atrevete a llevar la adrenalina a otro nivel.',
			'gallery' => [
				'whale-shark-gallery-1.jpg',
				'whale-shark-gallery-2.jpg',
				'whale-shark-gallery-3.jpg',
				'whale-shark-gallery-4.jpg',
				'whale-shark-gallery-5.jpg',
				'whale-shark-gallery-6.jpg',
				'whale-shark-gallery-7.jpg',
				'whale-shark-gallery-8.jpg',
				'whale-shark-gallery-9.jpg',
				'whale-shark-gallery-10.jpg',
				'whale-shark-gallery-11.jpg',
				'whale-shark-gallery-12.jpg',
				'whale-shark-gallery-13.jpg',
				'whale-shark-gallery-14.jpg',
				'whale-shark-gallery-15.jpg',
				'whale-shark-gallery-16.jpg',
				'whale-shark-gallery-17.jpg',
				'whale-shark-gallery-18.jpg',
			]
		];

		define('_title', $data['title'] .' - Adventrips');

		echo $this->view->render($this, 'tiburon_ballena');
	}

}
