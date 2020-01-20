<?php

defined('_EXEC') or die;

class Terms_controller extends Controller
{
	private $page;
	private $lang;

	public function __construct()
	{
		parent::__construct();

		$this->page = 'terms';
		$this->lang = Session::get_value('vkye_lang');
	}

	public function index()
	{
        define('_title', '{$lang.terms_and_conditions} | ' . Configuration::$web_page);

        $template = $this->view->render($this, 'index');

        $replace = [
            '{$seo_title}' => '',
            '{$seo_keywords}' => '',
            '{$seo_description}' => '',
            '{$terms_and_conditions}' => Session::get_value('settings')['terms_and_conditions'][$this->lang]
        ];

        $template = $this->format->replace($replace, $template);

        echo $template;
	}
}
