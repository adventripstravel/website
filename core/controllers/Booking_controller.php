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

	/* Ajax 1: Get map
	** Ajax 2: Get availability
	** Ajax 3: Get total
	** Ajax 4: Booking
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
						'location' => $tour['location'],
						'transportation' => !empty($tour['transportation']) ? $tour['transportation'] : []
					]
				]);
			}

			if ($_POST['action'] == 'get_availability')
			{
				if (!empty($tour['availability']))
				{
					$availability = $this->model->get_availability($tour['id'], $_POST['date'], $tour['availability']);

					if (!empty($availability) AND $availability > 0)
						$availability = $availability . ' paxs {$lang.availables}';
					else
						$availability = '{$lang.not_available}';
				}
				else
					$availability = '';

				echo json_encode([
					'status' => 'success',
					'data' => $availability
				]);
			}

			if ($_POST['action'] == 'get_total')
			{
				$total = ($_POST['adults'] * $tour['price']['adults']) + ($_POST['children'] * $tour['price']['children']);

				if ($tour['discount']['type'] == '%')
					$total = $total - (($tour['discount']['amount'] * $total) / 100);
				else if ($tour['discount']['type'] == '$')
					$total = $total - $tour['discount']['amount'];

				if ($this->lang = 'es')
					$total = Functions::get_formatted_currency('MXN', Functions::get_currency_exchange('USD', 'MXN', $total));
				else if ($this->lang = 'en')
					$total = Functions::get_formatted_currency('USD', $total);

				echo json_encode([
					'status' => 'success',
					'data' => $total
				]);
			}

			if ($_POST['action'] == 'booking')
			{
				$errors = [];

				if (!isset($_POST['date']) OR empty($_POST['date']))
					array_push($errors, ['date','{$lang.dont_leave_this_field_empty}']);
				else if ($_POST['date'] <= Functions::get_date())
					array_push($errors, ['date','{$lang.data_invalid}']);
				else if (!empty($tour['availability']) AND ($_POST['adults'] + $_POST['children']) > $this->model->get_availability($tour['id'], $_POST['date'], $tour['availability']))
					array_push($errors, ['date','{$lang.data_invalid}']);

				if (!isset($_POST['adults']) OR empty($_POST['adults']))
					array_push($errors, ['adults','{$lang.dont_leave_this_field_empty}']);
				else if ($_POST['adults'] < 1)
					array_push($errors, ['adults','{$lang.data_invalid}']);

				if (!empty($_POST['children']) AND $_POST['children'] < 0)
					array_push($errors, ['children','{$lang.data_invalid}']);

				if (!isset($_POST['firstname']) OR empty($_POST['firstname']))
					array_push($errors, ['firstname','{$lang.dont_leave_this_field_empty}']);

				if (!isset($_POST['lastname']) OR empty($_POST['lastname']))
					array_push($errors, ['lastname','{$lang.dont_leave_this_field_empty}']);

				if (!isset($_POST['lada']) OR empty($_POST['lada']))
					array_push($errors, ['phone','{$lang.dont_leave_this_field_empty}']);

				if (!isset($_POST['phone']) OR empty($_POST['phone']))
					array_push($errors, ['phone','{$lang.dont_leave_this_field_empty}']);
				else if (!is_numeric($_POST['phone']))
					array_push($errors, ['phone','{$lang.data_invalid}']);

				if (!isset($_POST['email']) OR empty($_POST['email']))
					array_push($errors, ['email','{$lang.dont_leave_this_field_empty}']);
				else if (Functions::check_email($_POST['email']) == false)
					array_push($errors, ['email','{$lang.data_invalid}']);

				if (!isset($_POST['promotional_code']) OR empty($_POST['promotional_code']))
					array_push($errors, ['promotional_code','{$lang.dont_leave_this_field_empty}']);
				else if (empty($this->model->get_airbnb($_POST['promotional_code'])))
					array_push($errors, ['promotional_code','{$lang.data_invalid}']);

				if (empty($errors))
				{
					$total = ($_POST['adults'] * $tour['price']['adults']) + ($_POST['children'] * $tour['price']['children']);

					if ($tour['discount']['type'] == '%')
						$total = $total - (($tour['discount']['amount'] * $total) / 100);
					else if ($tour['discount']['type'] == '$')
						$total = $total - $tour['discount']['amount'];

					$airbnb = $this->model->get_airbnb($_POST['promotional_code']);
					$provider = $this->model->get_provider($tour['provider']);

					$data = [
						'payment' => [
							'item_name' => $tour['name'][$this->lang],
							'item_number' => Functions::get_random(8),
							'amount' => $total,
							'quantity' => 1,
							'incidence_number' => Functions::get_random(8),
						],
						'tour' => $tour,
						'booking' => [
							'token' => Functions::get_random(6),
							'tour' => $tour['id'],
							'date_booking' => $_POST['date'],
							'date_booked' => Functions::get_date(),
							'paxes' => [
								'adults' => $_POST['adults'],
								'children' => $_POST['children']
							],
							'firstname' => $_POST['firstname'],
							'lastname' => $_POST['lastname'],
							'email' => $_POST['email'],
							'phone' => $_POST['phone'],
							'totals' => [
								'discount' => [
									'amount' => $tour['discount']['amount'],
									'type' => $tour['discount']['type']
								],
								'price' => [
									'adults' => $tour['price']['adults'],
									'children' => $tour['price']['children']
								],
								'total' => $total,
								'exchange_rate' => Functions::get_currency_exchange('USD', 'MXN'),
							],
							'payment' => [
								'method' => 'paypal',
								'currency' => 'USD',
								'date' => Functions::get_date_hour(),
							],
							'language' => $this->lang,
							'canceled' => false,
							'user' => $airbnb['id']
						],
						'emails' => [
							'exploore' => 'reservaciones@exploore.mx',
							'client' => $_POST['email'],
							'provider' => $provider['email'],
							'airbnb' => $airbnb['email'],
						]
					];

					$query = $this->model->new($data);

					if (!empty($query))
					{
						echo json_encode([
							'status' => 'success',
							'path' => 'https://payment.exploore.mx/index/index/' . $query
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
						'errors' => $errors
					]);
				}
			}
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

			$opt_ladas = '';

			foreach ($this->model->get_ladas() as $value)
				$opt_ladas .= '<option value="' . $value['lada'] . '">' . $value['name'][$this->lang] . ' (' . $value['lada'] . ')' . '</option>';

			$replace = [
	            '{$cover}' => '{$path.uploads}' . $tour['cover'],
	            '{$name}' => $tour['name'][$this->lang],
				'{$destination}' => $tour['destination'],
	            '{$price}' => '{$lang.adults} ' . Functions::get_formatted_currency('USD', $tour['price']['adults']) . ' & {$lang.children} ' . Functions::get_formatted_currency('USD', $tour['price']['children']) . ' <span>+ ' . (($tour['discount']['type'] == '%') ? $tour['discount']['amount'] . '%' : Functions::get_formatted_currency('USD', $tour['discount']['amount'])) . ' {$lang.to_discount_with_your_promotional_code}</span>',
				'{$discount}' => '{$lang.adults} ' . Functions::get_formatted_currency('USD', ($tour['price']['adults'] - (($tour['discount']['amount'] * $tour['price']['adults']) / 100))) . ' & {$lang.children} ' . Functions::get_formatted_currency('USD', ($tour['price']['children'] - (($tour['discount']['amount'] * $tour['price']['children']) / 100))),
				'{$description}' => $tour['description'][$this->lang],
				'{$p_observations}' => (!empty($tour['observations'])) ? '<p>' . $tour['observations'][$this->lang] . '</p>' : '',
				'{$div_gallery}' => $div_gallery,
				'{$availability}' => !empty($tour['availability']) ? $this->model->get_availability($tour['id'], Functions::get_date('sum', Functions::get_date(), '1', 'days'), $tour['availability']) . ' paxs {$lang.availables}' : '',
				'{$opt_ladas}' => $opt_ladas,
				'{$usd_total}' => ($tour['discount']['type'] == '%') ? Functions::get_formatted_currency('USD', ($tour['price']['adults'] - (($tour['discount']['amount'] * $tour['price']['adults']) / 100))) : Functions::get_formatted_currency('USD', ($tour['price']['adults'] - $tour['discount']['amount'])),
				'{$mxn_total}' => ($tour['discount']['type'] == '%') ? Functions::get_formatted_currency('MXN', Functions::get_currency_exchange('USD', 'MXN', ($tour['price']['adults'] - (($tour['discount']['amount'] * $tour['price']['adults']) / 100)))) : Functions::get_formatted_currency('MXN', Functions::get_currency_exchange('USD', 'MXN', ($tour['price']['adults'] - $tour['discount']['amount']))),
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
