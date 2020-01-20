<?php

defined('_EXEC') or die;

class Contact_controller extends Controller
{
	private $page;
	private $lang;

	public function __construct()
	{
		parent::__construct();

		$this->page = 'contact';
		$this->lang = Session::get_value('vkye_lang');
	}

	public function index()
	{
		if (Format::exist_ajax_request() == true)
        {
			if ($_POST['action'] == 'contact')
			{
				$errors = [];

	            if (!isset($_POST['firstname']) OR empty($_POST['firstname']))
	                array_push($errors, ['firstname', '{$lang.dont_leave_this_field_empty}']);

	            if (!isset($_POST['lastname']) OR empty($_POST['lastname']))
	                array_push($errors, ['lastname', '{$lang.dont_leave_this_field_empty}']);

	            if (!isset($_POST['subject']) OR empty($_POST['subject']))
	                array_push($errors, ['subject', '{$lang.dont_leave_this_field_empty}']);

	            if (!isset($_POST['email']) OR empty($_POST['email']))
	                array_push($errors, ['email', '{$lang.dont_leave_this_field_empty}']);
	            else if (Functions::check_email($_POST['email']) == false)
	                array_push($errors, ['email', '{$lang.invalid_field}']);

	            if (!isset($_POST['message']) OR empty($_POST['message']))
	                array_push($errors, ['message', '{$lang.dont_leave_this_field_empty}']);

	            if (empty($errors))
	            {
	                $mail_header  = 'MIME-Version: 1.0' . "\r\n";
					$mail_header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
					$mail_header .= 'From: ' . $_POST['firstname'] . ' ' . $_POST['lastname'] . ' <' . $_POST['email'] . '>' . "\r\n";

					mail(Session::get_value('settings')['contact']['email']['es'], $_POST['subject'], $_POST['message'], $mail_header);

					echo json_encode([
						'status' => 'success',
						'message' => '{$lang.operation_success}'
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
            define('_title', '{$lang.contact} | ' . Configuration::$web_page);

    		$template = $this->view->render($this, 'index');

    		$replace = [
    			'{$seo_title}' => '',
    			'{$seo_keywords}' => '',
    			'{$seo_description}' => ''
    		];

    		$template = $this->format->replace($replace, $template);

    		echo $template;
        }
	}
}
