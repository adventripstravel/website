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

			$art_tours = '';

			foreach ($this->model->get_tours() as $value)
			{
				$art_tours .=
				'<article class="p-' . $value['priority'] . '">
		            <header>
		                <figure>
		                    <img src="{$path.uploads}' . $value['cover'] . '" alt="Cover">
		                </figure>
		            </header>
		            <main>
		                <h4>' . $value['name'][$this->lang] . '</h4>
						<p>' . $value['summary'][$this->lang] . '</p>
						<span><i class="fas fa-globe-americas"></i>' . $value['destination'] . '</span>
						<div>
							<span><i class="fas fa-baby"></i>' . Functions::get_format_currency(Functions::get_currency_exchange($value['price']['child'], 'USD', Session::get_value('currency')), Session::get_value('currency')) . '</span>
							<span><i class="fas fa-male"></i>' . Functions::get_format_currency(Functions::get_currency_exchange($value['price']['adult'], 'USD', Session::get_value('currency')), Session::get_value('currency')) . '</span>
						</div>
						<a href="/booking/' . Functions::get_cleaned_string_to_url($value['name'][$this->lang]) . '/' . $value['id'] . '">{$lang.book} | {$lang.view_more}</a>
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
				'{$main_tour_child_price}' => Functions::get_format_currency(Functions::get_currency_exchange($main_tour['price']['child'], 'USD', Session::get_value('currency')), Session::get_value('currency')),
				'{$main_tour_adult_price}' => Functions::get_format_currency(Functions::get_currency_exchange($main_tour['price']['adult'], 'USD', Session::get_value('currency')), Session::get_value('currency')),
				'{$main_tour_destination}' => $main_tour['destination'],
				'{$main_tour_url}' => '/booking/' . Functions::get_cleaned_string_to_url($main_tour['name'][$this->lang]) . '/' . $main_tour['id'],
				'{$art_tours}' => $art_tours
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
