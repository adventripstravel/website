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

                    if (!empty($_POST['childs']) AND $_POST['childs'] < 0)
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

                // if ($_POST['action'] == 'create_booking')
                // {
				// 	$errors = [];
				//
                //     if (!empty($_POST['childs']) AND $_POST['childs'] < 0)
                //         array_push($errors, ['childs','{$lang.invalid_field}']);
				//
                //     if (!isset($_POST['adults']) or empty($_POST['adults']))
                //         array_push($errors, ['adults','{$lang.dont_leave_this_field_empty}']);
                //     else if ($_POST['adults'] < 1)
                //         array_push($errors, ['adults','{$lang.invalid_field}']);
				//
                //     if (!isset($_POST['date']) OR empty($_POST['date']))
                //         array_push($errors, ['date','{$lang.dont_leave_this_field_empty}']);
                //     else if ($_POST['date'] < Functions::get_current_date())
                //         array_push($errors, ['date','{$lang.invalid_field}']);
				//
                //     if (!isset($_POST['firstname']) OR empty($_POST['firstname']))
                //         array_push($errors, ['firstname','{$lang.dont_leave_this_field_empty}']);
				//
                //     if (!isset($_POST['lastname']) OR empty($_POST['lastname']))
                //         array_push($errors, ['lastname','{$lang.dont_leave_this_field_empty}']);
				//
                //     if (!isset($_POST['email']) OR empty($_POST['email']))
                //         array_push($errors, ['email','{$lang.dont_leave_this_field_empty}']);
                //     else if (Functions::check_email($_POST['email']) == false)
                //         array_push($errors, ['email','{$lang.invalid_field}']);
				//
                //     if (!isset($_POST['phone_lada']) OR empty($_POST['phone_lada']))
                //         array_push($errors, ['phone_lada','{$lang.dont_leave_this_field_empty}']);
				//
                //     if (!isset($_POST['phone_number']) OR empty($_POST['phone_number']))
                //         array_push($errors, ['phone_number','{$lang.dont_leave_this_field_empty}']);
				//
                //     if (empty($errors))
                //     {
				// 		$_POST['tour'] = $tour;
				// 		$_POST['language'] = $this->lang;
				//
                //         $query = $this->model->create_booking($_POST);
				//
                //         if (!empty($query))
                //         {
				// 			$mail_header  = 'MIME-Version: 1.0' . "\r\n";
				// 			$mail_header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				// 			$mail_header .= 'From: ' . $query['firstname'] . ' ' . $query['lastname'] . ' <' . $query['email'] . '>' . "\r\n";
				// 			$mail_body =
				// 			'Excursión: ' . $tour['name']['es'] . '
				// 			Niños: ' . $query['paxes']['childs'] . ' Paxes<br>
				// 			Adultos: ' . $query['paxes']['adults'] . ' Paxes<br>
				// 			Fecha: ' . Functions::get_format_date($query['booked_date'], 'd/m/Y') . '<br>
				// 			Nombre: ' . $query['firstname'] . ' ' . $query['lastname'] . '<br>
				// 			Correo electrónico: ' . $query['email'] . '<br>
				// 			Teléfono: ' . $query['phone']['lada'] . ' ' . $query['phone']['number'] . '<br>
				// 			Observaciones: ' . $query['observations'] . '<br>
				// 			Total: ' . Functions::get_format_currency(Functions::get_currency_exchange($query['total'], 'USD', Session::get_value('currency')), Session::get_value('currency')) . '<br>
				// 			Número de reservación: ' . $query['token'] . '<br>
				// 			Idioma de reservación: ' . $query['language'] . '<br>';
				//
				// 			mail(Session::get_value('settings')['contact']['email']['es'], 'Nueva reservación', $mail_body, $mail_header);
				//
				// 			echo json_encode([
            	// 				'status' => 'success',
				// 				'message' => '{$lang.booking_operation_success}'
            	// 			]);
                //         }
                //         else
                //         {
                //             echo json_encode([
            	// 				'status' => 'error',
            	// 				'errors' => '{$lang.operation_error}'
            	// 			]);
                //         }
                //     }
                //     else
                //     {
                //         echo json_encode([
        		// 			'status' => 'error',
        		// 			'errors' => $errors
        		// 		]);
                //     }
                // }
    		}
    		else
    		{
    			define('_title', $tour['name'][$this->lang] . ' | ' . Configuration::$web_page . ' | ' . $tour['seo']['keywords'][$this->lang]);

    			$template = $this->view->render($this, 'index');

				$div_price = '';

				if ($tour['available'] == true)
				{
					$div_price .=
					'<div>';

					if ($tour['price']['type'] == 'regular')
					{
						$div_price .=
						'<span><i class="fas fa-child"></i>' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($tour['price'], 'foreign')['childs'], $tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</span>
						<span><i class="fas fa-user"></i>' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($tour['price'], 'foreign')['adults'], $tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</span>';
					}
					else if ($tour['price']['type'] == 'height')
					{
						$div_price .=
						'<span class="height">' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($tour['price'], 'foreign')['min'], $tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '<i class="fas fa-minus"></i>' . $tour['price']['height'] . ' {$lang.height}<i class="fas fa-plus"></i>' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($tour['price'], 'foreign')['max'], $tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</span>';
					}

					if ($tour['price']['discounts']['foreign']['amount'] > 0)
					{
						if ($tour['price']['discounts']['foreign']['type'] == '%')
						{
							$div_price .=
							'<span class="discount">' . $tour['price']['discounts']['foreign']['amount'] . '% {$lang.to_discount}</span>';
						}
						else if ($tour['price']['discounts']['foreign']['type'] == '$')
						{
							$div_price .=
							'<span class="discount">' . Functions::get_format_currency(Functions::get_currency_exchange($tour['price']['discounts']['foreign']['amount'], $tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . ' {$lang.to_discount}</span>';
						}
					}

					$div_price .=
					'</div>';

					if ($tour['price']['discounts']['national']['amount'] > 0)
					{
						if ($tour['price']['discounts']['national']['type'] == '%')
						{
							$div_price .=
							'<p>{$lang.if_you_are_mexican_get} <strong>' . $tour['price']['discounts']['national']['amount'] . '%</strong> {$lang.to_discount}</p>';
						}
						else if ($tour['price']['discounts']['national']['type'] == '$')
						{
							$div_price .=
							'<p>{$lang.if_you_are_mexican_get} <strong>' . Functions::get_format_currency(Functions::get_currency_exchange($tour['price']['discounts']['national']['amount'], $tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</strong> {$lang.to_discount}</p>';
						}
					}
				}

				$stn_schedules = '';

				if ($tour['available'] == true)
				{
					$stn_schedules .=
					'<section class="bk-st-2">
				        <div class="container">
				            <div id="map" data-departure-title="{$lang.departure}" data-departure-lat="' . $tour['schedules']['departure']['place']['lat'] . '" data-departure-lng="' . $tour['schedules']['departure']['place']['lng'] . '" data-arrival-title="{$lang.arrival}" data-arrival-lat="' . $tour['schedules']['arrival']['place']['lat'] . '" data-arrival-lng="' . $tour['schedules']['arrival']['place']['lng'] . '" data-return-title="{$lang.return}" data-return-lat="' . $tour['schedules']['return']['place']['lat'] . '" data-return-lng="' . $tour['schedules']['return']['place']['lng'] . '"></div>
				            <div>
				                <div>
				                    <h6>{$lang.departure}</h6>
				                    <span><i class="fas fa-clock"></i>' . $tour['schedules']['departure']['hour'][$this->lang] . '</span>
				                    <span><i class="fas fa-map-marker-alt"></i>' . $tour['schedules']['departure']['place']['name'][$this->lang] . '</span>
				                </div>
				                <div>
				                    <h6>{$lang.arrival}</h6>
				                    <span><i class="fas fa-clock"></i>' . $tour['schedules']['arrival']['hour'][$this->lang] . '</span>
				                    <span><i class="fas fa-map-marker-alt"></i>' . $tour['schedules']['arrival']['place']['name'][$this->lang] . '</span>
				                </div>
				                <div>
				                    <h6>{$lang.return}</h6>
				                    <span><i class="fas fa-clock"></i>' . $tour['schedules']['return']['hour'][$this->lang] . '</span>
				                    <span><i class="fas fa-map-marker-alt"></i>' . $tour['schedules']['return']['place']['name'][$this->lang] . '</span>
				                </div>
				            </div>
				        </div>
				    </section>';
				}

                $stn_gallery = '';

				if (!empty($tour['gallery']))
				{
					$stn_gallery .=
					'<section class="bk-st-4">';

					foreach ($tour['gallery'] as $value)
	                {
	                    $stn_gallery .=
	                    '<figure>
	                        <img src="{$path.uploads}' . $value . '" alt="Gallery">
							<a href="{$path.uploads}' . $value . '" class="fancybox-thumb" rel="fancybox-thumb"><i class="fas fa-search-plus"></i></a>
	                    </figure>';
	                }

					$stn_gallery .=
					'</section>';
				}

				$stn_book_now = '';

				if ($tour['available'] == true)
				{
					$stn_book_now .=
					'<section class="bk-st-5">
				        <div class="container">
				            <h6>¡{$lang.book_now}!</h6>
				            <form name="create_booking">
				                <fieldset class="fields-group">
				                    <div class="warning">
				                        <p><span class="required-field">*</span>{$lang.required_fields}</p>
				                    </div>
				                </fieldset>
				                <fieldset class="fields-group">
				                    <div class="row">';

					if ($tour['price']['type'] == 'regular')
					{
						$stn_book_now .=
						'<div class="span2">
    						<div class="text">
    							<h6>{$lang.babies}</h6>
    							<input type="number" name="babies" value="0" min="0">
    						</div>
    						<div class="caption">
    							<p>' . $tour['price']['ages']['babies']['min'] . ' - ' . $tour['price']['ages']['babies']['max'] . ' {$lang.years}: {$lang.free}</p>
    						</div>
    					</div>
    					<div class="span2">
    						<div class="text">
    							<h6>{$lang.childs}</h6>
    							<input type="number" name="childs" value="0" min="0">
    						</div>
    						<div class="caption">
    							<p>' . $tour['price']['ages']['childs']['min'] . ' - ' . $tour['price']['ages']['childs']['max'] . ' {$lang.years}: ' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($tour['price'], 'foreign')['childs'], $tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</p>
    						</div>
    					</div>
    					<div class="span2">
    						<div class="text">
    							<h6><span class="required-field">*</span>{$lang.adults}</h6>
    							<input type="number" name="adults" value="1" min="1">
    						</div>
    						<div class="caption">
    							<p>' . $tour['price']['ages']['adults']['min'] . ' - ' . $tour['price']['ages']['adults']['max'] . ' {$lang.years}: ' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($tour['price'], 'foreign')['adults'], $tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</p>
    						</div>
    					</div>';
					}
					else if ($tour['price']['type'] == 'height')
					{
						$stn_book_now .=
						'<div class="span9">
    						<div class="text">
    							<h6><span class="required-field">*</span>{$lang.persons_number}</h6>
    							<input type="number" name="paxes" value="1" min="1">
								<span>';

						if ($tour['price']['discounts']['foreign']['amount'] > 0)
						{
							if ($tour['price']['discounts']['foreign']['type'] == '%')
							{
								$stn_book_now .=
								$tour['price']['discounts']['foreign']['amount'] . '% {$lang.to_discount}';
							}
							else if ($tour['price']['discounts']['foreign']['type'] == '$')
							{
								$stn_book_now .=
								Functions::get_format_currency(Functions::get_currency_exchange($tour['price']['discounts']['foreign']['amount'], $tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . ' {$lang.to_discount}';
							}
						}

						$stn_book_now .=
						'		</span>
							</div>
    						<div class="caption">
    							<p>{$lang.less_than} ' . $tour['price']['height'] . ' {$lang.height}: ' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($tour['price'], 'foreign')['min'], $tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . ', {$lang.higher_than} ' . $tour['price']['height'] . ' {$lang.height}: ' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($tour['price'], 'foreign')['max'], $tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . ', ' . $tour['price']['ages']['babies']['min'] . ' - ' . $tour['price']['ages']['babies']['max'] . ' {$lang.years}: {$lang.free}.</p>
    						</div>';

						if ($tour['price']['discounts']['national']['amount'] > 0)
						{
							$stn_book_now .=
							'<div class="checkbox">
								<span>{$lang.request_national_discount}</span>
								<input type="checkbox">
							</div>';
						}

						$stn_book_now .=
    					'</div>';
					}

					$stn_book_now .=
				    '<div class="span3">
                        <div class="text">
                            <h6><span class="required-field">*</span>{$lang.date}</h6>
                            <input type="date" name="date" value="' . Functions::get_current_date() . '" min="' . Functions::get_current_date() . '">
                        </div>
                    </div>';

					if ($tour['price']['type'] == 'regular')
					{
						$stn_book_now .=
						'<div class="span3">
							<div class="text">
								<h6>{$lang.total}</h6>
								<input type="text" name="total" value="' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($tour['price'], 'foreign')['adults'], $tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '" disabled>
								<span>';

						if ($tour['price']['discounts']['foreign']['amount'] > 0)
						{
							if ($tour['price']['discounts']['foreign']['type'] == '%')
							{
								$stn_book_now .=
								$tour['price']['discounts']['foreign']['amount'] . '% {$lang.to_discount}';
							}
							else if ($tour['price']['discounts']['foreign']['type'] == '$')
							{
								$stn_book_now .=
								Functions::get_format_currency(Functions::get_currency_exchange($tour['price']['discounts']['foreign']['amount'], $tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . ' {$lang.to_discount}';
							}
						}

						$stn_book_now .=
						'	</span>
						</div>';

						if ($tour['price']['discounts']['national']['amount'] > 0)
						{
							$stn_book_now .=
							'	<div class="checkbox">
									<span>{$lang.apply_national_discount}</span>
									<input type="checkbox" name="apply_national_discount">
								</div>
							</div>';
						}
					}

					$stn_book_now .=
				    '                </div>
				                </fieldset>
				                <fieldset class="fields-group">
				                    <div class="row">
				                        <div class="span6">
				                            <div class="text">
				                                <h6><span class="required-field">*</span>{$lang.firstname}</h6>
				                                <input type="text" name="firstname">
				                            </div>
				                        </div>
				                        <div class="span6">
				                            <div class="text">
				                                <h6><span class="required-field">*</span>{$lang.lastname}</h6>
				                                <input type="text" name="lastname">
				                            </div>
				                        </div>
				                    </div>
				                </fieldset>
				                <fieldset class="fields-group">
				                    <div class="row">
				                        <div class="span6">
				                            <div class="text">
				                                <h6><span class="required-field">*</span>{$lang.email}</h6>
				                                <input type="email" name="email">
				                            </div>
				                        </div>
				                        <div class="span2">
				                            <div class="text">
				                                <h6><span class="required-field">*</span>{$lang.lada}</h6>
				                                <select name="phone_lada">
				                                    <option value="" hidden>{$lang.select}</option>';

					foreach ($this->model->get_phone_ladas() as $value)
	                    $stn_book_now .= '<option value="' . $value['code'] . '">' . $value['name'][$this->lang] . ' (+' . $value['code'] . ')</option>';

					$stn_book_now .=
				    '                            </select>
				                            </div>
				                        </div>
				                        <div class="span4">
				                            <div class="text">
				                                <h6><span class="required-field">*</span>{$lang.phone}</h6>
				                                <input type="text" name="phone_number">
				                            </div>
				                        </div>
				                    </div>
				                </fieldset>
				                <fieldset class="fields-group">
				                    <div class="text">
				                        <h6>{$lang.observations}</h6>
				                        <textarea name="observations"></textarea>
				                    </div>
				                </fieldset>
				                <fieldset class="fields-group">
				                    <div class="warning">
				                        <p>{$lang.booking_accept_terms_and_conditions} <a href="/terms" target="_blank">{$lang.terms_and_conditions}</a></p>
				                    </div>
				                </fieldset>
				                <fieldset class="fields-group">
				                    <div class="button">
				                        <button type="submit">{$lang.book}</button>
				                    </div>
				                </fieldset>
				            </form>
				        </div>
				    </section>';
				}

				$art_main_tours = '';

				foreach ($this->model->get_main_tours($params[1]) as $value)
				{
					$art_main_tours .=
					'<article>
						<main data-image-src="{$path.uploads}' . $value['cover'] . '">
							<h2>' . $value['name'][$this->lang] . '</h2>
							<p>' . $value['summary'][$this->lang] . '</p>
							<span><i class="fas fa-map-marker-alt"></i>' . $value['destination'] . '</span>';

					if ($value['available'] == true)
					{
						$art_main_tours .=
						'<div>';

						if ($value['price']['type'] == 'regular')
						{
							$art_main_tours .=
							'<span><i class="fas fa-child"></i>' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($value['price'], 'foreign')['childs'], $value['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</span>
							<span><i class="fas fa-user"></i>' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($value['price'], 'foreign')['adults'], $value['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</span>';
						}
						else if ($value['price']['type'] == 'height')
						{
							$art_main_tours .=
							'<span class="height">' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($value['price'], 'foreign')['min'], $value['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '<i class="fas fa-minus"></i>' . $value['price']['height'] . ' {$lang.height}<i class="fas fa-plus"></i>' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($value['price'], 'foreign')['max'], $value['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</span>';
						}

						if ($value['price']['discounts']['foreign']['amount'] > 0)
						{
							if ($value['price']['discounts']['foreign']['type'] == '%')
							{
								$art_main_tours .=
								'<span class="discount">' . $value['price']['discounts']['foreign']['amount'] . '% {$lang.to_discount}</span>';
							}
							else if ($value['price']['discounts']['foreign']['type'] == '$')
							{
								$art_main_tours .=
								'<span class="discount">' . Functions::get_format_currency(Functions::get_currency_exchange($value['price']['discounts']['foreign']['amount'], $value['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . ' {$lang.to_discount}</span>';
							}
						}

						$art_main_tours .=
						'</div>';

						if ($value['price']['discounts']['national']['amount'] > 0)
						{
							if ($value['price']['discounts']['national']['type'] == '%')
							{
								$art_main_tours .=
								'<p>{$lang.if_you_are_mexican_get} <strong>' . $value['price']['discounts']['national']['amount'] . '%</strong> {$lang.to_discount}</p>';
							}
							else if ($value['price']['discounts']['national']['type'] == '$')
							{
								$art_main_tours .=
								'<p>{$lang.if_you_are_mexican_get} <strong>' . Functions::get_format_currency(Functions::get_currency_exchange($value['price']['discounts']['national']['amount'], $value['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</strong> {$lang.to_discount}</p>';
							}
						}
					}

					$art_main_tours .=
					'		<a href="/booking/' . Functions::get_cleaned_string_to_url($value['name'][$this->lang]) . '/' . $value['id'] . '">' . (($value['available'] == true) ? '{$lang.book_now}' : '{$lang.not_available} | {$lang.view_more}') . '</a>
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
					'{$destination}' => $tour['destination'],
					'{$div_price}' => $div_price,
					'{$stn_schedules}' => $stn_schedules,
    				'{$description}' => $tour['description'][$this->lang],
    				'{$stn_gallery}' => $stn_gallery,
					'{$stn_book_now}' => $stn_book_now,
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
