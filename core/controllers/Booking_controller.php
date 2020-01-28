<?php

defined('_EXEC') or die;

class Booking_controller extends Controller
{
	private $page;
	private $lang;

	public function __construct()
	{
		parent::__construct();

		$this->page = 'booking';
		$this->lang = Session::get_value('vkye_lang');
	}

	public function index($params)
	{
        $tour = $this->model->get_tour($params[1]);

        if (!empty($tour))
        {
            if (Format::exist_ajax_request() == true)
    		{
                if ($_POST['action'] == 'get_total')
    			{
    				$errors = [];

                    if ($_POST['childs'] < 0)
                        array_push($errors, ['childs','{$lang.invalid_field}']);

                    if (!isset($_POST['adults']) OR empty($_POST['adults']))
                        array_push($errors, ['adults','{$lang.dont_leave_this_field_empty}']);
                    else if ($_POST['adults'] < 1)
                        array_push($errors, ['adults','{$lang.invalid_field}']);

                    if (empty($errors))
                    {
						$_POST['tour'] = $tour;

                        $query = $this->model->get_total($_POST);

						if (!empty($query))
						{
							echo json_encode([
								'status' => 'success',
								'data' => [
									'total' => Functions::get_format_currency(Functions::get_currency_exchange($query, 'USD', Session::get_value('currency')), Session::get_value('currency'))
								]
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

                if ($_POST['action'] == 'new_booking')
                {
					$errors = [];

                    if ($_POST['childs'] < 0)
                        array_push($errors, ['childs','{$lang.invalid_field}']);

                    if (!isset($_POST['adults']) OR empty($_POST['adults']))
                        array_push($errors, ['adults','{$lang.dont_leave_this_field_empty}']);
                    else if ($_POST['adults'] < 1)
                        array_push($errors, ['adults','{$lang.invalid_field}']);

                    if (!isset($_POST['date']) OR empty($_POST['date']))
                        array_push($errors, ['adults','{$lang.dont_leave_this_field_empty}']);
                    else if ($_POST['date'] < Functions::get_future_date(Functions::get_current_date(), '1', 'days'))
                        array_push($errors, ['adults','{$lang.invalid_field}']);

                    if (!isset($_POST['firstname']) OR empty($_POST['firstname']))
                        array_push($errors, ['firstname','{$lang.dont_leave_this_field_empty}']);

                    if (!isset($_POST['lastname']) OR empty($_POST['lastname']))
                        array_push($errors, ['lastname','{$lang.dont_leave_this_field_empty}']);

                    if (!isset($_POST['email']) OR empty($_POST['email']))
                        array_push($errors, ['email','{$lang.dont_leave_this_field_empty}']);
                    else if (Functions::check_email($_POST['email']) == false)
                        array_push($errors, ['email','{$lang.invalid_field}']);

                    if (!isset($_POST['phone_lada']) OR empty($_POST['phone_lada']))
                        array_push($errors, ['phone_lada','{$lang.dont_leave_this_field_empty}']);

                    if (!isset($_POST['phone_number']) OR empty($_POST['phone_number']))
                        array_push($errors, ['phone_number','{$lang.dont_leave_this_field_empty}']);

                    if (empty($errors))
                    {
						$_POST['tour'] = $tour;
						$_POST['language'] = $this->lang;

                        $query = $this->model->new_booking($_POST);

                        if (!empty($query))
                        {
							$mail_header  = 'MIME-Version: 1.0' . "\r\n";
							$mail_header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
							$mail_header .= 'From: ' . $query['firstname'] . ' ' . $query['lastname'] . ' <' . $query['email'] . '>' . "\r\n";
							$mail_body =
							'Tour: ' . $tour['name']['es'] . '
							Niños: ' . $query['paxes']['childs'] . ' Paxes<br>
							Adultos: ' . $query['paxes']['adults'] . ' Paxes<br>
							Fecha: ' . Functions::get_format_date($query['booked_date'], 'd/m/Y') . '<br>
							Nombre: ' . $query['firstname'] . ' ' . $query['lastname'] . '<br>
							Correo electrónico: ' . $query['email'] . '<br>
							Teléfono: ' . $query['phone']['lada'] . ' ' . $query['phone']['number'] . '<br>
							Observaciones: ' . $query['observations'] . '<br>
							Total: ' . Functions::get_format_currency(Functions::get_currency_exchange($query['total'], 'USD', Session::get_value('currency')), Session::get_value('currency')) . '<br>
							Número de reservación: ' . $query['token'] . '<br>
							Idioma: ' . $query['language'] . '<br>';

							mail(Session::get_value('settings')['contact']['email']['es'], 'Nueva reservación', $mail_body, $mail_header);

							echo json_encode([
            					'status' => 'success',
								'message' => '{$lang.booking_operation_success}'
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
    			define('_title', $tour['name'][$this->lang] . ' | ' . Configuration::$web_page . ' | ' . $tour['seo']['keywords'][$this->lang]);

    			$template = $this->view->render($this, 'index');

                $fge_gallery = '';

				if (!empty($tour['gallery']))
				{
					$fge_gallery .=
					'<section class="bk-st-4">';

					foreach ($tour['gallery'] as $value)
	                {
	                    $fge_gallery .=
	                    '<figure>
	                        <img src="{$path.uploads}' . $value . '" alt="Gallery">
							<a href="{$path.uploads}' . $value . '" class="fancybox-thumb" rel="fancybox-thumb"><i class="fas fa-search-plus"></i></a>
	                    </figure>';
	                }

					$fge_gallery .=
					'</section>';
				}

                $opt_ladas = '';

                foreach ($this->model->get_ladas() as $value)
                    $opt_ladas .= '<option value="' . $value['code'] . '">' . $value['name'][$this->lang] . ' (+' . $value['code'] . ')</option>';

				$art_main_tours = '';

				foreach ($this->model->get_main_tours($params[1]) as $value)
				{
					$art_main_tours .=
					'<article>
						<main data-image-src="{$path.uploads}' . $value['cover'] . '">
							<h2>' . $value['name'][$this->lang] . '</h2>
							<p>' . $value['summary'][$this->lang] . '</p>
							<span><i class="fas fa-map-marker-alt"></i>' . $value['destination'] . '</span>
							<div>
								<span><i class="fas fa-baby"></i>' . Functions::get_format_currency(Functions::get_currency_exchange($value['price']['child'], 'USD', Session::get_value('currency')), Session::get_value('currency')) . '</span>
								<span><i class="fas fa-male"></i>' . Functions::get_format_currency(Functions::get_currency_exchange($value['price']['adult'], 'USD', Session::get_value('currency')), Session::get_value('currency')) . '</span>
							</div>
							<a href="/booking/' . Functions::get_cleaned_string_to_url($value['name'][$this->lang]) . '/' . $value['id'] . '">{$lang.book} | {$lang.view_more}</a>
						</main>
					</article>';
				}

    			$replace = [
    				'{$seo_title}' => $tour['name'][$this->lang],
    				'{$seo_keywords}' => $tour['seo']['keywords'][$this->lang],
    				'{$seo_description}' => $tour['seo']['description'][$this->lang],
                    '{$cover}' => '{$path.uploads}' . $tour['cover'],
    				'{$name}' => $tour['name'][$this->lang],
					'{$summary}' => $tour['summary'][$this->lang],
					'{$child_price}' => Functions::get_format_currency(Functions::get_currency_exchange($tour['price']['child'], 'USD', Session::get_value('currency')), Session::get_value('currency')),
					'{$adult_price}' => Functions::get_format_currency(Functions::get_currency_exchange($tour['price']['adult'], 'USD', Session::get_value('currency')), Session::get_value('currency')),
                    '{$destination}' => $tour['destination'],
					'{$schedule_departure_hour}' => $tour['schedules']['departure']['hour'][$this->lang],
					'{$schedule_departure_place_name}' => $tour['schedules']['departure']['place']['name'][$this->lang],
					'{$schedule_departure_place_lat}' => $tour['schedules']['departure']['place']['lat'],
					'{$schedule_departure_place_lng}' => $tour['schedules']['departure']['place']['lng'],
					'{$schedule_arrival_hour}' => $tour['schedules']['arrival']['hour'][$this->lang],
					'{$schedule_arrival_place_name}' => $tour['schedules']['arrival']['place']['name'][$this->lang],
					'{$schedule_arrival_place_lat}' => $tour['schedules']['arrival']['place']['lat'],
					'{$schedule_arrival_place_lng}' => $tour['schedules']['arrival']['place']['lng'],
					'{$schedule_return_hour}' => $tour['schedules']['return']['hour'][$this->lang],
					'{$schedule_return_place_name}' => $tour['schedules']['return']['place']['name'][$this->lang],
					'{$schedule_return_place_lat}' => $tour['schedules']['return']['place']['lat'],
					'{$schedule_return_place_lng}' => $tour['schedules']['return']['place']['lng'],
    				'{$description}' => $tour['description'][$this->lang],
    				'{$fge_gallery}' => $fge_gallery,
    				'{$opt_ladas}' => $opt_ladas,
    				'{$art_main_tours}' => $art_main_tours
    			];

    			$template = $this->format->replace($replace, $template);

    			echo $template;
    		}
        }
        else
            header('Location: /');
	}
}
