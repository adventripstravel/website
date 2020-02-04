<?php

defined('_EXEC') or die;

class Index_controller extends Controller
{
	private $page;
	private $lang;

	public function __construct()
	{
		parent::__construct();

		$this->page = 'index';
		$this->lang = Session::get_value('vkye_lang');
	}

	public function index()
	{
		if (Format::exist_ajax_request() == true)
		{
			if ($_POST['action'] == 'search_voucher')
			{
				$errors = [];

				if (!isset($_POST['token']) OR empty($_POST['token']))
					array_push($errors, ['token','{$lang.dont_leave_this_field_empty}']);
				else if ($this->model->check_exist_voucher($_POST['token']) == false)
					array_push($errors, ['token','{$lang.invalid_field}']);

				if (empty($errors))
				{
					echo json_encode([
						'status' => 'success',
						'path' => '/voucher/' . $_POST['token']
					]);
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
			define('_title', Session::get_value('settings')['seo']['titles'][$this->page][$this->lang] . ' | ' . Configuration::$web_page . ' | ' . Session::get_value('settings')['seo']['keywords'][$this->page][$this->lang]);

			$template = $this->view->render($this, 'index');

			$main_tour = $this->model->get_main_tour();

			$div_main_tour_price =
			'<div>';

			if ($main_tour['price']['type'] == 'regular')
			{
				$div_main_tour_price .=
				'<span><i class="fas fa-child"></i>' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($main_tour['price'])['childs'], $main_tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</span>
				<span><i class="fas fa-user"></i>' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($main_tour['price'])['adults'], $main_tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</span>';
			}
			else if ($main_tour['price']['type'] == 'height')
			{
				$div_main_tour_price .=
				'<span class="height">' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($main_tour['price'])['min'], $main_tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '<i class="fas fa-minus"></i>' . $main_tour['price']['height'] . ' {$lang.height}<i class="fas fa-plus"></i>' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($main_tour['price'])['max'], $main_tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</span>';
			}

			if ($main_tour['price']['discounts']['foreign']['amount'] > 0)
			{
				if ($main_tour['price']['discounts']['foreign']['type'] == '%')
				{
					$div_main_tour_price .=
					'<span class="discount">' . $main_tour['price']['discounts']['foreign']['amount'] . '% {$lang.to_discount}</span>';
				}
				else if ($main_tour['price']['discounts']['foreign']['type'] == '$')
				{
					$div_main_tour_price .=
					'<span class="discount">' . Functions::get_format_currency(Functions::get_currency_exchange($main_tour['price']['discounts']['foreign']['amount'], $main_tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . ' {$lang.to_discount}</span>';
				}
			}

			$div_main_tour_price .=
			'</div>';

			if ($main_tour['price']['discounts']['national']['amount'] > 0)
			{
				if ($main_tour['price']['discounts']['national']['type'] == '%')
				{
					$div_main_tour_price .=
					'<p>{$lang.if_you_are_mexican_get} <strong>' . $main_tour['price']['discounts']['national']['amount'] . '% </strong> {$lang.to_discount}</p>';
				}
				else if ($main_tour['price']['discounts']['national']['type'] == '$')
				{
					$div_main_tour_price .=
					'<p>{$lang.if_you_are_mexican_get} <strong>' . Functions::get_format_currency(Functions::get_currency_exchange($main_tour['price']['discounts']['national']['amount'], $main_tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</strong> {$lang.to_discount}</p>';
				}
			}

			$art_tours = '';

			foreach ($this->model->get_tours() as $value)
			{
				$art_tours .=
				'<article class="p' . $value['priority'] . '">
		            <header>
		                <figure>
		                    <img src="{$path.uploads}' . $value['cover'] . '" alt="Cover">
		                </figure>
		            </header>
		            <main>
		                <h2>' . $value['name'][$this->lang] . '</h2>
						<p>' . $value['summary'][$this->lang] . '</p>
						<span><i class="fas fa-map-marker-alt"></i>' . $value['destination'] . '</span>';

				if ($value['available'] == true)
				{
					$art_tours .=
					'<div>';

					if ($value['price']['type'] == 'regular')
					{
						$art_tours .=
						'<span><i class="fas fa-child"></i>' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($value['price'])['childs'], $value['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</span>
						<span><i class="fas fa-user"></i>' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($value['price'])['adults'], $value['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</span>';
					}
					else if ($value['price']['type'] == 'height')
					{
						$art_tours .=
						'<span class="height">' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($value['price'])['min'], $value['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '<i class="fas fa-minus"></i>' . $value['price']['height'] . ' {$lang.height}<i class="fas fa-plus"></i>' . Functions::get_format_currency(Functions::get_currency_exchange($this->model->get_price($value['price'])['max'], $value['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</span>';
					}

					if ($value['price']['discounts']['foreign']['amount'] > 0)
					{
						if ($main_tour['price']['discounts']['foreign']['type'] == '%')
						{
							$art_tours .=
							'<span class="discount">' . $value['price']['discounts']['foreign']['amount'] . '% {$lang.to_discount}</span>';
						}
						else if ($main_tour['price']['discounts']['foreign']['type'] == '$')
						{
							$art_tours .=
							'<span class="discount">' . Functions::get_format_currency(Functions::get_currency_exchange($value['price']['discounts']['foreign']['amount'], $value['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . ' {$lang.to_discount}</span>';
						}
					}

					$art_tours .=
					'</div>';

					if ($value['price']['discounts']['national']['amount'] > 0)
					{
						if ($value['price']['discounts']['national']['type'] == '%')
						{
							$art_tours .=
							'<p>{$lang.if_you_are_mexican_get} <strong>' . $value['price']['discounts']['national']['amount'] . '%</strong> {$lang.to_discount}</p>';
						}
						else if ($value['price']['discounts']['national']['type'] == '$')
						{
							$art_tours .=
							'<p>{$lang.if_you_are_mexican_get} <strong>' . Functions::get_format_currency(Functions::get_currency_exchange($value['price']['discounts']['national']['amount'], $value['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) . '</strong> {$lang.to_discount}</p>';
						}
					}
				}

				$art_tours .=
				'		<a href="/booking/' . Functions::get_cleaned_string_to_url($value['name'][$this->lang]) . '/' . $value['id'] . '">' . (($value['available'] == true) ? '{$lang.book_now}' : '{$lang.not_available} | {$lang.view_more}') . '</a>
					</main>
		        </article>';
			}

			$replace = [
				'{$seo_title}' => Session::get_value('settings')['seo']['titles'][$this->page][$this->lang],
				'{$seo_keywords}' => Session::get_value('settings')['seo']['keywords'][$this->page][$this->lang],
				'{$seo_description}' => Session::get_value('settings')['seo']['descriptions'][$this->page][$this->lang],
				'{$main_tour_cover}' => '{$path.uploads}' . $main_tour['cover'],
				'{$main_tour_name}' => $main_tour['name'][$this->lang],
				'{$main_tour_summary}' => $main_tour['summary'][$this->lang],
				'{$main_tour_destination}' => $main_tour['destination'],
				'{$div_main_tour_price}' => $div_main_tour_price,
				'{$main_tour_url}' => '/booking/' . Functions::get_cleaned_string_to_url($main_tour['name'][$this->lang]) . '/' . $main_tour['id'],
				'{$art_tours}' => $art_tours
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
