<?php

defined('_EXEC') or die;

class Booking_controller extends Controller
{
	private $lang;

	public function __construct()
	{
		parent::__construct();

		$this->lang = Session::get_value('lang');
	}

	/* Ajax: No ajax
	** Render: Booking
	------------------------------------------------------------------------------- */
	public function index($id)
	{
		$tour = $this->model->get_tour($id);

		if (Format::exist_ajax_request() == true)
		{
			if ($_POST['action'] == 'get_map')
			{
				echo json_encode([
					'status' => 'success',
					'data' => [
						'location' => [
							'lat' => $tour['location']['lat'],
							'lng' => $tour['location']['lng'],
						],
						'transportation' => [
							'lat' => !empty($tour['transportation']['lat']) ? $tour['transportation']['lat'] : null,
							'lng' => !empty($tour['transportation']['lng']) ? $tour['transportation']['lng'] : null,
						]
					]
				]);
			}

			// if ($_POST['action'] == 'get')
			// {
			// 	if ($_POST['option'] == 'availability')
			// 	{
			// 		$availability = $this->model->get_availability($tour['id'], $_POST['date'], $tour['availability']);
			//
			// 		echo json_encode([
			// 			'status' => 'success',
			// 			'data' => (empty($availability) OR $availability <= 0) ? '{$lang.not_available}' : $availability . ' paxs {$lang.available}'
			// 		]);
			// 	}
			//
			// 	if ($_POST['option'] == 'total')
			// 	{
			// 		$total = ($_POST['adults'] * $tour['price']['adults']) + ($_POST['children'] * $tour['price']['children']);
			//
			// 		if (!empty($tour['discount']))
			// 		{
			// 			if ($tour['discount']['type'] == '%')
			// 				$total = $total - (($tour['discount']['amount'] * $total) / 100);
			// 			else if ($tour['discount']['type'] == '$')
			// 				$total = $total - $tour['discount']['amount'];
			// 		}
			//
			// 		echo json_encode([
			// 			'status' => 'success',
			// 			'data' => $total
			// 		]);
			// 	}
			// }
			//
			// if ($_POST['action'] == 'booking')
			// {
			// 	$date = !empty($_POST['date']) ? $_POST['date'] : null;
			// 	$adults = !empty($_POST['adults']) ? $_POST['adults'] : null;
			// 	$children = !empty($_POST['children']) ? $_POST['children'] : 0;
			// 	$name = !empty($_POST['name']) ? $_POST['name'] : null;
			// 	$email = !empty($_POST['email']) ? $_POST['email'] : null;
			// 	$cellphone = !empty($_POST['cellphone']) ? $_POST['cellphone'] : null;
			// 	$code = (!empty($tour['discount']) AND !empty($_POST['code'])) ? $_POST['code'] : null;
			//
			// 	$errors = [];
			//
			// 	if (!isset($date))
			// 		array_push($errors, ['date','{$lang.dont_leave_this_field_empty}']);
			// 	else if ($date < Functions::get_date('sum', Functions::get_date(), '1', 'days'))
			// 		array_push($errors, ['date','{$lang.data_invalid}']);
			// 	else if (!empty($tour['availability']) AND ($adults + $children) > $this->model->get_availability($tour['id'], $date, $tour['availability']))
			// 		array_push($errors, ['date','{$lang.data_invalid}']);
			//
			// 	if (!isset($adults))
			// 		array_push($errors, ['adults','{$lang.dont_leave_this_field_empty}']);
			// 	else if ($adults < 1)
			// 		array_push($errors, ['adults','{$lang.data_invalid}']);
			//
			// 	if (!empty($children) AND $children < 0)
			// 		array_push($errors, ['children','{$lang.data_invalid}']);
			//
			// 	if (!isset($name))
			// 		array_push($errors, ['name','{$lang.dont_leave_this_field_empty}']);
			//
			// 	if (!isset($email))
			// 		array_push($errors, ['email','{$lang.dont_leave_this_field_empty}']);
			// 	else if (Functions::check_email($email) == false)
			// 		array_push($errors, ['email','{$lang.data_invalid}']);
			//
			// 	if (!isset($cellphone))
			// 		array_push($errors, ['cellphone','{$lang.dont_leave_this_field_empty}']);
			// 	else if (!is_numeric($cellphone))
			// 		array_push($errors, ['cellphone','{$lang.data_invalid}']);
			// 	else if (strlen($cellphone) != 10)
			// 		array_push($errors, ['cellphone','{$lang.data_invalid}']);
			//
			// 	if (!empty($tour['discount']))
			// 	{
			// 		if (!isset($code))
			// 			array_push($errors, ['code','{$lang.dont_leave_this_field_empty}']);
			// 		else if (empty($this->model->get_seller($code)))
			// 			array_push($errors, ['code','{$lang.data_invalid}']);
			// 	}
			//
			// 	if (empty($errors))
			// 	{
			// 		$total = ($adults * $tour['price']['adults']) + ($children * $tour['price']['children']);
			//
			// 		if (!empty($tour['discount']))
			// 		{
			// 			if ($tour['discount']['type'] == '%')
			// 				$total = $total - (($tour['discount']['amount'] * $total) / 100);
			// 			else if ($tour['discount']['type'] == '$')
			// 				$total = $total - $tour['discount']['amount'];
			// 		}
			//
			// 		$data = [
			// 			'payment' => [
			// 				[
			// 					'item_name' => $tour['name'][$this->lang],
			// 					'amount' => $total,
			// 					'quantity' => 1,
			// 					'item_number' => Functions::get_random(8),
			// 					'incidence_number' => Functions::get_random(8),
			// 					'data' => [
			// 						'booking' => [
			// 							'token' => Functions::get_random(6),
			// 							'name' => $name,
			// 							'email' => $email,
			// 							'cellphone' => $cellphone,
			// 							'id' => $tour['id'],
			// 							'date_booking' => $date,
			// 							'observations' => null,
			// 							'paxes' => [
			// 								'adults' => $adults,
			// 								'children' => $children
			// 							],
			// 							'totals' => [
			// 								'amount' => $total,
			// 								'taxes' => 0,
			// 								'discount' => [
			// 									'amount' => !empty($tour['discount']) ? $tour['discount']['amount'] : null,
			// 									'type' => !empty($tour['discount']) ? $tour['discount']['type'] : null
			// 								],
			// 								'price' => [
			// 									'adults' => $tour['price']['adults'],
			// 									'children' => $tour['price']['children']
			// 								],
			// 							],
			// 							'payment' => [
			// 								'method' => 'paypal',
			// 								'currency' => 'USD',
			// 								'datehour' => Functions::get_date_hour(),
			// 							],
			// 							'language' => $this->lang,
			// 							'canceled' => false,
			// 							'date_booked' => Functions::get_date(),
			// 							'code' => !empty($tour['discount']) ? $code : null
			// 						],
			// 						'tour' => $tour
			// 					]
			// 				]
			// 			]
			// 		];
			//
			// 		$query = $this->model->new($data);
			//
			// 		if (!empty($query))
			// 		{
			// 			echo json_encode([
			// 				'status' => 'success',
			// 				'path' => 'https://payment.exploore.mx/index/index/' . $query
			// 			]);
			// 		}
			// 		else
			// 		{
			// 			echo json_encode([
			// 				'status' => 'error',
			// 				'message' => 'DATABASE OPERATION ERROR'
			// 			]);
			// 		}
			// 	}
			// 	else
			// 	{
			// 		echo json_encode([
			// 			'status' => 'error',
			// 			'message' => $errors
			// 		]);
			// 	}
			// }
		}
		else
		{
			define('_title', 'Exploore.mx | ' . $tour['name'][$this->lang]);

			$template = $this->view->render($this, 'index');

			$div_gallery = '';

			if (!empty($tour['gallery']))
			{
				$div_gallery .=
				'<div class="gallery">';

				foreach ($tour['gallery'] as $value)
				{
					$div_gallery .=
					'<figure>
			            <img src="{$path.uploads}' . $value . '" alt="Gallery">
						<a href="{$path.uploads}' . $value . '" class="fancybox-thumb" rel="fancybox-thumb"><i class="material-icons">open_with</i></a>
			        </figure>';
				}

				$div_gallery .=
	            '</div>';
			}

			$replace = [
	            '{$cover}' => '{$path.uploads}' . $tour['cover'],
	            '{$name}' => $tour['name'][$this->lang],
				'{$destination}' => $tour['destination'],
	            '{$price}' => '{$lang.adults} ' . Functions::get_formatted_currency($tour['price']['adults'], 'USD') . ' & {$lang.children} ' . Functions::get_formatted_currency($tour['price']['children'], 'USD') . ' <span>+ ' . (($tour['discount']['type'] == '%') ? $tour['discount']['amount'] . '%' : Functions::get_formatted_currency($tour['discount']['amount'], 'USD')) . ' {$lang.to_discount_with_promotional_code}</span>',
				'{$discount}' => '{$lang.adults} ' . Functions::get_formatted_currency(($tour['price']['adults'] - (($tour['discount']['amount'] * $tour['price']['adults']) / 100)), 'USD') . ' & {$lang.children} ' . Functions::get_formatted_currency(($tour['price']['children'] - (($tour['discount']['amount'] * $tour['price']['children']) / 100)), 'USD'),
				'{$description}' => $tour['description'][$this->lang],
				'{$p_observations}' => (!empty($tour['observations'])) ? '<p>' . $tour['observations'][$this->lang] . '</p>' : '',
				'{$div_gallery}' => $div_gallery,
				'{$availability}' => !empty($tour['availability']) ? $this->model->get_availability($tour['id'], Functions::get_date('sum', Functions::get_date(), '1', 'days'), $tour['availability']) . ' paxs {$lang.availables}' : '',
				'{$usd_total}' => ($tour['discount']['type'] == '%') ? Functions::get_formatted_currency(($tour['price']['adults'] - (($tour['discount']['amount'] * $tour['price']['adults']) / 100)), 'USD') : Functions::get_formatted_currency(($tour['price']['adults'] - $tour['discount']['amount']), 'USD'),
				'{$mxn_total}' => ($tour['discount']['type'] == '%') ? Functions::get_formatted_currency(Functions::get_currency_exchange(($tour['price']['adults'] - (($tour['discount']['amount'] * $tour['price']['adults']) / 100)), 'USD', 'MXN'), 'MXN') : Functions::get_formatted_currency(Functions::get_currency_exchange(($tour['price']['adults'] - $tour['discount']['amount']), 'USD', 'MXN'), 'MXN'),
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
